@extends('layout.sidebar')

@section('title','Assign Faculty')

@push('styles')
<style>
.assign-wrapper {
    max-width: 1000px;
    margin: 10px auto;
    font-family: 'Segoe UI', sans-serif;
}

.card-box {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    overflow: hidden;
}

.card-header {
    background: #1e3a8a;
    color: #fff;
    font-weight: 600;
    font-size: 14px;
    padding: 16px 24px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.section {
    padding: 24px;
}

.label {
    display: block;
    font-size: 10px;
    font-weight: 600;
    margin-bottom: 6px;
    color: #1f2937;
}

.form-control, .form-select {
    width: 100%;
    padding: 8px 12px;
    font-size: 10px;
    border-radius: 8px;
    border: 1px solid #d1d5db;
    transition: border-color 0.2s;
}

.form-control:focus, .form-select:focus {
    border-color: #2563eb;
    outline: none;
}

.row-grid {
    display: grid;
    gap: 16px;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    margin-bottom: 16px;
}

.user-info {
    background: #f1f5f9;
    padding: 16px;
    border-radius: 10px;
    margin-bottom: 20px;
    font-size: 14px;
    border-left: 4px solid #2563eb;
}

.academic-section {
    border: 1px solid #e5e7eb;
    border-radius: 10px;
    padding: 16px;
    margin-bottom: 20px;
    background: #fafafa;
}

.academic-header {
    font-weight: 600;
    margin-bottom: 12px;
    color: #111827;
    font-size: 14px;
}

.actions {
    text-align: right;
    margin-top: 10px;
}

button.btn {
    padding: 8px 18px;
    font-size: 14px;
    border-radius: 8px;
    transition: 0.2s;
    cursor: pointer;
}

button.btn-primary {
    background-color: #2563eb;
    color: #fff;
    border: none;
}

button.btn-primary:hover {
    background-color: #1e40af;
}

button.btn-success {
    background-color: #16a34a;
    color: #fff;
    border: none;
}

button.btn-success:hover {
    background-color: #15803d;
}

button.btn-secondary {
    background-color: #f3f4f6;
    color: #111827;
    border: none;
}

button.btn-secondary:hover {
    background-color: #e5e7eb;
}
</style>
@endpush


@section('content')
<div class="assign-wrapper">

    <div class="card-box">

        <div class="card-header">
            <i class="fas fa-user-tie"></i>
            Assign Faculty
        </div>

        <div class="section">

            {{-- Search Faculty --}}
            <form method="GET" action="{{ route('faculty.search') }}">
                <div class="row-grid">
                    <div>
                        <label class="label">Search by ID or Email</label>
                        <input type="text" name="searchval" class="form-control" placeholder="Enter Faculty ID or Email">
                    </div>
                    <div style="display:flex; align-items:end;">
                        <button class="btn btn-primary"><i class="fa fa-search"></i> Search</button>
                    </div>
                </div>
            </form>

            {{-- Show user info if found --}}
            @isset($user)
            <div class="user-info">
                <strong>User Found:</strong>
                <p>Name: {{ $user->name }}<br>Email: {{ $user->email }}<br>ID: {{ $user->id }}</p>
            </div>

            {{-- Assign Faculty Form --}}
            <form method="POST" action="{{ route('faculty.store') }}">
                @csrf
                <input type="hidden" name="user_id" value="{{ $user->id }}">

                {{-- Designation & Department --}}
                <div class="row-grid">
                    <div>
                        <label class="label">Designation</label>
                        <select name="designation" class="form-select" required>
                            <option value="">Select</option>
                            <option>Lecturer</option>
                            <option>Assistant Professor</option>
                            <option>Associate Professor</option>
                            <option>Professor</option>
                            <option>Department Head</option>
                        </select>
                    </div>
                    <div>
                        <label class="label">Department</label>
                        <input type="text" name="department" class="form-control" placeholder="e.g. CSE">
                    </div>
                </div>

                {{-- Academic Info --}}
                <div class="academic-section">
                    <div class="academic-header">Bachelor's Information</div>
                    <div class="row-grid">
                        <div><label class="label">Degree</label><input type="text" name="bachelor_degree" class="form-control" placeholder="BSc in CSE"></div>
                        <div><label class="label">University</label><input type="text" name="bachelor_university" class="form-control" placeholder="e.g. SUST"></div>
                        <div><label class="label">Department</label><input type="text" name="bachelor_department" class="form-control"></div>
                        <div><label class="label">CGPA</label><input type="text" name="bachelor_cgpa" class="form-control"></div>
                    </div>
                </div>

                <div class="academic-section">
                    <div class="academic-header">Master's Information</div>
                    <div class="row-grid">
                        <div><label class="label">Degree</label><input type="text" name="masters_degree" class="form-control" placeholder="MSc in CSE"></div>
                        <div><label class="label">University</label><input type="text" name="masters_university" class="form-control"></div>
                        <div><label class="label">Department</label><input type="text" name="masters_department" class="form-control"></div>
                        <div><label class="label">CGPA</label><input type="text" name="masters_cgpa" class="form-control"></div>
                    </div>
                </div>

                <div class="actions">
                    <button class="btn btn-success">Assign Faculty</button>
                </div>

            </form>
            @endisset

        </div>

    </div>

</div>

@endsection
