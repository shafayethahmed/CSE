@extends('layout.sidebar')

@section('title','Edit Student')

@push('styles')
<style>
/* Wrapper */
.page-wrapper{
    max-width: 800px;   /* reduced width */
    margin: 5px auto;
    padding: 10px 10px;
}

/* Header */
.page-header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:10px;
}

.page-header h2{
    font-size:20px;
    font-weight:600;
    color:#1f2937;
}

/* Back Button */
.back-btn{
    background:#6b7280;
    border:none;
    padding:6px 14px;
    color:white;
    border-radius:6px;
    cursor:pointer;
    font-weight:600;
    font-size:12px;
}
.back-btn:hover{
    background:#4b5563;
}

/* Form */
form{
    display:grid;
    grid-template-columns: repeat(3,1fr);
    gap:5px 15px;
}

.form-group{
    display:flex;
    flex-direction:column;
}

label{
    font-size:12px;
    font-weight:600;
    margin-bottom:5px;
    color:#374151;
}

input, select{
    padding:10px 12px;
    border-radius:6px;
    border:1px solid #d1d5db;
    font-size:13px;
    transition:.25s;
    outline:none;
}

input:focus, select:focus{
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(37,99,235,0.12);
}

/* Action Buttons */
.actions{
    grid-column: span 3;
    display:flex;
    justify-content:flex-end;
    gap:10px;
    margin-top:10px;
}

.update-btn{
    background:var(--primary);
    color:white;
    border:none;
    padding:10px 22px;
    border-radius:6px;
    font-weight:600;
    font-size:12px;
    cursor:pointer;
    transition:.25s;
}
.update-btn:hover{
    background:#1e40af;
}

.cancel-btn{
    background:#e5e7eb;
    border:none;
    padding:10px 22px;
    border-radius:6px;
    font-weight:600;
    font-size:12px;
    cursor:pointer;
}
.cancel-btn:hover{
    background:#d1d5db;
}

/* Responsive */
@media(max-width:992px){
    form{
        grid-template-columns:repeat(2,1fr);
    }
    .actions{
        grid-column: span 2;
    }
}

@media(max-width:600px){
    form{
        grid-template-columns:1fr;
    }
    .actions{
        grid-column: span 1;
    }
}
</style>
@endpush

@section('content')
<div class="page-wrapper">

    <div class="page-header">
        <h2>Edit Student</h2>
        <button class="back-btn" onclick="goBack()">← Back</button>
    </div>

    <form id="editForm">

        <!-- Academic Info -->
        <div class="form-group">
            <label>Academic ID</label>
            <input type="text" value="{{ $student->academicId }}" >
        </div>

        <div class="form-group">
            <label>Student Name</label>
            <input type="text" value="{{ $student->name }}">
        </div>

        <div class="form-group">
            <label>Department</label>
            <input type="text" value="CSE" readonly>
        </div>

        <div class="form-group">
            <label>Session</label>
            <select>
                <option>Summer</option>
                <option selected>Spring</option>
            </select>
        </div>

        <div class="form-group">
            <label>Admission Year</label>
            <input type="text" value="2024">
        </div>

        <div class="form-group">
            <label>Semester</label>
            <select>
                <option selected>{{ $student->semester }}</option>
                <option value="">1-1</option>
                <option>1-2</option>
                <option>2-1</option>
                <option>2-2</option>
                <option>3-1</option>
                <option>3-2</option>
                <option>4-1</option>
                <option>4-2</option>
                <option value="Passed">Passed</option>
            </select>
        </div>

        <!-- Personal Info -->
        <div class="form-group">
            <label>Email</label>
            <input type="email" value="{{ $student->email }}">
        </div>

        <div class="form-group">
            <label>Mobile</label>
            <input type="tel" value="{{ $student->mobile }}">
        </div>

        <div class="form-group">
            <label>Date of Birth</label>
            <input type="date" value="{{ $student->dob }}">
        </div>

          <div class="form-group">
            <label>Address</label>
            <input type="address" value="{{ $student->address }}">
        </div>

        <!-- Action Buttons -->
        <div class="actions">
            <button type="button" class="cancel-btn" onclick="goBack()">Cancel</button>
            <button type="submit" class="update-btn">Update Student</button>
        </div>

    </form>

</div>
@endsection

@push('scripts')
<script>
function goBack(){
    window.history.back();
}

document.getElementById("editForm").addEventListener("submit", function(e){
    e.preventDefault();
    alert("Student information updated successfully!");
});
</script>
@endpush
