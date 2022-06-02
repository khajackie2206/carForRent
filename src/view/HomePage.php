<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">
    <title>Homepage</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/sign-in/">
    <link href="./assets/css/home.css" rel="stylesheet">
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<body class="text-center">
<nav class="navbar navbar-expand-lg navbar-light" style="background-color: rgb(95 95 246)">
    <a class="navbar-brand" href="#" style="color:white;"><strong>Home</strong></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item dropdown">
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </li>
            <li class="nav-item">
                <a href="<?php

                if (isset($_SESSION['user_username'])) {
                    echo "/addcar";
                } else {
                    echo "#";
                }?>" class="navbar-brand d-flex align-items-center" style="color: white;">
                    <strong>Add Car &nbsp; </strong>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                        <path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path>
                        <circle cx="12" cy="13" r="4"></circle>
                    </svg>
                </a>
            </li>
        </ul>
        <a href='/register' <button type='button' class='btn btn-warning' style="margin-right: 10px; color: dimgrey;">Sign up</button></a>
        <?php
        if (!isset($_SESSION['user_username'])) {
            echo "<a href='/login' <button type='button' class='btn btn-success signin'>Sign in</button></a>";
        } ?>
        <?php if (isset($_SESSION['user_username'])) {
            echo "<form method='post' action='/logout'><button type='submit' class='btn btn-danger signout'>Sign out</button></form> ";
        }
        ?>
        <a href="#" class="session" style="color: white; right: 150px;"> <strong><?php
        if (isset($_SESSION['user_username'])) {
            echo "Hi " . $_SESSION['user_username'];
        } ?></strong></a>
    </div>
</nav>
<header>
    <div class="collapse bg-dark" id="navbarHeader">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-md-7 py-4">
                    <h4 class="text-white"></h4>
                </div>
                <div class="col-sm-4 offset-md-1 py-4">
                    <h4 class="text-white"></h4>
                </div>
            </div>
        </div>
    </div>
</header>
<main role="main" style="background-color: #f8f9fa;">
    <div id="carouselExampleIndicators" class="carousel slide " data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100 picture_car" src="https://i.ytimg.com/vi/dip_8dmrcaU/maxresdefault.jpg" alt="First slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100 picture_car" src="https://www.topgear.com/sites/default/files/2022/03/McLaren_Artura_art_car_3.jpg" alt="Second slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100 picture_car" src="https://baoquocte.vn/stores/news_dataimages/chile/102021/26/16/amp_img/0740_1.jpg" alt="Third slide">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row card-car-cover" >
                <?php
                if (isset($data['carList'])) {
                    foreach ($data['carList'] as $key => $car) {
                        ?>
                <div class="col-md-4">
                    <div class="card mb-4 box-shadow">
                        <img class="card-img-top" src="<?php echo $car->getThumb(); ?>"
                             alt="Card image cap">
                        <div class="card-body">
                            <h4 class="card-text"><strong><?php echo $car->getBrandName() ?></strong></h4>
                            <p class="card-text card-car"><strong>Color: </strong> <?php echo $car->getColor()?></p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary">Rent Now</button>
                                </div>
                                <small class="text-muted"><a style="color: red; font-weight: bold;"> $ <?php echo number_format($car->getCost());?> <strong>/ day</strong></a> </small>
                            </div>
                        </div>
                    </div>
                </div>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
</main>
<footer class="text-muted">
    <div class="container">
        <p class="float-right">
            <a href="#">Back to top</a>
        </p>
        <p>This website is made by Khajackie - minhkha.nguyen@nfq.asia</p>
    </div>
</footer>
</body>
</html>
