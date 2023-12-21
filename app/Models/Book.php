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

public function updateBook($bookId , $title, $author , $genre, $desc ,$publicationYear, $totalCopies, $availableCopies){
    try {
        $query = "UPDATE `book` SET `title` = :title, `author` = :author, `genre` = :genre, `description` = :description, `publication_year` = :publicationYear, `total_copies` = :totalCopies, `available_copies` = :availableCopies WHERE `id` = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':genre', $genre);
        $stmt->bindParam(':author', $author);
        $stmt->bindParam(':description', $desc);
        $stmt->bindParam(':publicationYear', $publicationYear);
        $stmt->bindParam(':totalCopies', $totalCopies);
        $stmt->bindParam(':availableCopies', $availableCopies);
        $stmt->bindParam(':id', $bookId);

        return $stmt->execute();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }
}

public function deleteBook($bookId) {
    try {
        $query = "DELETE FROM `book` WHERE `id` = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $bookId);

        return $stmt->execute();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }
}

public function updateAvailableCopies($bookId, $newAvailableCopies)
{
    try {
        echo "Book ID: " . $bookId . "<br>";
        echo "New Available Copies: " . $newAvailableCopies . "<br>";

        $query = "UPDATE `book` SET `available_copies` = :availableCopies WHERE `id` = :bookId";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':availableCopies', $newAvailableCopies);
        $stmt->bindParam(':bookId', $bookId);

        if ($stmt->execute()) {
            echo "Update successful";
            return true;
        } else {
            echo "Update failed";
            print_r($stmt->errorInfo());
            return false;
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }
}


public function getAvailableCopiesById($bookId)
{
    try {
        $query = "SELECT `available_copies` FROM `book` WHERE `id` = :bookId";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':bookId', $bookId, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchColumn();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }
}

public function getBookById($bookId)
{
    try {
        $query = "SELECT * FROM book WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $bookId, \PDO::PARAM_INT);
        $stmt->execute();

        $book = $stmt->fetch(\PDO::FETCH_ASSOC);

        return $book ?: false;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }
}

}
