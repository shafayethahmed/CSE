@extends('layout.sidebar')
@section('title','Edit Course')

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>
.content-form-wrapper {
    margin-top: 20px;
    max-width: 900px;
    margin: 20px auto;   /* FIXED */
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
    height: 35px;
    width: 100%;
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

.form-row {
    display: flex;
    gap: 10px;
    margin-bottom: 15px;
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
    height: 35px;
    padding: 0 15px;
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
            <i class="fas fa-graduation-cap me-2"></i>
            Edit Course
        </div>

        <div class="form-section">

            {{-- Show Validation Errors --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul style="margin-bottom:0;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('courses.update',$course->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Row 1 --}}
                <div class="form-row">
                    <div>
                        <label class="form-label">Course Code</label>
                        <input type="text"
                               name="course_code"
                               class="form-control"
                               value="{{ old('course_code',$course->course_code) }}"
                               pattern="[A-Za-z]{3}-[0-9]{4}"
                               title="Enter format like CSE-1011"
                               required>
                    </div>

                    <div>
                        <label class="form-label">Course Title</label>
                        <input type="text"
                               name="course_title"
                               class="form-control"
                               maxlength="100"
                               value="{{ old('course_title',$course->course_title) }}"
                               required>
                    </div>
                </div>

                {{-- Row 2 --}}
                <div class="form-row">
                    <div>
                        <label class="form-label">Credit Hours</label>
                        <select name="course_credit" class="form-select" required>
                            <option value="">Select Credit</option>
                            @foreach(['1.0','1.5','2.0','2.5','3.0','3.5','4.0','4.5','5.0'] as $cre)
                                <option value="{{ $cre }}"
                                    {{ old('course_credit',$course->course_credit) == $cre ? 'selected' : '' }}>
                                    {{ $cre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- Row 3 --}}
                <div class="form-row">
                    <div>
                        <label class="form-label">Course Type</label>
                       <select name="course_type" class="form-select" required>
                        <option value="">Select Type</option>

                        <option value="theory"
                            {{ old('course_type',$course->course_type)=='theory'?'selected':'' }}>
                            Theory
                        </option>

                        <option value="sessional"
                            {{ old('course_type',$course->course_type)=='sessional'?'selected':'' }}>
                            Sessional
                        </option>

                        <option value="project"
                            {{ old('course_type',$course->course_type)=='project'?'selected':'' }}>
                            Thesis/Project/Practicum/Internship
                        </option>
                    </select>
                    </div>
                </div>

                {{-- Buttons --}}
                <div class="form-actions">
                    <button type="button" class="btn btn-secondary" onclick="window.history.back();">
                        Cancel
                    </button>

                    <button type="submit" class="btn btn-primary">
                        Update Course
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection