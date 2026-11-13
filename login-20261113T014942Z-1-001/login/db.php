<?php

// $dbHost = 'aws-0-ap-northeast-1.pooler.supabase.com';
// $dbUser = 'postgres.fdpiddtxihemhdwllyjm';
// $dbPassword = 'hy64y2IglbyK8Ezf';

// $conn = pg_connect("host=$dbHost port=5432 dbname=postgres user=$dbUser password=$dbPassword sslmode=require");

// if (!$conn) {
//     exit('Database connection failed.');
// }



//   https://tinyurl.com/vfxnm32k

$localhost = 'localhost';
$username = 'root';
$password = '';
$database = 'login_db';

$conn = new mysqli($localhost, $username, $password, $database);
