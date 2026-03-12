
@extends('layout.sidebar')
@section('title','Edit Course Teacher')
@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>
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

.course-form-header {
    background: #0c1b3d;
    color: white;
    padding: 14px 20px;
    font-size: 16px;
    font-weight: 600;
}

.form-section {
    padding: 20px;
}

.form-label {
    font-size: 13px;
    font-weight: 600;
    margin-bottom: 5px;
    display: block;
}

.form-control,
.form-select {
    height: 30px;
    width: 100%;
    border-radius: 8px;
    font-size: 14px;
    border: 1px solid #d1d5db;
    padding: 0 12px;
    background: #f9fafb;
}

.static-field {
    background: #f3f4f6;
    font-weight: 500;
}

.form-row {
    display: flex;
    gap: 10px;
    margin-bottom: 12px;
}

.form-row > div {
    flex: 1;
}

@media (max-width: 768px) {
    .form-row {
        flex-direction: column;
    }
}

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
    padding: 0 12px;
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
    border: 1px solid #d1d5db;
}
</style>
@endpush


@section('content')
<div class="content-form-wrapper">
    <div class="course-form-card">

        <div class="course-form-header">
            <i class="fas fa-user-tie me-2"></i>
            Assign Teacher to Course
        </div>

        <div class="form-section">

            {{-- FORM --}}
            <form action="#" method="POST">
                @csrf

                {{-- Static Course Info --}}
                <div class="form-row">
                    <div>
                        <label class="form-label">Course Code</label>
                        <input type="text"
                               class="form-control static-field"
                               value="{{ $facultyCourse->course->course_code }}"
                               readonly>
                    </div>

                    <div>
                        <label class="form-label">Course Title</label>
                        <input type="text"
                               class="form-control static-field"
                               value="{{ $facultyCourse->course->course_title }}"
                               readonly>
                    </div>
                </div>

                <div class="form-row">
                    <div>
                        <label class="form-label">Credit Hours</label>
                        <input type="text"
                               class="form-control static-field"
                               value="{{ $facultyCourse->course->course_credit }}"
                               readonly>
                    </div>
                     <div>
                        <label class="form-label">Course Type</label>
                        <input type="text"
                               class="form-control static-field"
                               value="{{ ucWords($facultyCourse->course->course_type) }}"
                               readonly>
                    </div>

                </div>

                {{-- Assign Teacher --}}
                <div class="form-row">
                     <div>
                        <label class="form-label">Currently Assigned</label>
                        <input type="text"
                               class="form-control static-field"
                               value="{{ $facultyCourse->faculty->name ?? "N/A"  }}"
                               readonly>
                    </div>
                    <div>
                        <label class="form-label">Select Teacher* <small>(In Case Of Change)</small></label>
                        <select name="teacher_id" class="form-select" required>
                            <option value="">Choose Teacher</option>

                            @foreach($faculties as $faculty)
                                <option value="{{ $faculty->id }}">
                                    {{ $faculty->name }}
                                </option>
                            @endforeach

                        </select>
                    </div>
                </div>


                {{-- Buttons --}}
                <div class="form-actions">

                    <button type="button"
                            class="btn btn-secondary"
                            onclick="window.history.back();">
                        Cancel
                    </button>

                    <button type="submit" class="btn btn-primary">
                        Assign Course Teacher
                    </button>

                </div>

            </form>

        </div>
    </div>
</div>
@endsection