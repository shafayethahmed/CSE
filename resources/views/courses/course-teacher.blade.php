@extends('layout.sidebar')

@section('title','Courses')

@push('styles')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>

/* Wrapper */
.page-wrapper{
    margin-top:20px;
    max-width:900px;
    margin-left:auto;
    margin-right:auto;
}

/* Header */
.page-header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:18px;
}

.page-header h2{
    font-size:18px;
    font-weight:600;
    color:#1f2937;
}

/* Header Buttons */
.header-actions{
    display:flex;
    gap:8px;
}

.header-btn{
    border:none;
    padding:6px 10px;
    border-radius:6px;
    cursor:pointer;
    font-size:12px;
    font-weight:600;
    display:flex;
    align-items:center;
    gap:5px;
}

/* Add Button */
.btn-add{
    background:#dcfce7;
    color:#166534;
}

.btn-add:hover{
    background:#bbf7d0;
}

/* Fetch Button */
.btn-fetch{
    background:#e0f2fe;
    color:#0369a1;
}

.btn-fetch:hover{
    background:#bae6fd;
}

/* Loading Spinner */
.loading-spinner{
    display:none;
    width:18px;
    height:18px;
    border:3px solid #f3f3f3;
    border-top:3px solid #2563eb;
    border-radius:50%;
    animation:spin 1s linear infinite;
}

@keyframes spin{
    0%{transform:rotate(0deg);}
    100%{transform:rotate(360deg);}
}

/* Filters */
.filter-box{
    background:#fff;
    padding:14px;
    border-radius:10px;
    margin-bottom:18px;
    box-shadow:0 8px 20px rgba(0,0,0,0.04);
    display:grid;
    grid-template-columns:repeat(2,1fr);
    gap:10px;
}

.filter-box input,
.filter-box select{
    padding:7px 9px;
    border-radius:6px;
    border:1px solid #d1d5db;
    font-size:12px;
}

.filter-box input:focus,
.filter-box select:focus{
    border-color:var(--primary);
    outline:none;
}

/* Table */
.table-box{
    background:#fff;
    padding:10px;
    border-radius:10px;
    box-shadow:0 10px 25px rgba(0,0,0,0.05);
}

table{
    width:100%;
    border-collapse:collapse;
    font-size:13px;
}

thead{
    background:#d9d5ebe1;
}

th{
    font-size:13px;
    font-weight:600;
    color:#000;
    padding:9px 8px;
    text-align:center;
}

td{
    padding:8px 6px;
    text-align:center;
}

tbody tr{
    border-bottom:1px solid #eef2f7;
}

tbody tr:hover{
    background:#f9fafb;
}

/* Edit Button */
.icon-btn{
    border:none;
    width:28px;
    height:28px;
    border-radius:6px;
    cursor:pointer;
    font-size:12px;
    display:inline-flex;
    align-items:center;
    justify-content:center;
}

.btn-edit{
    background:#fef9c3;
    color:#854d0e;
}

.btn-edit:hover{
    background:#fde68a;
}

</style>
@endpush


@section('content')

<div class="page-wrapper">

    <!-- Header -->
    <div class="page-header">

        <h2>Course Management</h2>

        <div class="header-actions">

            <!-- Add Button -->
            <button class="header-btn btn-add" onclick="goAssignPage()">
                <i class="fa-solid fa-plus"></i> Add
            </button>

            <!-- Fetch Button -->
            <button class="header-btn btn-fetch" onclick="fetchCourses()">
                <i class="fa-solid fa-rotate"></i> Fetch
            </button>

            <!-- Loading Spinner -->
            <div class="loading-spinner" id="loadingSpinner"></div>

        </div>

    </div>

    <!-- Filters -->
    <div class="filter-box">
        <input type="text" id="searchInput" placeholder="Search by Course Code or Title...">

        <select>
            <option>Instructor Status</option>
            <option>Null</option>
            <option>Assigned</option>
        </select>
    </div>

    <!-- Table -->
    <div class="table-box">

        <table>

            <thead>
                <tr>
                    <th>SL</th>
                    <th>Course Code</th>
                    <th>Course Title</th>
                    <th>Instructor</th>
                    <th width="90">Action</th>
                </tr>
            </thead>

            <tbody id="studentTable">
                  
                 @forelse ($facultyCourses as $fc  )
                 {{-- Doing the backend part for information about intructor --}}

                <tr>
                    <td>{{ $fc->id }}</td>
                    <td>{{ $fc->course->course_code ?? "NULL"}}</td>
                    <td>{{ $fc->course->course_title ?? "NULL" }}</td>
                    <td>{{ $fc->faculty->name ?? "NULL" }}</td>
                    <td>
                        <button class="icon-btn btn-edit" onclick="goAssignPage()" title="Edit">
                            <i class="fa-solid fa-pen"></i>
                        </button>
                    </td>
                </tr>
                 @empty
                     
                 @endforelse
            </tbody>

        </table>

    </div>

</div>

@endsection


@push('scripts')

<script>

document.addEventListener("DOMContentLoaded", function(){

    /* Search */
    document.getElementById("searchInput").addEventListener("keyup", function(){

        let value = this.value.toLowerCase();
        let rows = document.querySelectorAll("#studentTable tr");

        rows.forEach(row=>{
            row.style.display = row.innerText.toLowerCase().includes(value) ? "" : "none";
        });

    });

});


/* Redirect to Assign Page */
function goAssignPage(){
    window.location.href = "{{ route('assign-course-teacher.create') }}";
}


/* Fetch with loading */
function fetchCourses(){

    let spinner = document.getElementById("loadingSpinner");

    spinner.style.display="block";

    setTimeout(function(){

        spinner.style.display="none";

        alert("Courses fetched successfully!");

    },1500);

}

</script>

@endpush