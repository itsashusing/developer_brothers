@extends('admin.layout')
@section('title')
Edit a Lead
@endsection

@section('content')
<div>
    <div id="form" class="formbox">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Edit a lead</h3>
            </div>
            <form role="form" action="{{ route('editleads') }} " method="POST">
                @csrf
                @method('PUT')
                <div class="box-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <input type="text" name="id" hidden value="{{ $lead->id }}" id="">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" placeholder="Enter Name" name="name"
                                    value="{{ $lead->name }}">
                                @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }} </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="email">Email address</label>
                                <input type="email" class="form-control" id="email" placeholder="Enter email"
                                    name="email" value="{{ $lead->email }}">
                                @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }} </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="mobile">Mobile</label>
                                <input type="number" class="form-control" id="mobile" placeholder="Enter mobile number"
                                    name="mobile" value="{{ $lead->mobile }}">
                                @if ($errors->has('mobile'))
                                <span class="text-danger">{{ $errors->first('mobile') }} </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" class="form-control" id="address" placeholder="Enter full Address "
                                    name="address" value="{{ $lead->address }}">
                                @if ($errors->has('address'))
                                <span class="text-danger">{{ $errors->first('address') }} </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">

                                <label for="fo">Select Fo</label>
                                <select id="fo" name="fo" class="form-select " aria-label="Small select example">

                                    <option selected>Select a fo</option>
                                    @foreach ($fos as $fo)

                                    <option value="{{$fo->id}}">{{$fo->name}}</option>
                                    @endforeach

                                </select>
                                @if ($errors->has('fo'))
                                <span class="text-danger">{{ $errors->first('fo') }} </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">

                                <label for="time">Expiry time in minuts</label>
                                <input type="number" class="form-control" id="time" placeholder="Enter time in muinuts"
                                    name="time" value="{{ $lead->time }}">
                                @if ($errors->has('time'))
                                <span class="text-danger">{{ $errors->first('time') }} </span>
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