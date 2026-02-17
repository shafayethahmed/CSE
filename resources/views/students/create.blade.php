@extends('layout.sidebar')

@section('title','Add Student')

@push('styles')
<style>
.page-wrapper {
    max-width: 1800px; /* increase from 900px to 1100px or more */
    margin: 0px auto 0;
    padding: 10px;
}
/* Card Container */
.form-card {
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.06);
    padding: 20px 15px;
    font-family: "Segoe UI", Roboto, sans-serif;
}

/* Header */
.form-banner {
    background: var(--primary);
    color: #fff;
    padding: 12px 15px;
    border-radius: 8px 8px 0 0;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.form-banner h2 {
    font-size: 18px;
    font-weight: 700;
}

.back-btn {
    background: #fff;
    color: var(--primary);
    border: none;
    padding: 4px 10px;
    border-radius: 6px;
    font-size: 12px;
    font-weight: 600;
    cursor: pointer;
    transition: 0.3s;
}

.back-btn:hover {
    background: #f1f5f9;
}

/* Form Grid */
form {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 10px 20px; /* tighter gap */
    padding: 15px 0;
}

.form-group {
    display: flex;
    flex-direction: column;
}

label {
    font-size: 11px;
    font-weight: 600;
    margin-bottom: 3px;
    color: #374151;
    text-transform: uppercase;
}

input, select {
    padding: 5px 5px;
    border-radius: 6px;
    border: 1px solid #d1d5db;
    font-size: 12px;
    outline: none;
    transition: 0.25s;
}

input:focus, select:focus {
    border-color: var(--primary);
    box-shadow: 0 0 0 2px rgba(37, 99, 235, 0.15);
}

/* Full width fields */
.full-width {
    grid-column: span 3;
}

/* Error and success */
.error {
    font-size: 10px;
    color: #dc2626;
    margin-top: 2px;
    display: none;
}

.success {
    grid-column: span 3;
    color: #16a34a;
    font-size: 12px;
    margin-top: 5px;
    display: none;
}

/* Buttons */
.actions {
    grid-column: span 3;
    display: flex;
    justify-content: flex-end;
    margin-top: 5px;
    gap: 6px;
}

.actions button {
    padding: 8px 18px;
    font-size: 12px;
    font-weight: 600;
    border-radius: 6px;
    border: none;
    cursor: pointer;
    transition: 0.25s;
}

.actions .submit-btn {
    background: var(--primary);
    color: #fff;
}

.actions .submit-btn:hover {
    background: #1e40af;
}

.actions .cancel-btn {
    background: #f1f5f9;
    color: #374151;
}

.actions .cancel-btn:hover {
    background: #e5e7eb;
}
/* Overlay covering the whole screen */
#spinnerOverlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(255, 255, 255, 0.7);
    display: none; /* hidden by default */
    justify-content: center;
    align-items: center;
    z-index: 9999;
}

/* Responsive */
@media(max-width:992px){
    form {
        grid-template-columns: repeat(2, 1fr);
    }
    .full-width, .actions, .success {
        grid-column: span 2;
    }
}

@media(max-width:600px){
    form {
        grid-template-columns: 1fr;
    }
    .full-width, .actions, .success {
        grid-column: span 1;
    }
}
</style>
@endpush

@section('content')
<div class="page-wrapper">
    <div class="form-card">

        <!-- Header -->
        <div class="form-banner">
            <h2>Add New Student</h2>
            <button class="back-btn" onclick="goBack()">← Back</button>
        </div>

        <!-- Form -->
        <form id="studentForm">

            <!-- Academic Info -->
            <div class="form-group">
                <label>Academic ID</label>
                <input type="text" id="academicId" placeholder="Enter academic ID">
                <div class="error" id="academicIdError">Academic ID required</div>
            </div>

            <div class="form-group">
                <label>Student Name</label>
                <input type="text" id="name" placeholder="Enter full name">
                <div class="error" id="nameError">Name required</div>
            </div>

            <div class="form-group">
                <label>Department</label>
                <input type="text" value="CSE" readonly>
            </div>

            <div class="form-group">
                <label>Session</label>
                <select id="session">
                    <option value="">Select session</option>
                    <option>Summer</option>
                    <option>Spring</option>
                </select>
                <div class="error" id="sessionError">Select session</div>
            </div>

            <div class="form-group">
                <label>Admission Year</label>
                <input type="text" id="admissionYear" placeholder="e.g., 2024">
                <div class="error" id="yearError">Enter valid 4-digit year</div>
            </div>

            <div class="form-group">
                <label>Semester</label>
                <select id="semester">
                    <option value="">Select semester</option>
                    <option>1-1</option><option>1-2</option>
                    <option>2-1</option><option>2-2</option>
                    <option>3-1</option><option>3-2</option>
                    <option>4-1</option><option>4-2</option>
                </select>
                <div class="error" id="semesterError">Select semester</div>
            </div>

            <!-- Personal Info -->
            <div class="form-group">
                <label>Email</label>
                <input type="email" id="email" placeholder="Enter email address">
                <div class="error" id="emailError">Valid email required</div>
            </div>

            <div class="form-group">
                <label>Mobile</label>
                <input type="tel" id="mobile" placeholder="11-digit mobile number">
                <div class="error" id="mobileError">Valid 11-digit mobile required</div>
            </div>

            <div class="form-group">
                <label>Date of Birth</label>
                <input type="date" id="dob">
                <div class="error" id="dobError">Select date of birth</div>
            </div>

            <div class="form-group">
                <label>Address</label>
                <input type="address" id="dob">
                <div class="error" id="dobError">Select date of birth</div>
            </div>
            <div class="actions">
                <button type="button" class="cancel-btn" onclick="goBack()">Cancel</button>
                <button type="submit" class="submit-btn">Add Student</button>
            </div>

            <div class="success" id="successMessage">Student added successfully!</div>
        </form>
       
    </div>
</div>
@endsection

@push('scripts')
<script>
function goBack(){
        window.history.back();
}

const form = document.getElementById("studentForm");

form.addEventListener("submit", function(e) {
    e.preventDefault();

    let valid = true;

    const academicId = document.getElementById('academicId').value.trim();
    const nameVal = document.getElementById('name').value.trim();
    const sessionVal = document.getElementById('session').value;
    const year = document.getElementById('admissionYear').value.trim();
    const semesterVal = document.getElementById('semester').value;
    const emailVal = document.getElementById('email').value.trim();
    const mobileVal = document.getElementById('mobile').value.trim();
    const dobVal = document.getElementById('dob').value;

    const yearPattern = /^[0-9]{4}$/;
    const emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,}$/;
    const mobilePattern = /^[0-9]{10}$/;

    document.querySelectorAll(".error").forEach(el => el.style.display = "none");
    document.getElementById("successMessage").style.display = "none";

    if (!academicId) { document.getElementById('academicIdError').style.display = "block"; valid = false; }
    if (!nameVal) { document.getElementById('nameError').style.display = "block"; valid = false; }
    if (!sessionVal) { document.getElementById('sessionError').style.display = "block"; valid = false; }
    if (!year.match(yearPattern)) { document.getElementById('yearError').style.display = "block"; valid = false; }
    if (!semesterVal) { document.getElementById('semesterError').style.display = "block"; valid = false; }
    if (!emailVal.match(emailPattern)) { document.getElementById('emailError').style.display = "block"; valid = false; }
    if (!mobileVal.match(mobilePattern)) { document.getElementById('mobileError').style.display = "block"; valid = false; }
    if (!dobVal) { document.getElementById('dobError').style.display = "block"; valid = false; }

    if (valid) {
        document.getElementById("successMessage").style.display = "block";
        form.reset();
    }
});
</script>
@endpush
