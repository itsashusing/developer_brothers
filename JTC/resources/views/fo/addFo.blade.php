@extends('admin.layout')
@section('title')
    Add Fo member
@endsection

@section('content')
    <div>
        <div id="form" class="formbox">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Register yourself</h3>
                </div>
                <form role="form" action="{{ route('addFo') }} " method="POST">
                    @csrf
                    <div class="box-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" placeholder="Enter Name"
                                        name="name" value="{{ old('name') }}">
                                    @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }} </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email address</label>
                                    <input type="email" class="form-control" id="exampleInputEmail1"
                                        placeholder="Enter email" name="email" value="{{ old('email') }}">
                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }} </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">

                                <div class="form-group">
                                    <label for="adhar">Adhar Number</label>
                                    <input type="text" id="adhar" class="form-control"
                                        placeholder="Enter Adhar Number" name="adhar" value="{{ old('adhar') }}">
                                    @if ($errors->has('adhar'))
                                        <span class="text-danger">{{ $errors->first('adhar') }} </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="pan">Pan Number</label>
                                    <input type="text" value="{{old('pan')}}" id="pan" class="form-control" placeholder="Enter Pan Number"
                                        name="pan">
                                    @if ($errors->has('pan'))
                                        <span class="text-danger">{{ $errors->first('pan') }} </span>
                                    @endif
                                </div>

                            </div>

                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="mobile">Mobile</label>
                                    <input type="text" class="form-control" id="mobile"
                                        placeholder="Enter mobile number" name="mobile" value="{{ old('mobile') }}">
                                    @if ($errors->has('mobile'))
                                        <span class="text-danger">{{ $errors->first('mobile') }} </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Password</label>
                                    <input type="password" class="form-control" id="exampleInputPassword1"
                                        placeholder="Password " name="password">
                                    @if ($errors->has('password'))
                                        <span class="text-danger">{{ $errors->first('password') }} </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
