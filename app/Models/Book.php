<?php

namespace MyApp\Models;
require '../../vendor/autoload.php';
use MyApp\Database\Database;
use PDO;
use PDOException;

class Book
{
    private $conn;

    public function __construct()
    {
        $this->conn = Database::connect();
    }

    public function getAllBooks()
    {
        $query = "SELECT * FROM book";
        $stmt = $this->conn->query($query);

        if (!$stmt) {
            echo "Error in query: " . $this->conn->errorInfo()[2];
            return false;
        } else {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    public function addBook($title, $author , $genre, $desc ,$publicationYear, $totalCopies, $availableCopies,$cover){
    try {
        $query = "INSERT INTO `book` (`title`, `author`, `genre`, `description`, `publication_year`, `total_copies`, `available_copies`, `cover`) 
                  VALUES (:title,:author, :genre, :description, :publicationYear, :totalCopies, :availableCopies, :cover)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':genre', $genre);
        $stmt->bindParam(':author', $author);
        $stmt->bindParam(':description', $desc);
        $stmt->bindParam(':publicationYear', $publicationYear);
        $stmt->bindParam(':totalCopies', $totalCopies);
        $stmt->bindParam(':availableCopies', $availableCopies);
        $stmt->bindParam(':cover', $cover);

        return $stmt->execute();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }
}



}
