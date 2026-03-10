@extends('layout.sidebar')
@section('title','Offered Course')

@push('styles')
<style>

/* Wrapper */
.page-wrapper{
    max-width: 1000px;
    margin: 25px auto;
}

/* Card */
.card-box{
    background:#ffffff;
    border-radius:8px;
    box-shadow:0 4px 12px rgba(0,0,0,0.05);
    padding:18px;
}

/* Header */
.page-header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:15px;
}

.page-header h2{
    font-size:17px;
    font-weight:600;
    color:#000;
    margin:0;
}

/* Dark Info Box */
.header-info{
    background:#111;              /* dark */
    color:#fff;                   /* white text */
    padding:6px 14px;
    border-radius:6px;
    font-size:12px;
    font-weight:500;
    display:flex;
    gap:15px;
}

/* Filter */
.filter-box{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:18px;
    gap:10px;
}

.filter-box select{
    padding:6px 10px;
    border-radius:5px;
    border:1px solid #ccc;
    font-size:13px;
    color:#000;
}

.filter-box select:focus{
    border-color:#000;
    outline:none;
}

/* Table */
.table-responsive{
    overflow-x:auto;
}

table{
    width:100%;
    border-collapse:collapse;
    font-size:14px;
}

thead{
    background:rgba(2, 2, 2, 0.747);
    border-bottom:1px solid #ddd;
}

th{
    padding:10px;
    text-align:center;
    font-weight:600;
    font-size:13px;
    color:white;
}

td{
    padding:10px;
    text-align:center;
    color:#000;
}

tbody tr{
    border-bottom:1px solid #eee;
}

tbody tr:hover{
    background:#f5f5f5;
}

.empty-row{
    padding:18px;
    text-align:center;
    color:#000;
}

@media(max-width:600px){
    .page-header{
        flex-direction:column;
        align-items:flex-start;
        gap:8px;
    }
}

</style>
@endpush


@section('content')

<div class="page-wrapper">

    <div class="card-box">

        <!-- Header -->
        <div class="page-header">
            <h2>Offered Courses</h2>
        </div>
        <!-- Add Offered Course Button -->
        <div style="margin-bottom: 15px;">
            <button class="btn-primary-custom" onclick="window.location.href='{{ route('courses.offered.create') }}'">
                + Edit Offered Course
            </button>
        </div>

        <!-- Filter -->
        <form method="get">
            <div class="filter-box">

                <select name="semester" id="filterSemester">
                    @foreach(['1-1','1-2','2-1','2-2','3-1','3-2','4-1','4-2'] as $sem)
                        <option value="{{ $sem }}"
                            {{ request('semester','1-1') == $sem ? 'selected' : '' }}>
                            {{ $sem }}
                        </option>
                    @endforeach
                </select>

            </div>
        </form>

        <!-- Table -->
        <div class="table-responsive" >
            <div id="offerCourseTable">
                     @include('courses.partial.offered-course',['offeredCourses' => $offeredCourses]);
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
     {{-- Ajax part for fatch the data  --}}
     <script>
        $(document).ready(function(){
        //  Ajax part start from here:
          
        //   Filtering facth start from here:
          function fetchOfferedCourseData(){
                let filterSemester = $('#filterSemester').val();
            $.ajax({
                url : "{{ route('courses.offered-curriculum') }}",
                type : "GET",
                data : {filterSemester : filterSemester},
                 success:function(data){
                    $("#offerCourseTable").html(data);
                 },
                 error:function(){
                    alert("fething Error");
                 }
            });
          }

          //onchange value Filtering:
          $("#filterSemester").on('change',fetchOfferedCourseData);   
        });
     </script>
       
@endpush