<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/semantic-ui@2.5.0/dist/semantic.min.css">
<table class="user-table">
    <thead>
        <tr>
            <th>#</th><th>Name</th><th>Email</th><th>Mobile</th><th>Role</th><th>Status</th><th>Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ ucwords($user->name) }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->mobile }}</td>
            <td>{{ str_replace('-',' ', ucwords($user->role)) }}</td>
            <td>{{ ucfirst($user->status) }}</td>
            <td class="text-center action-btns">
                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-edit"><i class="fa fa-pen"></i></a>
                <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-delete" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i></button>
                </form>
            </td>
        </tr>
        @empty
        <tr><td colspan="7">No users found</td></tr>
        @endforelse
    </tbody>
</table>
{{-- !-- Pagination --> --}}
   <!-- Pagination -->
   <div class="d-flex justify-content-center mt-3" style="font-size: 0.85rem;">
    {{ $users->links('pagination::bootstrap-5') }}
    </div>
