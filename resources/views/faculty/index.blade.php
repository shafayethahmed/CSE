@extends('layout.sidebar')

@section('title','Faculty')

@push('styles')
<style>
.page-wrapper{
    padding:25px;
    background:#f5f7fb;
    min-height:100vh;
}

.page-header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:20px;
}

.page-header h2{
    font-size:20px;
    font-weight:600;
    color:#1f2937;
}

.btn-primary{
    background:#1e3a8a;
    border:none;
    padding:8px 16px;
    color:white;
    border-radius:8px;
    font-weight:600;
    font-size:13px;
}

.btn-primary:hover{background:#1e40af;}
/* FILTER */
.filter-box{
    background:#fff;
    padding:10px; /* 🔥 reduced */
    border-radius:10px;
    margin-bottom:15px;
    box-shadow:0 6px 15px rgba(0,0,0,0.04);
    display:grid;
    grid-template-columns: repeat(3, 1fr);
    gap:8px; /* 🔥 smaller gap */
}

.filter-box input,
.filter-box select{
    padding:6px 8px; /* 🔥 tighter */
    border-radius:6px;
    border:1px solid #d1d5db;
    font-size:12px; /* 🔥 smaller font */
    height:30px; /* 🔥 fixed compact height */
}

.filter-box input:focus,
.filter-box select:focus{
    border-color:#1e3a8a;
    outline:none;
}


/* TABLE */
.table-box{
    background:#fff;
    padding:12px;
    border-radius:10px;
    box-shadow:0 8px 20px rgba(0,0,0,0.04);
}

.table-responsive{
    overflow-x:auto;
}

.user-table{
    width:100%;
    border-collapse:separate;
    border-spacing:0;
    font-size:12px; /* smaller font */
}

.user-table thead{
    background:#e2e8f0;
}

.user-table th{
    padding:8px 8px;  /* 🔥 reduced */
    text-align:center;
    font-weight:600;
    font-size:12px;
}

.user-table td{
    padding:6px 6px;  /* 🔥 tighter rows */
    text-align:center;
}

/* zebra */
.user-table tbody tr:nth-child(even){
    background:#f8fafc;
}

/* hover */
.user-table tbody tr:hover{
    background:#eef2ff;
}

/* Actions */
.actions button{
    border:none;
    padding:3px 6px; /* 🔥 smaller */
    border-radius:5px;
    font-size:11px;
    margin-right:3px;
}

.btn-view{background:#e0f2fe;color:#0369a1;}
.btn-edit{background:#fef9c3;color:#854d0e;}
.btn-delete{background:#fee2e2;color:#b91c1c;}

/* SPINNER */
#spinnerOverlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(255, 255, 255, 0.7);
    display: none;
    justify-content: center;
    align-items: center;
    z-index: 9999;
}

.spinner {
    border: 6px solid #f3f3f3;
    border-top: 6px solid #1e3a8a;
    border-radius: 50%;
    width: 50px;
    height: 50px;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

@media(max-width:768px){
    .filter-box{grid-template-columns:1fr;}
}

</style>
@endpush

@section('content')

<div class="page-wrapper">

    <div class="page-header">
        <h2>Faculty Management</h2>
        <button class="btn-primary" onclick="addUser()">+ Assign Faculty</button>
    </div>

   <div class="filter-box">
    <input type="text" id="searchFaculty" placeholder="Search by Name or Email">
        <select id="statusFilter">
            <option value="">All Status</option>
            <option value="Active">Active</option>
            <option value="Inactive">Inactive</option>
        </select>
   </div>
    <div class="table-box">
        <div class="table-responsive">
             <div id="facultyTable">
                @include('faculty.partials.table', ['faculties' => $faculties])
            </div>
        </div>
    </div>

</div>

@endsection
@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
function addUser(){
    window.location.href = "{{ route('faculty.create') }}";
}

// AJAX Search + Filter
$(document).ready(function(){

    // 🔄 Fetch Data
    function fetchFaculty(url = null){

        let search = $('#searchFaculty').val();
        let filter = $('#statusFilter').val();

        $.ajax({
            url: url ?? "{{ route('faculty.index') }}",
            type: "GET",
            data: { search: search, filter: filter },

            beforeSend: function(){
                $('#spinnerOverlay').fadeIn();
            },

            success: function(data){
                $('#facultyTable').html(data);
            },

            complete: function(){
                $('#spinnerOverlay').fadeOut();
            },

            error: function(){
                alert('Something went wrong!');
            }
        });
    }

    // 🔍 Search
    $('#searchFaculty').on('keyup', function(){
        fetchFaculty();
    });

    // 🎯 Filter
    $('#statusFilter').on('change', function(){
        fetchFaculty();
    });

    // 📄 Pagination
    $(document).on('click', '.pagination a', function(e){
        e.preventDefault();
        let url = $(this).attr('href');
        fetchFaculty(url);
    });

});
setTimeout(() => {
    document.querySelectorAll('.toast-msg').forEach(t => t.remove());
}, 3000);

</script>
@endpush
