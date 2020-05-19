<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>ADVNTRIP Dashboard</title>
    <base href="<?php echo base_url(); ?>">
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="stylesheet" href="assets/bootstrap.min.css">
    <link rel="stylesheet" href="assets/main.css">
</head>

<body class="text-center">
    <form method="POST" action="auth/login" class="form-signin">
        <img class="mb-4" src="assets/logo.png" alt="" width="72"
            height="72">
        <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
        <label for="identity" class="sr-only">User name</label>
        <input type="text" name="identity" id="identity" class="form-control" placeholder="User name/email" required="" autofocus="">
        <label for="password" class="sr-only">Password</label>
        <input type="password" name="password" id="password" class="form-control" placeholder="Password" required="">
        <div class="checkbox mb-3">
            <label>
                <input type="checkbox" value="remember-me"> Remember me
            </label>
        </div>
        <input class="btn btn-lg btn-primary btn-block" value="Sign in" type="submit">
    </form>
</body>
</html>