<?php

require_once __DIR__ . '/functions.php';

$id = filter_input(INPUT_GET, 'id');

// データベースに接続
deleteCustomer($id);

header('Location: index.php');
exit;