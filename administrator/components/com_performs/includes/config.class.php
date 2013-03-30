<?php
/**
 * Class handles all configuration parameters for RSGallery2
 * @version $Id$
 * @package PerForms
 * @copyright (C) 2003 - 2006 RSGallery2
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 */

// no direct access
defined( '_VALID_MOS' ) or die( 'Restricted access' );

/**
 * Generic Config class
 * @package perForms
 */
class perfConfig {

    //  General
    var $version    = '2.4.0';
    var $debug      = false;

    // private vars for internal use
    var $_configTable = '#__performs_config';

    /**
     * constructor
     * @param bool true loads config from db, false will retain defaults
     */
    function perfConfig( $loadFromDB = true ){
        if( $loadFromDB )
            $this->_loadConfig();
    }

    /**
     * @return array An array of the public vars in the class
     */
    function getPublicVars() {
        $public = array();
        $vars = array_keys( get_class_vars( get_class( $this ) ) );
        sort( $vars );
        foreach ($vars as $v) {
            if ($v{0} != '_') {
                $public[] = $v;
            }
        }
        return $public;
    }

    /**
     *  binds a named array/hash to this object
     *  @param array $hash named array
     *  @return null|string null is operation was satisfactory, otherwise returns an error
     */
    function _bind( $array, $ignore='' ) {
        if (!is_array( $array )) {
            $this->_error = strtolower(get_class( $this )).'::bind failed.';
            return false;
        } else {
            return mosBindArrayToObject( $array, $this, $ignore );
        }
    }

    /**
     * Writes the configuration file line for a particular variable
     * @return string
     */
    function getVarText() {
        $txt = '';
        $vars = $this->getPublicVars();
        foreach ($vars as $v) {
            $k = str_replace( 'config_', 'mosConfig_', $v );
            $txt .= "\$$k = '" . addslashes( $this->$v ) . "';\n";
        }
        return $txt;
    }

    /**
      * Binds the global configuration variables to the class properties
     */
    function _loadConfig() {
      global $database;
      $sql = "SHOW TABLES LIKE '$this->_configTable'";
      $database->setQuery($sql);
      if ($database->query()){
        $result = $database->getNumRows();
        if ($result) {
          $installedConfigDB = true;
          
          $query = "SELECT * FROM " . $this->_configTable;
          $database->setQuery( $query );
          $vars = $database->loadAssocList();
          
          // if a new install, db hasn't been created yet.
          if( $vars == null ) return;
          
          foreach ($vars as $v) {
            $this->$v['name'] = $v['value'];
          }
        }
      }
    }
    
    /**
     * takes an array, binds it to the class and saves it to the database
     * @param array of settings
     * @return false if fail
     */
    function saveConfig( $config=null ) {
        global $database;
        
        //bind array to class
        if( $config !== null)
          $this->_bind($config);

        $vars = $this->getPublicVars();
        foreach ( $vars as $name ){
            //Checks if the value exists and overrides it if present, inserting if not
            //can seem a bit too much but since config is not gonna be changed often...
            $query = "SELECT * FROM " . $this->_configTable ." WHERE name='$name'";
            $database->setQuery( $query );
            if(!$database->query()){
                echo $database->getErrorMsg();
                return false;
            }
            $isCreated = $database->getNumRows();
            if ($isCreated==1) {
                if ($name == 'intro_text')
                    $this->$name = addslashes($this->$name);
                $query = "UPDATE " . $this->_configTable . " SET value='".$this->$name."' WHERE name='$name'";
            }   
            else {
                $query = "INSERT INTO " . $this->_configTable . "  VALUES ('', '$name', '".$this->$name."')";
            }
                
            
            $database->setQuery( $query );
            if(!$database->query()){
                echo $database->getErrorMsg();
                return false;
            }
        }
        return true;
    }

    /**
     * @param string name of variable
     * @return the requested variable
     */
    function get($varname){
        return $this->$varname;
    }
    
    /**
     * @param string name of variable
     * @param var new value
     */
    function set( $varname, $value ){
        $this->$varname = $value;
    }
    
    /**
     * @param string name of variable
     * @return the default value of requested variable
     */
    function getDefault( $varname ){
        $defaultConfig = new perfConfig( false );
        return $defaultConfig->get( $varname );
    }
}
?>