@extends('layout.sidebar')

@section('title','Faculty Profile')

@push('styles')
<style>
/* University MIS Professional Style */

.profile-wrapper {
    max-width: 750px;
    margin: 10px auto;
    font-family: 'Segoe UI', sans-serif;
    color: #111827;
}

/* Sections */
.section {
    margin-bottom: 10px;
    background-color: #fff;
    border-radius: 10px;
    padding: 20px 24px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.05);
}

.section h6 {
    font-weight: 600;
    font-size: 16px;
    margin-bottom: 12px;
    border-bottom: 1px solid #e5e7eb;
    padding-bottom: 6px;
    color: #1e3a8a;
    display: flex;
    align-items: center;
    gap: 6px;
}

/* Personal Info Grid */
.info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit,minmax(180px,1fr));
    gap: 10px;
    margin-bottom: 5px;
}

.info-box {
    display: flex;
    flex-direction: column;
}

.info-box label {
    font-size: 12px;
    font-weight: 600;
    color: #374151;
    margin-bottom: 4px;
}

.info-box span {
    font-size: 12px;
    color: #111827;
}

/* Tables */
.table {
    width: 100%;
    border-collapse: collapse;
    font-size: 12px;
    margin-top: 10px;
}

.table th, .table td {
    padding: 2px 5px;
    border: 1px solid #e5e7eb;
    text-align: center;
}

.table th {
    background-color: #f3f4f6;
    font-weight: 600;
    color: #1e3a8a;
}

.table tbody tr:nth-child(even) {
    background-color: #fafafa;
}

/* Action Buttons */
.actions {
    margin-top: 12px;
    text-align: right;
}

.btn {
    padding: 6px 16px;
    font-size: 14px;
    border-radius: 6px;
    cursor: pointer;
    border: none;
    transition: 0.2s;
    margin-left: 6px;
}

.btn-primary {
    background-color: #2563eb;
    color: #fff;
}

.btn-primary:hover {
    background-color: #1e40af;
}

.btn-secondary {
    background-color: #f3f4f6;
    color: #111827;
}

.btn-secondary:hover {
    background-color: #e5e7eb;
}

@media(max-width:768px){
    .info-grid {
        grid-template-columns: 1fr;
    }
}
</style>
@endpush

@section('content')
<div class="profile-wrapper">

    {{-- Personal Information --}}
    <div class="section">
        <h6><i class="fas fa-user-tie"></i> Personal Information</h6>
        <div class="info-grid">
            <div class="info-box">
                <label>Faculty ID</label>
                <span>{{ $faculty->faculty_id }}</span>
            </div>
            <div class="info-box">
                <label>Name</label>
                <span>{{ $faculty->name }}</span>
            </div>
            <div class="info-box">
                <label>Email</label>
                <span>{{ $faculty->email }}</span>
            </div>
            <div class="info-box">
                <label>Phone Number</label>
                <span>{{ $faculty->mobile }}</span>
            </div>
             <div class="info-box">
                <label>Designation</label>
                <span>{{ ucWords($faculty->designation) }}</span>
            </div>
            <div class="info-box">
                <label>Total Credit Limit</label>
                <span>{{ $faculty->credit_limit }}</span>
            </div>
            <div class="info-box">
                <label>Status</label>
                <span style="color: green";><b>Active</b></span>
            </div>
        </div>
    </div>

    {{-- Academic Information --}}
    <div class="section">
        <h6><i class="fas fa-graduation-cap"></i> Academic Information</h6>
        <table class="table">
            <thead>
                <tr>
                    <th>Degree</th>
                    <th>University</th>
                    <th>CGPA</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ ucWords($faculty->bachelor_degree) }}</td>
                    <td>{{ ucWords($faculty->bachelor_university) }}</td>
                    <td>{{ ucWords($faculty->bachelor_cgpa) }}</td>
                </tr>
                <tr>
                    <td>{{ ucWords($faculty->master_degree) ?? 'N/A'}}</td>
                    <td>{{ ucWords($faculty->master_university) ?? 'N/A'}}</td>
                    <td>{{ ucWords($faculty->master_cgpa) ?? 'N/A' }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    {{-- Assigned Courses --}}
    <div class="section">
        <h6><i class="fas fa-book"></i> Assigned Courses</h6>
        <table class="table">
            <thead>
                <tr>
                    <th>Course Code</th>
                    <th>Course Title</th>
                    <th>Credit Hours</th>
                </tr>
            </thead>
            <tbody>
                @foreach ( $facultyCourseTaken as $fct)
                <tr>
                    <td>{{ $fct->course_code }}</td>
                    <td>{{ $fct->course_title }}</td>
                    <td>{{ $fct->course_credit }}</td>
                </tr>
                 @endforeach
            </tbody>
        </table>

        <div class="actions">
                    <button type="button" class="btn btn-secondary" onclick="window.history.back();"> <i class="fas fa-arrow-left"></i> Back </button>
        </div>
    </div>

</div>
@endsection
