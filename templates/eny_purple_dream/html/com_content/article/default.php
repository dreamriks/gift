<?php // no direct access
defined('_JEXEC') or die('Restricted access');

$canEdit	= ($this->user->authorize('com_content', 'edit', 'content', 'all') || $this->user->authorize('com_content', 'edit', 'content', 'own'));
?>

		<!-- Title Check -->
		<?php if ($this->params->get('show_page_title', 1) && $this->params->get('page_title') != $this->article->title) : ?>
		<h1><?php echo $this->escape($this->params->get('pageclass_sfx')); ?>">
		<?php echo $this->escape($this->params->get('page_title')); ?>
		</h1>
		<?php endif; ?>
	
		<!-- Icon Check -->
		<?php if ($canEdit || $this->params->get('show_title') || $this->params->get('show_pdf_icon') || $this->params->get('show_print_icon') || $this->params->get('show_email_icon')) : ?>

<!-- H1 Title & Iconbar -->
<div class="page_area">

	<!-- H1 Title -->
	<div class="title">
		<?php if ($this->params->get('show_title')) : ?>
		<h1>
		<?php if ($this->params->get('link_titles') && $this->article->readmore_link != '') : ?>
		<a href="<?php echo $this->article->readmore_link; ?>" class="h1<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>">
		<?php echo $this->escape($this->article->title); ?>
		</a>
		
		<?php else : ?>
		<?php echo $this->escape($this->article->title); ?>
		<?php endif; ?>
		</h1>
		<?php endif; ?>
	</div>
	
	<!-- Icon -->
	<div class="icon">
		<!-- PDF Icon -->
		<?php if (!$this->print) : ?>
		<?php if ($this->params->get('show_pdf_icon')) : ?>
		<?php echo JHTML::_('icon.pdf',  $this->article, $this->params, $this->access); ?>
		<?php endif; ?>
		
		<!-- Print icon -->
		<?php if ( $this->params->get( 'show_print_icon' )) : ?>
		<?php echo JHTML::_('icon.print_popup',  $this->article, $this->params, $this->access); ?>
		<?php endif; ?>
		
		<!-- Email Icon -->
		<?php if ($this->params->get('show_email_icon')) : ?>
		<?php echo JHTML::_('icon.email',  $this->article, $this->params, $this->access); ?>
		<?php endif; ?>
		
		<!-- Edit Icon -->
		<?php if ($canEdit) : ?>
		<?php echo JHTML::_('icon.edit', $this->article, $this->params, $this->access); ?>
		<?php endif; ?>
		
		<!-- Print Screen Icon -->
		<?php else : ?>
		<?php echo JHTML::_('icon.print_screen',  $this->article, $this->params, $this->access); ?>
		<?php endif; ?>
	</div>
	
<div class="clear"></div>
</div>
<?php endif; ?>





		<!-- Show Intro Query -->
		<?php  if (!$this->params->get('show_intro')) :
		echo $this->article->event->afterDisplayTitle;
		endif; ?>

<?php echo $this->article->event->beforeDisplayContent; ?>
<div class="page_area<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>">

	<!-- Article Info -->
	<div class="article_info">
		<?php if (($this->params->get('show_author')) && ($this->article->author != "")) : ?>
		<span class="eny_author">
		<?php JText::printf( 'Written by', ($this->escape($this->article->created_by_alias) ? $this->escape($this->article->created_by_alias) : $this->escape($this->article->author)) ); ?>
		</span>
		<?php endif; ?>

		<?php if ($this->params->get('show_create_date')) : ?>
		<span class="eny_date">
		<?php echo JHTML::_('date', $this->article->created, JText::_('DATE_FORMAT_LC2')) ?>
		</span>
		<?php endif; ?>
		
		<?php if ( intval($this->article->modified) !=0 && $this->params->get('show_modify_date')) : ?>
		<p><span class="eny_modify">
		<?php echo JText::sprintf('LAST_UPDATED2', JHTML::_('date', $this->article->modified, JText::_('DATE_FORMAT_LC2'))); ?>
		</span></p>
		<?php endif; ?>
	</div>



	<!-- Section & Category Link -->
	<?php if (($this->params->get('show_section') && $this->article->sectionid) || ($this->params->get('show_category') && $this->article->catid)) : ?>
	<div class="sectioncategory">
	
		<!-- Section -->
		<?php if ($this->params->get('show_section') && $this->article->sectionid && isset($this->article->section)) : ?>
		<span>
			<?php if ($this->params->get('link_section')) : ?>
				<?php echo '<a href="'.JRoute::_(ContentHelperRoute::getSectionRoute($this->article->sectionid)).'">'; ?>
			<?php endif; ?>
			<?php echo $this->escape($this->article->section); ?>
			<?php if ($this->params->get('link_section')) : ?>
				<?php echo '</a>'; ?>
			<?php endif; ?>
				<?php if ($this->params->get('show_category')) : ?>
				<?php echo ' - '; ?>
			<?php endif; ?>
		</span>
		<?php endif; ?>
		
		<!-- Category -->
		<?php if ($this->params->get('show_category') && $this->article->catid) : ?>
		<span>
			<?php if ($this->params->get('link_category')) : ?>
				<?php echo '<a href="'.JRoute::_(ContentHelperRoute::getCategoryRoute($this->article->catslug, $this->article->sectionid)).'">'; ?>
			<?php endif; ?>
			<?php echo $this->escape($this->article->category); ?>
			<?php if ($this->params->get('link_category')) : ?>
				<?php echo '</a>'; ?>
			<?php endif; ?>
		</span>
		<?php endif; ?>
		
	</div>
	<?php endif; ?>

	<!-- Article URLs -->
	<?php if ($this->params->get('show_url') && $this->article->urls) : ?>
	<div>
		<a href="http://<?php echo $this->article->urls ; ?>" target="_blank">
		<?php echo $this->escape($this->article->urls); ?></a>
	</div>
	<?php endif; ?>

	<!-- Article | Content -->
	<div>
		<?php if (isset ($this->article->toc)) : ?>
		<?php echo $this->article->toc; ?>
		<?php endif; ?>
		<?php echo $this->article->text; ?>
	</div>

</div>

<!-- Article Event -->
<div class="article_event">
<?php echo $this->article->event->afterDisplayContent; ?>
</div>