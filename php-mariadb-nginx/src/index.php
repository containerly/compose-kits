<?php

$database_host = getenv('DATABASE_HOST');
$database_name = getenv('DATABASE_NAME');
$database_user = getenv('DATABASE_USER');
$database_pass = getenv('DATABASE_PASS');

$dbConn = new PDO("mysql:host={$database_host};dbname={$database_name}", $database_user, $database_pass);
$stmt = $dbConn->query("desc users;")->fetchAll();

echo '<pre>';
print_r($stmt);
echo '</pre>';
