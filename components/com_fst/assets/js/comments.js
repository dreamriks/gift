function commentFormRedirect() {

    jQuery("#addcommentform").submit(function (event) {
        event.preventDefault();


        /*if (jQuery('#comment_name').val() == "" || jQuery('#comment_body').val() == "") {
            alert("<?php echo JText::_('YOU_MUST_ENTER_A_NAME_AND_COMMENT'); ?>");
            return;
        }*/

        var $form = jQuery(this),
        term = $form.find('input[name="s"]').val(),
        url = $form.attr('action');
        jQuery('#addcomment').attr("disabled", true);

        jQuery.post(url, jQuery("#addcommentform").serialize(),
            function (data) {
               
                var reevent = false;
                var result = JSON.parse(data);

                // update comments display
                jQuery('.fst_comments_result').each ( function() {
                    if (result['display'] == "before") {
                        jQuery(this).html(result['comment'] + jQuery(this).html());
                    } else if (result['display'] == "after") {
                        jQuery(this).html(jQuery(this).html() + result['comment']);
                    } else if (result['display'] == "replace") {
                        jQuery(this).html(result['comment']);
                    }
                });

                // update form display
                if (result['form_display'] == "replace") {
                    jQuery('#add_comment').html(result['form']);
                    reevent = true;
                } else if (result['form_display'] == "clear_comment") {
                    jQuery('#comment_body').val("");
                    jQuery('#addcomment').attr("disabled", false);
                }

                if ($('captcha_cont') && typeof Recaptcha != "undefined") {
                    Recaptcha.create("6LcQbAcAAAAAAHuqZjftCSvv67KiptVfDztrZDIL", $('captcha_cont'));
                }

                if (reevent) {
                    commentFormRedirect();
                }

                if (result['valid'] == 0)
                    jQuery('#commentaddbutton').click();

                sortCommentHeights();
            }
        );

    });

    jQuery("#editcommentform").submit(function (event) {
        event.preventDefault();

        var $form = jQuery(this),
        term = $form.find('input[name="s"]').val(),
        url = $form.attr('action');
        var commentid = jQuery('#canceledit').attr('commentid');

        jQuery.post(url, jQuery("#editcommentform").serialize(),
            function (data) { 
                var newcomment = jQuery(data);
                newcomment.insertAfter(jQuery('#fst_comment_' + commentid));
                jQuery('#fst_comment_' + commentid).remove();
                sortCommentHeights();
            }
        );

    });
}

function sortCommentHeights() {
    jQuery('.fst_comment').each(function () {
        var baseheight = jQuery(this).innerHeight();
        var top = parseInt(jQuery(this).css('padding-top').replace('px', ''));
        if (top) {
            baseheight -= top;
        } else {
            top = 0;
        }
        var bottom = parseInt(jQuery(this).css('padding-bottom').replace('px', ''));
        if (bottom) {
            baseheight -= bottom;
        } else {
            bottom = 0;
        }
        var height = jQuery(this).children('.fst_comment_left').outerHeight();
        height = Math.max(height, jQuery(this).children('.fst_kb_mod_this').outerHeight());
        height = Math.max(height, jQuery(this).children('.fst_comment_comment').outerHeight());

        var pad = height - baseheight + top;
        jQuery(this).css('padding-bottom', pad + 'px');
    });    
}

jQuery(document).ready(function () {
    commentFormRedirect();
    sortCommentHeights();
});

function fst_remove_comment(commentid) {
    jQuery('#fst_comment_' + commentid).css('background-color', '#ffeeee');
    jQuery('#fst_comment_' + commentid + '_cross').css('display', 'none');
    jQuery('#fst_comment_' + commentid + '_tick').css('display', 'inline');
    jQuery('#fst_comment_' + commentid + '_delete').css('display', 'inline');
    var url = "<?php echo JRoute::_('&task=removecomment&commentid=XXCIDXX',false); ?>";
    url = url.replace("XXCIDXX",commentid);
    jQuery.get(url);
}
function fst_approve_comment(commentid) {
    jQuery('#fst_comment_' + commentid).css('background-color', '#eeffee');
    jQuery('#fst_comment_' + commentid + '_cross').css('display', 'inline');
    jQuery('#fst_comment_' + commentid + '_tick').css('display', 'none');
    jQuery('#fst_comment_' + commentid + '_delete').css('display', 'none');
    var url = "<?php echo JRoute::_('&task=approvecomment&commentid=XXCIDXX',false); ?>";
    url = url.replace("XXCIDXX",commentid);
    jQuery.get(url);
}
function fst_delete_comment(commentid) {
    jQuery('#fst_comment_' + commentid).css('background-color', '#dddddd');
    jQuery('#fst_comment_' + commentid).html('<?php echo JText::_("COMMENT_DELETED"); ?>');
    var url = "<?php echo JRoute::_('&task=deletecomment&commentid=XXCIDXX',false); ?>";
    url = url.replace("XXCIDXX",commentid);
    jQuery.get(url);
}
function fst_edit_comment(commentid) {
    jQuery('#fst_comment_' + commentid).html('<?php echo JText::_("PLEASE_WAIT"); ?>');
    var url = "<?php echo JRoute::_('&task=editcomment&commentid=XXCIDXX',false); ?>";
    url = url.replace("XXCIDXX",commentid);
    jQuery('#canceledit').each(function() {
        var commentid = jQuery(this).attr('commentid');
        cancel_edit(commentid);
    });
    jQuery.get(url, function (data) {
        jQuery('#fst_comment_' + commentid).html(data);
        setup_edit_form();
    });
}
function setup_edit_form()
{
    commentFormRedirect();

    jQuery('#canceledit').click(function(ev) {
        ev.preventDefault();
        var commentid = jQuery(this).attr('commentid');
        cancel_edit(commentid);
    });
}
function cancel_edit(commentid)
{
    var url = "<?php echo JRoute::_('&task=showcomment&commentid=XXCIDXX',false); ?>";
    url = url.replace('XXCIDXX', commentid);

    jQuery.get(url, function (data) {
        var newcomment = jQuery(data);
        newcomment.insertAfter(jQuery('#fst_comment_' + commentid));
        jQuery('#fst_comment_' + commentid).remove();
        sortCommentHeights();
        //jQuery('#fst_comment_' + commentid).html(data);
    });
}
var fst_ident = '<?php echo JRequest::getVar("ident",0); ?>';
var fst_published = '<?php echo JRequest::getVar("published",0); ?>';

function fst_moderate_refresh() {
    fst_ident = jQuery('#ident').val();
    fst_published = jQuery('#published').val();
    
    jQuery('#fst_moderate').html("<div class='fst_please_wait'><?php echo JText::_('PLEASE_WAIT'); ?></div>");

    var url = "<?php echo JRoute::_('&task=modinner&ident=XXXIDXX&published=XXPXX',false); ?>";
    url = url.replace('XXXIDXX',fst_ident);
    url = url.replace('XXPXX',fst_published);

    jQuery.get(url, function (data) {
        jQuery('#fst_moderate').html(data);
        sortCommentHeights();
    });
}
