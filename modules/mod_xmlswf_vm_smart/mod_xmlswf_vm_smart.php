<?php
/**
* @Copyright Copyright (C) 2010- xml/swf
* @license GNU/GPL http://www.gnu.org/copyleft/gpl.html
**/

defined( '_JEXEC' ) or die( 'Restricted access' );

if (!defined("VM_CATORDER_CLSSS")) {
class DgIparams
{
	var $id;
	var $ref;
	var $order;
	var $name;
}
class DGitem
{
	var $next;
	var $prev;
	var $par; // parrent
	var $firstc; //first child DGitem
	var $params;
	//var $curr_next;
	var $cii;
	var $c_info;
}

class Dgraph
{
	var $first; //first DGitem
	var $arr_forgraph;
	var $first_php4;
	function Dgraph()
	{
		$this->first_php4 = New DGitem();
		$this->first = &$this->first_php4;
		$this->first->next = NULL;
		$this->first->prev = NULL;
		$this->first->par = NULL;
		$this->first->firstc = NULL;
		$this->first->params = New DgIparams();
		$this->first->params->id = 0;
		$this->first->params->ref = -1;
		$this->first->params->order = 0;
		$this->first->params->name = '';
		//$this->curr_next = $this->first;
		$this->cii = 0;
		$this->c_info = array();
	}
	function BuildGraph (&$arr_igr) {
		//$this->arr_forgraph = $arr_igr;
		if ($arr_igr && is_array($arr_igr) && count($arr_igr) > 0) {
			for ($ai=0;$ai<count($arr_igr);$ai++) {
				$this->Add($arr_igr[$ai], $this->first);
			}
		} else {
			return false;
		}
	}
	function &Add(&$newgi, &$currgi)
	{
		//$newgi = &$this->arr_forgraph[$newgi_ai];
		//$currgi = &$this->arr_forgraph[$currgi_ai];
		if ($newgi->params->ref == $currgi->params->ref) {
			if ($newgi->params->order < $currgi->params->order) {
				$newgi->next = &$currgi;
				$newgi->prev = &$currgi->prev;
				$newgi->par = &$currgi->par;
				$currgi->prev = &$newgi;
				if ($newgi->prev) {
					$newgi->prev->next = &$newgi;
				} else {
					$newgi->par->firstc = &$newgi;
				}
				return $newgi;
			} else {
				if ($currgi->next) {
					return $this->Add($newgi, $currgi->next);
				} else {
					$currgi->next = &$newgi;
					$newgi->prev = &$currgi;
					$newgi->par = &$currgi->par;
					$newgi->next = NULL;
					return $newgi;
				}
			}
		} else {
			if ($newgi->params->ref == $currgi->params->id && !$currgi->firstc) {
				$currgi->firstc = &$newgi;
				$newgi->next = NULL;
				$newgi->prev = NULL;
				$newgi->par = &$currgi;
				return $newgi;
			} else {
				@ $theNext = &$this->Next($currgi);
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
		@ $cnext = $this->Next($curr_next);
		if ($cnext) {
			$this->c_info[$this->cii]['id'] = $cnext->params->id;
			$this->c_info[$this->cii]['name'] = $cnext->params->name;
			$this->c_info[$this->cii]['ref'] = $cnext->params->ref;
			$this->cii++;
			return $this->GetCatInfo($cnext);
		} else {
			return $this->c_info;
		}
	}
	function &Next(&$currgi)
	{
		if ($currgi->firstc) {
			return $currgi->firstc;
		} elseif($currgi->next) {
			return $currgi->next;
		} else {
			@ $thePnex = &$this->Pnex($currgi);
			if ($thePnex) {
				return $thePnex;
			} else {
				return false;
			}
		}
	}
	function &Pnex(&$currgi)
	{
		if ($currgi->params->ref == -1) {
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
define("VM_CATORDER_CLSSS", 1);
}

$bannerWidth                   = intval($params->get( 'bannerWidth', 912 ));
$bannerHeight                  = intval($params->get( 'bannerHeight', 700 ));
$backgroundColor         = trim($params->get( 'backgroundColor', '#FFFFFF' ));
$wmode                 = trim($params->get( 'wmode', 'window' ));
$xml_fname    = trim($params->get( 'xml_fname', 'a' ));
$catppv_id = 'xml/' . $xml_fname;

$id    = intval($params->get( 'category_id', 0 ));

$module_path = dirname(__FILE__).DS;
if (!is_dir($module_path . 'xml/')) {
	mkdir($module_path . 'xml/', 0777);
}

if( file_exists(dirname(__FILE__).'/../../components/com_virtuemart/virtuemart_parser.php' )) {
	require_once( dirname(__FILE__).'/../../components/com_virtuemart/virtuemart_parser.php' );
}
else {
	require_once( dirname(__FILE__).'/../components/com_virtuemart/virtuemart_parser.php' );
}

require_once(CLASSPATH.'ps_product.php');
$ps_product = new ps_product;

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

if (!function_exists('create_smartvm_xml_files')) {
function create_smartvm_xml_files($params, &$catppv_id)
{
$item_flag = false;
$database = new ps_DB();
$cat_id                    = trim($params->get( 'category_id', '0' ));
$id                    = explode(",",$cat_id);
$load_curr                 = trim($params->get( 'load_curr', '2' ));

//echo 'before in load'; echo $load_curr; exit();
if ($load_curr == 1) {
	$curr_uri  =& JFactory::getURI();
	$curr_uri_query = $curr_uri->getQuery(true);
	if(isset($curr_uri_query['option']) && $curr_uri_query['option'] == 'com_virtuemart') {
		if (isset($curr_uri_query['category_id'])) {
			unset($id);
			$id = array(0=>$curr_uri_query['category_id']);
		}
	}
}

if (1 == trim($params->get( 'catppv_flag', '2' ))) {
	if (trim($params->get( 'show_featured', 'no' )) == "yes") {
		$catppv_id .= '_fpr';
	} else {
		$catppv_id .= implode("_", $id);
	}
}
$module_path = dirname(__FILE__).DS;
if (!file_exists($module_path . $catppv_id . '.swf') ) {
	copy($module_path . 'slideshow.swf', $module_path . $catppv_id . '.swf');

	///////// set chmod 0644 for creating .wf file  if server is not windows
	$os_string = php_uname('s');
	$cnt = substr_count($os_string, 'Windows');
	if($cnt =='0'){
		@chmod($module_path . $catppv_id . '.swf', 0644);
	}

}

if (trim($params->get( 'show_featured', 'no' )) == "yes") {
	$cats_info[0] = array();
	$cats_info[0]['id'] = 0;
	$cats_info[0]['name'] = 'Featured';
} else {
if ($id[0]!=0)
{
	$query = "Select pc.category_id, pc.category_publish, pc.category_name FROM #__{vm}_category pc" ;		
	$query .= "\n where pc.category_publish = 'Y'";
	$query .= " and (";
	for ($i=0; $i<sizeof($id)-1; $i++) {
		$query .= "pc.category_id=".$id[$i]." or ";
	}
	$query .= "pc.category_id=".$id[$i].")";
	$query .= " ORDER BY pc.list_order";
	$database->query($query);
	$rows = $database->record;
	while ($database->next_record()) {
		$c_id_name[$database->f('category_id')] = $database->f('category_name');
	}
	$cats_info = array();
	$cii = 0;
	foreach($id as $curr_id) {
		$cats_info[$cii] = array();
		$cats_info[$cii]['id'] = $curr_id;
		$cats_info[$cii]['name'] = $c_id_name[$curr_id];
		$cii++;
	}
} else {
	$query = "Select pc.category_id, pc.category_publish, pc.category_name, pc.list_order, px.category_parent_id FROM #__{vm}_category pc, #__{vm}_category_xref px" ;
	$query .= "\n where pc.category_publish = 'Y' and px.category_child_id=pc.category_id";
	$query .= " ORDER BY px.category_parent_id, pc.list_order";
	$database->query($query);
	$rows = $database->record;
	$ci = 0;
	$cgr_info = array();
	while ($database->next_record()) {
		$cgr_info[$ci] = new DGitem();
		$cgr_info[$ci]->next = NULL;
		$cgr_info[$ci]->prev = NULL;
		$cgr_info[$ci]->par = NULL;
		$cgr_info[$ci]->firstc = NULL;
		$cgr_info[$ci]->params->id =  $database->f('category_id');
		$cgr_info[$ci]->params->ref = $database->f('category_parent_id');
		$cgr_info[$ci]->params->order = $database->f('list_order');
		$cgr_info[$ci]->params->name = $database->f('category_name');
		$ci++;
	}

	$cat_graph =  new Dgraph();
	$cat_graph->BuildGraph($cgr_info);
	
	$cats_info = array();
	
	$cats_info = $cat_graph->GetCatInfo($cat_graph->first);

}
}

$xml_data_filename = $module_path.$catppv_id.'.xml';
$xml_data_data = '<?xml version="1.0" encoding="utf-8"?>
<data>
	<channel>
';

$xml_data_data_btns = '';
$c_name = array();
foreach ($cats_info as $curr_cat) {
	$get_catxml = write_prodgalleryvm_xml_data($curr_cat['name'], $curr_cat['id'], $params);
	if ($get_catxml['flag']) {
		$item_flag = true;
		$xml_data_data_btns .= $get_catxml['xml_data'];
	}
}

$roundCorner	= trim($params->get( 'roundCorner', '' ));
$autoPlayTime	= trim($params->get( 'autoPlayTime', '' ));
$isHeightQuality	= trim($params->get( 'isHeightQuality', 'no' ));
$isHeightQuality = ($isHeightQuality == "yes") ? 'true' : 'false';

$blendMode	= 'normal';
$transDuration	= trim($params->get( 'transDuration', '' ));
$windowOpen	= trim($params->get( 'windowOpen', '' ));
$btnSetMargin	= trim($params->get( 'btnSetMargin', '' ));
$btnDistance	= trim($params->get( 'btnDistance', '' ));
$titleBgColor	= trim($params->get( 'titleBgColor', '' ));
$titleTextColor	= trim($params->get( 'titleTextColor', '' ));
$titleBgAlpha	= trim($params->get( 'titleBgAlpha', '' ));
$titleMoveDuration	= trim($params->get( 'titleMoveDuration', '' ));
$btnAlpha	= trim($params->get( 'btnAlpha', '' ));
$btnTextColor	= trim($params->get( 'btnTextColor', '' ));
$btnDefaultColor	= trim($params->get( 'btnDefaultColor', '' ));
$btnHoverColor	= trim($params->get( 'btnHoverColor', '' ));
$btnFocusColor	= trim($params->get( 'btnFocusColor', '' ));
$changImageMode	= trim($params->get( 'changImageMode', '' ));

$isShowBtn	= trim($params->get( 'isShowBtn', '' ));
$isShowBtn = ($isShowBtn == "yes") ? 'true' : 'false';

$isShowTitle	= trim($params->get( 'isShowTitle', '' ));
$isShowTitle = ($isShowTitle == "yes") ? 'true' : 'false';

$scaleMode	= trim($params->get( 'scaleMode', '' ));
$transform	= trim($params->get( 'transform', '' ));
$isShowAbout	= trim($params->get( 'isShowAbout', '' ));
$isShowAbout = ($isShowAbout == "yes") ? 'true' : 'false';
$randomorder	= trim($params->get( 'randomorder', 'no' ));
$randomorder = ($randomorder == "yes") ? 'true' : 'false';
$titleFont	= trim($params->get( 'titleFont', '' ));
$titleFontSize	= trim($params->get( 'titleFontSize', '' ));

$xml_data_data .= $xml_data_data_btns . '
	</channel>
	<config>	
		<roundCorner>' . $roundCorner .'</roundCorner>
		<autoPlayTime>' . $autoPlayTime .'</autoPlayTime>
		<isHeightQuality>' . $isHeightQuality .'</isHeightQuality>
		<blendMode>' . $blendMode .'</blendMode>
		<transDuration>' . $transDuration .'</transDuration>
		<windowOpen>' . $windowOpen .'</windowOpen>
		<btnSetMargin>' . $btnSetMargin .'</btnSetMargin>
		<btnDistance>' . $btnDistance .'</btnDistance>
		<titleBgColor>' . $titleBgColor .'</titleBgColor>
		<titleTextColor>' . $titleTextColor .'</titleTextColor>
		<titleBgAlpha>' . $titleBgAlpha .'</titleBgAlpha>
		<titleMoveDuration>' . $titleMoveDuration .'</titleMoveDuration>
		<btnAlpha>' . $btnAlpha .'</btnAlpha>	
		<btnTextColor>' . $btnTextColor .'</btnTextColor>	
		<btnDefaultColor>' . $btnDefaultColor .'</btnDefaultColor>
		<btnHoverColor>' . $btnHoverColor .'</btnHoverColor>
		<btnFocusColor>' . $btnFocusColor .'</btnFocusColor>
		<changImageMode>' . $changImageMode .'</changImageMode>
		<isShowBtn>' . $isShowBtn .'</isShowBtn>
		<isShowTitle>' . $isShowTitle .'</isShowTitle>
		<randomOrder>' . $randomorder .'</randomOrder>
		<scaleMode>' . $scaleMode .'</scaleMode>
		<transform>' . $transform .'</transform>
		<isShowAbout>' . $isShowAbout .'</isShowAbout>
		<titleFont>' . $titleFont .'</titleFont>
		<titleFontSize>' . $titleFontSize .'</titleFontSize>
	</config>
</data>';


$xml_prodgallery_file = fopen($xml_data_filename,'w');
fwrite($xml_prodgallery_file, $xml_data_data);


///////// set chmod 0777 for creating .wf file  if server is not windows
	$os_string = php_uname('s');
	$cnt = substr_count($os_string, 'Windows');
	if($cnt =='0'){
		@chmod($xml_data_filename, 0777);
	}

fclose($xml_prodgallery_file);
return $item_flag;
}
}

if (!function_exists('write_prodgalleryvm_xml_data')) {
function write_prodgalleryvm_xml_data($cat_name, $cat_id, $params)
{
global $mosConfig_absolute_path, $sess;
$ret_array = array('flag' => false, 'xml_data' => '');

$images_path    		 = trim($params->get( 'images_path', 'components/com_virtuemart/shop_image/product/' ));

if (trim($params->get( 'show_featured', 'no' )) == "yes") {
	$add_cat_q = " pp.product_special='Y' and ";
	$order_q = " RAND() ";
} else {
	$add_cat_q = " pc.category_id=".$cat_id." and ";
	$order_q = " p.product_list ";
}

	if ($params->get('show_price')=="yes")
			{
$query = "Select p.product_id, p.category_id, pc.category_publish, pc.category_flypage, pp.product_id, pp.product_parent_id, pp.product_name, pp.product_thumb_image, pp.product_weight, pp.product_weight_uom, pp.product_full_image, pp.product_s_desc, pr.product_id, pr.product_price,pr.price_quantity_start, pr.price_quantity_end, pt.tax_rate FROM #__{vm}_product_category_xref p,#__{vm}_category pc,#__{vm}_product pp LEFT JOIN  #__{vm}_product_price AS pr ON pp.product_id = pr.product_id" ;
			
$query .= " LEFT JOIN  #__{vm}_tax_rate AS pt ON pp.product_tax_id = pt.tax_rate_id \n where ".$add_cat_q." pc.category_id=p.category_id and pc.category_publish = 'Y' and pp.product_id = p.product_id and pp.product_parent_id=0 and pp.product_publish = 'Y' ORDER BY ".$order_q." LIMIT 20";
			}
			else
			{
$query = "Select p.product_id, p.category_id, pc.category_publish, pc.category_flypage, pp.product_id, pp.product_parent_id, pp.product_name, pp.product_thumb_image, pp.product_weight, pp.product_weight_uom, pp.product_full_image, pp.product_s_desc FROM #__{vm}_product_category_xref p,#__{vm}_category pc,#__{vm}_product pp" ;
			
$query .= "\n where ".$add_cat_q." pc.category_id=p.category_id and pc.category_publish = 'Y' and pp.product_id = p.product_id and pp.product_parent_id=0 and pp.product_publish = 'Y' ORDER BY ".$order_q." LIMIT 20";
			
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

	while ($db->next_record()) 
{
	$ret_array['flag'] = true;
	
	$price_txt = '';
	if ($params->get('show_price')=="yes") {
		//$price_txt .= $params->get('price_text', 'price: ');
		$price_txt .= ' ';
		$price_txt .= $params->get('currency', '$');
		$abs_price = abs($db->f('product_price'));
		$pricetax    = $params->get('pricetax', 'yes');
		if ($pricetax == 'yes') {
			$trate = abs($db->f('tax_rate'));
			if($trate > 0) {
				$abs_price = round((1 + $trate) * $abs_price, 2);
			}
		}
		$price_txt .= $abs_price;
	}
	
      if( !$db->f('category_flypage') ) 
		{
			$flypage = ps_product::get_flypage( $db->f('product_id'));
		}
      else 
		{
			$flypage = $db->f('category_flypage');
		}
$cu_url = $sess->url(URL.'index.php?page=shop.product_details&flypage='.$flypage.'&product_id='.$db->f('product_id').'&category_id='.$db->f('category_id'));
if ($params->get('rel_urls', '1') == 1) {
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
} else {
	$curr_link = $cu_url;
}

$xml_data .= ' <item>
			<link>' . $curr_link . '</link>';


$resCode = getResCode(JURI::root().$images_path . $db->f('product_full_image'));

$is_imageurl = substr_count($resCode['content_type'], 'image');

if($is_imageurl > 0)
{

	if($resCode['http_code']=='200'){

	$xml_data .= '<image>' .(($params->get('rel_urls', '1') == 1) ? JURI::root() : ''). $images_path . $db->f('product_full_image') . '</image>';


	}else{

	$xml_data .= '<image>'.JURI::root().'modules/mod_xmlswf_vm_smart/no_image.png</image>';
	}
}else{
	$xml_data .= '<image>'.JURI::root().'modules/mod_xmlswf_vm_smart/no_image.png</image>';
}

//$xml_data .= '<image>' .(($params->get('rel_urls', '1') == 1) ? JURI::root() : ''). $images_path . $db->f('product_full_image') . '</image>';



$xml_data .= '<title>' . $db->f('product_name') . $price_txt . '</title>
		</item>';
}
		$ret_array['xml_data'] = $xml_data;
		return $ret_array;
}
}
if (create_smartvm_xml_files($params, $catppv_id)) {

?>
<div style="text-align:center;">

<script language="javascript">AC_FL_RunContent = 0;</script>
<script src="<?php echo JURI::root()?>modules/mod_xmlswf_vm_smart/AC_RunActiveContent.js" language="javascript"></script>
<script language="javascript">
	if (AC_FL_RunContent == 0) {
		alert("This page requires AC_RunActiveContent.js.");
	} else {
			AC_FL_RunContent(
			'codebase', 'http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0',
			'width', '<?php echo $bannerWidth;?>',
			'height', '<?php echo $bannerHeight; ?>',
			'src', '<?php echo JURI::root()?>modules/mod_xmlswf_vm_smart/<?php echo $catppv_id; ?>',
			'quality', 'high',
			'pluginspage', 'http://www.adobe.com/go/getflashplayer_cn',
			'align', 'middle',
			'play', 'true',
			'loop', 'true',
			'scale', 'showall',
			'wmode', '<?php echo $wmode;?>',
			'devicefont', 'false',
			'flashvars','url=<?php echo JURI::root()?>modules/mod_xmlswf_vm_smart/<?php echo $catppv_id; ?>.xml',
			'id', 'AnimatedLines',
			'bgcolor', '<?php echo $backgroundColor; ?>',
			'name', 'AnimatedLines',
			'menu', 'true',
			'allowFullScreen', 'false',
			'allowScriptAccess','sameDomain',
			'movie', '<?php echo JURI::root()?>modules/mod_xmlswf_vm_smart/<?php echo $catppv_id; ?>',
			'salign', ''
			); //end AC code
	}
</script>

<noscript>
	<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="<?php echo $bannerWidth;?>" height="<?php echo $bannerHeight; ?>" id="AnimatedLines" align="middle">
	<param name="allowScriptAccess" value="sameDomain" />
	<param name="allowFullScreen" value="false" />
	<param name="flashvars" value="url=<?php echo JURI::root()?>modules/mod_xmlswf_vm_smart/<?php echo $catppv_id; ?>.xml"/>
	<param name="movie" value="<?php echo JURI::root()?>modules/mod_xmlswf_vm_smart/<?php echo $catppv_id; ?>.swf" />
	<param name="quality" value="high" />
	<param name="bgcolor" value="<?php echo $backgroundColor; ?>" />	
	<embed src="<?php echo JURI::root()?>modules/mod_xmlswf_vm_smart/<?php echo $catppv_id; ?>.swf" flashvars="url=<?php echo JURI::root()?>modules/mod_xmlswf_vm_smart/<?php echo $catppv_id; ?>.xml" quality="high" bgcolor="<?php echo $backgroundColor; ?>" width="<?php echo $bannerWidth;?>" height="<?php echo $bannerHeight; ?>" name="AnimatedLines" align="middle" allowScriptAccess="sameDomain" allowFullScreen="false" type="application/x-shockwave-flash" pluginspage="http://www.adobe.com/go/getflashplayer_cn" />
	</object>
</noscript>
</div>
<?php } ?>