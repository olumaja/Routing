<?php
    include_once 'partials/header.php';
?>
<body class="container--signin">
    
    <form class="my-form">
      <div class="signin-logo">
       <span> Logo</span>
      </div>
      <h2 class="signin-form-tile">Sign up</h2>
      <h6 class="signin-subtitle">Please enter your credentials to proceed.</h6>
      <div class="form-group">
        <label>Enter Name</label>
        <input type="text" name="name" class="form-control" placeholder="Enter Name">
      </div>
      <div class="form-group">
        <label>Email address</label>
        <input type="email" name="email" class="form-control" placeholder="samplemail@mail.com">
      </div>
      <div class="form-group">
        <label>Password</label>
        <input type="password" name="email" value="passwordpassword" class="form-control" >
      </div>
      <input type="submit" value="Sign in" class="btn btn-primary sign-btn">
      <span class="sign-up-text">
        <span>Have an account? </span>
        <a href="/auth/login">Login</a>
      </span>
    </form>

</body>
</html>