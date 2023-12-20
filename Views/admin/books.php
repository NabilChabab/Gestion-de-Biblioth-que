<?php
require '../../vendor/autoload.php';
use MyApp\Models\Book;
session_start();
$bookModel = new Book();
$books = $bookModel->getAllBooks();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="/Gestion-de-Biblioth-que/assets/css/style.css">

</head>
<style>
    .admin {
        display: flex;
        gap: 1rem;
    }

    .name p {
        font-weight: bold;
        color: grey;
    }
</style>

<body>
    <!-- =============== Navigation ================ -->
    <div class="container">
        <div class="navigation active" style="">
            <ul>
                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="book-outline"></ion-icon>
                        </span>
                        <span class="title">Bookify</span>
                    </a>
                </li>

                <li>
                    <a href="home.php">
                        <span class="icon">
                        <ion-icon name="people-outline"></ion-icon>
                        </span>
                        <span class="title">Users</span>
                    </a>
                </li>

                <li class="active">
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="book-outline"></ion-icon>
                        </span>
                        <span class="title">Books</span>
                    </a>
                </li>

                <li>
                    <a href="reservations.php">
                        <span class="icon">
                            <ion-icon name="checkmark-outline"></ion-icon> </span>
                        <span class="title">Reserved Books</span>
                    </a>
                </li>

                <li>
                    <a href="../auth/login.php">
                        <span class="icon">
                            <ion-icon name="log-out-outline"></ion-icon>
                        </span>
                        <span class="title">Sign Out</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- ========================= Main ==================== -->
        <div class="main active">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>

                <div class="search">
                    <label>
                        <input type="text" placeholder="Search here" name="search" id="search">
                        <ion-icon name="search-outline"></ion-icon>
                    </label>
                </div>

                <div class="admin">
                    <div class="user">
                        <img src="<?=$_SESSION['user_image']?>" alt="">
                    </div>
                    <div class="name">
                        <p>
                            <?php echo isset($_COOKIE['user_name']) ? $_COOKIE['user_name'] : ''; ?>
                        </p>
                        <p>
                            <?php echo isset($_COOKIE['user_role']) ? $_COOKIE['user_role'] : ''; ?>
                        </p>
                    </div>
                </div>
            </div>


            <div class="cardBox">
                <div class="card">
                    <div>
                        <div class="numbers">1,504</div>
                        <div class="cardName">Daily Views</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="eye-outline"></ion-icon>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <div class="numbers">800</div>
                        <div class="cardName">Total Students</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="people-outline"></ion-icon>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <div class="numbers">284</div>
                        <div class="cardName">Comments</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="chatbubbles-outline"></ion-icon>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <div class="numbers">42</div>
                        <div class="cardName">Total Teachers</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="people-outline"></ion-icon>
                    </div>
                </div>
            </div>

            <!-- ================ Order Details List ================= -->
            <div class="details">
                <div class="recentOrders">
                    <div class="cardHeader">
                        <h2>Recent Books</h2>
                        <a href="add.php" class="btn">Add New Book</a>
                    </div>

                    <table id="userTable">
                        <thead>
                            <tr>
                                <td>Cover</td>
                                <td>Title</td>
                                <td>Author</td>
                                <td>Genre</td>
                                <td>Description</td>
                                <td>Publication Year</td>
                                <td>Total Copies</td>
                                <td>Avilable Copies</td>
                                <td>Actions</td>

                            </tr>
                        </thead>

                        <tbody id="userTableBody">
                            <?php
                            foreach ($books as $book) {
                                echo '<tr>';
                                echo '<td><img src="' . $book['cover'] . '" alt="Cover" style="max-width:45px;height:45px;border-radius:10%;"></td>';
                                echo '<td>' . $book['title'] . '</td>';
                                echo '<td>' . $book['author'] . '</td>';
                                echo '<td>' . $book['genre'] . '</td>';
                                echo '<td>' . (strlen($book['description']) > 20 ? substr($book['description'], 0, 20) . '....' : $book['description']) . '</td>';
                                echo '<td>' . $book['publication_year'] . '</td>';
                                echo '<td>' . $book['total_copies'] . '</td>';
                                echo '<td>' . $book['available_copies'] . '</td>';
                                echo '<td>';
                                echo '<a href="edit.php?id=' . base64_encode($book['id']) . '" style="color:black;font-size:20px;margin-right:20px"><ion-icon name="pencil-outline"></ion-icon></a>';
                                echo '<a href="?id=' . base64_encode($book['id']) . '&delete" style="color:red;font-size:20px;"><ion-icon name="close-circle-outline"></ion-icon></a>';
                                echo '</td>';
                                echo '</tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

                <!-- ================= New Customers ================ -->

            </div>

            <!-- ======================= Cards ================== -->
        </div>

    </div>

    <!-- =========== Scripts =========  -->
    <script src="../../assets/js/main.js"></script>






    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>