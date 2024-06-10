<?php
include('header.php');



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <style>
        .carousel-item {
            height: 40%;
            background-size: cover;
        }

        .d-block {
            height: 350px;
            /* object-fit: scale-down; */
            max-width: 100%;
            image-resolution: 3000dpi;
            filter: blur(0);
        }
        .card-deck{
            /* display: flex; */
            margin-top: 20px;
            margin-left: 0px;
            margin-bottom: 50px;
            
        }.card{
            /* float: left; */
            width: 300px;
            height: 450px;
            float: left;
            margin-top: 30px;
            margin-left: 35px;
            box-shadow: 0 26px 58px 0 rgba(0, 0, 0, .22), 0 5px 14px 0 rgba(0, 0, 0, .18);

        }
        .btn-primary{
            margin-bottom: 20px;
            margin-left: 15px;
        }
        #price-tag{
            margin-left: 50px;
            font-size: 20px;
            font-weight: bold;
            margin: 30 auto;
        }
    </style>

</head>

<body>

    <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="images/download (1).jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="images/download (2).jpg" class="d-block w-100 " alt="...">
            </div>
            <div class="carousel-item">
                <img src="images/download (3).jpg" class="d-block w-100 " alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <div class="card-deck">
        <div class="card">
            <img class="card-img-top h-100" src="images/download (1).jpg" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
            </div>
            <div >
                <button class='btn btn-primary'>Book Now</button>
                <span id="price-tag">Price: 1000</span>
            </div>
        </div>
        <div class="card">
            <img class="card-img-top h-100" src="images/download (1).jpg" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
            </div>
            <div >
                <button class='btn btn-primary'>Book Now</button>
                <span id="price-tag">Price: 1000</span>
            </div>
        </div>
        <div class="card">
            <img class="card-img-top h-100" src="images/download (1).jpg" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
            </div>
            <div >
                <button class='btn btn-primary'>Book Now</button>
                <span id="price-tag">Price: 1000</span>
            </div>
        </div>
        <div class="card">
            <img class="card-img-top h-100" src="images/download (1).jpg" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
            </div>
            <div >
                <button class='btn btn-primary'>Book Now</button>
                <span id="price-tag">Price: 1000</span>
            </div>
        </div>
        <div class="card">
            <img class="card-img-top h-100" src="images/download (1).jpg" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
            </div>
            <div >
                <button class='btn btn-primary'>Book Now</button>
                <span id="price-tag">Price: 1000</span>
            </div>
        </div>
        <div class="card">
            <img class="card-img-top h-100" src="images/download (1).jpg" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
            </div>
            <div >
                <button class='btn btn-primary'>Book Now</button>
                <span id="price-tag">Price: 1000</span>
            </div>
        </div>
        <div class="card">
            <img class="card-img-top h-100" src="images/download (1).jpg" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
            </div>
            <div >
                <button class='btn btn-primary'>Book Now</button>
                <span id="price-tag">Price: 1000</span>
            </div>
        </div>
        <div class="card">
            <img class="card-img-top h-100" src="images/download (1).jpg" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
            </div>
            <div >
                <button class='btn btn-primary'>Book Now</button>
                <span id="price-tag">Price: 1000</span>
            </div>
        </div>
        <div class="card">
            <img class="card-img-top h-100" src="images/download (1).jpg" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
            </div>
            <div >
                <button class='btn btn-primary'>Book Now</button>
                <span id="price-tag">Price: 1000</span>
            </div>
        </div>
       
       
    </div>

</body>

</html>


<?php


include('footer.php');

?>