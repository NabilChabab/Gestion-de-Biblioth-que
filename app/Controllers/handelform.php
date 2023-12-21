<?php

require '../../vendor/autoload.php';
use MyApp\Models\User;
use MyApp\Controllers\UserController;
use MyApp\Models\Reservation;
use MyApp\Models\Book;

session_start();

if (isset($_POST['register'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $image = $_FILES['image'];

    $userController = new UserController();
    $userController->register($firstname, $lastname, $email, $phone, $password, $image);
}


if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $user = new User('', '', '', '', $email, $password, '');

    if ($user->getByEmail() > 0) {

        $role = $_SESSION['role'];
        switch ($role) {
            case 1:
                header('Location:../../Views/admin/home.php?welcomeadmin');
                exit();
            case 2:
                header('Location:../../Views/users/index.php?welcomeuser');
                exit();
            default:
                echo "Unknown role";
                break;
        }
    } else {
        echo "Login failed. Please check your credentials.";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['reserve'])) {

        $bookId = $_POST['bookId'];
        $returnDate = $_POST['returnDate'];

        if (isset($_SESSION['user_id'])) {
            $userId = $_SESSION['user_id'];

            $description = 'Reserved';

            $reservationModel = new Reservation();
            $result = $reservationModel->createReservation($userId, $bookId, $description, date('Y-m-d'), $returnDate);

            if ($result) {
                $bookModel = new Book();
                $currentAvailableCopies = $bookModel->getAvailableCopiesById($bookId);

                if ($currentAvailableCopies > 0) {
                    $newAvailableCopies = $currentAvailableCopies - 1;
                    $bookModel->updateAvailableCopies($bookId, $newAvailableCopies);
                    $_SESSION['reservation_success'] = true;
                    header('Location: ../../Views/users/index.php?success');
                    exit();
                } else {
                    echo "Error updating available copies: No available copies left.";
                }
            }
        } else {
            echo "User not logged in";
        }
    } elseif (isset($_POST['edit']) && isset($_GET['id'])) {
        $bookId = $_GET['id'];
        $title = $_POST['title'];
        $genre = $_POST['genre'];
        $author = $_POST['author'];
        $desc = $_POST['description'];
        $publicationYear = $_POST['publication'];
        $totalCopies = $_POST['total_copies'];
        $availableCopies = $_POST['available_copies'];


        $bookModel = new Book();
        $result = $bookModel->updateBook(
            $bookId,
            $title,
            $author,
            $genre,
            $desc,
            $publicationYear,
            $totalCopies,
            $availableCopies,
        );

        if ($result) {
            header('Location: ../../Views/admin/books.php');
            exit();
        } else {
            echo "Error adding book";
        }
    }
} else {
    echo "Invalid request";

}