@extends('layout.sidebar')

@section('title','Alumni')

@push('styles')
<style>
/* Wrapper */
.page-wrapper{
    margin-top: 30px;
    max-width: 1000px;
    margin: 0 auto;
}

/* Header */
.page-header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:20px;
}

.page-header h2{
    font-size:20px;
    font-weight:600;
    color:#111827;
}

/* Primary Button */
.btn-primary{
    background:#111827;
    border:none;
    padding:8px 16px;
    color:#ffffff;
    border-radius:6px;
    cursor:pointer;
    font-weight:500;
    font-size:13px;
    transition:.25s;
}
.btn-primary:hover{
    background:#1f2937;
}

/* Filters */
.filter-box{
    background:#ffffff;
    padding:14px;
    border-radius:10px;
    margin-bottom:20px;
    border:1px solid #e5e7eb;
    display:grid;
    grid-template-columns: repeat(4, 1fr);
    gap:12px;
}

.filter-box input,
.filter-box select{
    padding:7px 10px;
    border-radius:6px;
    border:1px solid #d1d5db;
    font-size:12px;
    background:#f9fafb;
}

.filter-box input:focus,
.filter-box select:focus{
    border-color:#9ca3af;
    outline:none;
}

/* Table Box */
.table-box{
    background:#ffffff;
    border-radius:10px;
    border:1px solid #e5e7eb;
    overflow:hidden;
}

/* Table */
table{
    width:100%;
    border-collapse:collapse;
    font-size:14px;
}

/* Clean Header */
thead{
    background:#eb8471;
    border-bottom:1px solid #e5e7eb;
}

th{
    font-size:14px;
    font-weight:600;
    color:black;
    padding:10px 8px;
    text-align:center;
}

/* Body */
td{
    padding:9px 6px;
    text-align:center;
    color:black;
}

tbody tr{
    border-bottom:1px solid #f1f5f9;
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
    padding:4px 10px;
    border-radius:5px;
    font-size:11px;
    cursor:pointer;
    font-weight:500;
    background:#f3f4f6;
    color:#374151;
    transition:.2s;
}

.actions button:hover{
    background:#e5e7eb;
}

/* Delete Button (subtle, not loud) */
.btn-delete{
    background:#f9fafb;
    color:#6b7280;
}
.btn-delete:hover{
    background:#e5e7eb;
    color:#111827;
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

<div class="page-wrapper">

    <!-- Header -->
    <div class="page-header">
        <h2>Alumni Students</h2>
    </div>
 
    <!-- Filters -->
    <div class="filter-box">
        <input type="text" id="searchInput" placeholder="Search by Name,Id,Email....">
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
       @include('alumni.partials.table',['alumni'=> $alumni])
    </div>

</div>
@endsection
@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function(){

    function alumnidata(page = 1){
        let searchInput = $('#searchInput').val();
        $.ajax({
            url: "{{ route('alumni.index') }}?page=" + page,
            type: "GET",
            data: {
                searchInput: searchInput
            },
            success: function(data){
                $('#alumnitable').html(data);
            },
            error: function(){
                alert('Something went wrong!');
            }
        });
    }

    //  Debounce (smooth typing)
    let delayTimer;
    $('#searchInput, #passedYear').on('keyup', function(){
        clearTimeout(delayTimer);
        delayTimer = setTimeout(function(){
            alumnidata();
        }, 300);
    });

    //  AJAX Pagination
    $(document).on('click', '.pagination a', function(e){
        e.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        alumnidata(page);
    });

});

setTimeout(() => {
    document.querySelectorAll('.toast-msg').forEach(t => t.remove());
}, 3000);
</script>
@endpush
