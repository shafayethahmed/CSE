@extends('layout.sidebar')

@section('title','Notices')

@push('styles')

<style>

/* ===== Page ===== */
.notice-page {
    padding: 15px;
}

/* Header */
.notice-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
}

/* Table */
.notice-table {
    background: #fff;
    border-radius: 10px;
    border: 1px solid #050b18;
    overflow-x: auto;
}

.notice-table table {
    width: 100%;
    border-collapse: collapse;
}

.notice-table th {
    background: #02182e;
    font-size: 13px;
    padding: 10px;
    text-align: center;
    font-weight: 600;
    color: white;
}

.notice-table td {
    font-size: 13px;
    padding: 10px;
    border-top: 1px solid #f1f5f9;
    text-align: center;
}

/* Button */
.btn-create {
    background: #2563eb;
    color: #fff;
    border-radius: 8px;
    padding: 6px 14px;
    font-size: 13px;
    border: none;
    text-decoration: none;
}

.btn-create:hover {
    background: #1d4ed8;
}

/* Action */
.action-btn {
    border: none;
    background: transparent;
    font-size: 14px;
    margin-right: 8px;
}

.text-primary { color: #2563eb; }
.text-danger { color: #dc2626; }

/* FILTER */
.filter-box{
    background:#fff;
    padding:10px;
    border-radius:10px;
    margin-bottom:8px;
    box-shadow:0 6px 15px rgba(0,0,0,0.04);
    display:grid;
    grid-template-columns: repeat(2, 1fr);
    gap:8px;
}

.filter-box input,
.filter-box select{
    padding:6px 8px;
    border-radius:6px;
    border:1px solid #d1d5db;
    font-size:12px;
    height:30px;
}

.filter-box input:focus,
.filter-box select:focus{
    border-color:#1e3a8a;
    outline:none;
}

/* ===== Responsive ===== */

/* Tablet */
@media (max-width: 992px){

.notice-header{
    flex-direction:column;
    align-items:flex-start;
    gap:10px;
}

.filter-box{
    grid-template-columns:1fr;
}

.notice-table th,
.notice-table td{
    font-size:12px;
    padding:8px;
}

}

/* Mobile */
@media (max-width: 600px){

.notice-page{
    padding:10px;
}

.notice-table table{
    min-width:600px;
}

.notice-table th{
    font-size:11px;
}

.notice-table td{
    font-size:11px;
    padding:6px;
}

.btn-create{
    padding:5px 10px;
    font-size:12px;
}

}

</style>

@endpush

@section('content')

<div class="notice-page">

<div class="notice-header">
    <h5 class="fw-bold">Notice Management</h5>

    <a href="{{ route('notices.create') }}" class="btn-create">
        <i class="fas fa-plus"></i> Create Notice
    </a>
</div>

{{-- FILTER --}}
<div class="filter-box">
    <input type="text" id="searchNotice" placeholder="Search by NoticeID or Title">
</div>

{{-- TABLE --}}
<div class="notice-table">
    <div id="noticeTable">
        @include('notices.partials.table',['notices'=>$notices])
    </div>
</div>

</div>

@endsection


@push('scripts')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>

$(document).ready(function(){

    function noticeTrigger(){

        let noticesearch = $('#searchNotice').val();

        $.ajax({

            url : "{{ route('notices.index') }}",
            type : "GET",
            data : { noticesearch : noticesearch },

            success: function(data){

                $('#noticeTable').html(data);

            },

            error: function(){

                alert("Something Went Wrong!");

            }

        });

    }

    $('#searchNotice').on('keyup',function(){

        noticeTrigger();

    });

});

</script>

@endpush