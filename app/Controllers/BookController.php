<?php

namespace MyApp\Controllers;
require '../../vendor/autoload.php';
use MyApp\Models\Book;

class BookController
{
    public function index()
    {
        $bookModel = new Book();
        $books = $bookModel->getAllBooks();

        include('../../Views/admin/home.php');
    }

    public function addBook()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add'])) {
            $title = $_POST['title'];
            $genre = $_POST['genre'];
            $author = $_POST['author'];
            $desc = $_POST['description'];
            $publicationYear = $_POST['publication'];
            $totalCopies = $_POST['total_copies'];
            $availableCopies = $_POST['available_copies'];

            $coverImageDir = '../../assets/images/';
            $coverImagePath = $coverImageDir . $_FILES['cover']['name'];

            if (move_uploaded_file($_FILES['cover']['tmp_name'], $coverImagePath)) {
                $bookModel = new Book();
                $result = $bookModel->addBook($title, $author, $genre, $desc, $publicationYear, $totalCopies, $availableCopies, $coverImagePath);

                if ($result) {
                    header('Location: ../../Views/admin/books.php');
                    exit(); 
                } else {
                    echo "Error adding book";
                }
            } else {
                echo "Error uploading cover image";
            }
        } else {
            include('path/to/your/book_form.php');
        }
    }

    
}
$book = new BookController();
$book->addBook();
