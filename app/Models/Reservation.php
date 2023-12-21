<?php

namespace MyApp\Models;
require '../../vendor/autoload.php';
use MyApp\Database\Database;
use PDOException;
use PDO;

class Reservation
{
    private $conn;

    public function __construct()
    {
        $this->conn = Database::connect();
    }

    public function createReservation($userId, $bookId, $description, $reservationDate, $returnDate)
    {
        try {
            $query = "INSERT INTO `reservation`(`description`, `reservation_date`, `return_date`,`user_id`, `book_id`) VALUES (:description, :reservationDate, :returnDate , :userId, :bookId)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':reservationDate', $reservationDate);
            $stmt->bindParam(':returnDate', $returnDate);
            $stmt->bindParam(':userId', $userId);
            $stmt->bindParam(':bookId', $bookId);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function deleteReservation($id) {
        try {
            $query = "DELETE FROM `reservation` WHERE `id` = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id);
    
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

}
