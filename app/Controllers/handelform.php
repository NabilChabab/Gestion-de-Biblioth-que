<?php

require '../../vendor/autoload.php';
use MyApp\Models\User;
use MyApp\Controllers\UserController;
use MyApp\Models\Book;
use MyApp\Controllers\BookController;
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

    $user = new User('','','','',$email,$password,'');

    if ($user->getByEmail()>0) {

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