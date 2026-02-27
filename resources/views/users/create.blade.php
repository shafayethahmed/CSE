@extends('layout.sidebar')

@section('title', 'Edit User')

@push('styles')
<style>
/* Card Container */
.card {
    background: #d2eafa; /* Light card background */
    padding: 10px 25px;
    border-radius: 16px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.08);
    max-width: 900px;
    margin: 20px auto;
    display: flex;
    gap: 15px;
    flex-wrap: wrap;
    justify-content: space-between;
    transition: all 0.3s ease;
}

.card:hover {
    box-shadow: 0 12px 28px rgba(0,0,0,0.12);
}

/* Titles */
.card h2 {
    width: 100%;
    text-align: center;
    margin-bottom: 6px;
    font-weight: 700;
    color: #1e3a8a;
}

.card .subtitle {
    width: 100%;
    text-align: center;
    font-size: 14px;
    color: #6b7280;
    margin-bottom: 25px;
}

/* Form Layout */
.form-left, .form-right {
    flex: 1;
    min-width: 250px;
}

.form-group {
    margin-bottom: 18px;
}

label {
    font-size: 12px;
    font-weight: 500;
    margin-bottom: 6px;
    display: block;
    color: #374151;
}

input, select {
    width: 100%;
    padding: 10px 12px;
    border-radius: 10px;
    border: 1px solid #d1d5db;
    background-color: #f9fafb;
    font-size: 12px;
    outline: none;
    transition: all 0.2s ease-in-out;
}

input:focus, select:focus {
    border-color: #3b82f6;
    background-color: #fff;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

button {
    padding: 12px 22px;
    border: none;
    border-radius: 10px;
    background: #3b82f6;
    color: white;
    font-size: 15px;
    font-weight: 600;
    cursor: pointer;
    margin-top: 10px;
    transition: all 0.3s ease;
}

button:hover {
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
    margin-top: 12px;
    text-align: center;
    font-size: 14px;
    color: #10b981;
    display: none;
}

/* Responsive for mobile */
@media(max-width: 768px){
    .card {
        flex-direction: column;
        max-width: 100%;
        margin: 10px auto;
    }
}
</style>
@endpush

@section('content')
<div class="card">
    @if (Auth::user()->role === 'super-admin')
    <h2>Add New User</h2>
    <p class="subtitle">Enter user details below</p>

    <form id="userForm" method="POST" action="{{ route('users.store') }}" style="width:100%; display:flex; flex-wrap:wrap; gap:25px;">
        @csrf

        <div class="form-left">
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="name" id="name" placeholder="Enter full name" >
                <div class="error" id="nameError">Please enter full name</div>
                @error('name')<div class="error">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label>Email Address</label>
                <input type="email" name="email" id="email" placeholder="Enter email address">
                <div class="error" id="emailError">Please enter valid email</div>
                @error('email')<div class="error">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="form-right">
            <div class="form-group">
                <label>Mobile Number</label>
                <input type="tel" name="mobile" id="mobile" placeholder="Enter 10-digit mobile number" >
                <div class="error" id="mobileError">Please enter valid 10-digit mobile number</div>
                @error('mobile')<div class="error">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label>Select Role</label>
                <select name="role" id="role">
                    <option value="">Choose role</option>
                    <option value="user">User</option>
                    <option value="staff">Staff</option>
                    <option value="department-head">Department Head</option>
                </select>
                <div class="error" id="roleError">Please select a role</div>
                @error('role')<div class="error">{{ $message }}</div>@enderror
            </div>

            <button type="submit">Submit</button>

            @if(session('success'))
                <div class="success-message" id="successMessage">
                    {{ session('success') }}
                </div>
            @endif
               @if(session('success'))
                <div class="success-message" id="successMessage">
                    {{ session('success') }}
                </div>
            @endif
        </div>
    </form>
     @endif
</div>
@endsection


