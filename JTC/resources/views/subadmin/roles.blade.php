@extends('admin.layout')
@section('title')
Sub Admin/ Role
@endsection
@section('content')
<div class="container">

    <div class="d-flex justify-content-end gap-2">
        <a class="btn btn-primary mb-4 " href="{{ route('addRoles') }}">Add Role</a>
    </div>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">All Roles Data Table</h3>
        </div><!-- /.box-header -->
        <div class="box-body table-responsive">
            <table id="example2" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>S.No.</th>
                        <th>Role Name</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($roles as $key => $item)
                    <tr>
                        <td>{{$key+1}} </td>
                        <td>{{$item->name}}</td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic mixed styles example">

                                <a href="{{route('editRole',$item->id)}}" class="btn btn-warning text-white">Edit</a>
                                <a href="{{route('permission',$item->id)}}" class="btn btn-success">Permission</a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>


            </table>
            <div class="d-flex justify-content-end mt-2">
                <div>
                    @if ($roles->lastPage() > 1)
                    <ul class="pagination">
                        <li class="{{ ($roles->currentPage() == 1) ? 'disabled' : '' }}">
                            <a class="btn btn-primary btn-sm me-1" href="{{ $roles->url(1) }}">First</a>
                        </li>
                        @for ($i = 1; $i <= $roles->lastPage(); $i++)
                            <li class="">
                                <a class="btn btn-primary btn-sm me-1 {{ ($roles->currentPage() == $i) ? 'active' : '' }}"
                                    href="{{ $roles->url($i) }}">{{ $i }}</a>
                            </li>
                            @endfor

                            <li>
                                <a class="btn btn-primary btn-sm mx-1 {{ ($roles->currentPage() == $roles->lastPage()) ? 'disabled' : '' }}"
                                    href="{{ $roles->url($roles->currentPage() + 1) }}">Next</a>
                            </li>


                    </ul>
                    <span class="m-0">Total {{$roles->lastPage()}} Pages</span>
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>
@endsection