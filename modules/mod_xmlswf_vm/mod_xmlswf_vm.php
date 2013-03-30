<?php
/**
* @Copyright Copyright (C) 2010- xml/swf
* @license GNU/GPL http://www.gnu.org/copyleft/gpl.html
**/
/** ensure this file is being included by a parent file */
defined( '_JEXEC' ) or die( 'Restricted access' ); 

if (!defined("VM_CATORDER_CLSSS_PG")) {
class DgIparamsPG
{
	var $id;
	var $ref;
	var $order;
	var $name;
	var $thumb;
}
class DGitemPG
{
	var $next;
	var $prev;
	var $par; // parrent
	var $firstc; //first child DGitemPG
	var $params;
	//var $curr_next;
	var $cii;
	var $c_info;
}

class DgraphPG
{
	var $first; //first DGitemPG
	function DgraphPG()
	{
		$this->first = New DGitemPG();
		$this->first->next = NULL;
		$this->first->prev = NULL;
		$this->first->par = NULL;
		$this->first->firstc = NULL;
		$this->first->params = New DgIparamsPG();
		$this->first->params->id = 0;
		$this->first->params->ref = -1;
		$this->first->params->order = 0;
		$this->first->params->name = '';
		$this->first->params->thumb = '';
		//$this->curr_next = $this->first;
		$this->cii = 0;
		$this->c_info = array();
	}
	function BuildGraph (&$arr_igr) {
		if ($arr_igr && is_array($arr_igr) && count($arr_igr) > 0) {
			foreach ($arr_igr as $akey => $curr_cigr) {
				if ($this->Add($curr_cigr, $this->first)) {
					//unset($arr_igr[$akey]);
				}
			}
			//return BuildGraph($arr_igr, $bgraph);
		} else {
			return false;
		}
	}
	function Add($newgi, $currgi)
	{
//echo '$newgi:';print_r($newgi);
//echo '$currgi:';print_r($currgi);
		if ($newgi->params->ref == $currgi->params->ref) {
			if ($newgi->params->order < $currgi->params->order) {
				$newgi->next = $currgi;
				$newgi->prev = $currgi->prev;
				$newgi->par = $currgi->par;
				$currgi->prev = $newgi;
				if ($newgi->prev) {
					$newgi->prev->next = $newgi;
				} else {
					$newgi->par->firstc = $newgi;
				}
				return $newgi;
			} else {
				if ($currgi->next) {
					return $this->Add($newgi, $currgi->next);
				} else {
					$currgi->next = $newgi;
					$newgi->prev = $currgi;
					$newgi->par = $currgi->par;
					$newgi->next = NULL;
					return $newgi;
				}
			}
		} else {
			if ($newgi->params->ref == $currgi->params->id && !$currgi->firstc) {
				$currgi->firstc = $newgi;
				$newgi->next = NULL;
				$newgi->prev = NULL;
				$newgi->par = $currgi;
				return $newgi;
			} else {
				$theNext = $this->Next($currgi);
				if ($theNext) {
					return $this->Add($newgi, $theNext);
				} else {
					return false;
				}
			}
		}
	}
	function GetCatInfo($curr_next)
	{
		//$this->curr_next = $this->first;
		//$this->cii = 0;
		$cnext = $this->Next($curr_next);
		if ($cnext) {
			$this->c_info[$this->cii]['id'] = $cnext->params->id;
			$this->c_info[$this->cii]['name'] = $cnext->params->name;
			@$this->c_info[$this->cii]['thumb'] = $cnext->params->thumb;
			$this->cii++;
			return $this->GetCatInfo($cnext);
		} else {
			return $this->c_info;
		}
	}
	function Next($currgi)
	{
		if ($currgi->firstc) {
			return $currgi->firstc;
		} elseif($currgi->next) {
			return $currgi->next;
		} else {
			$thePnex = $this->Pnex($currgi);
			if ($thePnex) {
				return $thePnex;
			} else {
				return false;
			}
		}
	}
	function Pnex($currgi)
	{
		if ($currgi === $this->first) {
			return false;
		} else {
			if ($currgi->par->next) {
				return $currgi->par->next;
			} else {
				return $this->Pnex($currgi->par);
			}
		}
	}
}
define("VM_CATORDER_CLSSS_PG", 1);
}

$bannerWidth                   = intval($params->get( 'bannerWidth', 720 ));
$imagewidth                   = intval($params->get( 'imagewidth', 516 ));
$imageheight                   = intval($params->get( 'imageheight', 397 ));
$bannerHeight                  = intval($params->get( 'bannerHeight', 460 ));
$backgroundColor         = trim($params->get( 'backgroundColor', '#ffffff' ));
$wmode                 = trim($params->get( 'wmode', 'window' )); 
$baseColor                   = $params->get( 'baseColor', '0x92BB38' );
$thumbwidth                   = intval($params->get( 'thumbwidth', 170 ));
$thumbheight                   = intval($params->get( 'thumbheight', 115 ));

$catppv_id = '';
$onlyvm_flag = false;
//vm parameters

$show_price    = $params->get( 'show_price', 'yes' );
$show_weight    = $params->get( 'show_weight', 'yes' );
$short_desc    = $params->get( 'short_desc', 'yes' );
$onlyvm                 = trim($params->get( 'onlyvm', '1' ));
//end of vm parameters


if( file_exists(dirname(__FILE__).'/../../components/com_virtuemart/virtuemart_parser.php' )) {
	require_once( dirname(__FILE__).'/../../components/com_virtuemart/virtuemart_parser.php' );
} else {
	require_once( dirname(__FILE__).'/../components/com_virtuemart/virtuemart_parser.php' );
}

require_once(CLASSPATH.'ps_product.php');
$ps_product = new ps_product;

if (!function_exists('create_product_xmlislidpro_files')) {
function create_product_xmlislidpro_files($params, &$catppv_id, &$onlyvm_flag)
{
//global $catppv_id;
$database = new ps_DB();
$cat_id                    = trim($params->get( 'category_id', '0' ));
$id                    = explode(",",$cat_id);
$load_curr                 = trim($params->get( 'load_curr', '2' ));
$onlyvm                 = trim($params->get( 'onlyvm', '1' ));
$vmcat_id                    = trim($params->get( 'vmcat_id', '0' ));
$vid                    = explode(",",$vmcat_id);


if ($load_curr == 1 || $onlyvm != 1) {
	$cs_uri = $_SERVER['REQUEST_URI'];
	
	if (stristr($cs_uri, 'option=com_virtuemart')) {
		$catid_ptr = '/category_id=([0-9]+)/';
		if (preg_match($catid_ptr, $cs_uri, $catid_match)) {
			if ($load_curr == 1 && 1 == trim($params->get( 'showcorp', '1'))) {
				unset($id);
				$id = array(0=>$catid_match[1]);
			}
			if ($onlyvm == 2 && ($vid[0] == 0 || array_search($catid_match[1], $vid) || array_search($catid_match[1], $vid) === 0)) {
				$onlyvm_flag = true;
			}
			if ($onlyvm == 3) {
				$prod_ptr = '/product_id=([0-9]+)/';
				if (preg_match($prod_ptr, $cs_uri, $prid_match)) {
					if (($vid[0] == 0 || array_search($prid_match[1], $vid) || array_search($prid_match[1], $vid) === 0)) {
						$onlyvm_flag = true;
					}
				}
			}
		}
	} else {
		$curr_uri  =& JFactory::getURI();
		$curr_uri_query = $curr_uri->getQuery(true);
		if(isset($curr_uri_query['option']) && $curr_uri_query['option'] == 'com_virtuemart') {
			if (isset($curr_uri_query['category_id'])) {
				if ($load_curr == 1 && 1 == trim($params->get( 'showcorp', '1'))) {
					unset($id);
					$id = array(0=>$curr_uri_query['category_id']);
				}
				if ($onlyvm == 2 && ($vid[0] == 0 || array_search($curr_uri_query['category_id'], $vid) || array_search($curr_uri_query['category_id'], $vid) === 0)) {
					$onlyvm_flag = true;
				}
				if ($onlyvm == 3 && isset($curr_uri_query['product_id']) && ($vid[0] == 0 || array_search($curr_uri_query['product_id'], $vid) || array_search($curr_uri_query['product_id'], $vid) === 0)) {
					$onlyvm_flag = true;
				}
			}
		}
	}
}

if ($onlyvm != 1 && !$onlyvm_flag) {
 return;
}

if (1 == trim($params->get( 'catppv_flag', '2' ))) {
	if ( 1 == trim($params->get( 'showcorp', '1')) ) {
		$catppv_id = implode("_", $id);
	} else {
		$catppv_id = "_c";
	}
}
$module_path = dirname(__FILE__).DS;
if (1 == trim($params->get( 'swfppv_flag', '2' )) && !file_exists($module_path . 'mod_xmlswf_vm'. $catppv_id . '.swf') ) {
	copy($module_path . 'mod_xmlswf_vm.swf', $module_path . 'mod_xmlswf_vm'. $catppv_id . '.swf');

	///////// set chmod 0644 for creating .swf file  if server is not windows
	$os_string = php_uname('s');
	$cnt = substr_count($os_string, 'Windows');
	if($cnt =='0'){
		@chmod($module_path . 'mod_xmlswf_vm'. $catppv_id . '.swf', 0644);
	}

}

if (1 == trim($params->get( 'showcorp', '1'))) {
	if ($id[0]!=0)
	{
		$query = "Select pc.category_id, pc.category_publish, pc.category_name, pc.category_thumb_image FROM #__{vm}_category pc" ;		
		$query .= "\n where pc.category_publish = 'Y'";
		$query .= " and (";
		for ($i=0; $i<sizeof($id)-1; $i++) {
			$query .= "pc.category_id=".$id[$i]." or ";
		}
		$query .= "pc.category_id=".$id[$i].")";
		$query .= " ORDER BY pc.list_order";
		$database->query($query);
		$rows = $database->record;
		$c_id_name = array();
		$c_id_thumb = array();
		while ($database->next_record()) {
			$c_id_name[$database->f('category_id')] = $database->f('category_name');
			$c_id_thumb[$database->f('category_id')] = $database->f('category_thumb_image');
		}
		$cats_info = array();
		$cii = 0;
		foreach($id as $curr_id) {
			$cats_info[$cii] = array();
			$cats_info[$cii]['id'] = $curr_id;
			$cats_info[$cii]['name'] = $c_id_name[$curr_id];
			$cats_info[$cii]['thumb'] = $c_id_thumb[$curr_id];
			$cii++;
		}
	} else {
		$query = "Select pc.category_id, pc.category_publish, pc.category_name, pc.list_order, pc.category_thumb_image, px.category_parent_id FROM #__{vm}_category pc, #__{vm}_category_xref px" ;
		$query .= "\n where pc.category_publish = 'Y' and px.category_child_id=pc.category_id";
		$query .= " ORDER BY px.category_parent_id, pc.list_order";
		$database->query($query);
		$rows = $database->record;
		$ci = 0;
		$cgr_info = array();
		while ($database->next_record()) {
			$cgr_info[$ci] = new DGitemPG();
			$cgr_info[$ci]->next = NULL;
			$cgr_info[$ci]->prev = NULL;
			$cgr_info[$ci]->par = NULL;
			$cgr_info[$ci]->firstc = NULL;
			$cgr_info[$ci]->params->id =  $database->f('category_id');
			$cgr_info[$ci]->params->ref = $database->f('category_parent_id');
			$cgr_info[$ci]->params->order = $database->f('list_order');
			$cgr_info[$ci]->params->name = $database->f('category_name');
			$cgr_info[$ci]->params->thumb = $database->f('category_thumb_image');
			$ci++;
		}

		$cat_graph =  new DgraphPG();
		$cat_graph->BuildGraph($cgr_info);
		
		$cats_info = array();
		
		$cats_info = $cat_graph->GetCatInfo($cat_graph->first);
	}
} else {
	$cats_info[0]['name'] = 'Featured Products';
	$cats_info[0]['id'] = 1;
}

//$module_path = dirname(__FILE__).DS;
$xml_categories_filename = $module_path.'default'.$catppv_id.'.xml';
$xml_category_data = '<?xml version="1.0" encoding="iso-8859-1"?>

<slideshow>
	<baseDef showPlay="'.trim($params->get( 'showPlay', '0')).'" autoSlideTimer="'.intval($params->get( 'autoSlideTimer', 5)).'" autoScale="'.trim($params->get( 'autoScale', '1')).'" autoAlign="'.trim($params->get( 'autoAlign', '1')).'" gradientColor1="'.trim($params->get( 'gradientColor1', '0xBFBFBF')).'"  gradientColor2="'.trim($params->get( 'gradientColor2', '0xE7E7E7')).'" pictureBoxColor= "'.trim($params->get( 'pictureBoxColor', '0x666666')).'" PictureThumbTitleColor="'.trim($params->get( 'PictureThumbTitleColor', '0xFFFFFF')).'" TextColor="'.trim($params->get( 'TextColor', '0xFFFFFF')).'" TitleTextColor="'.trim($params->get( 'TitleTextColor', '0x00CC33')).'" transitionTime="'.intval($params->get( 'transitionTime', 1)).'" TextSize="'.trim($params->get( 'TextSize', '10')).'" ThumbTextSize="'.trim($params->get( 'ThumbTextSize', '11')).'" />
';
foreach ($cats_info as $curr_cinf) {
	$xml_category_data .= write_product_xmlprjslpro_data($curr_cinf['name'], $curr_cinf['id'], $params);
}
$xml_category_data .= "
</slideshow>";
$xml_categories_file = fopen($xml_categories_filename,'w');
fwrite($xml_categories_file, $xml_category_data);


///////// set chmod 0777 for creating .xml file  if server is not windows
	$os_string = php_uname('s');
	$cnt = substr_count($os_string, 'Windows');
	if($cnt =='0'){
		@chmod($xml_categories_filename, 0777);
	}


fclose($xml_categories_file);

}
}

/// function for finding defining image exist or not
if (!function_exists('getResCode')) {
function getResCode($url)
	{
	    $ch = curl_init(trim($url));

		curl_setopt($ch, CURLOPT_NOBODY, true);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		curl_exec($ch);
		return $info = curl_getinfo($ch);
		curl_close($ch);

    }
}


if (!function_exists('write_product_xmlprjslpro_data')) {
function write_product_xmlprjslpro_data($cat_name, $cat_id, $params)
		{
$images_path    		 = trim($params->get( 'images_path', 'components/com_virtuemart/shop_image/product/' )); 
global $mosConfig_absolute_path, $sess;
if (1 == trim($params->get( 'showcorp', '1'))) {
	if ($params->get('show_price')=="yes") {
		$query = "Select p.product_id, p.category_id, pc.category_publish, pc.category_flypage, pp.product_id as pp_id, pp.product_parent_id, pp.product_name, pp.product_thumb_image, pp.product_weight, pp.product_weight_uom, pp.product_full_image, pp.product_s_desc, pr.product_id, pr.product_price,pr.price_quantity_start, pr.price_quantity_end, pt.tax_rate FROM #__{vm}_product_category_xref p,#__{vm}_category pc,#__{vm}_product pp LEFT JOIN  #__{vm}_product_price AS pr ON pp.product_id = pr.product_id" ;
		$query .= " LEFT JOIN  #__{vm}_tax_rate AS pt ON pp.product_tax_id = pt.tax_rate_id where pc.category_id=".$cat_id." and pc.category_id=p.category_id and pc.category_publish = 'Y' and pp.product_id = p.product_id and pp.product_parent_id=0 and pp.product_publish = 'Y' ORDER BY p.product_list";
	} else {
		$query = "Select p.product_id, p.category_id, pc.category_publish, pc.category_flypage, pp.product_id as pp_id, pp.product_parent_id, pp.product_name, pp.product_thumb_image, pp.product_weight, pp.product_weight_uom, pp.product_full_image, pp.product_s_desc FROM #__{vm}_product_category_xref p,#__{vm}_category pc,#__{vm}_product pp " ;
		$query .= " where pc.category_id=".$cat_id." and pc.category_id=p.category_id and pc.category_publish = 'Y' and pp.product_id = p.product_id and pp.product_parent_id=0 and pp.product_publish = 'Y' ORDER BY p.product_list";
	}
} else {
	$pr_id                    = trim($params->get( 'category_id', '0' ));
	$prid                    = explode(",", $pr_id);
	$qpid_arr = array();
	foreach ($prid as $c_pid) {
		$qpid_arr[] = " p.product_id=" . $c_pid . " ";
	}
	if (count($prid)>1) {
		$add_qpid = implode("OR", $qpid_arr);
		$add_qpid = ' (' . $add_qpid . ') ';
	} else {
		$add_qpid = $qpid_arr[0];
	}
	
	if ($params->get('show_price')=="yes") {
		$query = "Select p.product_id, p.category_id, pc.category_publish, pc.category_flypage, pp.product_id as pp_id, pp.product_parent_id, pp.product_name, pp.product_thumb_image, pp.product_weight, pp.product_weight_uom, pp.product_full_image, pp.product_s_desc, pr.product_id, pr.product_price,pr.price_quantity_start, pr.price_quantity_end, pt.tax_rate FROM #__{vm}_product_category_xref p,#__{vm}_category pc,#__{vm}_product pp LEFT JOIN  #__{vm}_product_price AS pr ON pp.product_id = pr.product_id" ;
		$query .= " LEFT JOIN  #__{vm}_tax_rate AS pt ON pp.product_tax_id = pt.tax_rate_id where ".$add_qpid." and pc.category_id=p.category_id and pc.category_publish = 'Y' and pp.product_id = p.product_id and pp.product_parent_id=0 and pp.product_publish = 'Y'";
	} else {
		$query = "Select p.product_id, p.category_id, pc.category_publish, pc.category_flypage, pp.product_id as pp_id, pp.product_parent_id, pp.product_name, pp.product_thumb_image, pp.product_weight, pp.product_weight_uom, pp.product_full_image, pp.product_s_desc FROM #__{vm}_product_category_xref p,#__{vm}_category pc,#__{vm}_product pp " ;
		$query .= " where ".$add_qpid." and pc.category_id=p.category_id and pc.category_publish = 'Y' and pp.product_id = p.product_id and pp.product_parent_id=0 and pp.product_publish = 'Y'";
	}
}

$xml_data = '';
$db = new ps_DB();
$db->query($query);
$rows = $db->record;

$uri_root = JURI::root();
$uri_root_arr = explode('/', $uri_root);
if(count($uri_root_arr) > 4){
	$uri_r_flds = array_slice($uri_root_arr, 3);
	$uri_fldstr = implode ('/', $uri_r_flds);
	$uri_fldstr = (substr($uri_fldstr, 0, 4));
	if (substr($uri_fldstr, -1) == '/') {
		$uri_fldstr = substr($uri_fldstr, 0, -1);
	}
	$uri_rfirst_arr = array_slice($uri_root_arr, 0, 3);;
	$uri_rfirst = implode ('/', $uri_rfirst_arr);
} else {
	$uri_fldstr = false;
}
if (substr($uri_root, -1) == '/') {
		$uri_root = substr($uri_root, 0, -1);
}
$xml_dataa = array();
$items_flag = false;
	while ($db->next_record()) 
{
$items_flag = true;

if( !$db->f('category_flypage') ) {
			$flypage = ps_product::get_flypage( $db->f('pp_id'));
		} else {
			$flypage = $db->f('category_flypage');
		}
		
		$cu_url = $sess->url(URL.'index.php?page=shop.product_details&flypage='.$flypage.'&product_id='.$db->f('pp_id').'&category_id='.$db->f('category_id'));
		if (stripos('a' . $cu_url, 'http://') == 1) {
			$curr_link = $cu_url;
		} else {
			if ($uri_fldstr) {
				$stri_ufld = stripos ( 'a' . $cu_url, $uri_fldstr);
				if ($stri_ufld != 1 && $stri_ufld != 2) {
					if (substr($cu_url, 0, 1) == '/') {
						$curr_link = $uri_root . $cu_url;
					} else {
						$curr_link = $uri_root .'/'. $cu_url;
					}
				} else {
					if ($stri_ufld == 1) {//if no '/'
						$curr_link = $uri_rfirst.'/'.$cu_url;
					} else {
						if ($stri_ufld == 2) {
							if (substr($cu_url, 0, 1) == '/') {
								$curr_link = $uri_rfirst.$cu_url;
							} else {
								$curr_link = $uri_root .'/'. $cu_url;
							}
						}
					}
				}
			} else {
				if (substr($cu_url, 0, 1) == '/') {
					$curr_link = $uri_root . $cu_url;
				} else {
					$curr_link = $uri_root .'/'. $cu_url;
				}
			}
		}

$xml_dataa[$db->f('pp_id')] = '
	<pic url="'.$curr_link.'" target="'.$params->get('target', '_self').'" ';  
	
/////////// no image code //////////////

	
$xml_dataa[$db->f('pp_id')] = '
	<pic url="'.$curr_link.'" target="'.$params->get('target', '_self').'" ';  

$resCode_thumb = getResCode(JURI::root().$images_path.$db->f('product_thumb_image'));

$is_imageurl_thumb = substr_count($resCode_thumb['content_type'], 'image');
if($is_imageurl_thumb > 0)
{
	if($resCode_thumb['http_code']=='200'){

		$xml_dataa[$db->f('pp_id')] .=' thumb="'.JURI::root().$images_path.$db->f('product_thumb_image').'"'; 

	}else{

		$xml_dataa[$db->f('pp_id')] .=' thumb="'.JURI::root().'modules/mod_xmlswf_vm/noimage_thumb.png"'; 

	}
}else{
		$xml_dataa[$db->f('pp_id')] .=' thumb="'.JURI::root().'modules/mod_xmlswf_vm/noimage_thumb.png"'; 

}

$resCode_fullImage = getResCode(JURI::root().$images_path.$db->f('product_full_image'));

$is_imageurl_main = substr_count($resCode_fullImage['content_type'], 'image');

if($is_imageurl_main > 0)
{
	if($resCode_fullImage['http_code']=='200'){

	$xml_dataa[$db->f('pp_id')] .=' pic="'.JURI::root().$images_path.$db->f('product_full_image').'">';

	}else{

		$xml_dataa[$db->f('pp_id')] .=' pic="'.JURI::root().'modules/mod_xmlswf_vm/no_image.png">'; 


	}
}else{
	$xml_dataa[$db->f('pp_id')] .=' pic="'.JURI::root().'modules/mod_xmlswf_vm/no_image.png">';  

}

$xml_dataa[$db->f('pp_id')] .=' <Title><![CDATA['.$db->f('product_name').']]></Title>';


	if ($params->get('short_desc') == "yes") {
		$xml_dataa[$db->f('pp_id')] .= '<desc><![CDATA['.$db->f('product_s_desc').']]></desc>';
	}
	$xml_dataa[$db->f('pp_id')] .= '</pic>';

}
if (!$items_flag) {
	return '';
}
if (1 == trim($params->get( 'showcorp', '1'))) {
	foreach($xml_dataa as $cur_xml) {
		$xml_data .= $cur_xml;
	}
} else {
	foreach ($prid as $c_pid) {
		$xml_data .= $xml_dataa[$c_pid];
	}
}
	
		return $xml_data;
		}
}
create_product_xmlislidpro_files($params, $catppv_id, $onlyvm_flag);
if ($onlyvm == 1 || $onlyvm_flag) {
if (1 == trim($params->get( 'swfppv_flag', '2' ))) {
	$catswf_id = $catppv_id;
} else {
	$catswf_id = '';
}
?>
<div style="text-align:center;">
<script language="javascript">AC_FL_RunContent = 0;</script>
<script src="<?php echo JURI::root()?>modules/mod_xmlswf_vm/AC_RunActiveContent.js" language="javascript"></script>
<script language="javascript">
	if (AC_FL_RunContent == 0) {
		alert("This page requires AC_RunActiveContent.js.");
	} else {
		AC_FL_RunContent(
			'codebase', 'http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0',
			'width', '<?php echo $bannerWidth;?>',
			'height', '<?php echo $bannerHeight; ?>',
			'src', '<?php echo JURI::root()?>modules/mod_xmlswf_vm/mod_xmlswf_vm<?php echo $catswf_id; ?>',
			'quality', 'high',
			'pluginspage', 'http://www.macromedia.com/go/getflashplayer',
			'align', 'middle',
			'play', 'true',
			'loop', 'true',
			'scale', 'showall',
			'wmode', '<?php echo $wmode;?>',
			'devicefont', 'false',
			'id', 'flcontent',
			'bgcolor', '<?php echo $backgroundColor; ?>',
			'name', 'flcontent',
			'menu', 'true',
			'allowFullScreen', 'true',
			'allowScriptAccess','sameDomain',
			'movie', '<?php echo JURI::root()?>modules/mod_xmlswf_vm/mod_xmlswf_vm<?php echo $catswf_id; ?>',
			'salign', '',
			'FlashVars','maxwidth=<?php echo $bannerWidth;?>&maxheight=<?php echo $bannerHeight; ?>&imagewidth=<?php echo $imagewidth;?>&imageheight=<?php echo $imageheight;?>&baseColor=<?php echo $baseColor;?>&thumbwidth=<?php echo $thumbwidth;?>&thumbheight=<?php echo $thumbheight;?>&xmlfileurl=<?php echo JURI::root()?>modules/mod_xmlswf_vm/default<?php echo $catppv_id;?>.xml'
			); //end AC code
	}

</script>

<noscript>
<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0" width="<?php echo $bannerWidth;?>" height="<?php echo $bannerHeight; ?>" align="middle" id="content">
<param name="allowScriptAccess" value="sameDomain" />
<param name="wmode" value="<?php echo $wmode;?>" />
<param name="FlashVars" value="maxwidth=<?php echo $bannerWidth;?>&maxheight=<?php echo $bannerHeight; ?>&imagewidth=<?php echo $imagewidth;?>&imageheight=<?php echo $imageheight;?>&baseColor=<?php echo $baseColor;?>&thumbwidth=<?php echo $thumbwidth;?>&thumbheight=<?php echo $thumbheight;?>&xmlfileurl=<?php echo JURI::root()?>modules/mod_xmlswf_vm/default<?php echo $catppv_id;?>.xml"/>
<param name="allowFullScreen" value="true" />	<param name="movie" value="<?php echo JURI::root().'modules/mod_xmlswf_vm/mod_xmlswf_vm'.$catswf_id.'.swf';?>" /><param name="quality" value="high" /><param name="bgcolor" value="<?php echo $backgroundColor; ?>" />
<embed src="<?php echo JURI::root().'modules/mod_xmlswf_vm/mod_xmlswf_vm'.$catswf_id.'.swf';?>" FlashVars="maxwidth=<?php echo $bannerWidth;?>&maxheight=<?php echo $bannerHeight; ?>&imagewidth=<?php echo $imagewidth;?>&imageheight=<?php echo $imageheight;?>&baseColor=<?php echo $baseColor;?>&thumbwidth=<?php echo $thumbwidth;?>&thumbheight=<?php echo $thumbheight;?>&xmlfileurl=<?php echo JURI::root()?>modules/mod_xmlswf_vm/default<?php echo $catppv_id;?>.xml" quality="high" wmode="<?php echo $wmode;?>"
 bgcolor="<?php echo $backgroundColor;?>" width="<?php echo $bannerWidth;?>" height="<?php echo $bannerHeight; ?>" name="content" align="middle" allowScriptAccess="sameDomain" allowFullScreen="true" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
</object>
</noscript>
</div>
<?php } ?>