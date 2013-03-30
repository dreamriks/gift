<?php

$help = $_GET['help'];

$url = "http://www.freestyle-joomla.com/comhelp/fsf/" . $help;

header("Location: $url");