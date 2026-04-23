<?php

function getAllBanners($conn){
    $sql = "SELECT * FROM banner ORDER BY id DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getBannerById($conn, $id){
    $sql = "SELECT * FROM banner WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function addBanner($conn, $image, $title){
    $sql = "INSERT INTO banner (image, title, active) VALUES (?, ?, 1)";
    $stmt = $conn->prepare($sql);
    return $stmt->execute([$image, $title]);
}

function updateBanner($conn, $id, $image, $title){
    $sql = "UPDATE banner SET image=?, title=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    return $stmt->execute([$image, $title, $id]);
}

function deleteBanner($conn, $id){
    $sql = "DELETE FROM banner WHERE id=?";
    $stmt = $conn->prepare($sql);
    return $stmt->execute([$id]);
}