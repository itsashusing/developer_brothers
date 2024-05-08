@extends('admin.layout')
@section('title')
Profile
@endsection

@section('content')
<div class="container">
    <div class="d-flex justify-content-center align-items-center">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between ">
                    <span>
                        Admin
                    </span>
                    <span>
                        <a class="btn btn-warning btn-sm text-white" href="{{route('changepassword')}}">Change Password</a>
                    </span>
                </div>
            </div>

            <div class="card-body">
                <div class="row">

                    <div class="d-flex gap-2">
                        <div>Email</div>
                        <div>{{$admin->email}}</div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection