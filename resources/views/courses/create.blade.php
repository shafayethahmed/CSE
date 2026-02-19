@extends('layout.sidebar')

@section('title','Add Course')

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>
/* Minimal Professional Admin Form */
.content-form-wrapper {
    margin-top: 20px;
    max-width: 900px;
    margin: 5 auto;
    padding: 15px;
}

.course-form-card {
    background: #fff;
    border: 1px solid #e5e7eb;
    border-radius: 10px;
}

/* Compact Header */
.course-form-header {
    background: #0c1b3d;
    color: white;
    padding: 14px 20px;
    font-size: 16px;
    font-weight: 600;
}

/* Form Section */
.form-section {
    padding: 20px;
}

/* Labels */
.form-label {
    font-size: 13px;
    font-weight: 600;
    margin-bottom: 5px;
    display: block;
}

/* Compact Inputs */
.form-control,
.form-select {
    height: 30px;
    max-width: 100%;
    border-radius: 8px;
    font-size: 14px;
    border: 1px solid #d1d5db;
    padding: 0 12px;
    background: #fff;
}

.form-control:focus,
.form-select:focus {
    border-color: #2563eb;
    box-shadow: none;
    outline: none;
}

/* Layout */
.form-row {
    display: flex;
    gap: 10px;
    margin-bottom: 10px;
}

.form-row > div {
    flex: 1;
}

/* Responsive */
@media (max-width: 768px) {
    .form-row {
        flex-direction: column;
    }
}

/* Buttons */
.form-actions {
    border-top: 1px solid #f1f5f9;
    padding-top: 15px;
    margin-top: 20px;
    display: flex;
    justify-content: flex-end;
    gap: 10px;
}

.btn {
    height: 30px;
    padding: 0 10px;
    font-size: 14px;
    border-radius: 8px;
}

.btn-primary {
    background: #2563eb;
    color: white;
    border: none;
}

.btn-secondary {
     background: white;
     color: black;
     border: none;
     text-align: center;
   
}
</style>
@endpush

@section('content')
<div class="content-form-wrapper">
    <div class="course-form-card">

        <div class="course-form-header">
            <i class="fas fa-graduation-cap me-2"></i>
            Add New Course
        </div>

        <div class="form-section">
            <form action="#" method="POST">
                @csrf

                {{-- Row 1 --}}
                <div class="form-row">
                    <div>
                        <label class="form-label">Course Code</label>
                        <input type="text"
                               name="course_code"
                               class="form-control"
                               placeholder="e.g. CSE-101"
                               maxlength="20"
                               required>
                    </div>

                    <div>
                        <label class="form-label">Course Title</label>
                        <input type="text"
                               name="course_title"
                               class="form-control"
                               placeholder="e.g. Data Structure"
                               maxlength="100"
                               required>
                    </div>
                </div>

                {{-- Row 2 --}}
                <div class="form-row">
                    <div>
                        <label class="form-label">Credit Hours</label>
                        <input type="number"
                               name="credit"
                               step="0.5"
                               min="1"
                               max="4"
                               class="form-control"
                               placeholder="e.g. 3.0"
                               required>
                    </div>
                        
                    <div>
                        <label class="form-label">Semester</label>
                        <select name="semester" class="form-select" required>
                            <option value="">Select Semester</option>
                            <option value="1-1">1st Year - 1st Semester</option>
                            <option value="1-2">1st Year - 2nd Semester</option>
                            <option value="2-1">2nd Year - 1st Semester</option>
                            <option value="2-2">2nd Year - 2nd Semester</option>
                            <option value="3-1">3rd Year - 1st Semester</option>
                            <option value="3-2">3rd Year - 2nd Semester</option>
                            <option value="4-1">4th Year - 1st Semester</option>
                            <option value="4-2">4th Year - 2nd Semester</option>
                        </select>
                    </div>
                </div>

                {{-- Buttons --}}
                <div class="form-actions">
                  <button type="button" class="btn btn-secondary" onclick="window.history.back();">
                        Cancel
                    </button>

                    <button type="submit" class="btn btn-primary">
                        Save Course
                    </button>
                </div>

            </form>
        </div>

    </div>
</div>
@endsection
