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
                <input class="form-control mb-2" type="file">
                <button class="btn btn-success">Upload</button>
            </div>
        </div>
        <div class="col-6">
            <div class="d-flex justify-content-end">
                <a class="btn btn-success" href="/files/excel_format.xlsx" download="excel_format.xlsx">Download Excel
                    format</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-wrap gap-4">
                        <h4>Export All leads</h4>
                        <a href="{{route('export')}}" class="btn btn-success">Export All leads</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection