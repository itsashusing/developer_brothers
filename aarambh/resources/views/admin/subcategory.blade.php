@extends('template')
@section('content')
<div class="row">
    <div class="col-6">
        <h6 class="mb-0 text-uppercase">{{ $page_data['page_title'] }}</h6>
    </div>
    <div class="col-6 text-end px-0 px-lg-3" id="permission_country_create">
        <button type="button" onclick="ajaxModal('{{ url('ajaxModal/modal_files.add_sub_category') }}', sendObj({'_token' : '{{ csrf_token() }}'}))" class="btn btn-primary btn-sm px-3"><i class='bx bx-plus'></i>Add</button>
    </div>
</div>
<hr />
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table  no-footer" style="width:100%; border: 1px solid #e9ecef">
                <thead class="table-light">
                    <tr>
                        <th>S no.</th>
                        <th>Sub Category Name</th>
                        <th>Category Name</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($page_data['get_table'] as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{$item->sub_category_name}}</td>
                        <td>{{$item->category->category_name}}</td>
                        <td>
                            @if ($item->status == 1)
                            <span class="badge rounded-pill bg-success">Active</span>
                            @else
                            <span class="badge rounded-pill bg-danger">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <div class="dropdown dropstart d-flex order-actions">
                                <a href="javascript:;" class="mx-1" data-bs-toggle="dropdown" aria-expanded="false"><i class='bx bx-dots-horizontal-rounded'></i></a>
                                <ul class="dropdown-menu">
                                    <li class="py-1">
                                        <a class="dropdown-item px-3" style="all: unset; cursor: pointer;" href="{{ route('subcategory') }}/change_status/{{ $item->id }}">
                                            @if ($item->status == 1)
                                            Mark Inactive
                                            @else
                                            Mark Active
                                            @endif
                                        </a>
                                    </li>
                                    <li class="py-1">
                                        <a href="javascript:;" onclick="ajaxModal('{{ url('ajaxModal/modal_files.edit_sbcategory') }}', sendObj({'_token' : '{{ csrf_token() }}','id': {{$item->id}}}))" class="dropdown-item px-3" style="all: unset; cursor: pointer;">Edit</a>
                                    </li>
                                    <li class="py-1">
                                        <a href="{{ route('subcategory') }}/delete/{{ $item->id }}" class="dropdown-item px-3" style="all: unset; cursor: pointer;">Delete</a>
                                    </li>

                                </ul>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $page_data['get_table']->links('vendor.pagination.bootstrap-5') }}
        </div>
    </div>
</div>
@endsection
