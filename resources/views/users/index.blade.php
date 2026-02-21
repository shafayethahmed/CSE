@extends('layout.sidebar')

@section('title','Users & Roles')

@push('styles')
<style>
.page-wrapper{ padding:25px; background:#f5f7fb; min-height:100vh; }
.page-header{ display:flex; justify-content:space-between; align-items:center; margin-bottom:20px; }
.page-header h2{ font-size:20px; font-weight:600; color:#1f2937; }
.btn-primary{ background:#1e3a8a; border:none; padding:8px 16px; color:white; border-radius:8px; font-weight:600; font-size:13px; }
.btn-primary:hover{ background:#1e40af; }

/* FILTER */
.filter-box{ background:#fff; padding:10px; border-radius:10px; margin-bottom:15px; box-shadow:0 6px 15px rgba(0,0,0,0.04); display:grid; grid-template-columns: repeat(2, 1fr); gap:8px; }
.filter-box input, .filter-box select{ padding:6px 8px; border-radius:6px; border:1px solid #d1d5db; font-size:12px; height:30px; }
.filter-box input:focus, .filter-box select:focus{ border-color:#1e3a8a; outline:none; }

/* TABLE */
.table-box{ background:#fff; padding:12px; border-radius:10px; box-shadow:0 8px 20px rgba(0,0,0,0.04); }
.table-responsive{ overflow-x:auto; }
.user-table{ width:100%; border-collapse:separate; border-spacing:0; font-size:12px; }
.user-table thead{ background:#e2e8f0; }
.user-table th, .user-table td{ padding:6px 8px; text-align:center; }
.user-table tbody tr:nth-child(even){ background:#f8fafc; }
.user-table tbody tr:hover{ background:#eef2ff; }

/* Action buttons container */
.action-btns{
    display:flex;           /* Side by side */
    justify-content:center; /* Center horizontally */
    gap:5px;                /* Gap between buttons */
    align-items:center;     /* Vertical align center */
}

/* Edit button */
.btn-edit{
    background:#fef9c3;
    color:#854d0e;
    border:none;
    padding:5px 8px;
    border-radius:5px;
    font-size:13px;
    display:flex;
    align-items:center;
    justify-content:center;
    cursor:pointer;
    transition:0.3s;
}

.btn-edit:hover{
    background:#fddf6b;
}

/* Delete button */
.btn-delete{
    background:#fee2e2;
    color:#b91c1c;
    border:none;
    padding:5px 8px;
    border-radius:5px;
    font-size:13px;
    display:flex;
    align-items:center;
    justify-content:center;
    cursor:pointer;
    transition:0.3s;
}

.btn-delete:hover{
    background:#fca5a5;
}

@media(max-width:768px){ .filter-box{ grid-template-columns:1fr; } }
</style>
@endpush

@section('content')
<div class="page-wrapper">

    <div class="page-header">
        <h2>User Management</h2>
        <button class="btn-primary" onclick="addUser()">+ Add User</button>
    </div>
    <!-- Filters -->
    <div class="filter-box">
        <input type="text" id="searchUser" placeholder="Search by Name or Email">
        <select id="roleFilter">
            <option value="">All Roles</option>
            <option value="user">User</option>
            <option value="staff">Staff</option>
            <option value="department-head">Department Head</option>
            <option value="super-admin">Super Admin</option>
        </select>
    </div>
    <!--Table Box -->
    <div class="table-box">
        <div class="table-responsive">
            <div id="userTable">
                @include('users.partials.table', ['users' => $users])
            </div>
        </div>
    </div>
<!-- Pagination -->   
</div>
 
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
function addUser(){
    window.location.href = "{{ route('users.create') }}";
}

// AJAX Search + Filter
$(document).ready(function(){

    function fetchUsers(){
        let search = $('#searchUser').val();
        let role   = $('#roleFilter').val();
        $.ajax({
            url: "{{ route('users.index') }}",
            type: "GET",
            data: { search: search, role: role },
            success: function(data){
                $('#userTable').html(data);
            },
            error: function(){
                alert('Something went wrong!');
            }
        });
    }

    $('#searchUser').on('keyup', fetchUsers);
    $('#roleFilter').on('change', fetchUsers);
});
</script>
@endpush