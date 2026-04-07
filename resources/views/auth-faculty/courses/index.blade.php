<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
@extends('auth-faculty.layout.sidebar')
@section('title','Courses')

@push('styles')
<style>
/* Wrapper */
.page-wrapper{
    max-width: 1000px;
    margin: 5 auto;
}

/* Header */
.page-header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom: 18px;
}

.page-header h2{
    font-size:18px;
    font-weight:600;
    color:#1f2937;
}
/* Table */
.table-box{
    background:#ffffff;
    padding:8px;
    border-radius:10px;
    box-shadow:0 10px 25px rgba(0,0,0,0.05);
}

table{
    width:100%;
    border-collapse:collapse;
    font-size:11px;
}

thead{
    background: rgba(241, 155, 57, 0.904);
}

th{
    font-size:12px;
    font-weight:600;
    color:black;
    padding:9px 10px;
    text-align: center;
}

td{
    padding:6px 6px;
    text-align: center;
     font-size:13px;
}

tbody tr{
    border-bottom:1px solid #eef2f7;
    transition:.2s;
}

tbody tr:hover{
    background:#f9fafb;
}


/* Responsive */
@media(max-width:992px){
    .filter-box{grid-template-columns:repeat(2,1fr);}
}

@media(max-width:600px){
    .filter-box{grid-template-columns:1fr;}
    .page-header{
        flex-direction:column;
        align-items:flex-start;
        gap:10px;
    }
}

</style>
@endpush

@section('content')
<div class="page-wrapper">
    
    <!-- Header with Search & Button -->
    <div class="page-header">
        <h2>Taken Courses</h2>
    </div>
    
    <div class="table-box">
        <table>
            <thead>
                <tr>
                    <th>SL</th>
                    <th>Course Code</th>
                    <th>Course Title</th>
                    <th>Course Credit</th>
                    <th>Course Type</th>
                </tr>
            </thead>
            <tbody>
            @forelse ($coursesList as $course)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $course->course_code }}</td>
                    <td>{{ $course->course_title }}</td>
                    <td>{{ $course->course_credit }}</td>
                    @if ($course->course_type === 'project')
                         <td>Thesis/Practicum/Project/Internship</td>
                    @else
                        <td>{{ ucWords($course->course_type) }}</td>
                    @endif
                    {{-- Actions are ecrypted for specific users --}}
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">Course Not Found</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
@push('scripts')
