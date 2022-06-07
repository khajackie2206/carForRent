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
<body class="body-car">
<form class="form-signin form-register" method="POST">
    <div style="text-align: center;">
    <img class="mb-4" src="https://bintangjasatirta.com/login/avatar.png" alt="" width="92"
         height="92">
    </div>
    <h1 class="h3 mb-3 font-weight-normal" style="padding-bottom: 50px; text-align: center;">Create an account</h1>
    <div class="form-group">
        <label for="exampleInputPassword1" class="name_title">Username: </label>
        <input type="text" name="username"  class="form-control" placeholder="Enter username" autofocus >
        <p style="color:red; height: 15px;"><?=$data['errors']['username'] ?? ' '?></p>
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1" class="name_title">Fullname: </label>
        <input type="text" name="name"  class="form-control" placeholder="Enter fullname" autofocus >
        <p style="color:red; height: 15px;"><?=$data['errors']['name'] ?? ' '?></p>
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1" class="name_title">Password:</label>
        <input type="password"  name="password"  class="form-control" placeholder="Enter password"  >
        <p style="color:red; height: 15px;"><?=$data['errors']['password'] ?? ' '?></p>
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1" class="name_title">Confirm Password:</label>
        <input type="password"  name="re_password"  class="form-control" placeholder="Enter confirm password"  >
        <p style="color:red; height: 15px;"><?=$data['errors']['retype password'] ?? ' '?></p>
    </div>
    <div class="checkbox mb-3 home-return" style="text-align: center;">
        <a href="/" >Return to home page</a>
    </div>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign up</button>
</form>
</body>
</html>
