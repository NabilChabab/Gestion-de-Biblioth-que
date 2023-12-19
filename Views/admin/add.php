<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>PHP CRUD Application</title>

    <style>
        .card {
            width: 100%;
            border: none;
            background-color: transparent;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .card img {
            width: 200px;
            height: 200px;
            border-radius: 10%;
            object-fit: cover;
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
</head>

<body class="bg-dark text-light">
    <div class="container mt-3">
        <div class="text-center mb-4">
            <h3>Add New Book</h3>
            <p class="text-muted">Complete the form below to add a new books</p>
        </div>

        <div class="container d-flex justify-content-center" style="margin-top:0%;">
            <form action="../../app/Controllers/BookController.php" method="post" enctype="multipart/form-data" style="width:50vw; min-width:300px;">
                <div class="card">
                    <img src="../../assets/images/bg-callout.jpg" alt="image" id="image">
                    <label for="input-file">Book Cover</label>
                    <input type="file" accept="image/jpg , image/png , image/jpeg" id="input-file" name="cover">
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <input type="text" class="form-control" name="title" placeholder="title">
                    </div>

                    <div class="col">
                        <input type="text" class="form-control" name="author" placeholder="author">
                    </div>
                </div>

                <select class="form-select mb-3" aria-label="Default select example" name="genre">
                    <option selected>Genre</option>
                    <option value="Action">Action</option>
                    <option value="Fantasy">Fantasy</option>
                    <option value="Dev">Dev</option>
                </select>

                <div class="form-floating mb-3">
                    <textarea class="form-control text-dark" name="description" placeholder="Description" id="floatingTextarea2"
                        style="height: 100px"></textarea>
                </div>

                <div class="mb-3">
                    <input type="text" class="form-control" name="publication" placeholder="Publication Year">
                </div>

                <div class="mb-3">
                    <input type="number" class="form-control" name="total_copies" placeholder="Total Copies">
                </div>

                <div class="mb-3">
                    <input type="number" class="form-control" name="available_copies" placeholder="Available Copies">
                </div>

                <div class="row ms-1 mt-4">
                    <button type="submit" class="btn btn-success col-3 me-3" name="add">Publish</button>
                    <a href="home.php" class="btn btn-danger col-3">Cancel</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
    <script>
        let image = document.getElementById("image");
        let input = document.getElementById("input-file");

        input.onchange = () => {
            image.src = URL.createObjectURL(input.files[0]);
        }
    </script>
</body>

</html>