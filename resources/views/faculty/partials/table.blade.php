<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/semantic-ui@2.5.0/dist/semantic.min.css">
<table class="user-table">
    <thead>
        <tr>
            <th>Faculty-ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Designation</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>

    <tbody>
        @forelse($faculties as $faculty)
        <tr>
            <td>{{ $faculty->faculty_id}}</td>
            <td>{{ $faculty->name }}</td>
            <td>{{ $faculty->email }}</td>
            <td>{{str_replace('-',' ', ucwords($faculty->designation))}}</td>
            <td>{{ $faculty->faculty_status }}</td>
            <td class="text-center action-btns">
                <a href="{{ route('faculty.show', $faculty->id) }}" class="btn btn-sm btn-view"><i class="fa fa-eye"></i></a>
                <a href="{{ route('faculty.edit', $faculty->id) }}" class="btn btn-sm btn-edit"><i class="fa fa-pen"></i></a>
                <form action="{{ route('faculty.destroy', $faculty->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-delete" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i></button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5">No faculty found</td>
        </tr>
        @endforelse
    </tbody>
</table>

<div class="mt-3">
    {{ $faculties->links('pagination::tailwind') }}
</div>

