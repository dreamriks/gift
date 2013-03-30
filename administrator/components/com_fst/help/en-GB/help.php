<?php

$help = $_GET['help'];

$url = "http://www.freestyle-joomla.com/comhelp/fst/" . $help;

header("Location: $url");