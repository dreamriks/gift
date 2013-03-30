<?php
/*
    Document   : default_posts.php
    Created on : 30-dic-2009, 19:30:05
    Author     : Luis Martín
    Description:
        template to display list of posts (thread of messages)
*/

defined( '_JEXEC' ) or die( 'Restricted access' ); ?>
<!-- Tabla de posts -->
<table class="post_list">
    <thead>
        <tr>
            <th><?php echo JText::_('POSTNUMBER');?></th>
            <th><?php echo JText::_('MESSAGE');?></th>
            <th><?php echo JText::_('CREATIONDATE');?></th>
            <th><?php echo JText::_('AUTHOR');?></th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = count($this->posts);
        $odds = 0;
        // Loop through all posts
        foreach ($this->posts as $post) {
        ?>
            <tr class="r<?php echo $odds; ?>">
                <td><?php echo $i; ?></td>
                <td><?php echo $post->post_body; ?></td>
                <td><?php echo JHTML::Date($post->cdate, $this->dateFormatArr['strftime']); ?></td>
                <td><?php echo $post->username; ?></td>
            </tr>
        <?php
            $i--;
            $odds = 1 - $odds;
        }
        ?>
    </tbody>
</table>
