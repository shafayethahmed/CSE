@extends('auth-faculty.layout.sidebar')
@section('title','Change Password')
@push('styles')
<style>
/* Card Container */
.card {
    background: #ffd09bb2;
    padding: 5px 20px;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
    max-width: 800px;
    margin: 10px auto;
    display: flex;
    flex-direction: column;
    gap: 2px;
    transition: all 0.3s ease;
}

.card:hover {
    box-shadow: 0 14px 40px rgba(0,0,0,0.12);
}

/* Titles */
.card h2 {
    text-align: center;
    font-weight: 700;
    color: #0a2675;
    font-size: 20px;
    margin-bottom: 5px;
}

.card .subtitle {
    text-align: center;
    font-size: 12px;
    color: #6b7280;
    margin-bottom: 30px;
}

/* Form */
.form-group {
    display: flex;
    flex-direction: column;
    margin-bottom: 20px;
}

label {
    font-size: 12px;
    font-weight: 500;
    margin-bottom: 8px;
    color: #374151;
}

input {
    padding: 10px 12px;
    border-radius: 12px;
    border: 1px solid #d1d5db;
    background-color: #f9fafb;
    font-size: 13px;
    outline: none;
    transition: all 0.2s ease-in-out;
}

input:focus {
    border-color: #3b82f6;
    background-color: #fff;
    box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
}

/* Buttons */
button.submit-btn {
    padding: 5px 12px;
    border: none;
    border-radius: 12px;
    background: #020617;
    color: white;
    font-size: 15px;
    font-weight: 600;
    cursor: pointer;
    align-self: center;
    transition: all 0.3s ease;
}

button.submit-btn:hover {
    background: #2563eb;
    transform: translateY(-2px);
}

/* Error and Success */
.error {
    color: #ef4444;
    font-size: 12px;
    margin-top: 5px;
    display: none;
}

.success-message {
    margin-top: 15px;
    text-align: center;
    font-size: 14px;
    color: #10b981;
    display: none;
}

/* Responsive */
@media(max-width: 576px){
    .card {
        padding: 25px 20px;
        margin: 30px 15px;
    }
}
</style>
@endpush

@section('content')
<div class="card-wrapper">
    <div class="card">
        <h2>Change Password</h2>
        <p class="subtitle">Update your password securely</p>
        <form id="changePasswordForm" method="POST" action="#">
            @csrf
            @method('PUT')
            <!-- Current Password -->
            <div class="form-group">
                <label for="current_password">Current Password</label>
                <input type="password" name="current_password" id="current_password" placeholder="Enter current password">
                <div class="error" id="currentPasswordError">Please enter your current password</div>
            </div>

            <!-- New Password -->
            <div class="form-group">
                <label for="new_password">New Password</label>
                <input type="password" name="new_password" id="new_password" placeholder="Enter new password">
                <div class="error" id="newPasswordError">Password must be at least 6 characters</div>
            </div>

            <!-- Confirm Password -->
            <div class="form-group">
                <label for="confirm_password">Confirm New Password</label>
                <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm new password">
                <div class="error" id="confirmPasswordError">Passwords do not match</div>
            </div>
            <div style="text-align: center;">
                  <button type="submit" class="submit-btn">Update Password</button>
            </div>

            <div class="success-message" id="successMessage">
                Password updated successfully!
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
const form = document.getElementById("changePasswordForm");

form.addEventListener("submit", function(e){
    let isValid = true;

    const current = document.getElementById("current_password").value.trim();
    const newPass = document.getElementById("new_password").value.trim();
    const confirm = document.getElementById("confirm_password").value.trim();

    const currentError = document.getElementById("currentPasswordError");
    const newError = document.getElementById("newPasswordError");
    const confirmError = document.getElementById("confirmPasswordError");

    currentError.style.display = "none";
    newError.style.display = "none";
    confirmError.style.display = "none";

    if(current === "") {
        currentError.style.display = "block";
        isValid = false;
    }

    if(newPass.length < 6) {
        newError.style.display = "block";
        isValid = false;
    }

    if(newPass !== confirm) {
        confirmError.style.display = "block";
        isValid = false;
    }

    if(!isValid){
        e.preventDefault();
    }
});
</script>
@endpush
