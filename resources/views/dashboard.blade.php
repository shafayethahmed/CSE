@extends('layout.sidebar')

@section('title','Dashboard')

@push('styles')
<style>

/* ===== Dashboard Layout ===== */
.dashboard-wrapper {
    padding: 15px;
}

/* ===== Small Summary Cards ===== */
.summary-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
    gap: 12px;
}

.summary-card {
    background: #fff;
    border: 1px solid #e5e7eb;
    border-radius: 10px;
    padding: 12px;
    display: flex;
    align-items: center;
    gap: 10px;
    transition: .2s;
}

.summary-card:hover {
    box-shadow: 0 5px 15px rgba(0,0,0,0.06);
}

.summary-icon {
    width: 34px;
    height: 34px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    color: #fff;
}

.bg-blue { background: #2563eb; }
.bg-green { background: #16a34a; }
.bg-orange { background: #ea580c; }
.bg-purple { background: #7c3aed; }
.bg-red { background: #dc2626; }
.bg-teal { background: #0d9488; }

.summary-text h4 {
    font-size: 13px;
    font-weight: 600;
    margin: 0;
}

.summary-text p {
    font-size: 15px;
    font-weight: 700;
    margin: 0;
}

/* ===== Section Card ===== */
.section-card {
    margin-top: 18px;
    background: #fff;
    border-radius: 10px;
    border: 1px solid #e5e7eb;
}

.section-header {
    padding: 10px 14px;
    font-size: 14px;
    font-weight: 600;
    border-bottom: 1px solid #f1f5f9;
    background: #f9fafb;
}

.section-body {
    padding: 14px;
}

/* ===== Notice Placeholder ===== */
.notice-highlight {
    height: 180px;
    border-radius: 8px;
    background: #f3f4f6;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #6b7280;
    font-size: 13px;
}

/* ===== Student Table ===== */
.table-dashboard {
    width: 100%;
    border-collapse: collapse;
}

.table-dashboard th {
    font-size: 12px;
    text-align: left;
    padding: 8px;
    background: #f9fafb;
}

.table-dashboard td {
    font-size: 13px;
    padding: 8px;
    border-top: 1px solid #f1f5f9;
}

.badge-status {
    padding: 2px 6px;
    border-radius: 6px;
    font-size: 11px;
    font-weight: 600;
}

.badge-active {
    background: #dcfce7;
    color: #166534;
}

</style>
@endpush


@section('content')

@php
// ===== MOCK DATA =====
$totalStudents = 350;
$totalAlumni = 120;
$totalCourses = 45;
$totalFaculty = 22;
$activeFaculty = 18;
$inactiveFaculty = 4;
$totalUsers = 90;
$activeUsers = 70;
$totalSemesters = 8;
$totalNotices = 12;

// Last admitted students
$recentStudents = [
    (object)['name'=>'Rahim Uddin','dept'=>'CSE','semester'=>'1-1','status'=>'Active'],
    (object)['name'=>'Karim Hasan','dept'=>'EEE','semester'=>'1-1','status'=>'Active'],
    (object)['name'=>'Jahid Khan','dept'=>'CSE','semester'=>'1-2','status'=>'Active'],
    (object)['name'=>'Mitu Akter','dept'=>'BBA','semester'=>'1-1','status'=>'Active'],
    (object)['name'=>'Shila Begum','dept'=>'CSE','semester'=>'1-1','status'=>'Active'],
];
@endphp


<div class="dashboard-wrapper">

    {{-- ===== SUMMARY CARDS ===== --}}
    <div class="summary-grid">

        <div class="summary-card">
            <div class="summary-icon bg-blue"><i class="fas fa-user-graduate"></i></div>
            <div class="summary-text">
                <h4>Total Students</h4>
                <p>{{ $totalStudents }}</p>
            </div>
        </div>

        <div class="summary-card">
            <div class="summary-icon bg-green"><i class="fas fa-user-check"></i></div>
            <div class="summary-text">
                <h4>Alumni Students</h4>
                <p>{{ $totalAlumni }}</p>
            </div>
        </div>

        <div class="summary-card">
            <div class="summary-icon bg-purple"><i class="fas fa-book"></i></div>
            <div class="summary-text">
                <h4>Total Courses</h4>
                <p>{{ $totalCourses }}</p>
            </div>
        </div>

        <div class="summary-card">
            <div class="summary-icon bg-orange"><i class="fas fa-chalkboard-teacher"></i></div>
            <div class="summary-text">
                <h4>Total Faculty</h4>
                <p>{{ $totalFaculty }}</p>
            </div>
        </div>

        <div class="summary-card">
            <div class="summary-icon bg-teal"><i class="fas fa-user-tie"></i></div>
            <div class="summary-text">
                <h4>Active Faculty</h4>
                <p>{{ $activeFaculty }}</p>
            </div>
        </div>

        <div class="summary-card">
            <div class="summary-icon bg-red"><i class="fas fa-user-slash"></i></div>
            <div class="summary-text">
                <h4>Inactive Faculty</h4>
                <p>{{ $inactiveFaculty }}</p>
            </div>
        </div>

        <div class="summary-card">
            <div class="summary-icon bg-blue"><i class="fas fa-users"></i></div>
            <div class="summary-text">
                <h4>Total Users</h4>
                <p>{{ $totalUsers }}</p>
            </div>
        </div>

        <div class="summary-card">
            <div class="summary-icon bg-green"><i class="fas fa-user-shield"></i></div>
            <div class="summary-text">
                <h4>Active Users</h4>
                <p>{{ $activeUsers }}</p>
            </div>
        </div>

        <div class="summary-card">
            <div class="summary-icon bg-purple"><i class="fas fa-layer-group"></i></div>
            <div class="summary-text">
                <h4>Total Semester</h4>
                <p>{{ $totalSemesters }}</p>
            </div>
        </div>

        <div class="summary-card">
            <div class="summary-icon bg-orange"><i class="fas fa-bullhorn"></i></div>
            <div class="summary-text">
                <h4>Total Notices</h4>
                <p>{{ $totalNotices }}</p>
            </div>
        </div>

    </div>


    {{-- ===== Highlighted Notices ===== --}}
    <div class="section-card">
        <div class="section-header">
            Highlighted Latest Notices
        </div>
        <div class="section-body">
            <div class="notice-highlight">
                Your latest highlighted notice will appear here
            </div>
        </div>
    </div>


    {{-- ===== Recent Students ===== --}}
    <div class="section-card">
        <div class="section-header">
            Last 5 Admitted Students
        </div>

        <div class="section-body">

            <table class="table-dashboard">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Department</th>
                        <th>Semester</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($recentStudents as $student)
                    <tr>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->dept }}</td>
                        <td>{{ $student->semester }}</td>
                        <td>
                            <span class="badge-status badge-active">
                                {{ $student->status }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>

        </div>
    </div>

</div>

@endsection