<?php
// @version $Id: default.php 10381 2008-06-01 03:35:53Z pasamio $
defined('_JEXEC') or die('Restricted access');
?>

<h4 class="eny_poll"><?php echo $poll->title; ?></h4>
<form name="form2" method="post" action="index.php" class="poll">
	<fieldset>
		<?php for ($i = 0, $n = count($options); $i < $n; $i++) : ?>
		<div class="eny_poll_vote">
		<input type="radio" name="voteid" id="voteid<?php echo $options[$i]->id; ?>" value="<?php echo $options[$i]->id; ?>" alt="<?php echo $options[$i]->id; ?>" />
		<label for="voteid<?php echo $options[$i]->id; ?>">
			<?php echo $options[$i]->text; ?>
		</label>
		</div>
		<?php endfor; ?>
	</fieldset>
	
	<div class="eny_poll_vote_results">
	<input type="submit" name="task_button" class="button" value="<?php echo JText::_('Vote'); ?>" />
	<a class="eny_poll" href="<?php echo JRoute::_('index.php?option=com_poll&id='.$poll->slug.$itemid.'#content'); ?>">
		<?php echo JText::_('Results'); ?></a>
	</div>

	<input type="hidden" name="option" value="com_poll" />
	<input type="hidden" name="id" value="<?php echo $poll->id; ?>" />
	<input type="hidden" name="task" value="vote" />
	<?php echo JHTML::_( 'form.token' ); ?>
</form>
