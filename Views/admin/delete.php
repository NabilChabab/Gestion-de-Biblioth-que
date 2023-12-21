<?php
require '../../vendor/autoload.php';
use MyApp\Models\Book;
use MyApp\Models\Reservation;
session_start();
if (isset($_GET['id']) && isset($_GET['delete'])) {
    $bookModel = new Book();
    $id = base64_decode($_GET['id']);
    $delete = $bookModel->deleteBook($id);
    header('location: books.php');
}elseif (isset($_GET['id']) && isset($_GET['deleteres'])) {
    $resModel = new Reservation();
    $id = base64_decode($_GET['id']);
    $delete = $resModel->deleteReservation($id);
    header('location: reservations.php');
}
?>