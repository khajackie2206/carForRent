
    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">

        <title>Signin Template for Bootstrap</title>

        <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/sign-in/">

        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
              integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <!-- Custom styles for this template -->
        <link href="./assets/css/style.css" rel="stylesheet">
    </head>
    <body class="body-car">
    <form action="/addcar" method="post" enctype="multipart/form-data" class="form-addcar">
        <?php

        if (isset($data['success'])) {
            echo "<div class='alert alert-success' role='alert' style='text-align: center;'> " . $data['success'] . " </div>";
        }
        ?>
        <div style="text-align: center">
        <img class="mb-4" src="https://getbootstrap.com/docs/4.0/assets/brand/bootstrap-solid.svg" alt="" width="72"
             height="72" >
        </div>
        <h1 class="h3 mb-3 font-weight-normal" style="text-align: center;">Create new Car</h1>
        <div class="form-group">
            <label for="exampleInputEmail1" class="name_title">Brand</label>
            <input type="text" class="form-control" name="brand" id="brand" aria-describedby="emailHelp" placeholder="Enter Car brand">
            <p style="color:red; height: 15px;"><?=$data['errorMessage']['brand'] ?? ' '?></p>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1" class="name_title">Price</label>
            <input type="number" class="form-control" name="price" id="price" placeholder="Enter cost">
            <p style="color:red; height: 15px;"><?=$data['errorMessage']['price'] ?? ' '?></p>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1" class="name_title">Color</label>
            <input type="text" class="form-control" name="color" id="price" placeholder="Enter color">
            <p style="color:red; height: 15px;"><?=$data['errorMessage']['color'] ?? ' '?></p>
        </div>
        <div class="form-group" class="name_title">
                <label for="exampleFormControlFile1">Add picture</label>
                <input type="file" name="file" class="form-control-file" id="exampleFormControlFile1">
                <p style="color:red; height: 15px;"><?=$data['errorMessage']['error'] ?? ' '?></p>
        </div>
        <div class="checkbox mb-3 home-return" style="text-align: center;">
            <a href="/" >Return to home page</a>
        </div>
        <!-- Submit button -->
        <button type="submit" class="btn btn-primary btn-block mb-4">Send</button>
        <?php
        if (isset($data['error'])) {
            echo "<div class='alert alert-danger' role='alert' style='text-align: center;'> " . $data['error'] . " </div>";
        }
        ?>
    </form>
    </body>
    </html>
