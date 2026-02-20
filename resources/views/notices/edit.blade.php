@php
// MOCK for testing (remove later)
$notice = (object)[
    'notice_no' => 'RTM-AKTU/CSE/2026/012',
    'publish_date' => '2026-02-20',
    'title' => 'Notice for Make-Up Examination',
    'body' => 'This is to inform all concerned that the Make-Up Examinations for the Summer 2025 Semester Final Examinations will commence on 27th February 2026.

Students who were unable to attend the final examinations are advised to submit a duly signed Make-Up Examination Form along with required fees before the deadline.

All students must collect their Admit Cards before the commencement of the examination.

N.B: No student will be allowed to sit for the Make-Up Examination without an Admit Card.',
    'publisher_name' => 'Abu Syeed Muhammed Abdullah',
    'designation' => 'Associate Professor & Controller of Examinations'
];
@endphp
@extends('layout.sidebar')

@section('title','Edit Notice')

@push('styles')
<style>
/* ===== CONTAINER ===== */
.container {
    max-width: 800px;
    margin: 40px auto;
    padding: 20px;
}

/* ===== CARD STYLING ===== */
.card {
    border-radius: 12px;
    box-shadow: 0 6px 18px rgba(0,0,0,0.08);
    overflow: hidden;
    border: none;
}

.card-header {
    background-color: #f8f9fa;
    font-size: 1.25rem;
    font-weight: 600;
    color: #333;
    padding: 15px 20px;
    border-bottom: 1px solid #e0e0e0;
}

/* ===== CARD BODY ===== */
.card-body {
    padding: 25px 20px;
    background-color: #fff;
}

/* ===== FORM ELEMENTS ===== */
.form-label {
    font-weight: 500;
    margin-bottom: 6px;
}

.form-control {
    border-radius: 8px;
    border: 1px solid #ced4da;
    padding: 10px 12px;
    font-size: 14px;
    transition: border-color 0.2s, box-shadow 0.2s;
}

.form-control:focus {
    border-color: #0d6efd;
    box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.15);
}

textarea.form-control {
    resize: vertical;
}

/* ===== BUTTONS ===== */
button.btn-primary, button.btn-secondary {
    border-radius: 8px;
    padding: 10px 20px;
    font-size: 15px;
    font-weight: 500;
    transition: background-color 0.2s, transform 0.2s;
}

button.btn-primary:hover {
    background-color: #0b5ed7;
    transform: translateY(-1px);
}

button.btn-secondary:hover {
    background-color: #6c757d;
    transform: translateY(-1px);
}

/* ===== ROW SPACING ===== */
.row > .col-md-6 {
    margin-bottom: 15px;
}

/* ===== RESPONSIVE ===== */
@media (max-width: 576px) {
    .card-body {
        padding: 20px 15px;
    }
}
</style>
@endpush

@section('content')

<div class="container">

    <div class="card shadow-sm">
        <div class="card-header fw-bold">
            Edit Notice
        </div>

        <div class="card-body">

            <form action="#" method="POST">
                {{-- {{ route('notices.update', $notice->id) }} this route need to include --}}
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Notice Title</label>
                    <input type="text" name="title" class="form-control" value="{{ old('title', $notice->title) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Notice Body</label>
                    <textarea name="body" rows="8" cols="50" class="form-control" required>{{ old('body', $notice->body) }}</textarea>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label">Published By</label>
                        <input type="text" name="publisher_name" class="form-control" value="{{ old('publisher_name', $notice->publisher_name) }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Designation</label>
                        <input type="text" name="designation" class="form-control" value="{{ old('designation', $notice->designation) }}" required>
                    </div>
                </div>

                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">Update Notice</button>
                    <a href="{{ route('notices.index') }}" class="btn btn-secondary">Cancel</a>
                </div>

            </form>

        </div>
    </div>

</div>

@endsection