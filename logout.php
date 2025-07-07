<?php

ob_start(); // Start output buffering
include "libs/load.php";
Session::start();
Session::destroy();
header("Location: index.php");
exit;