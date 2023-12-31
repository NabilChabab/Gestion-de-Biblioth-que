<?php
require '../../vendor/autoload.php';
use MyApp\Models\Book;
use MyApp\Models\Reservation;


$bookModel = new Book();
$books = $bookModel->getAllBooks();
session_start();
if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];

    $reservationModel = new Reservation();
    $userReservations = $reservationModel->getUserReservations($userId);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Bookify</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Simple line icons-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.5.5/css/simple-line-icons.min.css"
        rel="stylesheet" />
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic"
        rel="stylesheet" type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />


    <style>
        .card-img-top {
            width: 100%;
            height: 300px;
            object-fit: cover;
        }

        .user-image {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            margin-right: 10px;
        }
    </style>
</head>

<body id="page-top">
    <!-- Navigation-->
    <a class="menu-toggle rounded" href="#"><i class="fas fa-bars"></i></a>
    <nav id="sidebar-wrapper">
        <ul class="sidebar-nav">
            <li class="sidebar-brand">
                <?php
                if (isset($_SESSION['user_image'])) {
                    echo '<img src="' . $_SESSION['user_image'] . '" alt="User Image" class="user-image" />';
                }
                ?><a href="#page-top">Start Bookify</a>
            </li>
            <li class="sidebar-nav-item"><a href="#page-top">Home</a></li>
            <li class="sidebar-nav-item"><a href="#about">About</a></li>
            <li class="sidebar-nav-item"><a href="#services">Services</a></li>
            <li class="sidebar-nav-item"><a href="#portfolio">Portfolio</a></li>
            <li class="sidebar-nav-item"><a href="#contact">Contact</a></li>
            <li class="sidebar-nav-item"><a href="../auth/login.php">Logout</a></li>
        </ul>
    </nav>
    <!-- Header-->
    <header class="masthead d-flex align-items-center">
        <div class="container px-4 px-lg-5 text-center">
            <h1 class="mb-1">Welcome To Bookify</h1>
            <h3 class="mb-5"><em>A Wonderfull Store to Book Any Book</em></h3>
            <a class="btn btn-primary btn-xl" href="#about">Find Out More</a>
        </div>
    </header>
    <!-- About-->
    <section class="content-section bg-light" id="about">
        <div class="container px-4 px-lg-5 text-center">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-lg-10">
                    <h2>Stylish Portfolio is the perfect theme for your next project!</h2>
                    <p class="lead mb-5">
                        This theme features a flexible, UX friendly sidebar menu and stock photos from our friends at
                        <a href="https://unsplash.com/">Unsplash</a>
                        !
                    </p>
                    <a class="btn btn-dark btn-xl" href="#services">What We Offer</a>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="reservationModal" tabindex="-1" aria-labelledby="reservationModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="reservationModalLabel">Book Reservation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="bookDetails">
                    </div>
                    <form id="reservationForm" action="../../app/Controllers/handelform.php" method="post">
                        <input type="hidden" id="bookId" name="bookId" value="">
                        <div class="mb-3">
                            <label for="returnDate" class="form-label">Return Date (Max:
                                <?php echo date('Y-m-d', strtotime('+15 days')); ?>)
                            </label>
                            <input type="date" class="form-control" id="returnDate" name="returnDate" required
                                max="<?php echo date('Y-m-d', strtotime('+15 days')); ?>">
                        </div>

                        <button type="submit" class="btn btn-primary" name="reserve">Submit Reservation</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="reservationsModal" tabindex="-1" aria-labelledby="reservationsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reservationsModalLabel">Your Reservations</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php foreach ($userReservations as $reservation): ?>
                    <div class="reservation-item mb-3 p-3 border">
                        <?php
                        $bookId = $reservation['book_id'];
                        $book = $bookModel->getBookById($bookId);

                        if ($book): ?>
                            <h6 class="mb-2"><strong>Book Title:</strong> <?php echo $book['title']; ?></h6>
                        <?php else: ?>
                            <p class="mb-2"><strong>Book Title:</strong> N/A</p>
                        <?php endif; ?>
                        <p class="mb-0"><strong>Return Date:</strong> <?php echo $reservation['return_date']; ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

    <!-- Services-->
    <div class="modal fade" id="reservationSuccessModal" tabindex="-1" aria-labelledby="reservationSuccessModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="reservationSuccessModalLabel">Reservation Successful</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Your reservation was successful! Thank you for choosing Bookify.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="container px-4 px-lg-5 mb-4">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <form method="GET" action="">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Search by Title" name="search"
                            id="searchInput"
                            value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <section class="content-section bg-primary text-white text-center" id="services">
        <button class="btn btn-light rounded-circle" id="viewReservationsBtn"
            style="position: fixed; top: 10px; left: 10px;">
            <i class="fas fa-book"></i>
        </button>
        <div class="container-fluid d-flex justify-content-center align-items-center" style="">

            <div class="row col-12" style="gap:2rem;">
                <?php foreach ($books as $book): ?>
                    <div class="card" style="width: 21.2rem;">
                        <img class="card-img-top" src="<?php echo $book['cover']; ?>" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title text-black">
                                <?php echo $book['title']; ?>
                            </h5>
                            <p class="card-text text-dark">
                                <?php echo $book['description']; ?>
                            </p>
                            <button type="button" class="btn btn-primary reserve-btn" data-bs-toggle="modal"
                                data-bs-target="#reservationModal" data-book-id="<?php echo $book['id']; ?>">
                                Book Now
                            </button>
                        </div>
                    </div>
                <?php endforeach; ?>


            </div>
        </div>
    </section>


    <!-- Callout-->
    <section class="callout">
        <div class="container px-4 px-lg-5 text-center">
            <h2 class="mx-auto mb-5">
                Welcome to
                <em>your</em>
                next website!
            </h2>
            <a class="btn btn-primary btn-xl" href="https://startbootstrap.com/theme/stylish-portfolio/">Download
                Now!</a>
        </div>
    </section>
    <!-- Portfolio-->
    <section class="content-section" id="portfolio">
        <div class="container px-4 px-lg-5">
            <div class="content-section-heading text-center">
                <h3 class="text-secondary mb-0">Portfolio</h3>
                <h2 class="mb-5">Recent Projects</h2>
            </div>
            <div class="row gx-0">
                <div class="col-lg-6">
                    <a class="portfolio-item" href="#!">
                        <div class="caption">
                            <div class="caption-content">
                                <div class="h2">Stationary</div>
                                <p class="mb-0">A yellow pencil with envelopes on a clean, blue backdrop!</p>
                            </div>
                        </div>
                        <img class="img-fluid" src="assets/img/portfolio-1.jpg" alt="..." />
                    </a>
                </div>
                <div class="col-lg-6">
                    <a class="portfolio-item" href="#!">
                        <div class="caption">
                            <div class="caption-content">
                                <div class="h2">Ice Cream</div>
                                <p class="mb-0">A dark blue background with a colored pencil, a clip, and a tiny ice
                                    cream cone!</p>
                            </div>
                        </div>
                        <img class="img-fluid" src="assets/img/portfolio-2.jpg" alt="..." />
                    </a>
                </div>
                <div class="col-lg-6">
                    <a class="portfolio-item" href="#!">
                        <div class="caption">
                            <div class="caption-content">
                                <div class="h2">Strawberries</div>
                                <p class="mb-0">Strawberries are such a tasty snack, especially with a little sugar on
                                    top!</p>
                            </div>
                        </div>
                        <img class="img-fluid" src="assets/img/portfolio-3.jpg" alt="..." />
                    </a>
                </div>
                <div class="col-lg-6">
                    <a class="portfolio-item" href="#!">
                        <div class="caption">
                            <div class="caption-content">
                                <div class="h2">Workspace</div>
                                <p class="mb-0">A yellow workspace with some scissors, pencils, and other objects.</p>
                            </div>
                        </div>
                        <img class="img-fluid" src="assets/img/portfolio-4.jpg" alt="..." />
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- Call to Action-->
    <section class="content-section bg-primary text-white">
        <div class="container px-4 px-lg-5 text-center">
            <h2 class="mb-4">The buttons below are impossible to resist...</h2>
            <a class="btn btn-xl btn-light me-4" href="#!">Click Me!</a>
            <a class="btn btn-xl btn-dark" href="#!">Look at Me!</a>
        </div>
    </section>
    <!-- Map-->
    <div class="map" id="contact">
        <iframe
            src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=Twitter,+Inc.,+Market+Street,+San+Francisco,+CA&amp;aq=0&amp;oq=twitter&amp;sll=28.659344,-81.187888&amp;sspn=0.128789,0.264187&amp;ie=UTF8&amp;hq=Twitter,+Inc.,+Market+Street,+San+Francisco,+CA&amp;t=m&amp;z=15&amp;iwloc=A&amp;output=embed"></iframe>
        <br />
        <small><a
                href="https://maps.google.com/maps?f=q&amp;source=embed&amp;hl=en&amp;geocode=&amp;q=Twitter,+Inc.,+Market+Street,+San+Francisco,+CA&amp;aq=0&amp;oq=twitter&amp;sll=28.659344,-81.187888&amp;sspn=0.128789,0.264187&amp;ie=UTF8&amp;hq=Twitter,+Inc.,+Market+Street,+San+Francisco,+CA&amp;t=m&amp;z=15&amp;iwloc=A"></a></small>
    </div>
    <!-- Footer-->
    <footer class="footer text-center">
        <div class="container px-4 px-lg-5">
            <ul class="list-inline mb-5">
                <li class="list-inline-item">
                    <a class="social-link rounded-circle text-white mr-3" href="#!"><i
                            class="icon-social-facebook"></i></a>
                </li>
                <li class="list-inline-item">
                    <a class="social-link rounded-circle text-white mr-3" href="#!"><i
                            class="icon-social-twitter"></i></a>
                </li>
                <li class="list-inline-item">
                    <a class="social-link rounded-circle text-white" href="#!"><i class="icon-social-github"></i></a>
                </li>
            </ul>
            <p class="text-muted small mb-0">Copyright &copy; Your Website 2023</p>
        </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top"><i class="fas fa-angle-up"></i></a>
    <!-- Bootstrap core JS-->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var reserveButtons = document.querySelectorAll('.reserve-btn');
            var bookDetailsContainer = document.getElementById('bookDetails');
            var bookIdInput = document.getElementById('bookId');

            reserveButtons.forEach(function (button) {
                button.addEventListener('click', function (event) {
                    var bookId = event.currentTarget.dataset.bookId;
                    bookIdInput.value = bookId;

                    var bookDetails = <?php echo json_encode($books); ?>;
                    var selectedBook = bookDetails.find(function (book) {
                        return book.id == bookId;
                    });

                    bookDetailsContainer.innerHTML = `
                <img src='${selectedBook.cover}' style="width:200px;height:300px;margin-left:25%;object-fit:cover;">
                <h5>${selectedBook.title}</h5>
                <p>${selectedBook.description}</p>
                `;
                });
            });
        });


    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            <?php if (isset($_SESSION['reservation_success']) && $_SESSION['reservation_success']): ?>
                var reservationSuccessModal = new bootstrap.Modal(document.getElementById('reservationSuccessModal'));
                reservationSuccessModal.show();
                <?php unset($_SESSION['reservation_success']); ?>
            <?php endif; ?>

        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var viewReservationsBtn = document.getElementById('viewReservationsBtn');
            viewReservationsBtn.addEventListener('click', function () {
                var reservationsModal = new bootstrap.Modal(document.getElementById('reservationsModal'));
                reservationsModal.show();
            });
        });
    </script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
    <script src="js/filter.js"></script>
</body>

</html>