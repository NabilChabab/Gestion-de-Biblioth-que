<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Paytone+One&family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body class="bg-dark">
    <section class="background-radial-gradient overflow-hidden">
        <style>
            #radius-shape-1 {
                height: 220px;
                width: 220px;
                top: -60px;
                left: -130px;
                background: radial-gradient(#44006b, #ad1fff);
                overflow: hidden;
            }

            #radius-shape-2 {
                border-radius: 38% 62% 63% 37% / 70% 33% 67% 30%;
                bottom: -60px;
                right: -110px;
                width: 300px;
                height: 300px;
                background: radial-gradient(#44006b, #ad1fff);
                overflow: hidden;
            }

            .bg-glass {
                background-color: hsla(0, 0%, 100%, 0.9) !important;
                backdrop-filter: saturate(200%) blur(25px);
            }

            .row {
                margin-top: 5%;
            }

            .error input {
                border: 3px solid red;
            }

            .success input {
                border: 3px solid green;
            }

            form span.error-msg {
                color: red;
                width: 100%;
                display: flex;
                margin-left: 30%;
                margin-bottom: 20px;
            }

            form {
                padding: 20px;
            }

            form a {
                margin-left: 25%;
                text-decoration: none;
            }

            .card {
                width: 100%;
                border: none;
                background-color: transparent;
                border: none;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .card img {
                width: 150px;
                border-radius: 50%;
                object-fit: cover;
                margin: auto;
            }

            .card label {
                margin-top: 30px;
                text-align: center;
                height: 40px;
                cursor: pointer;
                font-weight: bold;
                margin-bottom: 20px;
            }

            .card input {
                display: none;
            }
        </style>

        <div class="container px-4 py-5 px-md-5 text-center text-lg-start my-5">
            <div class="row gx-lg-5 align-items-center mb-5">
                <div class="col-lg-6 mb-5 mb-lg-0" style="z-index: 10">
                    <h1 class="my-5 display-5 fw-bold ls-tight" style="color: hsl(218, 81%, 95%)">
                        Happy Marionette <br />
                        <span style="color: hsl(218, 81%, 75%)">All on One Platform</span>
                    </h1>
                    <p class="mb-4 opacity-70" style="color: hsl(218, 81%, 85%)">
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                        Temporibus, expedita iusto veniam atque, magni tempora mollitia
                        dolorum consequatur nulla, neque debitis eos reprehenderit quasi
                        ab ipsum nisi dolorem modi. Quos?
                    </p>
                </div>

                <div class="col-lg-6 mb-5 mb-lg-0 position-relative">
                    <div id="radius-shape-1" class="position-absolute rounded-circle shadow-5-strong"></div>
                    <div id="radius-shape-2" class="position-absolute shadow-5-strong"></div>

                    <div class="card1 bg-glass">
                        <div class="card-body px-4 py-5 px-md-5">
                        <form action="../app/Controllers/handelform.php" enctype="multipart/form-data" method="POST">
                                <div class="card">
                                    <img src="../assets/images/me.jpg" alt="image" id="image">
                                    <label for="input-file">Choose Image</label>
                                    <input type="file" accept="image/jpg, image/png, image/jpeg" name="image" style="background-color: transparent;" id="input-file">
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="form-outline">
                                            <input type="text" id="firstname" class="form-control"
                                                placeholder="FirstName" name="firstname" />
                                            <p class="fname-error text-danger"></p>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-outline">
                                            <input type="text" id="lastname" class="form-control" placeholder="LastName"
                                                name="lastname" />
                                            <p class="lname-error text-danger"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-outline mb-4">
                                    <input type="text" id="phone" class="form-control" placeholder="Phone"
                                        name="phone" />
                                    <p class="phone-error text-danger"></p>
                                </div>

                                <div class="form-outline mb-4">
                                    <input type="email" id="email" class="form-control" placeholder="Email"
                                        name="email" />
                                    <p class="email-error text-danger"></p>
                                </div>

                                <div class="form-outline mb-4">
                                    <input type="password" id="password" class="form-control" placeholder="Password"
                                        name="password" />
                                    <p class="password-error text-danger"></p>
                                </div>

                                <button type="submit" class="btn btn-primary btn-block mb-4 col-12" name="register">
                                    Register
                                </button>
                                <a type="submit" class="mb-4 col-12 register" href="login.php">
                                    Already have an account Login
                                </a>

                                <!-- Register buttons -->
                                <div class="text-center">
                                    <button type="button" class="btn btn-link btn-floating mx-1">
                                        <i class='bx bxl-meta'></i>
                                    </button>

                                    <button type="button" class="btn btn-link btn-floating mx-1">
                                        <i class='bx bxl-google'></i>
                                    </button>

                                    <button type="button" class="btn btn-link btn-floating mx-1">
                                        <i class='bx bxl-linkedin'></i>
                                    </button>

                                    <button type="button" class="btn btn-link btn-floating mx-1">
                                        <i class='bx bxl-github'></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="../assets/js/login.js"></script>
    <script src="../assets/js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
        <script>
      let image = document.getElementById("image");
      let input = document.getElementById("input-file");

      input.onchange = () => {
         image.src = URL.createObjectURL(input.files[0]);
      }
   </script>
</body>



<script>
    AOS.init();
</script>

</html>