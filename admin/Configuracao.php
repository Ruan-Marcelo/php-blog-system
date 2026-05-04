<?php
session_start();

if (isset($_SESSION['admin_id']) && isset($_SESSION['username'])) {
?>

<!DOCTYPE html>
<html>

<head>
    <title>Dashboard - Banners</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/CSS/side-bar.css">
    <link rel="stylesheet" href="../assets/CSS/style.css">

    <style>
        body {
            background-image: url('https://static.wikia.nocookie.net/koppieverse/images/2/2a/JP.png/revision/latest?cb=20250228160704');
        }
    </style>
</head>

<body>

<?php
$key = "hhdsfs1263z";
include "inc/side-nav.php";

?>



<script>
    var navList = document.getElementById('navList').children;
    navList.item(6).classList.add("active");
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

<?php
} else {
    header("Location: ../admin-login.php");
    exit;
}
?>