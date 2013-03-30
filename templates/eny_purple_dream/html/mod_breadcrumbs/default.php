<?php
/**
* @package   ENY Purple Dream
* @version   1.0.00 2009-11-17 15:43:26
* @author    ENYtheme http://www.enytheme.com
* @copyright Copyright (C) 2009 ENYtheme e.K.
*/

// no direct access
defined('_JEXEC') or die('Restricted access'); ?>
<div class="eny_breadcrumb_left">
		<?php if ($params->get('showHome', 1)) {
			echo '<a href="'.$this->baseurl.'"><img class="eny_breadcrumb_home" title="Home" alt="Home" src="templates/eny_purple_dream/images/eny_home.png"/></a>';
			}
		?>
</div>
<div class="eny_breadcrumb_middle">
	<span class="eny_breadcrumbs_pathway">
		<?php for ($i = 0; $i < $count; $i ++) :
			if (($i == 0) &&($params->get('showHome', 1)))  {
				echo '';
			}	
			elseif ($i < $count -1) {
				if(!empty($list[$i]->link)) {
					echo '<a href="'.$list[$i]->link.'#content" class="pathway">'.$list[$i]->name.'</a>';
				} else {
					echo $list[$i]->name;
				}
				echo '  ';
			}  else if ($params->get('showLast', 1)) { // when $i == $count -1 and 'showLast' is true
	    		echo $list[$i]->name;
			}
		endfor; ?>
	</span>
</div>
<div class="clear"></div>
