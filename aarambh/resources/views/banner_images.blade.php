@extends('template')
@section('content')
<div class="row">
    <div class="col-6">
        <h6 class="mb-0 text-uppercase">{{ $page_data['page_title'] }}</h6>
    </div>
    <div class="col-6 text-end px-0 px-lg-3">
        <button type="button" onclick="ajaxModal('{{ url('ajaxModal/modal_files.add_banner_images') }}', sendObj({'_token' : '{{ csrf_token() }}'}))" class="btn btn-primary btn-sm px-3"><i class='bx bx-plus'></i>Add</button>
    </div>
</div>
<hr />
<div class="card" ng-app="paginationApp" ng-controller="paginationController">
    <div class="card-body">
        <x-paginationHeader />
        <div class="table-responsive">
            <table class="table dataTable no-footer" style="width:100%; border: 1px solid #e9ecef">
                <thead class="table-light">
                    <tr id="thead-html">
                        <th>S no.</th>
                        <th>Image</th>
                        <th>Description </th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr dir-paginate="item in users | filter: q | itemsPerPage: usersPerPage" total-items="totalUsers" current-page="pagination.current">
                        <td>@{{ getSerialNumber($index) }}</td>
                        <td><img style="width: 2rem" class="rounded" src="{{asset('')}}/@{{ item.image }}" alt="" srcset=""> </td>
                        <td>@{{ item.description }}</td>
                        <td>
                            <span ng-if="item.status == 1" class="badge rounded-pill bg-success">Active</span>
                            <span ng-if="item.status == 0" class="badge rounded-pill bg-danger">Inactive</span>
                        </td>

                        <td>
                            <div class="dropdown dropstart d-flex order-actions">
                                <a href="javascript:;" class="mx-1" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class='bx bx-dots-horizontal-rounded'></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="py-1">
                                        <a class="dropdown-item px-3" style="all: unset; cursor: pointer;" href="{{ route('homebanner') }}/change_status/@{{ item.id }}">@{{ item.status == 1 ? "Mark Inactive" : "Mark Active" }}</a>
                                    </li>
                                    <li class="py-1">
                                        <a href="javascript:;" class="dropdown-item px-3" style="all: unset; cursor: pointer;" ng-click="ajaxModal('{{ url('ajaxModal/modal_files.update_role') }}', sendObj({'_token' : '{{ csrf_token() }}', 'param1' : item.id}))">Edit</a>
                                    </li>

                                </ul>
                            </div>
                        </td>
                    </tr>
                    <tr ng-if="totalUsers <= 0">
                        <td id="no-data">
                            <div class="text-center">No data available in table</div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <x-paginationFooter />
        </div>
    </div>
</div>
@endsection
