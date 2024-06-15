                        {{-- <pre>
    @php
foreach ($page_data['get_table'] as $key => $item) {
    echo count($item->quiz);
}
@endphp
</pre> --}}

                        @php
                        use App\Models\Subject;
                        $subject= Subject::find($page_data['subject_id'])
                        @endphp

                        @extends('template')
                        @section('content')
                        <div class="row">
                            <div class="col-6">
                                <h6 class="mb-0 text-uppercase">{{ $subject->subject_name}}</h6>
                            </div>
                            <div class="col-6 text-end px-0 px-lg-3">
                                <button type="button" onclick="ajaxModal('{{ url('ajaxModal/modal_files.add_test') }}', sendObj({'_token' : '{{ csrf_token() }}','id':{{$page_data['subject_id']}}}))" class="btn btn-primary btn-sm px-3"><i class='bx bx-plus'></i>Create Test</button>
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
                                                <th>Set</th>
                                                <th class="text-center">Total Question </th>
                                                <th>Video url </th>
                                                <th>Status</th>
                                                <th class="text-end">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr dir-paginate="item in users | filter: q | itemsPerPage: usersPerPage" total-items="totalUsers" current-page="pagination.current">
                                                <td>@{{ getSerialNumber($index) }}</td>
                                                <td>@{{item.set}} </td>
                                                <td class="text-center">@{{ (item.quiz.length ) }}</td>
                                                {{-- <td hidden > @{{item.video_url[0].video_url}} </td> --}}
                                                <td> <button class="btn" ng-click="copyVideoURLTd(item.video_url[0].video_url)"><i class='bx bxs-copy'></i></button>
                                                </td>
                                                <td>
                                                    <span ng-if="item.status == 1" class="badge rounded-pill bg-success">Active</span>
                                                    <span ng-if="item.status == 0" class="badge rounded-pill bg-danger">Inactive</span>
                                                </td>

                                                <td>
                                                    <div class="d-flex flex-wrap gap-1 justify-content-end ">
                                                        <span class="badge text-bg-warning"><a style="all: unset; cursor: pointer;" ng-click="ajaxModal('{{ url('ajaxModal/modal_files.add_video_url') }}', sendObj({'_token' : '{{ csrf_token() }}', 'id' : item.id  }))"><i class='bx bx-plus'></i>Url</a></span>


                                                        <span class="badge text-bg-info"> <a style="all: unset; cursor: pointer;" href="{{ route('quiz') }}/@{{ item.id }}"><i class='bx bx-plus'></i>Question</a></span>

                                                        <span class="badge text-bg-danger" ng-if="item.status"> <a style="all: unset; cursor: pointer;" href="{{ route('test') }}/@{{ item.id }}/change_status">

                                                                <i class='bx bx-x'></i>
                                                            </a></span>
                                                        <span class="badge text-bg-info" ng-if="item.status==0"> <a style="all: unset; cursor: pointer;" href="{{ route('test') }}/@{{ item.id }}/change_status">


                                                                <i class='bx bx-check'></i>
                                                            </a></span>

                                                        <span class="badge text-bg-warning"> <a style="all: unset; cursor: pointer;" ng-click="ajaxModal('{{ url('ajaxModal/modal_files.edit_test') }}', sendObj({'_token' : '{{ csrf_token() }}', 'id' : item.id  }))"><i class='bx bxs-edit-alt'></i></a></span>

                                                        <span class="badge text-bg-danger"> <a style="all: unset; cursor: pointer;" href="{{ route('test') }}/@{{ item.id }}/delete"><i class='bx bxs-trash-alt'></i></a></span>

                                                    </div>
                                                    {{-- <div class="dropdown dropstart d-flex order-actions">
                                                        <a href="javascript:;" class="mx-1" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class='bx bx-dots-horizontal-rounded'></i>
                                                        </a>
                                                        <ul class="dropdown-menu">
                                                            <li class="py-1">
                                                                <a class="dropdown-item px-3" style="all: unset; cursor: pointer;" href="{{ route('quiz') }}/@{{ item.id }}">Add Question</a>
                                                    </li>
                                                    <li class="py-1">
                                                        <a href="javascript:;" class="dropdown-item px-3" style="all: unset; cursor: pointer;" ng-click="ajaxModal('{{ url('ajaxModal/modal_files.add_video_url') }}', sendObj({'_token' : '{{ csrf_token() }}', 'id' : item.id  }))">Add Video Url</a>
                                                    </li>
                                                    <li class="py-1">
                                                        <a class="dropdown-item px-3" style="all: unset; cursor: pointer;" href="{{ route('test') }}/@{{ item.id }}/change_status">@{{ item.status == 1 ? "Mark Inactive" : "Mark Active" }}</a>
                                                    </li>
                                                    <li class="py-1">
                                                        <a href="javascript:;" class="dropdown-item px-3" style="all: unset; cursor: pointer;" ng-click="ajaxModal('{{ url('ajaxModal/modal_files.edit_test') }}', sendObj({'_token' : '{{ csrf_token() }}', 'id' : item.id  }))">Edit</a>
                                                    </li>
                                                    <li class="py-1">
                                                        <a class="dropdown-item px-3" style="all: unset; cursor: pointer;" href="{{ route('test') }}/@{{ item.id }}/delete">Delete</a>
                                                    </li>
                                                    </ul>
                                </div> --}}
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
