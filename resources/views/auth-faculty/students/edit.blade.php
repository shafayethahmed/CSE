@extends('auth-faculty.layout.sidebar')
@section('title','Edit Student')
@push('styles')
<style>
.page-wrapper {
    max-width: 1800px;
    margin: 0 auto;
    padding: 10px;
}
.form-card {
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.06);
    padding: 20px 15px;
    font-family: "Segoe UI", Roboto, sans-serif;
}
.form-banner {
    background: var(--primary);
    color: #fff;
    padding: 12px 15px;
    border-radius: 8px 8px 0 0;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.form-banner h2 {
    font-size: 18px;
    font-weight: 700;
}
.back-btn {
    background: #fff;
    color: var(--primary);
    border: none;
    padding: 4px 10px;
    border-radius: 6px;
    font-size: 12px;
    font-weight: 600;
    cursor: pointer;
}
form {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 10px 20px;
    padding: 15px 0;
}
.form-group {
    display: flex;
    flex-direction: column;
}
label {
    font-size: 11px;
    font-weight: 600;
    margin-bottom: 3px;
    color: #374151;
    text-transform: uppercase;
}
input, select {
    padding: 5px;
    border-radius: 6px;
    border: 1px solid #d1d5db;
    font-size: 12px;
}
input:focus, select:focus {
    border-color: var(--primary);
    box-shadow: 0 0 0 2px rgba(37, 99, 235, 0.15);
}
.error {
    font-size: 10px;
    color: #dc2626;
    margin-top: 2px;
}
.actions {
    grid-column: span 3;
    display: flex;
    justify-content: flex-end;
    margin-top: 5px;
    gap: 6px;
}
.actions button {
    padding: 8px 18px;
    font-size: 12px;
    font-weight: 600;
    border-radius: 6px;
    border: none;
    cursor: pointer;
}
.actions .submit-btn {
    background: var(--primary);
    color: #fff;
}
.actions .cancel-btn {
    background: #f1f5f9;
}

@media(max-width:992px){
    form { grid-template-columns: repeat(2, 1fr); }
}
@media(max-width:600px){
    form { grid-template-columns: 1fr; }
}
</style>
@endpush

@section('content')
<div class="page-wrapper">
    <div class="form-card">

        <div class="form-banner">
            <h2>Edit Student</h2>
            <button class="back-btn" onclick="goBack()">← Back</button>
        </div>

        @if(session('error'))
            <div class="toast-msg toast-error">{{ session('error') }}</div>
        @endif

        <form action="{{ route('students.update', $student->id)}}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Academic ID</label>
                <input type="text" name="academicId"
                       value="{{ old('academicId', $student->academicId) }}"
                       pattern="^099\d{13}$" required  disabled>
                @error('academicId')<div class="error">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label>Student Name</label>
                <input type="text" name="name"
                       value="{{ old('name', $student->name) }}" required disabled>
                @error('name')<div class="error">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label>Session</label>
                <select name="session" required disabled>
                    <option value="">Select session</option>
                    <option value="summer" {{ old('session', $student->session) == 'summer' ? 'selected' : '' }}>Summer</option>
                    <option value="spring" {{ old('session', $student->session) == 'spring' ? 'selected' : '' }}>Spring</option>
                </select>
                @error('session')<div class="error">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label>Admission Year</label>
                <input type="text" name="admissionYear"
                       value="{{ old('admissionYear', $student->admissionYear) }}"
                       pattern="[0-9]{4}" required disabled>
                @error('admissionYear')<div class="error">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label>Semester <sup style="color: red;">Only Editable</sup></label>
                <select name="semester" required>
                    <option value="">Select semester</option>
                    @foreach(['1-1','1-2','2-1','2-2','3-1','3-2','4-1','4-2'] as $sem)
                        <option value="{{ $sem }}" {{ old('semester', $student->semester) == $sem ? 'selected' : '' }}>{{ $sem }}</option>
                    @endforeach
                </select>
                @error('semester')<div class="error">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email"
                       value="{{ old('email', $student->email) }}" required disabled>
                @error('email')<div class="error">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label>Mobile</label>
                <input type="tel" name="mobile"
                       value="{{ old('mobile', $student->mobile) }}" required disabled>
                @error('mobile')<div class="error">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label>Date of Birth</label>
                <input type="date" name="dob"
                       value="{{ old('dob', $student->dob) }}" required disabled>
                @error('dob')<div class="error">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label>Address</label>
                <input type="text" name="address"
                       value="{{ old('address', $student->address) }}" required disabled>
                @error('address')<div class="error">{{ $message }}</div>@enderror
            </div>
             <div class="form-group">
                <label>Status</label>
                    <select name="status" required disabled>
                    <option value="">Select Status</option>
                    @foreach(['ongoing','onhold','graduated'] as $status)
                        <option value="{{ $status }}" {{ old('status', $student->status) == $sem ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
                    @endforeach
                  </select>
                @error('address')<div class="error">{{ $message }}</div>@enderror
            </div>

            <div class="actions">
                <button type="button" class="cancel-btn" onclick="goBack()">Cancel</button>
                <button type="submit" class="submit-btn">Update Student</button>
            </div>
        </form>

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
