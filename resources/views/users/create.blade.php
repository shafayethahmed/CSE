@extends('layout.sidebar')

@section('title','Add New User')

@push('styles')
<style>
/* Card Container */
.card {
    background: #ffffff;
    padding: 20px 40px;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
    max-width: 900px;
    margin: 10px auto;
    display: flex;
    flex-direction: column;
    gap: 10px;
    transition: all 0.3s ease;
}

.card:hover {
    box-shadow: 0 14px 40px rgba(0,0,0,0.12);
}

/* Titles */
.card h2 {
    text-align: center;
    margin-bottom: 5px;
    font-weight: 700;
    color: #1e3a8a;
    font-size: 24px;
}

.card .subtitle {
    text-align: center;
    font-size: 14px;
    color: #6b7280;
    margin-bottom: 30px;
}

/* Form Layout */
.form-row {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}

.form-group {
    flex: 1;
    min-width: 250px;
    display: flex;
    flex-direction: column;
}

label {
    font-size: 13px;
    font-weight: 500;
    margin-bottom: 8px;
    color: #374151;
}

input, select {
    width: 100%;
    padding: 6px 14px;
    border-radius: 12px;
    border: 1px solid #d1d5db;
    background-color: #f9fafb;
    font-size: 13px;
    outline: none;
    transition: all 0.2s ease-in-out;
}

input:focus, select:focus {
    border-color: #3b82f6;
    background-color: #fff;
    box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
}

/* Buttons */
button.submit-btn {
    align-self: center;
    padding: 10px 20px;
    border: none;
    border-radius: 12px;
    background: #3b82f6;
    color: white;
    font-size: 15px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    margin-top: 10px;
}

button.submit-btn:hover {
    background: #2563eb;
    transform: translateY(-2px);
}

/* Error and success messages */
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

/* Responsive for mobile */
@media(max-width: 768px){
    .card {
        padding: 25px 20px;
        margin: 20px auto;
    }
    
    .form-row {
        flex-direction: column;
    }
}
</style>
@endpush

@section('content')
<div class="card-wrapper">
    <div class="card">
        <h2>Edit User</h2>
        <p class="subtitle">Update user details below</p>

        <form id="editUserForm" method="POST" action="#">
            @csrf
            @method('PUT')

            <!-- Row 1: Name + Email -->
            <div class="form-row">
                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" name="name" id="name" value="John Doe" placeholder="Enter full name">
                    <div class="error" id="nameError">Please enter full name</div>
                </div>

                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" name="email" id="email" value="johndoe@example.com" placeholder="Enter email address">
                    <div class="error" id="emailError">Please enter valid email</div>
                </div>
            </div>

            <!-- Row 2: Mobile + Role -->
            <div class="form-row">
                <div class="form-group">
                    <label>Mobile Number</label>
                    <input type="tel" name="mobile" id="mobile" value="0123456789" placeholder="Enter mobile number">
                    <div class="error" id="mobileError">Please enter valid mobile number</div>
                </div>

                <div class="form-group">
                    <label>Select Role</label>
                    <select name="role" id="role">
                        <option value="">Choose role</option>
                        <option value="User" selected>User</option>
                        <option value="Staff">Staff</option>
                    </select>
                    <div class="error" id="roleError">Please select a role</div>
                </div>
            </div>

            <!-- Row 3: Status -->
            <div class="form-row">
                <div class="form-group">
                    <label>Status</label>
                    <select name="status" id="status">
                        <option value="">Select status</option>
                        <option value="Active" selected>Active</option>
                        <option value="Inactive">Inactive</option>
                    </select>
                    <div class="error" id="statusError">Please select status</div>
                </div>
            </div>

            <button type="submit" class="submit-btn">Update</button>

            <div class="success-message" id="successMessage">
                User updated successfully!
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
const form = document.getElementById("editUserForm");

form.addEventListener("submit", function(e) {
    let isValid = true;

    const name = document.getElementById("name").value.trim();
    const email = document.getElementById("email").value.trim();
    const mobile = document.getElementById("mobile").value.trim();
    const role = document.getElementById("role").value;
    const status = document.getElementById("status").value;

    const nameError = document.getElementById("nameError");
    const emailError = document.getElementById("emailError");
    const mobileError = document.getElementById("mobileError");
    const roleError = document.getElementById("roleError");
    const statusError = document.getElementById("statusError");

    nameError.style.display = "none";
    emailError.style.display = "none";
    mobileError.style.display = "none";
    roleError.style.display = "none";
    statusError.style.display = "none";

    if (name === "") {
        nameError.style.display = "block";
        isValid = false;
    }

    const emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,}$/;
    if (!email.match(emailPattern)) {
        emailError.style.display = "block";
        isValid = false;
    }

    if (mobile.length < 10) {
        mobileError.style.display = "block";
        isValid = false;
    }

    if (role === "") {
        roleError.style.display = "block";
        isValid = false;
    }

    if (status === "") {
        statusError.style.display = "block";
        isValid = false;
    }

    if (!isValid) {
        e.preventDefault();
    }
});
</script>
@endpush
