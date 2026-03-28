@php
     $accessRoleForFacultyPage = ['super-admin','department-head']
 @endphp
    @if (in_array(Auth::user()->role ,$accessRoleForFacultyPage))
@extends('layout.sidebar')

@section('title','Assign Batch Teacher')

@push('styles')
<style>
.wrapper{
    max-width: 780px;
    margin: 20px auto;
}

.card-box{
    background:#fff;
    border-radius:12px;
    padding:22px 24px;
    border:1px solid #e5e7eb;
}

.card-box:hover{
    box-shadow:0 6px 18px rgba(0,0,0,0.06);
}

.card-box h5{
    font-weight:600;
    margin-bottom:15px;
}

.row-flex{
    display:flex;
    gap:10px;
    margin-bottom:12px;
}

.row-flex > div{
    flex:1;
}

.label{
    font-size:12px;
    font-weight:600;
    margin-bottom:4px;
}

.form-control, .form-select{
    height:36px;
    font-size:13px;
    border-radius:8px;
    border:1px solid #d1d5db;
    padding-left:12px;
}

.btn{
    border-radius:8px;
    font-size:13px;
    padding:6px 14px;
}

.btn-primary{ background:#2563eb; color:#fff; }
.btn-success{ background:#16a34a; color:#fff; }

.user-info{
    background:#f9fafb;
    border:1px solid #e5e7eb;
    padding:12px;
    border-radius:8px;
    margin-bottom:14px;
    font-size:13px;
}

.alert{
    padding:8px 10px;
    border-radius:8px;
    font-size:13px;
    margin-bottom:10px;
}

.alert-success{ background:#dcfce7; color:#166534; }
.alert-danger{ background:#fee2e2; color:#991b1b; }
.alert-warning{ background:#fef3c7; color:#92400e; }

.actions{
    text-align:right;
}

@media(max-width:768px){
    .row-flex{ flex-direction:column; }
}
</style>
@endpush

@section('content')
@error('error')
    <div class="text-danger">
       {{ $message }}
    </div>
@enderror
<div class="wrapper">
<div class="card-box">

<h5>Assign Batch Teacher</h5>
@if ($errors->any())
    <div class="alert alert-danger mb-2">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
{{-- MESSAGE --}}
<div id="messageBox" class="alert d-none"></div>

{{-- SEARCH FORM --}}
<form id="facultyemail">
    <label class="label">Search Faculty Email</label>
    <div class="row-flex">
        <input type="text" id="searchEmail" class="form-control" placeholder="Enter Faculty Email">
        <button class="btn btn-primary">Search</button>
    </div>
</form>

{{-- FACULTY INFO (always shown if exists) --}}
<div class="user-info d-none" id="facultyInfo">
    <strong>Faculty Status</strong>
    <p id="facultyData"></p>
</div>

{{-- ASSIGN SECTION WILL BE DYNAMICALLY APPENDED HERE --}}
<div id="assignContainer"></div>

</div>
</div>

@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function(){
setTimeout(() => {
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => alert.style.display = 'none');
}, 5000);

    $("#facultyemail").on('submit', function(e){
        e.preventDefault();

        let emailVal = $('#searchEmail').val();

        $.ajax({
            url: "{{ route('batch-supervisor.faculty.search') }}",
            type: "GET",
            data: { email: emailVal },

            success: function(response){
                // reset UI
                $("#messageBox").addClass('d-none').html('');
                $("#facultyInfo").addClass('d-none');
                $("#assignContainer").html('');

                //  Not found
                if(response.status === 'error'){
                    $("#messageBox")
                        .removeClass('d-none alert-success alert-warning')
                        .addClass('alert-danger')
                        .html('Faculty not found');
                    return;
                }

                //  Inactive
                if(response.data.faculty_status === 'inactive'){
                    $("#messageBox")
                        .removeClass('d-none alert-success alert-danger')
                        .addClass('alert-warning')
                        .html('Faculty account is inactive');
                    return;
                }

                // Active → SHOW faculty info AND assign section
                $("#facultyInfo").removeClass('d-none');

                $("#facultyData").html(`
                    Name: ${response.data.name} <br>
                    Email: ${response.data.email}
                `);

                $("#messageBox")
                    .removeClass('d-none alert-danger alert-warning')
                    .addClass('alert-success')
                    .html('Faculty found and active');

                // dynamically append semester + assign form
                $("#assignContainer").html(`
                    <form method="POST" action="{{ route('batch-supervisor.store') }}">
                        @csrf
                        <input type="hidden" name="faculty_id" value="${response.data.id}">

                        <div class="row-flex">
                            <div>
                                <label class="label">Semester</label>
                                <select name="semester" class="form-select" required>
                                    <option value="">Select Semester</option>
                                    <option value="1-1">1-1</option>
                                    <option value="1-2">1-2</option>
                                    <option value="2-1">2-1</option>
                                    <option value="2-2">2-2</option>
                                    <option value="3-1">3-1</option>
                                    <option value="3-2">3-2</option>
                                    <option value="4-1">4-1</option>
                                    <option value="4-2">4-2</option>
                                </select>
                            </div>
                        </div>

                        <div class="actions">
                            <button class="btn btn-success">Assign</button>
                        </div>
                    </form>
                `);
            },

            error: function(){
                $("#messageBox")
                    .removeClass('d-none')
                    .addClass('alert-danger')
                    .html('Server error!');
            }
        });
    });

});
</script>
@endpush
@endif