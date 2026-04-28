<?php 

/**
 * @var PDO $conn
 */

$sName = "localhost";
$uName = "root";
$pass = "";
$db_name = "blog_db";

try {
    $conn = new PDO(
        "mysql:host=localhost;port=3307;dbname=$db_name",
        $uName,
        $pass
    );

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {
    echo "Connection failed : " . $e->getMessage();
}