@php
/* ---------------- MOCK FACULTY DATABASE ---------------- */
$allFaculty = [
    (object)[
        'id'=>1,
        'name'=>'Dr. Rahim Uddin',
        'email'=>'rahim@university.edu'
    ],
    (object)[
        'id'=>2,
        'name'=>'Farhana Akter',
        'email'=>'farhana@university.edu'
    ],
];

/* ------------ MOCK SEARCH LOGIC ------------ */
$faculty = null;

if(request('search')){
    foreach($allFaculty as $f){
        if($f->email == request('search') || $f->id == request('search')){
            $faculty = $f;
        }
    }
}

/* ------------ MOCK SUBMIT ------------ */
if(request()->isMethod('post')){
    session()->flash('success','Semester assigned successfully (Mock)');
}
@endphp

@extends('layout.sidebar')

@section('title','Assign Batch Teacher')

@push('styles')
<style>

/* ===== Wrapper ===== */
.wrapper{
    max-width: 780px;
    margin: 20px auto;
}

/* ===== Card ===== */
.card-box{
    background:#fff;
    border-radius:12px;
    padding:22px 24px;
    border:1px solid #e5e7eb;
    transition:0.2s;
}

.card-box:hover{
    box-shadow:0 6px 18px rgba(0,0,0,0.06);
}

/* ===== Title ===== */
.card-box h5{
    font-weight:600;
    color:#111827;
    margin-bottom:15px;
}

/* ===== Layout ===== */
.row-flex{
    display:flex;
    gap:10px;
    margin-bottom:12px;
}

.row-flex > div{
    flex:1;
}

/* ===== Label ===== */
.label{
    font-size:12px;
    font-weight:600;
    color:#374151;
    margin-bottom:4px;
}

/* ===== Input ===== */
.form-control, .form-select{
    height:36px;
    font-size:13px;
    border-radius:8px;
    border:1px solid #d1d5db;
    transition:0.2s;
    padding-left:12px; 

}

.form-control:focus,
.form-select:focus{
    border-color:#2563eb;
    box-shadow:0 0 0 2px rgba(37,99,235,0.08);
}

/* ===== Buttons ===== */
.btn{
    border-radius:8px;
    font-size:13px;
    padding:6px 14px;
}

.btn-primary{
    background:#2563eb;
    border:none;
}

.btn-primary:hover{
    background:#1e40af;
}

.btn-success{
    background:#16a34a;
    border:none;
}

.btn-success:hover{
    background:#15803d;
}

/* ===== Faculty Info ===== */
.user-info{
    background:#f9fafb;
    border:1px solid #e5e7eb;
    padding:12px 14px;
    border-radius:8px;
    margin-bottom:14px;
    font-size:13px;
}

.user-info strong{
    color:#1e3a8a;
}

/* ===== Alert ===== */
.alert{
    border-radius:8px;
    font-size:13px;
}

/* ===== Actions ===== */
.actions{
    text-align:right;
    margin-top:14px;
}

/* ===== Responsive ===== */
@media(max-width:768px){
    .row-flex{
        flex-direction:column;
    }
}

</style>
@endpush


@section('content')

<div class="wrapper">

    <div class="card-box">

        <h5>Assign Batch Teacher</h5>

        {{-- SUCCESS MESSAGE --}}
        @if(session('success'))
            <div class="alert alert-success py-2">
                {{ session('success') }}
            </div>
        @endif


        {{-- Faculty Search --}}
        <form method="GET">
            <label class="label">Search Faculty (ID or Email)</label>

            <div class="row-flex">
                <input type="text" name="search"
                       value="{{ request('search') }}"
                       class="form-control"
                       placeholder="Enter Faculty ID or Email">

                <button class="btn btn-primary btn-sm">
                    Search
                </button>
            </div>
        </form>


        {{-- Show faculty after search --}}
        @if($faculty)
        <div class="user-info">
            <strong>Faculty Found</strong>
            <p class="mb-0 mt-1">
                {{ $faculty->name }} <br>
                <span class="text-muted">{{ $faculty->email }}</span>
            </p>
        </div>


        {{-- Assign Semester --}}
        <form method="POST">
            @csrf

            <input type="hidden" name="faculty_id" value="{{ $faculty->id }}">

            <div class="row-flex">
                <div>
                    <label class="label">Semester</label>
                    <select name="semester" class="form-select" required>
                        <option value="">Select Semester</option>
                        <option>1-1</option>
                        <option>1-2</option>
                        <option>2-1</option>
                        <option>2-2</option>
                        <option>3-1</option>
                        <option>3-2</option>
                        <option>4-1</option>
                        <option>4-2</option>
                    </select>
                </div>
            </div>

            <div class="actions">
                <button class="btn btn-success">Assign</button>

                <a href="#" class="btn btn-light border">
                   Cancel
                </a>
            </div>

        </form>
        @endif

    </div>

</div>

@endsection