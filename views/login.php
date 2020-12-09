<?php
    include_once 'partials/header.php';
?>
<body class="container--signin">
    
<form class="my-form" action="/auth/login" method="post">
    <div class="signin--logo">
        <span>Logo</span>
    </div>

    <h2 class="signin--form-tile">Sign in</h2>
    <h6 class="signin-subtitle">Please enter your credentials to proceed.</h6>
    <div class="form-group">
        <label>Email address</label>
        <input type="email" name="email" class="form-control" placeholder="samplemail@mail.com">
        <small>Forgot password?</small>
    </div>
    <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" class="form-control" >
    </div>
    <input type="submit" value="Sign in" class="btn btn-primary sign-btn">
    <span class="sign-up-text">
        <span>Dont’ have an account? </span>
        <a href="/auth/register">Sign up</a>
      </span>
</form>
</body>
</html>
