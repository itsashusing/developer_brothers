@extends('admin.layout')
@section('title')
Edit Role
@endsection

@section('content')
<div>
    <div id="form" class="formbox">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Edit Role</h3>
            </div>
            <form role="form" action="{{ route('editRole',$role->id) }} " method="POST">
                @csrf
                @method('PUT')
                <div class="box-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <input type="text" hidden value="{{$role->id}}" name="" id="">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" placeholder="Enter Name" name="name"
                                    value="{{$role->name}}">
                                @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }} </span>
                                @endif
                            </div>
                            <div class="box-footer d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>

                    </div>

            </form>
        </div>
    </div>
</div>
@endsection