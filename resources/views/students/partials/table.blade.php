<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/semantic-ui@2.5.0/dist/semantic.min.css">
<table>
    <thead>
        <tr style="text-align: center;">
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Mobile</th>
            <th>Session</th>
            <th>Semester</th>
            <th>Year</th>
            <th>Actions</th>
        </tr>
    </thead>

    <tbody>
        @forelse($students as $student)
        <tr>
            <td>{{ $student->academicId }}</td>
            <td>{{ ucwords($student->name) }}</td>
            <td>{{ $student->email }}</td>
            <td>{{ $student->mobile }}</td>
            <td>{{ ucfirst($student->session)}}</td>
            <td>{{ $student->semester }}</td>
            <td>{{ $student->admissionYear }}</td>
             <td class="actions">
                        <a href="{{ route('students.show',$student->id) }}">
                                <button class="btn-view" >View</button>
                        </a>
                        <a href="{{ route('students.edit',$student->id) }}">
                            <button class="btn-edit">Edit</button>
                        </a>
                        <form action="{{ route('students.destroy',$student->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete"
                                onclick="return confirm('Are you sure you want to delete this Student?')">
                                Delete
                            </button>
                        </form>           
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="8" style="font-weight: 400;font-size:14px;">No Students Found</td>
        </tr>
        @endforelse
    </tbody>
</table>

<div>
    {{ $students->links('pagination::tailwind') }}
</div>