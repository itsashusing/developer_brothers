@extends('admin.layout')
@section('title')
EditProfile
@endsection

@section('content')
<div class="container">
    <div style="max-width: 300px">
        <form action="{{route('changepassword')}}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" class="form-control" name="email" id="exampleInputEmail1" value="{{$admin->email}}">
                @if ($errors->has('email'))
                <span class="text-danger">{{ $errors->first('email') }} </span>

                @endif
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Old Password</label>
                <input type="password" placeholder="Enter old password" name="oldpassword" class="form-control"
                    id="exampleInputPassword1">
                @if ($errors->has('oldpassword'))
                <span class="text-danger">{{ $errors->first('oldpassword') }} </span>

                @endif
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">New Password</label>
                <input type="password" placeholder="Enter new password" name="newpassword" class="form-control"
                    id="exampleInputPassword1">
                @if ($errors->has('newpassword'))
                <span class="text-danger">{{ $errors->first('newpassword') }} </span>

                @endif
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

</div>
@endsection