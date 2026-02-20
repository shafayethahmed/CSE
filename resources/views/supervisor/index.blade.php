@extends('layout.sidebar')

@section('title','Batch Teacher List')

@push('styles')
<style>
.wrapper{
    max-width: 950px;
    margin: 15px auto;
}

.card-box{
    background: #fff;
    border-radius: 10px;
    padding: 18px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.05);
}

.header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:10px;
}

.table{
    width:100%;
    font-size:13px;
    border-collapse:collapse;
}

.table th, .table td{
    border:1px solid #e5e7eb;
    padding:6px;
    text-align: center;
}

.table th{
    background:#f3f4f6;
}

.badge{
    padding:3px 8px;
    border-radius:6px;
    font-size:12px;
    background:#e0f2fe;
}
.btn-sm{
    background: #2563eb;
    color: #fff;
    padding: 6px 14px;
    font-size: 13px;
    border-radius: 6px;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    transition: 0.2s;
}

.btn-sm:hover{
    background: #1e40af;
    color: #fff;
}
.btn-delete{
    background:#fee2e2;
    color:#b91c1c;
    border: none;
}
</style>
@endpush

@section('content')

@php
// Mock Data
$batchTeachers = [
    (object)[
        'faculty' => 'Dr. Rahim Uddin',
        'email' => 'rahim@university.edu',
        'batch' => 'CSE-22',
        'semester' => '4-1'
    ],
    (object)[
        'faculty' => 'Farhana Akter',
        'email' => 'farhana@gmail.com',
        'batch' => 'CSE-23',
        'semester' => '3-2'
    ]
];
@endphp

<div class="wrapper">

    <div class="card-box">

        <div class="header">
            <h5>Batch Teacher</h5>

            <a href="{{ route('supervisor.assign') }}" class="btn btn-primary btn-sm">
                + Assign Supervisor
            </a>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>Faculty</th>
                    <th>Email</th>
                    <th>Semester</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach($batchTeachers as $row)
                <tr>
                    <td>{{ $row->faculty }}</td>
                    <td>{{ $row->email }}</td>
                    <td>{{ $row->semester }}</td>
                     <td class="actions">
                        <button class="btn-delete" onclick="deleteSupervisor(this)">Delete</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>

</div>

@endsection
