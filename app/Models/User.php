<?php
namespace MyApp\Models;
require '../../vendor/autoload.php';
use MyApp\Database\Database;
use PDO;
use PDOException;
class User
{
    private $firstname;
    private $lastname;
    private $phone;
    private $email;
    private $password;
    private $image;
    private $conn;

    public function __construct($firstname, $lastname, $phone, $email, $password , $image)
    {
        $this->conn = Database::connect();
        $this->setFirstName($firstname);
        $this->setLastName($lastname);
        $this->setPhone($phone);
        $this->setEmail($email);
        $this->setPassword($password);
        $this->setImage($image);
    }

    public function createUser()
    {
        $firstname = $this->getFirstName();
        $lastname = $this->getLastName();
        $email = $this->getEmail();
        $phone = $this->getPhone();
        $password = $this->getPassword();
        $image = $this->getImage();

        $firstnameError = $this->validateFirstName($firstname);
        $lastnameError = $this->validateLastName($lastname);
        $emailError = $this->validateEmail($email);
        $phoneError = $this->validatePhone($phone);
        $passwordError = $this->validatePassword($password);
        $imageError = $this->validateImage($image);

        if (!empty($firstnameError) || !empty($lastnameError) || !empty($passwordError) || !empty($emailError) || !empty($phoneError) || !empty($imageError)) {
            echo "Validation error: $firstnameError $lastnameError $emailError $phoneError";
            return false;
        }

        $hashPassword = password_hash($password, PASSWORD_DEFAULT);

        try {
            $query = "INSERT INTO `user`(`firstname`, `lastname`, `email`, `password`, `phone` , `image`) VALUES (:firstname, :lastname, :email, :password, :phone , :image)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':firstname', $firstname);
            $stmt->bindParam(':lastname', $lastname);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $hashPassword);
            $stmt->bindParam(':phone', $phone);
            $stmt->bindParam(':image', $image);

            $result = $stmt->execute();

            if ($result) {
                $lastId = $this->conn->lastInsertId();
                $queryRole = "INSERT INTO `user_role`(`user_id`, `role_id`) VALUES (:userId, 2)";
                $stmtRole = $this->conn->prepare($queryRole);
                $stmtRole->bindParam(':userId', $lastId);
                $resultRole = $stmtRole->execute();

                if ($resultRole) {
                    return true;
                } else {
                    echo "Error adding user role";
                }

                return false;
            } else {
                echo "Error adding user";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }

        return false;
    }

    private function validateEmail($email)
    {
        if (empty($email)) {
            return 'Username is required';
        }

        $queryCheck = "SELECT * FROM `user` WHERE `email`=:email";
        $stmtCheck = $this->conn->prepare($queryCheck);
        $stmtCheck->bindParam(':email', $email);
        $stmtCheck->execute();

        if ($stmtCheck->rowCount() > 0) {
            return 'Email is already taken';
        }

        return '';
    }

    private function validatePassword($password)
    {
        return empty($password) ? 'Password is required' : '';
    }

    private function validateFirstName($firstname)
    {
        return empty($firstname) ? 'FirstName is required' : '';
    }

    private function validateLastName($lastname)
    {
        return empty($lastname) ? 'LastName is required' : '';
    }

    private function validatePhone($phone)
    {
        return empty($phone) ? 'Phone Number is required' : '';
    }
    private function validateImage($image){
        if (empty($image['name'])) {
            return 'Image is required';
        }
    
        $file_name = $image['name'];
        $file_temp = $image['tmp_name'];
        $upload_path = "../../assets/images/";
        $upload_image = $upload_path . $file_name;
    
        if (move_uploaded_file($file_temp, $upload_image)) {
            return $this->setImage($upload_image);
        } else {
            return 'Error uploading file.';
        }
    }
    
    
    
    public function getAllUsers()
    {
        $query = "SELECT u.*, r.name FROM user AS u INNER JOIN user_role AS ur ON u.id = ur.user_id INNER JOIN role AS r ON ur.role_id = r.id";
        $stmt = $this->conn->query($query);

        if (!$stmt) {
            echo "Error in query: " . $this->conn->errorInfo()[2];
            return false;
        } else {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    public function getByEmail()
    {
        $email = $this->getEmail();
        $password = $this->getPassword();
        $passwordError = $this->validatePassword($password);

        if (!empty($passwordError)) {
            echo "Validation error: $passwordError";
            return false;
        }

        $query = "SELECT u.*, ur.role_id, r.name FROM user AS u INNER JOIN user_role AS ur ON u.id = ur.user_id INNER JOIN role AS r ON ur.role_id = r.id WHERE email=:email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if (!$stmt) {
            echo "Error retrieving user: " . $this->conn->errorInfo()[2];
            return false;
        }

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            echo "User not found";
            return false;
        }

        if (password_verify($password, $row['password'])) {
            $_SESSION['role'] = $row['role_id'];
            return true;
        } else {
            echo "Incorrect password";
            return false;
        }
    }


    public function getFirstName()
    {
        return $this->firstname;
    }

    public function setFirstName($firstname)
    {
        $this->firstname =$firstname;
    }

    public function getLastName()
    {
        return $this->lastname;
    }

    public function setLastName($lastname)
    {
        $this->lastname = $lastname;
    }

    public function getEmail(){
        return $this->email;
    }
    public function setEmail($email){
        $this->email = $email;
    }

    public function getPhone(){
        return $this->phone;
    }

    public function setPhone($phone){
        $this->phone = $phone;
    }

    public function getPassword(){
        return $this->password;
    }
    public function setPassword($password){
        $this->password = $password;
    }

    public function getImage(){
        return $this->image;
    }

    public function setImage($image){
        $this->image = $image;
    }
}


?>