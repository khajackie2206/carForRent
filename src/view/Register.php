<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">

    <title>Signup</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/sign-in/">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="./assets/css/style.css" rel="stylesheet">
</head>
<body class="text-center body-car">
<form class="form-signin form-register" method="POST">
    <img class="mb-4" src="https://bintangjasatirta.com/login/avatar.png" alt="" width="92"
         height="92">
    <h1 class="h3 mb-3 font-weight-normal" style="padding-bottom: 50px;">Please sign up</h1>
    <div class="form-group">
        <input type="text" name="username"  class="form-control" placeholder="Username" autofocus >
        <p style="color:red; height: 15px;"><?=$data['errorMessage']['color'] ?? ' '?></p>
    </div>
    <div class="form-group">
        <label for="inputUsername" class="sr-only" >Name</label>
        <input type="text" name="name"  class="form-control" placeholder="Fullname" autofocus >
        <p style="color:red; height: 15px;"><?=$data['errorMessage']['color'] ?? ' '?></p>
    </div>
    <div class="form-group">
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password"  name="password"  class="form-control" placeholder="Password"  >
        <p style="color:red; height: 15px;"><?=$data['errorMessage']['color'] ?? ' '?></p>
    </div>
    <div class="checkbox mb-3 home-return">
        <a href="/" >Return to home page</a>
    </div>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign up</button>
    <p class="mt-5" style="color: red;"><?php

        if (isset($data)) {
            echo $data['error'];
        }
        ?></p>
</form>
</body>
</html>
