{{-- Encrypted Page For Dedicated Role --}}
@if (Auth::user()->role)
@extends('layout.sidebar')

@section('title','Edit Faculty Profile')

@push('styles')
<style>
/* University MIS Professional Style - Edit Form */

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

.info-box input, .info-box select {
    font-size: 12px;
    padding: 4px 8px;
    border-radius: 6px;
    border: 1px solid #d1d5db;
    height: 28px;
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

    <form method="POST" action="{{ route('faculty.update', $faculty->id) }}">
        @csrf
        @method('PUT')

        {{-- Personal Information --}}
        <div class="section">
            <h6><i class="fas fa-user-tie"></i> Personal Information</h6>
            <div class="info-grid">
                <div class="info-box">
                    <label>Faculty ID</label>
                    <input type="text" name="faculty_id" value="{{ $faculty->faculty_id }}" readonly>
                </div>
                <div class="info-box">
                    <label>Name</label>
                    <input type="text" name="user_name" value="{{ $faculty->name }}" >
                </div>
                <div class="info-box">
                    <label>Email</label>
                    <input type="email" name="user_email" value="{{ $faculty->email }}" >
                </div>
                <div class="info-box">
                    <label>Phone Number</label>
                    <input type="text" name="user_mobile" value="{{ $faculty->mobile }}">
                </div>
                 <div class="info-box">
                   <label>Designation</label>
                    <input type="text" name="designation" value="{{ $faculty->designation }}" >
                </div>
                <div class="info-box">
                    <label>Total Credit Limit</label>
                    <input type="number" name="credit_limit" value="{{ $faculty->credit_limit }}" step="1">
                </div>
                <div class="info-box">
                    <label>Total Credit Taken</label>
                    <input type="number" name="credit_taken" value="{{ count($faculty->courses) }}" step="1" readonly>
                </div>
                <div class="info-box">
                    <label>Status</label>
                    <select name="status">
                        <option value="active" {{ $faculty->status == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ $faculty->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
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
                        <td><input type="text" name="bachelor_degree" value="{{ $faculty->bachelor_degree }}"></td>
                        <td><input type="text" name="bachelor_university" value="{{ $faculty->bachelor_university }}"></td>
                        <td><input type="text" name="bachelor_department" value="{{ $faculty->bachelor_department }}"></td>
                        <td><input type="text" name="bachelor_cgpa" value="{{ $faculty->bachelor_cgpa }}"></td>
                    </tr>
                    <tr>
                        <td><input type="text" name="master_degree" value="{{ $faculty->master_degree }}"></td>
                        <td><input type="text" name="master_university" value="{{ $faculty->master_university }}"></td>
                        <td><input type="text" name="master_department" value="{{ $faculty->master_department }}"></td>
                        <td><input type="text" name="master_cgpa" value="{{ $faculty->master_cgpa }}"></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="actions">
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update Faculty</button>
            <button type="button" class="btn btn-secondary" onclick="window.history.back();"><i class="fas fa-arrow-left"></i> Back</button>
        </div>

    </form>
</div>
@endsection
@endif