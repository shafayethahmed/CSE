<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
@php
    $facultyActionPrivillageRole = ['super-admin','staff','department-head','user'];
@endphp
<table>
        <thead>
            <tr>
                <th>SL</th>
                <th>Notice Title</th>
                <th>Published By</th>
                <th>Date</th>
                <th width="120">Action</th>
            </tr>
        </thead>

        <tbody>
            @forelse ( $notices as $notice )
                <tr>
                <td>{{ $notice->notice_id}}</td>
                <td>{{ ucwords($notice->title) }}</td>
                <td>{{ $notice->published_by }}</td>
                <td>{{ $notice->updated_at }}</td>
              <td>
                    <a href="{{ route('notices.show',$notice->id) }}" class="action-btn text-primary">
                        <i class="fa fa-eye"></i>
                    </a>

                    @if(in_array(Auth::user()->role, ['super-admin', 'staff', 'department-head']))
                        <a href="{{ route('notices.edit',$notice->id) }}" class="action-btn text-primary">
                            <i class="fa fa-edit"></i>
                        </a>
                    @endif

                    @if(in_array(Auth::user()->role, ['super-admin', 'department-head']))
                        <form action="{{ route('notices.destroy',$notice->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="action-btn text-danger"
                                onclick="return confirm('Are you sure you want to delete this notice?')">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>
                    @endif
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
    {{ $notices->links('pagination::bootstrap-5') }}
    </div>