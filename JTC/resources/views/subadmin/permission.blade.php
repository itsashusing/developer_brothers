@extends('admin.layout')
@section('title')
Sub Admin/ Permission
@endsection
@section('content')

<div class="container">

    <div id="form" class="formbox">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Permission</h3>
            </div>
            <form role="form" action="{{ route('permissionchangestatus',$role->id) }} " method="POST">
                @csrf
                <div class="box-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">

                                <div class="box-body table-responsive">
                                    <table id="example2" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Role Name</th>
                                                <th>Active</th>
                                                <th>View</th>
                                                <th>Create</th>
                                                <th>Edit</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            
                                            @php
                                            $array = [
                                            'Dashboard' => ['view' => 1, 'edit' => 0, 'active' => 1, 'create' => 1],
                                            'Fo' => ['view' => 0, 'edit' => 1, 'active' => 1, 'create' => 1]
                                            ];



                                            foreach ($array as $key => $value) {
                                            echo $key;
                                            }
                                            @endphp
                                            @foreach ($array as $key => $item)
                                            <tr>
                                                <td>{{$key }}</td>
                                                <td>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" name="dashboard[active]"
                                                            type="checkbox" role="switch" {{$item['active'] ? 'checked'
                                                            : '' }}>
                                                </td>
                                                <td>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" role="switch"
                                                            name="dashboard[view]" {{$item['view'] ? 'checked' : '' }}>
                                                </td>
                                                <td>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" role="switch"
                                                            name="dashboard[create]" {{$item['create'] ? 'checked' : ''
                                                            }}>
                                                </td>

                                                <td>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" role="switch"
                                                            name="dashboard[edit]" {{$item['edit'] ? 'checked' : '' }}>
                                                </td>
                                            </tr>
                                            @endforeach


                                        </tbody>


                                    </table>


                                </div>
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