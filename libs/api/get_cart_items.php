<?php
require_once '../load.php';
header('Content-Type: application/json');

echo json_encode(Cart::items());