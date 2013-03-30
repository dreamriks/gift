<?php
/**
* @Copyright Freestyle Joomla (C) 2010
* @license GNU/GPL http://www.gnu.org/copyleft/gpl.html
*     
* This file is part of Freestyle Testimonials
* This program is free software: you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation, either version 3 of the License, or
* (at your option) any later version.
* 
* This program is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU General Public License for more details.
* 
* You should have received a copy of the GNU General Public License
* along with this program.  If not, see <http://www.gnu.org/licenses/>.
**/
?>
<?php defined('_JEXEC') or die('Restricted access'); ?>
<form action="<?php echo JRoute::_( 'index.php?option=com_fst&view=tests' );?>" method="post" name="adminForm">
<?php $ordering = ($this->lists['order'] == "ordering"); ?>
<div id="editcell">
	<table>
		<tr>
			<td width="100%">
				<?php echo JText::_("FILTER"); ?>:
				<input type="text" name="search" id="search" value="<?php echo JView::escape($this->lists['search']);?>" class="text_area" onchange="document.adminForm.submit();" title="<?php echo JText::_("FILTER_BY_TITLE_OR_ENTER_ARTICLE_ID");?>"/>
				<button onclick="this.form.submit();"><?php echo JText::_("GO"); ?></button>
				<button onclick="document.getElementById('search').value='';this.form.submit();this.form.getElementById('prod_id').value='0';this.form.getElementById('ispublished').value='-1';"><?php echo JText::_("RESET"); ?></button>
			</td>
			<td nowrap="nowrap">
				<?php
//
				if (array_key_exists("published",$this->lists)) echo $this->lists['published'];
				?>
			</td>
		</tr>
	</table>

    <table class="adminlist">
    <thead>

        <tr>
			<th width="5">#</th>
            <th width="20" class="title">
   				<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $this->data ); ?>);" />
			</th>
            <th  class="title" width="8%" nowrap="nowrap">
				<?php echo JHTML::_('grid.sort',   'Name', 'name', @$this->lists['order_Dir'], @$this->lists['order'] ); ?>
			</th>
			<!-- If not got a type selected -->
			
			<!-- If a type has been selected, then be more specific -->
			<?php if ($this->ident): ?>
<!--//-->
			<?php else: ?>
<!--//-->
				<th  class="title" width="8%" nowrap="nowrap">
					<?php echo JHTML::_('grid.sort',   'Article/Product', 'itemid', @$this->lists['order_Dir'], @$this->lists['order'] ); ?>
				</th>
			<?php endif; ?>
			
			<th class="title">
				<?php echo JText::_("BODY"); ?>
			</th>
			<th  class="title" width="8%" nowrap="nowrap">
				<?php echo JHTML::_('grid.sort',   'Added', 'added', @$this->lists['order_Dir'], @$this->lists['order'] ); ?>
			</th>
			<th width="1%" nowrap="nowrap">
				<?php echo JHTML::_('grid.sort',   'MOD_STATUS', 'published', @$this->lists['order_Dir'], @$this->lists['order'] ); ?>
			</th>
		</tr>
    </thead>
    <?php

    $k = 0;
    for ($i=0, $n=count( $this->data ); $i < $n; $i++)
    {
        $row =& $this->data[$i];
        $checked    = JHTML::_( 'grid.id', $i, $row->id );
        $link = JRoute::_( 'index.php?option=com_fst&controller=test&task=edit&cid[]='. $row->id );

    	$published = FST_GetModerationText($row->published);

        ?>
        <tr class="<?php echo "row$k"; ?>">
            <td>
                <?php echo $row->id; ?>
            </td>
           	<td>
   				<?php echo $checked; ?>
			</td>
			<td>
			    <?php echo $row->name; ?>
			</td>
<!--//-->
			<td>
			    <?php echo $this->comment_objs[$row->ident]->handler->GetItemTitle($row->itemid); ?>
			</td>
 			<td>
			    <a href="<?php echo $link; ?>"><?php
			    	$body = strip_tags($row->body);
			    	if (strlen($body) > 250)
			    		$body = substr($body,0,250) . "...";

			    	echo $body;
			    ?></a>
			</td>
  			<td>
			    <?php echo FST_Helper::Date($row->added,FST_DATETIME_MID); ?>
			</td>
			<td align="center">
				<a href="#" class="modchage" id="comment_<?php echo $row->id;?>" current='<?php echo $row->published; ?>'>
					<?php echo $published; ?>
				</a>
			</td>
		</tr>
        <?php
        $k = 1 - $k;
    }
    ?>
	<tfoot>
		<tr>
			<td colspan="9"><?php echo $this->pagination->getListFooter(); ?></td>
		</tr>
	</tfoot>

    </table>
</div>

<input type="hidden" name="option" value="com_fst" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="boxchecked" value="0" />
<input type="hidden" name="controller" value="test" />
<input type="hidden" name="filter_order" value="<?php echo $this->lists['order']; ?>" />
<input type="hidden" name="filter_order_Dir" value="<?php echo $this->lists['order_Dir']; ?>" />
</form>

<script>
jQuery(document).ready(function () {
	jQuery('.modchage').click( function () {
		var id = jQuery(this).attr('id').split('_')[1];
		var current = jQuery(this).attr('current');
		if (current == 1)
		{
			fst_remove_comment(id);		
		} else {
			fst_approve_comment(id);
		}
	});
});


function fst_remove_comment(commentid) {
 	var obj = jQuery('#comment_' + commentid);
	obj.attr('current',2);
 	var img = jQuery('#comment_' + commentid + ' img');
    var src = img.attr('src');
	
	var curimg = src.split("/").pop();
	src = src.replace(curimg, "declined.png");
	img.attr('src',src);
	
    var url = "<?php echo JRoute::_('index.php?option=com_fst&view=tests&task=removecomment&commentid=XXCIDXX',false); ?>";
    url = url.replace("XXCIDXX",commentid);
    jQuery.get(url);
}
function fst_approve_comment(commentid) {
 	var obj = jQuery('#comment_' + commentid);
	obj.attr('current',1);
    var img = jQuery('#comment_' + commentid + ' img');
    var src = img.attr('src');
	
	var curimg = src.split("/").pop();
	src = src.replace(curimg, "accepted.png");
	img.attr('src',src);
	
    var url = "<?php echo JRoute::_('index.php?option=com_fst&view=tests&task=approvecomment&commentid=XXCIDXX',false); ?>";
    url = url.replace("XXCIDXX",commentid);
    jQuery.get(url);
}

</script>