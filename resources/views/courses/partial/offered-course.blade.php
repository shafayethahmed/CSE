<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/semantic-ui@2.5.0/dist/semantic.min.css">
<div class="header-info">
                <span>Semester: {{ $offeredSemester ?? '1-1' }}</span>
                <span>Total Credit: {{ $offeredCourses->sum('course.course_credit') }}</span>
 </div>
<table>
    <tr>
      <thead>
        <th>Code</th>
        <th>Title</th>
        <th>Credit</th>
      </thead>
    </tr>
     <tbody>
        @forelse ($offeredCourses as $ofc)
            <tr>
            <td>{{ $ofc->course->course_code}}</td>
            <td>{{ $ofc->course->course_title }}</td>
            <td>{{ $ofc->course->course_credit }}</td>
            </tr>
        @empty
            <tr style="text-align: center;">
                <td colspan="7">No Course Offered This Semester.</td>
            </tr>
        @endforelse
        
     </tbody>
</table>
{{-- Assing later the pagiation table --}}
<div class="mb-1">
    {{ $offeredCourses->links('pagination::semantic-ui') }}
</div>