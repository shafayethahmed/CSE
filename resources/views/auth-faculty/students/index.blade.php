@extends('auth-faculty.layout.sidebar')
@section('title','Students')
@push('styles')
<style>
/* Wrapper */
.page-wrapper{
    margin-top: 10px;
    max-width: 900px;
    margin: 5px auto; /* FIXED */
}

/* Header */
.page-header{
    display:flex;
    justify-content:space-between;
    align-items:center;
}

.page-header h2{
    font-size:18px;
    font-weight:600;
    color:#1f2937;
}
/* Filters */
.filter-box{
    background:#fff;
    padding:14px;
    border-radius:10px;
    margin-bottom:18px;
    box-shadow:0 8px 20px rgba(0,0,0,0.04);
    display:grid;
    grid-template-columns: repeat(4, 1fr);
    gap:10px;
}

.filter-box input,
.filter-box select{
    padding:7px 9px;
    border-radius:6px;
    border:1px solid #d1d5db;
    font-size:12px;
    transition:.2s;
}

.filter-box input:focus,
.filter-box select:focus{
    border-color: var(--primary);
    outline:none;
}

/* Table */
.table-box{
    background:#fff;
    padding:8px;
    border-radius:10px;
    box-shadow:0 10px 25px rgba(0,0,0,0.05);
}

table{
    width:100%;
    border-collapse:collapse;
    font-size:11px;
}

thead{
     background:#f19b19f3;

}

th{
    font-size:12px;
    font-weight:600;
    color: black;
    padding:5px 8px;
    text-align: center;
}

td{
    padding:6px 6px;
    text-align: center;
    font-size: 12px;
}

tbody tr{
    border-bottom:1px solid #eef2f7;
    transition:.2s;
}

tbody tr:hover{
    background:#f9fafb;
}

/* Actions */
.actions{
    white-space:nowrap;
}

.actions button{
    border:none;
    padding:2px 6px;
    border-radius:5px;
    font-size:11px;
    margin-right:3px;
    cursor:pointer;
    font-weight:500;
    transition:.2s;
}

/* Button colors */
.btn-view{
    background:#e0f2fe;
    color:#0369a1;
}
.btn-view:hover{
    background:#bae6fd;
}

.btn-edit{
    background:#fef9c3;
    color:#854d0e;
}
.btn-edit:hover{
    background:#fde68a;
}

.btn-delete{
    background:#fee2e2;
    color:#b91c1c;
}
.btn-delete:hover{
    background:#fecaca;
}
/* Toast */
.toast-msg{
    position:fixed;
    top:20px;
    right:20px;
    padding:8px 12px;
    border-radius:6px;
    color:#fff;
    z-index:9999;
    font-size: 12px;
    animation:slideFade .4s ease forwards;
}
.toast-success{ background:#28a745; }
.toast-error{ background:#dc3545; }

/* Animation */
@keyframes slideIn{
    from{ opacity:0; transform:translateX(50px); }
    to{ opacity:1; transform:translateX(0); }
}

/* Responsive */
@media(max-width:992px){
    .filter-box{
        grid-template-columns:repeat(2,1fr);
    }
}

@media(max-width:600px){
    .filter-box{
        grid-template-columns:1fr;
    }
    .page-header{
        flex-direction:column;
        align-items:flex-start;
        gap:10px;
    }
}

</style>
@endpush

@section('content')
<div id="toast-container"></div> 
<div class="page-wrapper">
    <div class="page-header">
        <h2>Students</h2>
        <h6 style="color:orangered;"><i>Under my supervising.</i></h6>
    </div>
    <!-- Filters -->
    <div class="filter-box">
        <input type="text" id="searchInput" placeholder="Search by Name or ID">
        <select id="semesterSelect">
            <option value="">All Semesters</option>
             @foreach ($semesters as $semester){
                <option value="{{ $semester }}">{{ $semester }}</option>
             } 
             @endforeach
        </select>
    </div>
   {{-- Toast --}}
    @if(session('success'))
    <div class="toast-msg toast-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
    <div class="toast-msg toast-error">{{ session('error') }}</div>
    @endif

    <!-- Table -->
    <div class="table-box">
        <div id="studentTable">
            {{-- @include('students.partials.table',['students'=> $students]) --}}
            @include('auth-faculty.students.partials.table',['students' => $students])
        </div>
    </div>

</div>

@endsection
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
$(document).ready(function(){

    function fetchStudent(page = 1){
        let searchInput = $('#searchInput').val();
        let semesterSelect = $('#semesterSelect').val();

        $.ajax({
            url: "{{ route('faculty.students') }}?page=" + page,
            type: "GET",
            data: {
                searchInput: searchInput,
                semesterSelect: semesterSelect
            },
            success: function(data){
                $('#studentTable').html(data);
            },
            error: function(error){
                console.log(error);
            }
        });
    }

    //  Debounce for better performance
    let timeout = null;

    $('#searchInput,#semesterSelect')
        .on('keyup change', function(){
            clearTimeout(timeout);
            timeout = setTimeout(function(){
                fetchStudent();
            }, 400);
        });

    //  Pagination click (AJAX)
    $(document).on('click', '.pagination a', function(e){
        e.preventDefault();

        let page = $(this).attr('href').split('page=')[1];
        fetchStudent(page);
    });

});

 setTimeout(() => {
    document.querySelectorAll('.toast-msg').forEach(t => t.remove());
}, 3000);
</script>
@endpush
