<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>CSE Department Management System</title>

<link rel="icon" href="{{ asset('Images/RTM-Logo.jpg') }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
    min-height:100vh;
   background: linear-gradient(rgba(4,5,36,.65), rgba(4,5,36,.65)), url("{{ asset('images/RTM-AKTU-CAMPUS.jpeg') }}") no-repeat center/cover;

    display:flex;
    flex-direction:column;
    justify-content:center;
    padding:15px;
}

.login-container{
    max-width:420px;
    width:40%;
    margin:auto;
    background:#fff;
    border-radius:14px;
    padding:28px;
    text-align:center;
    box-shadow:0 15px 40px rgba(0,0,0,.35);
}

.image-icon img{
    width:75px;
    margin-bottom:10px;
}

h6{font-size:15px;margin-bottom:0}
#login-text{
    font-size:11px;
    color:#c40000;
    margin-bottom:18px;
}

.btn-primary{
    background:#040524;
    border-color:#040524;
    width:100%;
}

.btn-primary:hover{background:#020318}

#linkpassword{
    font-size:12px;
}

footer{
    text-align:center;
    margin-top:15px;
}

#footer-txt{
    font-size:11px;
    color:#fff;
    opacity:.85;
}

/* Mobile tweaks */
@media(max-width:576px){
    .login-container{
        padding:22px;
    }
}
</style>
</head>

<body>

<div class="login-container">

    <div class="image-icon">
        <img src="{{ asset('images/RTM-Logo.jpg') }}" alt="RTM Logo">
    </div>

    <h6>Department Of Computer Science & Engineering</h6>
    <p><i>RTM Al-Kabir Technical University</i></p>

    <p id="login-text">Please provide your information to login.</p>

    <form>
        <div class="mb-3">
            <input type="email" class="form-control" placeholder="Email" required>
        </div>

        <div class="mb-3">
            <input type="password" class="form-control" placeholder="Password" required>
        </div>

        <div class="mb-3 d-flex justify-content-between align-items-center" id="linkpassword">
            <a href="#" data-bs-toggle="modal" data-bs-target="#forgotModal">Forgot Password?</a>
        </div>

        <button type="submit" class="btn btn-primary">Login</button>
    </form>

</div>

<footer>
    <p id="footer-txt">Developed By Shafayeth Ahmed</p>
</footer>

<!-- FORGOT PASSWORD MODAL -->
<div class="modal fade" id="forgotModal" tabindex="-1" style="height: auto;">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Forgot Password</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <p style="font-size:13px">
            Enter your registered email address. We’ll send password reset instructions.
        </p>

        <input type="email" class="form-control mb-3" placeholder="Enter your email" required>
      </div>

      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button class="btn btn-primary">Send Reset Link</button>
      </div>

    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
