@extends('layout.sidebar')

@section('title','Batch Teacher List')

@push('styles')
<style>
.wrapper{
    max-width: 950px;
    margin: 15px auto;
}

.card-box{
    background: #fff;
    border-radius: 10px;
    padding: 18px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.05);
}

.header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:10px;
}

.table{
    width:100%;
    font-size:13px;
    border-collapse:collapse;
}

.table th, .table td{
    border:1px solid #e5e7eb;
    padding:6px;
    text-align: center;
}

.table th{
    background:#f3f4f6;
}

.badge{
    padding:3px 8px;
    border-radius:6px;
    font-size:12px;
    background:#e0f2fe;
}
.btn-sm{
    background: #2563eb;
    color: #fff;
    padding: 6px 14px;
    font-size: 13px;
    border-radius: 6px;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    transition: 0.2s;
}

.btn-sm:hover{
    background: #1e40af;
    color: #fff;
}
.btn-delete{
    background:#fee2e2;
    color:#b91c1c;
    border: none;
}
</style>
@endpush

@section('content')
<div class="wrapper">

    <div class="card-box">

        <div class="header">
            <h5>Batch Teacher</h5>

            <a href="{{ route('supervisor.assign') }}" class="btn btn-primary btn-sm">
                + Assign Supervisor
            </a>
        </div>
        @if(session('success'))
            <div class="alert alert-success mb-1" style="color: green;">
                {{ session('success') }}
            </div>
        @endif
        {{-- Error --}}
        @if ($errors->any())
            <div class="alert alert-danger mb-2">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
      <table class="table">
    <thead>
        <tr>
            <th>Faculty</th>
            <th>Email</th>
            <th>Semester</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>
        @foreach($batchSupervisor as $row)
        <tr>
            <td>{{ $row->faculty->name }}</td>
            <td>{{ $row->faculty->email }}</td>
            <td>{{ $row->semester }}</td>
            <td>
                {{-- Delete Form --}}
                <form action="{{ route('batch-supervisor.destroy', $row->id) }}" method="POST"
                      onsubmit="return confirm('Are you sure you want to delete this supervisor?');">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

    </div>

</div>
@endsection
@push('scripts')
     <script>
        function deleteSupervisor(){
            alert('this is the');
        }
      setTimeout(() => {
    // Select all elements with class 'alert'
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                alert.style.display = 'none';
            });
        }, 3000);
     </script>
@endpush
