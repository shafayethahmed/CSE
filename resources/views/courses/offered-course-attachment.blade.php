@if (in_array(Auth::user()->role ,['super-admin','department-head','staff']))
@extends('layout.sidebar')

@section('title','Assign Offered Courses')

@push('styles')
<style>
.page-wrapper{
    max-width: 1000px;
    margin: 25px auto;
}

.card-box{
    background:#ffffff;
    border-radius:8px;
    box-shadow:0 4px 12px rgba(0,0,0,0.05);
    padding:18px;
}

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

.header-info{
    background:#111;
    color:#fff;
    padding:6px 14px;
    border-radius:6px;
    font-size:12px;
    font-weight:500;
    display:flex;
    gap:15px;
    margin-bottom: 15px;
}

.filter-box{
    display:flex;
    justify-content:flex-start;
    align-items:center;
    margin-bottom:18px;
    gap:10px;
}

.filter-box select{
    padding:6px 10px;
    border-radius:5px;
    border:1px solid #ccc;
    font-size:13px;
}

.filter-box select:focus{
    border-color:#000;
    outline:none;
}

/* Searchable list */
.search-box{
    position:relative;
    margin-bottom:15px;
}

.search-box input{
    width:100%;
    padding:10px 14px;
    border-radius:10px;
    border:1px solid #e5e7eb;
    font-size:14px;
}

.search-box input:focus{
    outline:none;
    border-color:#2563eb;
}

/* Courses list */
.courses-list{
    max-height:300px;
    overflow-y:auto;
    border:1px solid #e5e7eb;
    border-radius:10px;
    padding:10px;
}

.courses-list label{
    display:flex;
    align-items:center;
    gap:10px;
    padding:6px 8px;
    border-radius:6px;
    cursor:pointer;
    transition:.2s;
}

.courses-list label:hover{
    background:#f3f4f6;
}

.submit-btn{
    margin-top:15px;
    padding:10px 18px;
    background:#2563eb;
    color:#fff;
    border:none;
    border-radius:10px;
    font-weight:500;
    cursor:pointer;
    transition:.3s ease;
}

.submit-btn:hover{
    background:#1e40af;
}
.course-compact-list {
  max-width: 900px; /* Fits small spaces */
  font-size: 13px;
  line-height: 1.3;
  font-family: -apple-system, BlinkMacSystemFont, sans-serif;
}

.course-compact-list label {
  display: block;
  padding: 4px 6px;
  margin: 1px 0;
  border: 1px solid #e0e0e0;
  background: #fafafa;
  border-radius: 3px;
  cursor: pointer;
  white-space: nowrap; /* Prevents wrapping for tight fit */
  overflow: hidden;
  text-overflow: ellipsis;
}

.course-compact-list label:hover {
  background: #f0f0f0;
}

.course-compact-list span {
  display: flex;
  align-items: center;
  justify-content: space-between;
  color: #444;
}

.course-compact-list a {
  color: #d00;
  text-decoration: none;
  font-weight: bold;
  font-size: 12px;
  padding: 2px 6px;
  border-radius: 2px;
  transition: background 0.2s;
}

.course-compact-list a:hover {
  background: #fee;
}

@media (max-width: 480px) {
  .course-compact-list {
    font-size: 12px;
    max-width: 100%;
  }
}


</style>
@endpush

@section('content')
<div class="page-wrapper">
    <div class="card-box">

        <div class="page-header">
            <h2>Assign Offered Courses</h2>
        </div>

        <div class="header-info">
            <span>Select semester to assign courses</span>
        </div>

        <!-- Semester selection -->
        <form id="assignCoursesForm" method="POST" action="{{ route('courses.offered.store') }}">
            @csrf
            <div class="filter-box">
                <select id="semesterSelect" name="semester">
                    @foreach(['1-1','1-2','2-1','2-2','3-1','3-2','4-1','4-2'] as $sem)
                        <option value="{{ $sem }}">{{ $sem }}</option>
                    @endforeach
                </select>
            </div>
            
            {{-- Courses That already assigned to the system --}}
             <h4 style="margin-top: 10px;"><i>Offered Courses</i></h4>
           <div class="course-compact-list">
                    {{-- Returned Json will show here  --}}
            </div>
            
            <hr>

            <h4 style="margin-top: 20px;"><i>Assign New Courses</i></h4>
            <!-- Search box -->
            <div class="search-box">
                <input type="text" id="courseSearchInput" placeholder="Search course code or title...">
            </div>
            {{-- Taking The CSRF token --}}
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <!-- Dynamic course checkboxes -->
            <div class="courses-list" id="coursesList">
                @foreach($courses as $course)
                    <label>
                        <input type="checkbox" name="courses[]" value="{{ $course->id }}">
                        <span>{{ $course->course_code }} - {{ $course->course_title }}</span>
                    </label>
                @endforeach
            </div>

            <button type="submit" class="submit-btn">Assign Selected Courses</button>
        </form>
    </div>
</div>
@endsection

@push('scripts')
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
       

// Search filter for courses
const searchInput = document.getElementById('courseSearchInput');
const coursesList = document.getElementById('coursesList');
const courseItems = Array.from(coursesList.getElementsByTagName('label'));

searchInput.addEventListener('input', function(){
    const query = this.value.toLowerCase();
    courseItems.forEach(item => {
        const text = item.textContent.toLowerCase();
        item.style.display = text.includes(query) ? 'flex' : 'none';
    });
});

// // reload courses on semester change 
// const semesterSelect = document.getElementById('semesterSelect');
// semesterSelect.addEventListener('change', function(){
//     // In a real system, you can fetch courses via AJAX
//     // For now we just reset the search input
//     searchInput.value = '';
//     courseItems.forEach(item => item.style.display='flex');
// });


// function confirmDelete(id) {
//     if (confirm('Delete this course?')) {
//         // Add your delete logic here, e.g., fetch(`/courses/${id}`, {method: 'DELETE'})
//         window.location.reload(); // Or handle via AJAX
//     }
// }

//   Jquery part Start From here: 
$(document).ready(function(){

    function fetchAssignedCourses(){  //function for diplayed already assigned course.

        let filterSemesterValue = $("#semesterSelect").val();

        $.ajax({
            url: "{{ route('courses.offered-curriculum.assigned') }}",
            type : "GET",
            data : { filterSemesterValue : filterSemesterValue },

            success: function(response){

                let courseList = $(".course-compact-list");
                courseList.html(""); // clear previous list

                if(response.courses.length > 0){

                    response.courses.forEach(function(course){

                        let html = `
                            <label>
                                <span>
                                    ${course.course?.course_code ?? 'N/A'} -
                                    ${course.course?.course_title ?? 'No Title'}
                                    <button type="button" class="deleteCourse" data-course-id="${course.course?.id ?? ''}">❌</button>
                                </span>
                            </label>
                        `;

                        courseList.append(html);

                    });

                }else{

                    courseList.html(`<p style="color:#999">No courses assigned</p>`);

                }

            }

        });

    } 
    
    //Function for deleting the courses that already existed: 
    $(document).on("click",".deleteCourse",function(e){
       e.preventDefault();
       
       //Taking the course id:
       let CourseID = $(this).data("course-id");

       //ensutring the confirmation: 
       if(!confirm("Are you sure to delete this course ?")){
         return;
       }

       //ajax call for delting the course-id: 
       $.ajax({
            url : "/offered-course/delete/" + CourseID,
            type : "DELETE",
            headers : {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success:function(response){
                alert(response.message);
                // Recall the function for fetching the data of other courses:
                fetchAssignedCourses();
            },
            error:function(xhr){
              alert("Course Delete Failed!");
            },
       });
    });

    $("#semesterSelect").on('change', fetchAssignedCourses);
    fetchAssignedCourses(); 



});
</script>
@endpush
@endif