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
    text-align: left;
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
                <span>F101</span>
            </div>
            <div class="info-box">
                <label>Name</label>
                <span>Dr. Rahim Uddin</span>
            </div>
            <div class="info-box">
                <label>Email</label>
                <span>rahim@university.edu</span>
            </div>
            <div class="info-box">
                <label>Phone Number</label>
                <span>+880 1234 567890</span>
            </div>
            <div class="info-box">
                <label>Total Credit Limit</label>
                <span>18</span>
            </div>
             <div class="info-box">
                <label>Total Credit Taken</label>
                <span>17</span>
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
                    <th>Department</th>
                    <th>CGPA</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>BSc in CSE</td>
                    <td>SUST</td>
                    <td>CSE</td>
                    <td>3.75</td>
                </tr>
                <tr>
                    <td>MSc in CSE</td>
                    <td>SUST</td>
                    <td>CSE</td>
                    <td>3.90</td>
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
                <tr>
                    <td>CSE-101</td>
                    <td>Data Structure</td>
                    <td>3.0</td>
                </tr>
                <tr>
                    <td>CSE-202</td>
                    <td>Algorithms</td>
                    <td>3.0</td>
                </tr>
                <tr>
                    <td>CSE-305</td>
                    <td>Database Systems</td>
                    <td>3.0</td>
                </tr>
            </tbody>
        </table>

        <div class="actions">
                    <button type="button" class="btn btn-secondary" onclick="window.history.back();"> <i class="fas fa-arrow-left"></i> Back </button>
        </div>
    </div>

</div>
@endsection
