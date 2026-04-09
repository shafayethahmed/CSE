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
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>
        @forelse($students as $student)
        <tr>
            <td>{{ $student->academicId }}</td>
            <td>{{ ucwords($student->name) }}</td>
            <td>{{ $student->email }}</td>
            <td>{{ $student->mobile }}</td>
            <td>{{ ucfirst($student->session)}}-{{ $student->admissionYear }}</td>
            <td>{{ $student->semester }}</td>
            <td style="background-color:rgba(255, 177, 148, 0.815);"><b>{{ ucfirst($student->status) }}</b></td>
             <td class="actions">
                    <a href="{{ route('faculty.students.show', $student->id) }}" class="btn-view">
                        View
                    </a>

                    <a href="{{ route('faculty.students.edit', $student->id) }}" class="btn-edit">
                        Edit
                    </a>
                </td>
        </tr>
        @empty
        <tr>
            <td colspan="8" style="font-weight: 400;font-size:14px;">No Students Found</td>
        </tr>
        @endforelse
    </tbody>
</table>

{{-- <div>
    {{ $students->links('pagination::tailwind') }}
</div> --}}
