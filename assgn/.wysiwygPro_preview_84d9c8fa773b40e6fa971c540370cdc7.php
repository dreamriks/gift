<?php
if ($_GET['randomId'] != "y7ITIOZgzSUxxEVG5X08KXue4r9Qo_CB2bZywo61f15O_G26J8oojEhd7cDQ706X") {
    echo "Access Denied";
    exit();
}

// display the HTML code:
echo stripslashes($_POST['wproPreviewHTML']);

?>  
