<?php

namespace MyApp\Controllers;

require '../../vendor/autoload.php';

use MyApp\Models\User;

class UserController
{
    public function register($firstname, $lastname, $email, $phone, $password, $image)
    {
        $user = new User('', $firstname, $lastname, $phone, $email, $password, $image);
        if ($user->createUser()) {
            $this->redirect(2);
        } else {
            echo "Error adding user";
        }
    }

    public function login(User $user, $email, $password)
    {
        $user->setEmail($email);
        $user->setPassword($password);

        if ($user->getByEmail()) {
            $this->redirect($_SESSION['role']);
        } else {
            echo "Incorrect email or password";
        }
    }

    private function redirect($role)
    {
        switch ($role) {
            case 1:
                header('location:../../Views/auth/login.php?welcomeadmin');
                exit();
            case 2:
                header('location:../../Views/auth/login.php?welcomeuser');
                exit();
            default:
                echo 'Unknown role';
                break;
        }
    }
}

?>
