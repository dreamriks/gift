<?php // no direct access
defined('_JEXEC') or die('Restricted access');
$cparams =& JComponentHelper::getParams('com_media');
?>
<?php if ($this->params->get('show_page_title', 1)) : ?>
<div class="componentheading<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>">
	<h1><?php echo $this->escape($this->params->get('page_title')); ?></h1>
</div>
<?php endif; ?>


<div class="contentpane<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>">

	<div class="contentdescription<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>">
	<?php if ($this->params->get('show_description_image') && $this->section->image) : ?>
	<div class="eny_section_table">
		<img src="<?php echo $this->baseurl . '/' . $cparams->get('image_path') . '/'.  $this->section->image;?>" />
	<?php endif; ?>
	<?php if ($this->params->get('show_description') && $this->section->description) : ?>
	<div class="eny_section_table_description">
		<?php echo $this->section->description; ?>
		</div>
	<?php endif; ?>
	</div>
</div>


	<div class="eny_section_table">
	<?php if ($this->params->get('show_categories', 1)) : ?>
	<ul>
	<?php foreach ($this->categories as $category) : ?>
		<?php if (!$this->params->get('show_empty_categories') && !$category->numitems) continue; ?>
		<li>
			<a href="<?php echo $category->link; ?>" class="category">
				<?php echo $this->escape($category->title);?></a>
			<?php if ($this->params->get('show_cat_num_articles')) : ?>
			&nbsp;
			<span class="small">
				( <?php if ($category->numitems==1) {
				echo $category->numitems ." ". JText::_( 'item' );}
				else {
				echo $category->numitems ." ". JText::_( 'items' );} ?> )
			</span>
			<?php endif; ?>
			<?php if ($this->params->def('show_category_description', 1) && $category->description) : ?>
			<br />
			<?php echo $category->description; ?>
			<?php endif; ?>
		</li>
	<?php endforeach; ?>
	</ul>
	<?php endif; ?>
	</div>

</div>
