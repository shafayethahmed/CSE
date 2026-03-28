<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<div id="alumnitable">
    <table>
        <thead>
            <tr>
                <th>Academic ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Passed Year</th>
                <th>Batch</th>
                <th width="140">Action</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($alumni as $alu)
                <tr>
                    <td>{{ $alu->academicId }}</td>
                    <td>{{ $alu->name }}</td>
                    <td>{{ $alu->email }}</td>
                    <td>{{ $alu->mobile }}</td>
                    <td>{{ $alu->passedyear }}</td>
                    <td>{{ ucfirst($alu->session) . '-' . $alu->admissionYear }}</td>
                    <td class="actions">
                        <form action="{{ route('alumni.destroy',$alu->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete"
                                onclick="return confirm('Are you sure you want to delete this record?')">
                                Delete
                            </button>
                        </form>   
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">No Data Found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Pagination -->
    <div style="padding:10px;">
        {{ $alumni->links('pagination::bootstrap-5') }}
    </div>
</div>