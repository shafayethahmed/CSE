@extends('layout.sidebar')

@section('title','Student Profile')

@push('styles')
<style>
.page-wrapper {
    max-width: 900px;
    margin: 0px auto 0; /* Add top spacing */
    padding: 10px;
}

/* Card Container */
.profile-card {
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.06);
    overflow: hidden;
    font-family: "Segoe UI", Roboto, sans-serif;
}

/* Header Banner */
.profile-banner {
    background: var(--primary);
    color: #fff;
    padding: 18px 15px; /* slightly tighter */
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.profile-banner h2 {
    font-size: 15px;
    font-weight: 700;
}

.back-btn {
    background: #fff;
    color: var(--primary);
    border: none;
    padding: 4px 12px; /* smaller for compact look */
    border-radius: 6px;
    font-weight: 600;
    cursor: pointer;
    font-size: 12px;
    transition: 0.3s;
}

.back-btn:hover {
    background: #f1f5f9;
}

/* Top Summary */
.profile-summary {
    display: flex;
    justify-content: space-between;
    padding: 10px 10px;
    border-bottom: 1px solid #e5e7eb;
    gap: 10px; /* compact spacing */
}

.profile-summary div {
    flex: 1;
    text-align: center;
}

.profile-summary .label {
    font-size: 11px;
    font-weight: 600;
    color: #6b7280;
    margin-bottom: 2px;
    text-transform: uppercase;
}

.profile-summary .value {
    font-size: 14px;
    font-weight: 700;
    color: #111827;
}

/* Status */
.status-badge {
    display: inline-block;
    padding: 3px 10px;
    border-radius: 16px;
    font-size: 11px;
    font-weight: 600;
    color: #fff;
}

.status-passed { background-color: #16a34a; }
.status-ongoing { background-color: #3b82f6; }
.status-onhold { background-color: #facc15; color: #111827; }

/* Detail Sections */
.profile-section {
    padding: 15px 10px; /* tighter padding */
}

.profile-section h3 {
    font-size: 13px;
    font-weight: 600;
    color: #374151;
    margin-bottom: 8px;
    border-bottom: 1px solid #e5e7eb;
    padding-bottom: 4px;
}

.profile-details {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 8px 15px; /* tighter gaps */
}

.profile-details .detail-box {
    display: flex;
    flex-direction: column;
}

.detail-label {
    font-size: 11px;
    font-weight: 600;
    color: #6b7280;
    margin-bottom: 2px;
    text-transform: uppercase;
}

.detail-value {
    font-size: 13px;
    font-weight: 600;
    color: #111827;
}

/* Responsive */
@media(max-width:768px){
    .profile-summary {
        flex-direction: column;
        gap: 8px;
        align-items: flex-start;
    }
    .profile-details {
        grid-template-columns: 1fr;
    }
}
</style>
@endpush

@section('content')
<div class="page-wrapper">
    <div class="profile-card">

        <!-- Header -->
        <div class="profile-banner">
            <h2>Student Profile</h2>
            <button class="back-btn" onclick="goBack()">← Back</button>
        </div>

        <!-- Top Summary -->
        <div class="profile-summary">
            <div>
                <div class="label">Academic ID</div>
                <div class="value">{{$student->academicId }}</div>
            </div>
            <div>
                <div class="label">Name</div>
                <div class="value">{{$student->name }}</div>
            </div>
            <div>
                <div class="label">Department</div>
                <div class="value">CSE</div>
            </div>
            <div>
               <div class="label">Status</div>

                @if ($student->semester === "Passed")
                    <div class="value">
                        <span class="status-badge status-ongoing">Ex-Student</span>
                    </div>
                @else
                    <div class="value">
                        <span class="status-badge status-ongoing">Ongoing</span>
                    </div>
                @endif
            </div> 
        </div>

        <!-- Academic Info Section -->
        <div class="profile-section">
            <h3>Academic Information</h3>
            <div class="profile-details">
                <div class="detail-box">
                    <div class="detail-label">Session</div>
                    <div class="detail-value">{{$student->session }}</div>
                </div>
                <div class="detail-box">
                    <div class="detail-label">Semester</div>
                    <div class="detail-value">{{$student->semester }}</div>
                </div>
                <div class="detail-box">
                    <div class="detail-label">Admission Year</div>
                    <div class="detail-value">{{$student->admissionYear }}</div>
                </div>
            </div>
        </div>

        <!-- Personal Info Section -->
        <div class="profile-section">
            <h3>Personal Information</h3>
            <div class="profile-details">
                <div class="detail-box">
                    <div class="detail-label">Email</div>
                    <div class="detail-value">{{$student->email }}</div>
                </div>
                <div class="detail-box">
                    <div class="detail-label">Mobile</div>
                    <div class="detail-value">{{$student->mobile }}</div>
                </div>
                <div class="detail-box">
                    <div class="detail-label">Date of Birth</div>
                    <div class="detail-value">{{$student->dob}}</div>
                </div>
                <div class="detail-box">
                    <div class="detail-label">Address</div>
                    <div class="detail-value">{{$student->address}}</div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@push('scripts')
<script>
function goBack(){
    window.history.back();
}
</script>
@endpush
