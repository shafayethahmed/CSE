@php
     $accessRole = ['super-admin','staff','user','department-head']
 @endphp
  @if (in_array(Auth::user()->role ,$accessRole))
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
    text-align: center;
    padding: 8px;
    background: #f9fafb;
}

.table-dashboard td {
    font-size: 13px;
    padding: 8px;
    border-top: 1px solid #f1f5f9;
    text-align: center;
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

/* Notice part */
.notice-wrapper {
    padding: 15px;
    font-family: "Times New Roman", serif;
    font-size: 14px;
}

/* ===== A4 PAPER ===== */
.notice-paper {
    width: 190mm;
    min-height: 190mm;
    background: #fff;
    margin: 0 auto;
    padding: 10mm 15mm;
    color: #000;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    box-sizing: border-box;
    position: relative;
}

/* ===== HEADER ===== */
.notice-header {
    display: flex;
    align-items: center;
    border-bottom: 2px solid #000;
    padding-bottom: 10px;
    margin-bottom: 15px;
}

.notice-header img {
    width: 90px;
    height: auto;
    margin-right: 12px;
}

.notice-header-text h3 {
    margin: 0;
    font-size: 20px;
    font-weight: bold;
}

.notice-header-text h4 {
    margin: 2px 0;
    font-size: 15px;
    font-style: italic;
    text-align: center;
}

.notice-header-text p {
    margin: 2px 0;
    font-size: 12px;
    text-align: center;
}

/* ===== NOTICE INFO ===== */
.notice-info {
    display: flex;
    justify-content: space-between;
    font-size: 13px;
    margin-bottom: 20px;
}

/* ===== TITLE ===== */
.notice-title {
    text-align: center;
    font-size: 16px;
    font-weight: bold;
    text-decoration: underline;
    margin-bottom: 20px;
}

/* ===== BODY ===== */
.notice-body {
    font-size: 14px;
    line-height: 1.8;
    text-align: justify;
}

/* ===== SIGNATURE ===== */
.notice-signature {
    margin-top: 70px;
    width: 300px;
    float: left;
    text-align: left;
}

.notice-signature p {
    margin: 3px 0;
}

/* ===== FOOTER ===== */
.notice-footer {
    clear: both;
    margin-top: 80px;
    border-top: 2px solid #000;
    padding-top: 8px;
    font-size: 11px;
    text-align: center;
}

/* ===== SMALL SYSTEM NOTE ===== */
.notice-system-note {
    margin-top: 5px;
    font-size: 10px;
    text-align: center;
    font-style: italic;
}

/* ===== BUTTONS ===== */
.notice-actions {
    margin-bottom: 12px;
}
.notice-actions button {
    margin-right: 6px;
}

</style>
@endpush


@section('content')
<div class="dashboard-wrapper">

    {{-- ===== SUMMARY CARDS ===== --}}
    <div class="summary-grid">
        @if (Auth::user()->role === "super-admin")
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
                <p>{{ $totalActiveUsers }}</p>
            </div>
        </div>
         @endif

         @if (in_array(Auth::user()->role ,['super-admin','staff','department-head','user']))
        <div class="summary-card">
            <div class="summary-icon bg-orange"><i class="fas fa-chalkboard-teacher"></i></div>
            <div class="summary-text">
                <h4>Total Faculty</h4>
                <p>{{ $totalFaculties }}</p>
            </div>
        </div>

     @if (in_array(Auth::user()->role ,['super-admin','staff','department-head']))
        <div class="summary-card">
            <div class="summary-icon bg-teal"><i class="fas fa-user-tie"></i></div>
            <div class="summary-text">
                <h4>Active Faculty</h4>
                <p>{{ $totalActiveFaculties }}</p>
            </div>
        </div>

        <div class="summary-card">
            <div class="summary-icon bg-red"><i class="fas fa-user-slash"></i></div>
            <div class="summary-text">
                <h4>Inactive Faculty</h4>
                <p>{{ $totalInActiveFaculties }}</p>
            </div>
        </div>
     @endif
          <div class="summary-card">
            <div class="summary-icon bg-blue"><i class="fas fa-user"></i></div>
            <div class="summary-text">
                <h4>Total Staff</h4>
                <p>{{ $totalStaffs }}</p>
            </div>
        </div>

        <div class="summary-card">
            <div class="summary-icon bg-blue"><i class="fas fa-user-graduate"></i></div>
            <div class="summary-text">
                <h4>Total Students</h4>
                <p>{{ $totalStudents }}</p>
            </div>
        </div>

         <div class="summary-card">
            <div class="summary-icon bg-orange"><i class="fas fa-user-check"></i></div>
            <div class="summary-text">
                <h4>Running Student</h4>
                <p>{{ $totalOngoingStudents }}</p>
            </div>
        </div>

        <div class="summary-card">
            <div class="summary-icon bg-green"><i class="fas fa-user-graduate"></i></div>
            <div class="summary-text">
                <h4>Total Graduated</h4>
                <p>{{ $totalAlumniStudents }}</p>
            </div>
        </div>

        <div class="summary-card">
            <div class="summary-icon bg-purple"><i class="fas fa-book"></i></div>
            <div class="summary-text">
                <h4>Total Courses</h4>
                <p>{{ $totalCourses}}</p>
            </div>
        </div>

        <div class="summary-card">
            <div class="summary-icon bg-purple"><i class="fas fa-chalkboard-teacher"></i></i></div>
            <div class="summary-text">
                <h4>Assigned Course</h4>
                <p>{{ $assignedFacultyToCourseCount }}</p>
            </div>
        </div>

         <div class="summary-card">
            <div class="summary-icon bg-purple"><i class="fas fa-unlink"></i></i></i></div>
            <div class="summary-text">
                <h4>Unassigned Course</h4>
                <p>{{ $unassignedFacultyToCourseCount }}</p>
            </div>
        </div>


        <div class="summary-card">
            <div class="summary-icon bg-purple"><i class="fas fa-layer-group"></i></div>
            <div class="summary-text">
                <h4>Total Semester</h4>
                <p>8</p>
            </div>
        </div>

        <div class="summary-card">
            <div class="summary-icon bg-orange"><i class="fas fa-bullhorn"></i></div>
            <div class="summary-text">
                <h4>Total Notices</h4>
                <p>{{ $totalNotices }}</p>
            </div>
        </div>
        @endif


    </div>


    {{-- ===== Highlighted Notices ===== --}}
    <div class="section-card">
        <div class="section-header">
            Last Notice
        </div>
        <div class="notice-wrapper">

                <div class="notice-paper">

                    {{-- HEADER --}}
                    <div class="notice-header">
                        <img src="{{ asset('images/RTM-Logo.jpg') }}">
                        <div class="notice-header-text">
                            <h3>RTM Al-Kabir Technical University (RTM-AKTU)</h3>
                            <h4>Department Of Computer Science & Engineering</h4>
                            <p>E-mail: info@rtm-aktu.edu.bd</p>
                            <p>Web: www.rtm-aktu.edu.bd</p>
                        </div>
                    </div>

                    {{-- NOTICE NUMBER + DATE --}}
                    <div class="notice-info">
                        <div>
                            <strong>Notice No:</strong> RTM-AKTU/{{ $notice->notice_id }}
                        </div>
                        <div>
                            <strong>Date:</strong> {{ \Carbon\Carbon::parse($notice->created_date)->format('d F Y') }}
                        </div>
                    </div>

                    {{-- TITLE --}}
                    <div class="notice-title">
                        {{ $notice->title }}
                    </div>

                    {{-- BODY --}}
                    <div class="notice-body">
                        {!! nl2br(e($notice->body)) !!}
                    </div>

                    {{-- SIGNATURE --}}
                    <div class="notice-signature">
                        <p><strong>Published By</strong></p>
                        <p>{{ $notice->published_by }}</p>
                        <p>{{ $notice->designation }}</p>
                        <p>RTM Al Kabir Technical University</p>
                    </div>

                    {{-- FOOTER --}}
                    <div class="notice-footer">
                        Sylhet: TB Gate, East Shahid Eidgah, Sylhet-3100, Bangladesh |
                        Dhaka Liaison Office: 581, Shewrapara, Mirpur, Dhaka 1216
                    </div>

                    {{-- SYSTEM NOTE --}}
                    <div class="notice-system-note">
                        This notice was created by the RTM-AKTU CSE Management System.
                    </div>

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
                        <th>Academic ID</th>
                        <th>Name</th>
                        <th>Session</th>
                        <th>Semester</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($latestStudents as $student)
                    <tr>
                        <td>{{ $student->academicId }}</td>
                        <td>{{ $student->name }}</td>
                        <td>{{ ucfirst($student->session)."-".$student->admissionYear }}</td>
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
@endif