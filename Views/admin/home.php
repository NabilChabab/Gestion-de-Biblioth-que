<?php
require '../../vendor/autoload.php';
use MyApp\Models\User;
$userModel = new User('','', '', '', '', '', '');
$users = $userModel->getAllUsers();
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
                        <span class="title">Happy-marionnette</span>
                    </a>
                </li>

                <li class="active">
                    <a href="#">
                        <span class="icon">
                        <ion-icon name="people-outline"></ion-icon>
                        </span>
                        <span class="title">Users</span>
                    </a>
                </li>

                <li>
                    <a href="books.php">
                        <span class="icon">
                            <ion-icon name="book-outline"></ion-icon>
                        </span>
                        <span class="title">Books</span>
                    </a>
                </li>

                <li>
                    <a href="reservations.php">
                        <span class="icon">
                        <ion-icon name="checkmark-outline"></ion-icon>
                        </span>
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
                        <h2>Recent Users</h2>
                        <a href="add_students.php" class="btn">View All</a>
                    </div>

                    <table id="userTable">
                        <thead>
                            <tr>
                                <td>ID</td>
                                <td>Profile</td>
                                <td>FirstName</td>
                                <td>LastName</td>
                                <td>Email</td>
                                <td>Phone</td>
                                <td>Type</td>
                                <td>Actions</td>

                            </tr>
                        </thead>

                        <tbody id="userTableBody">
                            <?php
                            foreach ($users as $user) {
                                echo '<tr>';
                                echo '<td>' . htmlspecialchars($user['id']) . '</td>';
                                echo '<td><img src="' . htmlspecialchars($user['image']) . '" alt="Profile" style="max-width:45px;border-radius:50%;"></td>';
                                echo '<td>' . htmlspecialchars($user['firstname']) . '</td>';
                                echo '<td>' . htmlspecialchars($user['lastname']) . '</td>';
                                echo '<td>' . htmlspecialchars($user['email']) . '</td>';
                                echo '<td>' . htmlspecialchars($user['phone']) . '</td>';
                                echo '<td>' . htmlspecialchars($user['name']) . '</td>';
                                echo '<td>';
                                echo '<a href="edit.php?id=' . base64_encode($user['id']) . '" style="color:black;font-size:20px;margin-right:20px"><ion-icon name="pencil-outline"></ion-icon></a>';
                                echo '<a href="delete.php?id=' . base64_encode($user['id']) . '&deleteuser" style="color:red;font-size:20px;"><ion-icon name="close-circle-outline"></ion-icon></a>';
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