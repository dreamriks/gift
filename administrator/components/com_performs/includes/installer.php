<?php
/** Class handles installation for PerForms
* @version $Id$
* @package DBInstaller
* @author David Walters
* @copyright (C) 2007 perForms
* @date 2007-2-8
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

/** \cond The code below makes doxygen 1.5.1 behave unexpectedly*/
// no direct access
defined( '_VALID_MOS' ) or die( 'Restricted access' );
global $mosConfig_absolute_path,$mosConfig_lang, $mosConfig_live_site;
if (isset($mosConfig_lang)) {
  if (file_exists($mosConfig_absolute_path.'/components/com_performs/language/'.$mosConfig_lang.'.php')) {
    include($mosConfig_absolute_path.'/components/com_performs/language/'.$mosConfig_lang.'.php');
  } else {
    include($mosConfig_absolute_path.'/components/com_performs/language/english.php');
  }
} else {
  report_error(-32768, "No Language!", "perForms is unable to find any language files!");
}

//include( $mosConfig_absolute_path . '/administrator/components/com_performs/class.performs.php' );

function HandleException( $exceptionstr ) {
  if (phpversion() > 5.0) {
//		require_once("ExceptionHandler.php");
//		ThrowException($exceptionstr);
  } else {
    echo $exceptionstr;
  }
}

define('PARSE_MODE_SQL', 1);
define('PARSE_MODE_CSV', 2);
define('PARSE_MODE_XML', 3);
/** \endcond */
/**Parses a line of text and produces ColumnDef objects from it.
* @package DBInstaller
* @author David Walters
* @date 2007-2-8
*/
class SQLColumnDefParser {
  var $table;
  var $line;
  var $strNAME;
  var $strTYPE;
  var $strNOTNULL;
  var $strSIGNED;
  var $strDEFAULT;
  var $strAUTOINC;
  var $appendbuffer;
  var $strREMAIN;
  function parse() {
    $this->line = trim($this->line);
    $line = $this->line;
    $linelength = strlen($this->line);
    $index = -1;
    while (++$index < $linelength) {
      switch ($this->line[$index]) {
        case ' ': {
          switch ( $line[++$index] ) {
            case 'a': case 'A': {
              //auto_increment
              $index += 13;
              $this->strAUTOINC = "auto_increment";
              break;
            }
            case 'd': case 'D': {
              //default
              $index += 8;
              if ($line[$index] != "'") {
                //                while (($line[$index] != " ") && ($index < $linelength)) {
                while (($index < $linelength) && ($line[$index] != " ")) {
                  $this->strDEFAULT .= $line[$index];
                  ++$index;
                }
                } else {
                  --$index;
                }
              break;
              }
            case 'n': case 'N': {
              switch ( $line[++$index] ) {
                case 'o': case 'O': {
                  $this->strNOTNULL = "NOT NULL";
                  $index += 6;
                  break;
                }
                case 'u': case 'U': {
                  $this->strNOTNULL = "NULL";
                  $index += 2;
                  break;
                }
              }
              break;
            }
            case 'u': case 'U': {
              //unsigned
              $index += 7;
              $this->strSIGNED = "unsigned";
              break;
            }
            case 's': case 'S': {
              //signed
              $index += 5;
              break;
            }
            default: {
              //              throw new Exception( "Unknown attribute found at # $index: ($line)" );
              HandleException( "Unknown attribute found at # $index: ($line)" );
              while ( (++$index < $linelength) && ($line[$index] != " ") ){
                $this->strREMAIN .= $line[$index];
              }
              break;
            }
            }
          break;
          }
        case "'": {
          $this->strDEFAULT .= "'";
          while (($line[++$index] != "'") && ($index < $linelength) ){
            $this->strDEFAULT .= $line[$index];
          }
          $this->strDEFAULT .= "'";
          break;
        }
        case "`":{
          while ($line[++$index] != "`") {
            $this->strNAME .= $line[$index];
          }
          ++$index;
          //          while ( ($line[++$index] != " ") && ($index < $linelength) ){
          while ( (++$index < $linelength) && ($line[$index] != " ") ){
            $this->strTYPE .= $line[$index];
          }
          --$index;
          break;
          }
        default: {
          $this->strREMAIN .= $line[$index];
          break;
        }
        }
        }
      }
  function SQLColumnDefParser(&$table_def, $sql_line) {
    $this->tabledef = $table_def;
    $this->line = $sql_line;
    $this->parse();
  }
  /**Creates a new ColumnDef object from the contents of the parser fields.
    @return The new ColumnDef object.
    */
  function Create() {
    return ( 
             new ColumnDef( $this->tabledef, $this->strNAME, $this->strTYPE, 
                            $this->strSIGNED, $this->strNOTNULL, 
                            $this->strDEFAULT, $this->strAUTOINC)
             );
  }
    }

/** Generic Simple Column definition (DESCRIBE jos_performs)
* @date 2007-2-8
*/
class ColumnDef {
  var $columnName; ///<The name of the column.
  var $columnType; ///<The column Type.
  var $columnSigned; ///<Shortcut method to check for a sign modifier on the type.
  var $columnNull; ///<Column NULL or NOT NULL property.
  var $columnDefault; ///<Field to hold the column default value.
  var $columnAutoInc; ///<Shortcut to the extra column, checking for auto_increment
  var $columnKey; ///<PRI if column is primary key.
  var $columnExtra; ///<Field for holding extra directives, like sign or auto_increment
  var $columnAfter; ///<Special identifier for ADD statements. The name of the column to add this column after.
  var $tableDef; ///<A reference to the parent table definition.
  function ColumnDef ( &$table_def, $column_name, $column_type, 
                       $column_signed = null, $column_null = "NULL",  
                       $column_default = null, $column_autoinc = null ) {
    $this->tableDef = $table_def;
    $this->columnName = $column_name;
    $this->columnType = $column_type;
    $this->columnSigned = $column_signed;
    $this->columnNull = $column_null;
    $this->columnDefault = $column_default;
    $this->columnAutoInc = $column_autoinc;
    $this->columnName = $column_name;
    if (isset($this->tabledef) && $this->tableDef->primaryKey == $this->columnName) $this->columnKey = "PRI";
  }
  /**
    * Creates a string containing the values this object is mapped to in a sql
   * compliant way.
   * @return A string containing a line suitable for some sort of table op.
   */
  function SQL() {
    $returnvalue = "`"
    . $this->columnName . "`"
    . " " . $this->columnType 
    . ((isset($this->columnSigned))? " " . $this->columnSigned : "")
    . ((isset($this->columnNull))? " " . $this->columnNull : "")
    . ((isset($this->columnDefault))? " DEFAULT " . $this->columnDefault : "")
    . ((isset($this->columnAutoInc))? " " . $this->columnAutoInc : "");
    return $returnvalue;
  }
  /** Creates a ColumnDef object given the file type.
    * @author David Walters
    * @date 2007-2-8
    * @return An object of type ColumnDef
    * @param tabledef The parent TableDef object.
    * @param line The line of text to parse, containing a line from a SQL ADD TABLE directive.
    * @param mode Not yet implemented. Could be used to refactor for file filters.
    * @throws Exception if $mode does not correspond to a working parser module.
    */
  function Parse ( &$tabledef, $line, $mode=PARSE_MODE_SQL ) {
    switch ($mode) {
      case PARSE_MODE_SQL: {
        $parser = new SQLColumnDefParser($tabledef, $line);
        return $parser->Create();
        break;
      }
      default: {
        HandleException ( "PARSE_MODE_SQL" );
        break;
      }
    }
  }
  /** 
    * @date 2007-2-8
    * @param addPrefix Adds the joomla db prefix, if true.
    * @return bool true if column exists
    */
  function Exists( $addPrefix = true) {
    global $database;
    if ( $addPrefix ) {
      $table = $this->tableDef->pfxTableName();
    } else {
      $table = $this->tableDef->tableName;
    }
    $sql = "SHOW COLUMNS FROM `$table` LIKE '$this->columnName'";
    $database->setQuery($sql);
    if ($database->query()){
      $result = $database->getNumRows();
      if ($result)
        return true;
    }
    return false;
  }
}

class SQLTableDefParser {
  var $tableop;
  var $tablename;
  var $tabletype;
  var $primarykey;
  var $columnDirectives;
  var $firstColumn;
  var $ccount;
  var $dcount;
  function SQLTableDefParser( $table_op ) {
    $this->tableop = $table_op;
    $this->columnDirectives = split(",", $this->tableop);
    $this->dcount = count($this->columnDirectives);
    
    $this->parse();
  }
  function parse() {
    if(!empty($this->tableop) && $this->tableop != "#") {      
      $pk_type = split("'\)", $this->columnDirectives[$this->dcount-1]);
      $pk = split("\(`", $pk_type[0]);
      $pkz = split("`", $pk[1]);
      $this->primarykey = $pkz[0];
      $typ = split("=", $pkz[1]);
      $this->tabletype = str_replace(";", "", $typ[1]);
      
      $firstline = split(" \(", $this->columnDirectives[0]);
      $tabledirectives = split(" ", $firstline[0] );
      $this->firstColumn = split(",", $firstline[1]);
      $this->tablename = trim($tabledirectives[count($tabledirectives)-1]);
      $this->tablename = str_replace("#__", "", $this->tablename);
      $this->tablename = str_replace("`", "", $this->tablename);
      
      $this->ccount = $this->dcount - 2;
    } else {
    }
  }
  function Create() {
    $td = new TableDef($this->tablename, $this->tabletype, $this->primarykey);
    $cindex = 0;
    $td->columnDefs[$cindex] = ColumnDef::Parse( $td, $this->firstColumn[0] );
    while ( ++$cindex <= $this->ccount ) {
      $td->columnDefs[$cindex] = ColumnDef::Parse( $td, trim($this->columnDirectives[$cindex]) );
      if ($cindex > 0) $td->columnDefs[$cindex]->columnAfter =
        $td->columnDefs[$cindex-1]->columnName;
    }
    return ($td);
  }
}

/**
* Generic Table definition as needed for defining a table
 * @date 2007-2-8
 */
class TableDef {
  var $tableName; ///<The table name with no joomla prefix
  var $primaryKey; ///<The column name that is the primary key.
  var $tableType; ///<The table type (TYPE=MYISAM usually)
  var $columnDefs = array();///<An array of column definition objects.
    /** Default constructor.
    * @param table_name The name to assign to the new table definition.
    * @param table_type The table type.
    * @param primary_key The name of the column which will be the primary key.
    * @since 2007-2-8
    */
    function TableDef ( $table_name, $table_type = null, $primary_key = null) {
      $this->tableName = $table_name;
      if ($table_type!=null) $this->tableType = $table_type;
      if ($primary_key != null) $this->primaryKey = $primary_key;
    }
    /**
      * @return The number of columns defined for this table.
     */
    function ColumnCount() {
      return count ( $this->columnDefs );
    }
    /**
      * @return A string appended with $mosConfig_dbprefix
     */
    function pfxTableName() {
      global $mosConfig_dbprefix;
      return $mosConfig_dbprefix.$this->tableName;
    }
    /** Checks if specified table exists in the system.
      * @param addPrefix Tablename
      * @return True or False
      */
    function Exists( $addPrefix = true) {
      global $database, $mosConfig_dbprefix;
      if ($addPrefix) {
        $table = $this->pfxTableName();
      } else {
        $table = $this->tableName;
      }
      $sql = "SHOW TABLES LIKE '$table'";
      $database->setQuery($sql);
      if ($database->query()){
        $result = $database->getNumRows();
        if ($result)
          return true;
      }
      return false;
    }
    /** Builds a TableDef object from the line of text provided.
      * @version $Id$
      * @author David Walters
      * @date 2007-2-8
      */
    function Parse($tableop, $mode=PARSE_MODE_SQL) {
      
      switch ($mode) {
        case PARSE_MODE_SQL: {
          $parser = new SQLTableDefParser($tableop);
          return $parser->Create();
          break;
        }
        default: {
          //report_error();
          break;
        }
      }
    }
}
/**Base class for all classes that prepare sql output.
*@date 2007-2-12
*A simple definition to provide a common functionality to the sql statement
* generators in this package. Useful for testing when you are running through
* a whole bunch of classes and checking that their SQL() is as expected,
* or debugging, and say, "what's the SQL?" - 
* SQL() from outside, and $sqlStatement from inside.
*/
class SQLAction {
  var $sqlStatement;
  function SQL() {
    return $this->sqlStatement;
  }
}
/**Class to rename a group of tables using two arrays of strings
* @date 2007-2-10
*
*/
class TableRenamer extends SQLAction {
  var $newnames;
  var $newtablenames;
  var $oldnames;
  var $tdef;
  function TableRenamer( $old_table_names, $new_table_names) {
    $this->oldnames = $old_table_names;
    $this->newtablenames = $new_table_names;
    $nameindex = -1;
    $namecount = count ( $old_table_names );
    $this->newnames = array();
    while (++$nameindex < $namecount) {
      $this->newnames[$old_table_names[$nameindex]] = $new_table_names[$nameindex];
    }
    $this->renameTables();
  }
  /** Adds SQL statement(s) as required to rename tables created previously
    * if they exist.
    * @param $oldnames An array of table names to rename.
    */
  function renameTables() {
    global $mosConfig_dbprefix, $isUpgrade;
    if (isset($this->newnames) && count($this->newnames) > 0) {
      $this->sqlStatement = "# -- Renaming Legacy Tables, if any.\n";
      foreach ($this->newnames as $oldname => $newname) {
        $this->tdef = new TableDef($oldname);
        if ( $this->tdef->Exists( true ) ) {
          $isUpgrade = true;
          $this->sqlStatement .= "ALTER TABLE `$mosConfig_dbprefix$oldname` RENAME `$mosConfig_dbprefix$newname`;\n";
        }
      }
    } else {
      $this->sqlStatement = "# -- No legacy tables defined.\n";
    }
    return $this->sqlStatement;
  }
}

class MigrateInfo {
  var $TableName;
  var $ColumnName;
  var $OldValue;
  var $NewValue;
  function MigrateInfo( $table_name, $column_name, $old_value, $new_value ) {
    $this->TableName = $table_name;
    $this->ColumnName = $column_name;
    $this->OldValue = $old_value;
    $this->NewValue = $new_value;
  }
  function __toString() {
    return @"MigrateInfo: $this->TableName
(
 [TableName] => $this->TableName
 [ColumnName] => $this->ColumnName
 [OldValue] => $this->OldValue
 [NewValue] => $this->NewValue
 ) 

";
  }
}

/**Builds sql to rewrite the values of existing tables for conformity.
* @date 2007-2-12
* @since 2.2.3
*/
class DataMigrator extends SQLAction {
  var $migrateInfo;
  function DataMigrator($cleaninstall = true, $MigrateInfoArray = null) {
		if (!$cleaninstall) {
			$this->migrateInfo = $MigrateInfoArray;
			$this->migrate();
			$this->migrateToUtf8();
		}
  }

  /** Takes existing user data that contains illegal searator chars and
   * appends directives to update the user tables concerned with utf-8 legal
	 * characters
   */
  function migrateToUtf8() {
		global $mosConfig_debug, $mosConfig_dbprefix, $database;
		
		$valuequery = "SELECT itemId, value from #__performs_items";
		$database->setQuery($valuequery);
		if (!$database->query()) {
			if ($mosConfig_debug) {
				echo $database->stderr(true);
			}
			return;
		}
		$valuearray = $database->loadAssocList('itemId');
		$naughtychar = "".chr(167);
		$nicechar = "".chr(31);
		foreach ($valuearray as $valId => $vals) {
			$val = $vals['value'];
			if (strpos($val, $naughtychar) === false) {
			} else {
				//replace naughtychar with nicechar
				$val = str_replace($naughtychar, $nicechar, $val);
				//replace multiple occurrences of the separator with one
				$val = preg_replace("/[".$nicechar."]+/", $nicechar, $val);
				//drop our commands in the sql statement
				$this->sqlStatement .= "#Substituting old, char 167 separators with the new 31-separators\n";
				$this->sqlStatement .= "UPDATE ".$mosConfig_dbprefix."performs_items SET value = '" .$val ."' WHERE itemId = '" .$valId ."';\n";
			}
		}
		echo "<hr />";
	}	

  /** Takes existing user data that is incompatible with the new version and 
   * appends directives to update the user tables concerned.
   */
  function migrate() {
    global $mosConfig_dbprefix;
    if (isset($this->migrateInfo) && count($this->migrateInfo) > 0) {
      $this->sqlStatement = "#Migrating User Data\n";
      foreach ($this->migrateInfo as $m) {
				$whereclause = "WHERE $m->ColumnName ";
				if ($m->OldValue != "NULL") {
					$whereclause .= "= '$m->OldValue'";
				} else {
					$whereclause .= "IS NULL";
				}
        $tdef = new TableDef($m->TableName);
        if ($tdef->Exists()) {
          $this->sqlStatement .= "UPDATE ".$mosConfig_dbprefix."$m->TableName SET $m->ColumnName = '$m->NewValue' $whereclause;\n";
        }
      }
    }
  }
}

class SchemaUpdater extends SQLAction {
  var $sqlFileLocation;
  var $cleanInstallStatements;
  var $tabledefs;
  var $pieces;
  /** Loads a sql text file and deserializes an array of TableDef objects from 
    * the statements contained in the file.
    */
  function getTableDefs() {
    if ( isset ($this->sqlFileLocation) && file_exists( $this->sqlFileLocation) ) {
      $filesize = filesize( $this->sqlFileLocation );
      $this->cleanInstallStatements = 
        fread( fopen( $this->sqlFileLocation, 'r' ), $filesize );
      $this->pieces  = sqlUtils::split_sql($this->cleanInstallStatements);
      $this->tabledefs = array();
      for ($i=0; $i<count($this->pieces); $i++) {
        $this->pieces[$i] = trim($this->pieces[$i]);
        $this->tabledefs[$i] = TableDef::Parse( $this->pieces[$i] );      
      }
    } else {
      HandleException( "Unknown gFile: $this->sqlFileLocation\n" );
    }
  }
  function updateSchema() {
    global $isUpgrade;
    if (isset($this->tabledefs) && count($this->tabledefs) > 0) {
      $this->sqlStatement = "#Updating Schema\n";
      foreach  ( $this->tabledefs as $tabledef ) {
        $ccount = $tabledef->ColumnCount();
        if ( $tabledef->Exists() ) {
          $isUpgrade = true;
          $this->sqlStatement .= "ALTER TABLE `" . $tabledef->pfxTableName() ."`" . "\n" ;
          $ccounter = 0; $newcolumns = 0;
          if (isset($tabledef->columnDefs) && count($tabledef->columnDefs) > 0) {
            foreach ( $tabledef->columnDefs as $columndef ) {
              ++$ccounter;
              if ( $columndef->Exists() ) {
                $this->sqlStatement .= " CHANGE `" . $columndef->columnName . "` " . $columndef->SQL();
              } else {
                $this->sqlStatement .= " ADD " .$columndef->SQL() . " AFTER `" . $columndef->columnAfter . "`";
              }
              $this->sqlStatement .= (($ccounter < $ccount) ? "," : ";") . "\n";
            } // end column loop
          }
        } else {
          //table does not exist
          $this->sqlStatement .= "CREATE TABLE IF NOT EXISTS " . $tabledef->pfxTableName() ." (\n" ;
          foreach ( $tabledef->columnDefs as $columndef ) {
            $this->sqlStatement .= " " . $columndef->SQL() . ",\n";
          } // end column loop
          $this->sqlStatement .= " PRIMARY KEY (`" . $tabledef->primaryKey . "`)\n"
            . ") TYPE=" . $tabledef->tableType . ";\n\n";
        }
      }
    } // end table loop
  }
  function SchemaUpdater( $sql_file_location=null ) {
    $this->sqlFileLocation = $sql_file_location;
    $this->getTableDefs();
    $this->updateSchema();
  }
}
/**A Class to make sure there are no data truncation problems in the usr_
* tables, since rc3-4 - Part of the "Live" item editing feature.
* @since 2.3
*	@date 2007-04-25
* @author David Walters
*/
class UserSchemaUpdater extends SQLAction {
	/**Fixes usr_tables that might be truncating captured data (since rc3)
	* @author David Walters
	* @since 2.3
	* @date 2007-04-25
	*/
	function updateUserSchema() {
	global $mosConfig_absolute_path, $database, $mosConfig_dbprefix;
		$addcomma = false;
		$newschema = "";
		$columnexists = false;
		$altertable = true;
		$this->sqlStatement = "#Modifying User Schemas\n";
		$existing_forms_query = "SELECT id from ".$mosConfig_dbprefix."performs";
		$database->setQuery($existing_forms_query);
		if (!$database->query()) {
			$this->sqlStatement .= "#No existing _performs tables to fix.\n";
			return;
		}
		$existingusrforms = $database->loadResultArray();
		if (count($existingusrforms) == 0) {
			$this->sqlStatement .= "#No tables to fix.\n";
			return;
		}
		foreach ($existingusrforms as $v => $formId) {
			$itemchanged = true;
			$qry = "SELECT * FROM ".$mosConfig_dbprefix."performs WHERE id = '".$formId."'";
			$database->setQuery($qry);
			$data = $database->query();
			if (!$data) {
				echo "<script> alert('".$database->getErrorMsg(true)."'); window.history.go(-1); </script>\n";
				exit();
			}
			$frmlist = $database->loadObjectList();
			if (count($frmlist) == 0) continue;
			$tablename = $frmlist[0]->tablename;
			$tablerow = $frmlist[0];
			$table_id = $tablerow->id;
			$altertable = false;
			$alterquery = "";
			if ($tablename != "") {
				$alterquery = "ALTER TABLE " . $database->NameQuote($tablename) . "\n";
				$_qry = "DESCRIBE `".$tablename."`";
				$database->setQuery($_qry);
				$columnexists = false;
				if (!$database->query()) {
					echo "<script> alert('".$database->getErrorMsg(true)."'); window.history.go(-1); </script>\n";
					exit();
				}
				$describelist = $database->loadObjectList();
				
				$userAlterQuery = "";
				$addGuid = true;
				foreach ($describelist as $describe) {
					if ($describe->Field == "GUID") {
						$addGuid = false;
						break;
					}
				}
				if ($addGuid) {
					$alterquery .= " ADD `GUID` text";
					$addcomma = true;
				}
				$itemqry = "SELECT * FROM ".$mosConfig_dbprefix."performs_items WHERE formId = '$formId'";
				$database->setQuery($itemqry);
				if (!$database->query()) {
					echo "<script> alert('".$database->getErrorMsg(true)."'); window.history.go(-1); </script>\n";
					exit();
				}
				$rowlist = $database->loadObjectList();
				$add_guid = true;
				foreach ($rowlist as $row) {
					$objitem = $row;
					$itemvars = get_object_vars($objitem);
					foreach ($itemvars as $itemvarname => $itemvarval) {
						if (!is_a($itemvarval, "database")) {
							switch ($itemvarname) {
//								case "tablename": {
//								//refactor ... should be like a migrateinfo
//									$_qry = "DESCRIBE " . $itemvarval;
//									$database->setQuery($_qry);
//									if (!$database->query()) {
//										echo "<script> alert('".$database->getErrorMsg(true)."'); window.history.go(-1); </script>\n";
//										exit();
//									}
//									$tabledesc = $database->loadObjectList();
//									foreach ($tabledesc as $obj) {
//										if ($obj->Field == "GUID") {
//											$add_guid = false;
//										}
//									}
//									if ($add_guid) {
//										$userAlterQuery .= "ALTER TABLE `" .$itemvarval . "`\n"
//											. "ADD `GUID` text\n;";
//											$addGuid = true;
//									}
//									break;
//									//refactor...
//								}
								case "name": {
									$newschema = " text";
									//TODO: add switch for file items - filename or actual file
									$altertable = true;
									$columnexists = false;
									foreach ($describelist as $obj) {
										if ($obj->Field == $row->name) {
											$columnexists = true;
										}
									}
									$alterquery .= ($addcomma ? ",\n " : " ")
									. (($columnexists) ? "CHANGE ".$database->NameQuote($itemvarval) . " " : "ADD ") 
									. $database->NameQuote($row->name)
									. $newschema
									. (($row->required) ? " NOT NULL" : "");
									$addcomma = true;
									break;
								}
								default: {
								}
							}//switch itemvarname
						}//if is_a
					}//foreach itemvars
				}//foreach rowlist
			}// if tablename != ""
			$alterquery .= ";\n";
			if ($altertable) {
				$this->sqlStatement .= ($alterquery);
			}//if altertable
		}	//foreach formid
	}
	function UserSchemaUpdater($cleaninstall = false) {
		if (!$cleaninstall) {
			$this->sqlStatement = "#Checking for usr_performs_tables\n";
			$this->updateUserSchema();
		}
	}
}
/**Class to hold extension info for the installer
* @date 2007-04-25
* @since 2.3
* @author David Walters
*/
class ExtensionInfo {
	var $elementType;
	var $elementName;
	var $elementInstaller;
	var $elem;
	var $publish;
	var $elementDir;
	function ExtensionInfo($elementtype, $elementname, $elem, $publish) {
		global $mosConfig_absolute_path, $mainframe;
		$this->elementType = $elementtype;
		$this->elementName = $elementname;
		require_once( $mainframe->getPath( 'installer_class', $elementtype ) );
		switch ($elementtype) {
			case "mambot": {
				$this->elementInstaller = new mosInstallerMambot();
				break;
			}
			case "module": {
				$this->elementInstaller = new mosInstallerModule();;
				break;
			}
		}
		$this->elem = $elem;
		$this->publish = $publish;
		$this->elementDir = $mosConfig_absolute_path."/administrator/components/com_performs/plugins/".$this->elementName;
	}
}
/**Class to populate the joomla tables with extensions to the component
* @since 2.3
* @date 2007-04-25
* @author David Walters
*/
class PerFormsExtensionInstaller extends SQLAction {
	var $elements;
	function installExtensions() {
		global $mosConfig_debug, $database;
		foreach ($this->elements as $elementInfo) {
			$elementType = $elementInfo->elementType;
			$elementName = $elementInfo->elementName;
			$elementInstaller = $elementInfo->elementInstaller;
			$elem = $elementInfo->elem;
			$publish = $elementInfo->publish;
			$elementDir = $elementInfo->elementDir;
			//TODO: uninstall module code
			$ret = $elementInstaller->install($elementDir);
			if ($mosConfig_debug) {
				if ($ret) {
					$this->sqlStatement.="#$elementType '$elementName' Installed!\n";
					if ($publish) {
						$this->sqlStatement .= "UPDATE #__".$elementType."s"
							. "\nSET published = 1"
							. "\nWHERE $elem = "
							. $database->Quote( $elementName )
							. ";\n";
		//				$database->setQuery( $query );
		//				if (!$database->query()) {
		//					echo 'SQL error: ' . $database->stderr( true ) ;
		//					$ret = false;
		//				}
		//				if ($mosConfig_debug) {
		//					if ($ret) {
		//						echo "<h1>$elementType '$elementName' Published!</h1>";
		//					} else {
		//						echo "<h1>$elementType '$elementName' Failed!</h1>";
		//					}
		//				}
					}
				} else {
					//TODO: migrate existing modules...
					$this->sqlStatement.="#$elementType '$elementName' Failed - perForms will not overwrite modules.\n";
				}
			}
		}
	}
	function PerFormsExtensionInstaller($cleaninstall = true, &$element_array) {
	//TODO: update module data so user modules persist with new vars if need be
		$this->elements = $element_array;
		$this->sqlStatement = "#Installing perForms extensions.\n";
	}
}


/** The PerForms installer class, version 1.0.
*  This class aims to be a generic table updater, building an update script
*  from a source sql file (or string) on construction and running the resultant
*  sql statement(s) on Install().
*  It is faster to let mySql decide what to do with a change update as part of 
*  a group than it is to get a list of change candidates, look at their type
*  information, check it is correct with our new schema, write out the change
*  if a change order is required, then post the changes back to mysql. mySql 
*  won't change them if we are sending it a directive to change the type of
*  a column to the type that it is. It will do that much faster than php can.
* @date 2007-2-8
*/
class DBInstaller extends SQLAction {
  var $tableRenamer;
  var $dataMigrator;
  var $schemaUpdater;
  var $userSchemaUpdater;
	var $extensionInstaller;
	var $cleaninstall;
  /** Default constructor constructs the underlying object model.
    * @author David Walters
    * @date 2007-2-9
    **/
  function DBInstaller( $clean_install = true, $sql_file_location=null, 
												$table_renamer=null, $data_migrator=null,
												$extension_info = null ) {
			$this->cleaninstall = $clean_install;
			$this->schemaUpdater  =  new SchemaUpdater($sql_file_location);
			$this->userSchemaUpdater = new UserSchemaUpdater(true);
			$this->tableRenamer   =  new TableRenamer($table_renamer);
			$this->dataMigrator   =  new DataMigrator($data_migrator);
			$this->extensionInstaller = new PerFormsExtensionInstaller($extension_info);
			die("DEFAULT BASE CLASS CONSTRUCTOR CALLED");
  }
  function buildSQLString() {
    global $perfConfig, $database, $mosConfig_db, $mosConfig_dbprefix;
    $newVersion = $perfConfig->getDefault( 'version' );
		$this->extensionInstaller->installExtensions();
		$this->sqlStatement = "#PerForms ". $newVersion ." Installation Statements\n"
			. ((!$this->cleaninstall) ? $this->userSchemaUpdater->SQL() : "")
			. ((!$this->cleaninstall) ? $this->tableRenamer->SQL() : "")
			. $this->schemaUpdater->SQL()
			. ((!$this->cleaninstall) ? $this->dataMigrator->SQL() : "")
			. "commit;\n"
			. $this->extensionInstaller->SQL()
			. "\n";
  }
  /**  Shows a dialog box with friendly icons and soft colouring to tell the 
    *  user how things went with the installation.
    */
  function install_info($info_title, $info_text) {
    global $mosConfig_live_site;
    ?>
      <div style="padding: 12pt;">
      <table width="100%" style="border: thin maroon solid;" cellspacing="0">
      <tr style="background-color: aliceblue;">
      <td rowspan="4" style="text-align:center;vertical-align:top; padding:6pt;">
      <img src="<?php echo $mosConfig_live_site; ?>/administrator/images/install.png">
      </td>
      <td class="contentheading" style="color: maroon; vertical-align: middle; padding: 8pt; font-family: helvetica;">
      <i>PerForms</i>
      </td>
      <td></td>
      </tr>
      <tr>
      <td style="padding: 6pt; font-style: italic;"><?php echo INSTALLATION_MESSAGES; ?></td>
        </tr>
        <tr><td></td><td></td></tr>
        <tr><td style="padding:6pt;"><tt><?php echo $info_title; ?></tt></td></tr>
          <tr style="background-color: lavenderblush; font-style: italic;">
          <td rowspan="3" style="text-align:center;vertical-align: top; padding: 6pt;">
          <img src="<?php echo $mosConfig_live_site; ?>/administrator/images/support.png"></td>
          <td style="padding: 6pt;"><?php echo $info_text; ?></td><td></td></tr>
            <tr>
            <td style="padding: 6pt; font-style: italic;"></td>
            <td rowspan="4" style="text-align:center;vertical-align:top; padding:6pt;">
            <i><?php echo PF_LICENCE_INFO; ?></i>
              </td>
              </tr>
              </table>
              </div>
              <?php
  }
  
  /** Runs the installation SQL script on the joomla db, informing the user of
    * postconditions, and announcements from the team.
    * @since 2.2.3
    */
  function Install() {
    global $perfConfig, $isUpgrade, $mosConfig_debug;
    echo "<table width=\"80%\"><tr><td>";
    $tabs = new MosTabs(0);
    $tabs->startPane("installpane");
    $this->buildSQLString();
    $dberrors = sqlutils::runSqlString($this->SQL());
    $errorcount = count($dberrors);
    if ($errorcount > 0) {
      $tabs->startTab(INS_SQL_ERRORS, "installpane");
      echo "<h2>SQL Errors</h2><pre>";
      print_r($dberrors);
      echo "</pre>";
      $tabs->endTab();
    }
    $tabs->startTab(INS_WELCOME, "installpane");
    if ( $isUpgrade ) {
      $newVersion = $perfConfig->getDefault( 'version' );
      $msg = SUCCESSFUL_UPGRADE  . " $newVersion";
      $this->install_info( $msg, UPGRADE_MESSAGE);
    } else {
      $this->install_info(THANKS_FOR_CHOOSING, WELCOME_TO_PERFORMS);      
    }
    $tabs->endTab();
    if ($mosConfig_debug || $errorcount > 0) {
      $tabs->startTab(INS_SQL_STATEMENTS, "installpane");
      $sqlHTML = "<textarea cols=100 rows=25>".$this->sqlStatement."</textarea>";
      echo $sqlHTML;
      $tabs->endTab();
    }
    $tabs->endPane();
    echo "</td></tr></table><hr />";
  }
  
}


/** Helper functions for deserializing a sql statement, or sending to the db.
* @author David Walters
* @date 2007-2-8
* @since 2.2.3
*/
class sqlUtils {
  /** Takes a string and sends it to the sql interpreter connected to joomla
  */
  function runSqlString ( $query ) {
		global $database, $mosConfig_absolute_path;
		$sqlDir = $mosConfig_absolute_path . '/administrator/components/com_performs/sql/';
		$errors = array();
    
		$pieces  = sqlUtils::split_sql($query);
    
		for ($i=0; $i<count($pieces); $i++) {
			$pieces[$i] = trim($pieces[$i]);
			if(!empty($pieces[$i]) && $pieces[$i] != "#") {
				$database->setQuery( $pieces[$i] );
				if (!$database->query()) {
					$errors[] = array ( $database->getErrorMsg(), $pieces[$i] );
				}
			}
		}
		return $errors;
  }
	/**
  ripped from joomla core: /installation/install2.php
   * @param sql The SQL string to split.
   */
	function split_sql($sql) {
		$sql = trim($sql);
		$sql = ereg_replace("\n#[^\n]*\n", "\n", $sql);
    
		$buffer = array();
		$ret = array();
		$in_string = false;
    
		for($i=0; $i<strlen($sql)-1; $i++) {
			if($sql[$i] == ";" && !$in_string) {
				$ret[] = substr($sql, 0, $i);
				$sql = substr($sql, $i + 1);
				$i = 0;
			}
      
			if($in_string && ($sql[$i] == $in_string) && $buffer[1] != "\\") {
				$in_string = false;
			}
			elseif(!$in_string && ($sql[$i] == '"' || $sql[$i] == "'") && (!isset($buffer[0]) || $buffer[0] != "\\")) {
				$in_string = $sql[$i];
			}
			if(isset($buffer[1])) {
				$buffer[0] = $buffer[1];
			}
			$buffer[1] = $sql[$i];
		}
    
		if(!empty($sql)) {
			$ret[] = $sql;
		}
		return($ret);
	}
}

?>

