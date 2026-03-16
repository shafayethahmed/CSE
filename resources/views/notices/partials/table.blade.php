<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

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
                <td>{{ $notice->created_at }}</td>

                <td>
                    <a href="{{ route('notices.show',$notice->id) }}" class="action-btn text-primary">
                        <i class="fa fa-eye"></i>
                    </a>

                    <a href="#" class="action-btn text-primary">
                        <i class="fa fa-edit"></i>
                    </a>

                    <a href="#" class="action-btn text-danger">
                        <i class="fa fa-trash"></i>
                    </a>
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