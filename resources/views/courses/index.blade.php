<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
@extends('layout.sidebar')
@section('title','Courses')

@push('styles')
<style>
/* Wrapper */
.page-wrapper{
    max-width: 1000px;
    margin: 10 auto;
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

/* Primary Button */
.btn-primary{
    background: var(--primary);
    border:none;
    padding:7px 14px;
    color:white;
    border-radius:6px;
    cursor:pointer;
    font-weight:600;
    font-size:12px;
    transition:.25s;
}
.btn-primary:hover{
    background:#1e40af;
}

/* Filters */
.filter-box{
    background:#fff;
    padding:14px;
    border-radius:10px;
    margin-bottom:18px;
    box-shadow:0 8px 20px rgba(0,0,0,0.04);
}

.filter-box input,
.filter-box select{
    padding:7px 9px;
    border-radius:6px;
    border:1px solid #d1d5db;
    font-size:12px;
    transition:.2s;
    width: 100%;
}

.filter-box input:focus,
.filter-box select:focus{
    border-color: var(--primary);
    outline:none;
}

/* Table */
.table-box{
    background:#fff;
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
    background:#061164e1;
}

th{
    font-size:10px;
    font-weight:600;
    color:white;
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

/* Actions */
.actions{
    white-space:nowrap;
}

.actions button{
    border:none;
    padding:2px 6px;
    border-radius:5px;
    font-size:11px;
    margin-right:3px;
    cursor:pointer;
    font-weight:500;
    transition:.2s;
}

/* Button colors */
.btn-view{
    background:#e0f2fe;
    color:#0369a1;
}
.btn-view:hover{
    background:#bae6fd;
}

.btn-edit{
    background:#fef9c3;
    color:#854d0e;
}
.btn-edit:hover{
    background:#fde68a;
}

.btn-delete{
    background:#fee2e2;
    color:#b91c1c;
}
.btn-delete:hover{
    background:#fecaca;
}
/* Toast */
.toast-msg{
    position:fixed;
    top:20px;
    right:20px;
    padding:8px 12px;
    border-radius:6px;
    color:#fff;
    z-index:9999;
    font-size: 12px;
    animation:slideFade .4s ease forwards;
}
.toast-success{ background:#28a745; }
.toast-error{ background:#dc3545; }

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
{{-- Toast --}}
@if(session('success'))
<div class="toast-msg toast-success">{{ session('success') }}</div>
@endif
@if(session('error'))
<div class="toast-msg toast-error">{{ session('error') }}</div>
@endif

<div class="page-wrapper">
    
    <!-- Header with Search & Button -->
    <div class="page-header">
        <h2>Course Management</h2>
        <div style="display: flex; gap: 10px; align-items: center;">
            <form method="get" style="margin: 0;">
                <input type="text" name="search" placeholder="Search by Course Code or Title..." id="courseSearch" style="width: 250px; border-radius:10px;">
            </form>
            <button class="btn btn-primary" onclick="addCourse()">+ Add Course</button>
        </div>
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
                    <th>Offered Semester</th>
                    <th width="140">Action</th>
                </tr>
            </thead>
            <tbody>
            @forelse ($courses as $course)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $course->course_code }}</td>
                    <td>{{ $course->course_title }}</td>
                    <td>{{ $course->course_credit }}</td>
                    <td>{{ ucWords($course->course_type) }}</td>
                    <td>{{ $course->semester }}</td>
                    <td class="actions">
                        <button class="btn-edit" onclick="editCourse({{ $course->id }})"><i class="fa fa-edit"></i></button>
                        <form action="{{ route('courses.destroy', $course->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-delete" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">Course Not Found</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
<!-- Pagination -->
<div class="d-flex justify-content-center mt-3" style="font-size: 0.85rem;">
    {{ $courses->links('pagination::bootstrap-5') }}
 </div>
</div>
@endsection
@push('scripts')
<script>
let searchTimeout;

const searchInput = document.getElementById('courseSearch');

searchInput.addEventListener('input', function() {
    clearTimeout(searchTimeout);

    const query = this.value.trim();

    if (!query) return;

    searchTimeout = setTimeout(() => {
        fetch(`{{ route('courses.index') }}?search=${encodeURIComponent(query)}`)
            .then(res => res.text())
            .then(html => {
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');
                const newTbody = doc.querySelector('tbody');
                const tableBody = document.querySelector('table tbody');
                
                if (newTbody && tableBody) {
                    tableBody.innerHTML = newTbody.innerHTML;
                }
                
                // Search box stays visible, just clear input value after 4s
                setTimeout(() => {
                    searchInput.value = '';
                }, 9000);
            })
            .catch(err => console.error('Search error:', err));
    }, 500);
});
setTimeout(() => {
    document.querySelectorAll('.toast-msg').forEach(t => t.remove());
}, 3000);

//Add Course Script: 
function addCourse(){
    window.location.href = "{{ route('courses.create') }}";
}
//Edit Course Script: 
 function editCourse(courseId){
    window.location.href = "{{ route('courses.edit',':id') }}".replace(':id',courseId);
 }
</script>
@endpush>
