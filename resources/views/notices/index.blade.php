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
    border: 1px solid #e5e7eb;
}

.notice-table table {
    width: 100%;
    border-collapse: collapse;
}

.notice-table th {
    background: #f9fafb;
    font-size: 13px;
    padding: 10px;
    text-align: left;
    font-weight: 600;
}

.notice-table td {
    font-size: 13px;
    padding: 10px;
    border-top: 1px solid #f1f5f9;
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

</style>

@endpush

@section('content')

@php
// MOCK DATA for testing
$notices = [
(object)[
'id'=>1,
'title'=>'Make-Up Examination Notice',
'publisher'=>'Controller of Examination',
'date'=>'2026-02-19'
],
(object)[
'id'=>2,
'title'=>'Semester Final Routine',
'publisher'=>'Academic Office',
'date'=>'2026-02-10'
],
];
@endphp

<div class="notice-page">
<div class="notice-header">
    <h5 class="fw-bold">Notice Management</h5>
    <a href="{{ route('notices.create') }}" class="btn-create">
        <i class="fas fa-plus"></i> Create Notice
    </a>
</div>


{{-- ===== Table ===== --}}
<div class="notice-table">

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Notice Title</th>
                <th>Published By</th>
                <th>Date</th>
                <th width="120">Action</th>
            </tr>
        </thead>

        <tbody>
            @foreach($notices as $key => $notice)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $notice->title }}</td>
                <td>{{ $notice->publisher }}</td>
                <td>{{ $notice->date }}</td>

                <td>
                    <a href="#" class="action-btn text-primary">
                        <i class="fas fa-eye"></i>
                    </a>

                    <a href="#" class="action-btn text-primary">
                        <i class="fas fa-edit"></i>
                    </a>

                    <a href="#" class="action-btn text-danger">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>

    </table>

</div>
</div>

@endsection
