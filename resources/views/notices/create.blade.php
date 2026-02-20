@extends('layout.sidebar')

@section('title','Create Notice')

@push('styles')
<style>
/* ===== CONTAINER ===== */
.container {
    max-width: 700px;
    margin: 10px auto;
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
    padding: 10px 15px;
    border-bottom: 1px solid #e0e0e0;
}

/* ===== CARD BODY ===== */
.card-body {
    padding: 15px 10px;
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

/* ===== TEXTAREA ===== */
textarea.form-control {
    resize: vertical;
}

/* ===== BUTTON ===== */
button.btn-primary {
    background-color: #0d6efd;
    border: none;
    border-radius: 8px;
    padding: 5px 10px;
    font-size: 12px;
    font-weight: 500;
    transition: background-color 0.2s, transform 0.2s;
}

button.btn-primary:hover {
    background-color: #0b5ed7;
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
            Create New Notice
        </div>

        <div class="card-body">

            <form action="{{ route('notices.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Notice Title</label>
                    <input type="text" name="title" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Notice Body</label>
                    <textarea name="body" rows="8"  cols="50" class="form-control" required></textarea>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label">Published By</label>
                        <input type="text" name="publisher_name" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Designation</label>
                        <input type="text" name="designation" class="form-control" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary mt-3">
                    Save Notice
                </button>

            </form>

        </div>
    </div>

</div>

@endsection