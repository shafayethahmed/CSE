@extends('layout.sidebar')

@section('title','Courses')

@push('styles')
<style>
/* Wrapper */
.page-wrapper{
    margin-top: 20px;
    max-width: 900px;
    margin: 5 auto;
}

/* Header */
.page-header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:18px;
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
    display:grid;
    grid-template-columns: repeat(4, 1fr);
    gap:10px;
}

.filter-box input,
.filter-box select{
    padding:7px 9px;
    border-radius:6px;
    border:1px solid #d1d5db;
    font-size:12px;
    transition:.2s;
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
    background:#d9d5ebe1;
}

th{
    font-size:12px;
    font-weight:600;
    color:#000000;
    padding:9px 8px;
    text-align: center;
}

td{
    padding:6px 6px;
    text-align: center;
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
/* Overlay covering the whole screen */
#spinnerOverlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(255, 255, 255, 0.7);
    display: none; /* hidden by default */
    justify-content: center;
    align-items: center;
    z-index: 9999;
}

/* Spinner design */
.spinner {
    border: 6px solid #f3f3f3; /* Light gray */
    border-top: 6px solid #1e3a8a; /* Primary blue color */
    border-radius: 50%;
    width: 50px;
    height: 50px;
    animation: spin 2s linear infinite;
}

/* Spin animation */
@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
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

    <!-- Header -->
    <div class="page-header">
        <h2>Course Curriculam</h2>
    </div>

    <!-- Filters -->
    <div class="filter-box">
        <select>
            <option>1-1</option><option>1-2</option>
            <option>2-1</option><option>2-2</option>
            <option>3-1</option><option>3-2</option>
            <option>4-1</option><option>4-2</option>
        </select>
       <div style="overflow: hidden; margin-top: 10px;">
            <small style="float:right;">
                Total Credit: 12
            </small>
        </div>
    </div>
      
    <!-- Table -->
    <div class="table-box">
        <table>
            <thead>
                <tr>
                    <th>Course Code</th>
                    <th>Course Title</th>
                    <th>Course Credit</th>
                </tr>
            </thead>

            <tbody id="studentTable">
                <tr>
                    <td>CSE-4201</td>
                    <td>Data Structure</td>
                    <td>3</td>
                </tr>
            </tbody>
        </table>
    </div>

</div>

@endsection


@push('scripts')
<script>

document.addEventListener("DOMContentLoaded", function(){

    /* Search */
    document.getElementById("searchInput").addEventListener("keyup", function() {
        let value = this.value.toLowerCase();
        let rows = document.querySelectorAll("#studentTable tr");

        rows.forEach(row=>{
            row.style.display = row.innerText.toLowerCase().includes(value) ? "" : "none";
        });
    });

});


</script>
@endpush
