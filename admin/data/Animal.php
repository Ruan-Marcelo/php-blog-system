<?php 

// =========================
// GET ALL
// =========================
function getAllAnimals($conn){
   $sql = "SELECT * FROM animals ORDER BY id DESC";
   $stmt = $conn->prepare($sql);
   $stmt->execute();

   return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// =========================
// GET BY ID
// =========================
function getAnimalById($conn, $id){
   $sql = "SELECT * FROM animals WHERE id = ?";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$id]);

   return $stmt->fetch(PDO::FETCH_ASSOC);
}

// =========================
// SEARCH
// =========================
function searchAnimals($conn, $key){
   $key = "%$key%";

   $stmt = $conn->prepare("
       SELECT * FROM animals 
       WHERE name LIKE ? 
       OR species LIKE ? 
       OR description LIKE ?
   ");

   $stmt->execute([$key, $key, $key]);

   return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


// =========================
// DELETE
// =========================
function deleteAnimalById($conn, $id){
   $sql = "DELETE FROM animals WHERE id = ?";
   $stmt = $conn->prepare($sql);
   return $stmt->execute([$id]);
}

// =========================
// CREATE
// =========================
function createAnimal($conn, $data){
   $sql = "INSERT INTO animals (name, species, age, description) 
           VALUES (?, ?, ?, ?)";

   $stmt = $conn->prepare($sql);

   return $stmt->execute([
      $data['name'],
      $data['species'],
      $data['age'],
      $data['description']
   ]);
}

// =========================
// UPDATE
// =========================
function updateAnimal($conn, $data){
   $sql = "UPDATE animals SET 
           name = ?, 
           species = ?, 
           age = ?, 
           description = ?
           WHERE id = ?";

   $stmt = $conn->prepare($sql);

   return $stmt->execute([
      $data['name'],
      $data['species'],
      $data['age'],
      $data['description'],
      $data['id']
   ]);
}