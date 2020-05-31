<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <base href="<?php echo site_url(); ?>">
    <link rel="icon" href="favicon.ico">
    <title>Signin Template for Bootstrap</title>

    <link href="assets/css/bootstrap.min.css" rel="stylesheet">

    <link href="assets/css/signin.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <form method="POST" action="auth/login" class="form-signin">
            <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
            <label for="identity" class="sr-only">User name</label>
            <input type="text" name="identity" id="identity" class="form-control" placeholder="User name/email"
                required="" autofocus="">
            <label for="password" class="sr-only">Password</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Password"
                required="">
            <div class="checkbox mb-3">
                <label>
                    <input type="checkbox" value="remember-me"> Remember me
                </label>
            </div>
            <input class="btn btn-lg btn-primary btn-block" value="Sign in" type="submit">
        </form>
    </div>
</body>

</html>