@extends('admin.layout')

@section('title')

<div class="container">

    Import leads
</div>

@endsection
@section('content')

<div class="container">

    <div class="row mb-4">
        <div class="col-6">
            <div class="form-group">
                <form action="{{ route('importleads') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <input class="form-control mb-2" type="file" name="file">
                        @if ($errors->has('file'))

                        <span class="text-danger">{{ $errors->first('file') }} </span>

                        @endif
                    </div>
                    <button class="btn btn-success" type="submit">Upload</button>
                    <a class="btn btn-warning text-white" href="/files/sample.xlsx" download>Download
                        sample
                        file</a>
                </form>

            </div>
        </div>

    </div>

</div>

@endsection