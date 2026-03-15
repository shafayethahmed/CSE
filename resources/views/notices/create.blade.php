@extends('layout.sidebar')

@section('title','Create Notice')

@push('styles')
<style>

/* PAGE WRAPPER */
.notice-wrapper{
    max-width:920px;
    margin:20px auto;
}

/* CARD */
.notice-card{
    background:#e2c7b1d8;
    border-radius:10px;
    border:1px solid #e6e6e6;
    box-shadow:0 4px 12px rgba(0,0,0,0.05);
    overflow:hidden;
}

/* HEADER */
.notice-header{
    padding:14px 18px;
    font-size:16px;
    font-weight:600;
    background:#010b1a;
    color: white;
    border-bottom:1px solid #eee;
}

/* BODY */
.notice-body{
    padding:20px;
}

/* FORM GROUP */
.form-group{
    margin-bottom:16px;
}

.form-label{
    font-size:13px;
    font-weight:600;
    margin-bottom:6px;
}

/* INPUT */
.form-control{
    height:36px;
    border-radius:6px;
    font-size:14px;
    border:1px solid #dcdcdc;
}

textarea.form-control{
    height:auto;
    resize:vertical;
}

/* INPUT FOCUS */
.form-control:focus{
    border-color:#2563eb;
    box-shadow:0 0 0 2px rgba(37,99,235,0.15);
}

/* ERROR */
.text-danger{
    font-size:12px;
    margin-top:3px;
}

/* BUTTON AREA */
.form-actions{
    margin-top:20px;
    display:flex;
    justify-content:flex-end;
    gap:10px;
}

/* BUTTONS */
.btn{
    font-size:13px;
    border-radius:6px;
    padding:6px 14px;
}

.btn-primary{
    background:#2563eb;
    border:none;
}

.btn-primary:hover{
    background:#1d4ed8;
}

.btn-secondary{
    background:#f1f1f1;
    border:1px solid #ddd;
    text-decoration: none;
}

/* RESPONSIVE */
@media(max-width:600px){
    .row{
        flex-direction:column;
    }
}

</style>
@endpush


@section('content')

<div class="notice-wrapper">

    <div class="notice-card">

        <div class="notice-header">
            Create Notice
        </div>

        <div class="notice-body">

            @error('wrong')
                <div class="text-danger mb-2">
                    {{ $message }}
                </div>
            @enderror

            <form action="{{ route('notices.store') }}" method="POST">
                @csrf

                {{-- TITLE --}}
                <div class="form-group">
                    <label class="form-label">
                        Notice Title <span class="text-danger">*</span>
                    </label>

                    <input type="text"
                           name="title"
                           class="form-control"
                           value="{{ old('title') }}"
                           placeholder="Enter notice title">

                    @error('title')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- BODY --}}
                <div class="form-group">
                    <label class="form-label">
                        Notice Description <span class="text-danger">*</span>
                    </label>

                    <textarea name="body"
                    rows="8"  cols="50"
                              class="form-control"
                              placeholder="Write the notice details...">{{ old('body') }}</textarea>

                    @error('body')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- ROW --}}
                <div class="row d-flex gap-3">

                    <div class="form-group col">
                        <label class="form-label">
                            Published By <span class="text-danger">*</span>
                        </label>

                        <input type="text"
                               name="publisher_name"
                               class="form-control"
                               value="{{ old('publisher_name') }}"
                               placeholder="Publisher name">

                        @error('publisher_name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group col">
                        <label class="form-label">
                            Designation <span class="text-danger">*</span>
                        </label>

                        <input type="text"
                               name="designation"
                               class="form-control"
                               value="{{ old('designation') }}"
                               placeholder="Publisher designation">

                        @error('designation')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                {{-- ACTION BUTTONS --}}
                <div class="form-actions">

                    <a href="{{ route('notices.index') }}" class="btn btn-secondary">
                        Cancel
                    </a>

                    <button type="submit" class="btn btn-primary">
                        Create Notice
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection