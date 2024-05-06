@extends('admin.layout')
@section('title')
Fo/activeFo
@endsection
@section('content')
<div>
    {{-- <div class="d-flex justify-content-end">
        <a class="btn btn-primary mb-4 " href="{{ route('addFo') }}">Add Form</a>
    </div> --}}
    {{-- Table start form here --}}
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Active Fo Data Table</h3>
        </div><!-- /.box-header -->
        <div class="box-body table-responsive">
            <table id="example2" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Adhar</th>
                        <th>Pan</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($fo_data as $fo)

                    <tr>
                        <td>{{$fo->name}}</td>
                        <td>{{$fo->email}}</td>
                        <td>{{$fo->mobile}}</td>
                        <td> {{$fo->adhar}}</td>
                        <td>{{$fo->pan}}</td>
                        {{-- <td>
                            @if ($fo->status == 1)

                            <span class="badge bg-success">Active</span>
                            @elseif($fo->status == 0)
                            <span class="badge bg-danger">Inactive</span>
                            @endif

                        </td> --}}
                        <td><a href="">
                                <div class="form-check form-switch">
                                    <input class="form-check-input " type="checkbox" @if ($fo->status == 1) checked
                                    @endif
                                    onchange="changeStatus({{ $fo->id }})" role="switch"
                                    id="flexSwitchCheckDefault">
                                    <label class="form-check-label" for="flexSwitchCheckDefault"></label>
                                </div>
                            </a></td>
                    </tr>
                    @endforeach


                </tbody>


            </table>
            <div class="d-flex justify-content-end mt-2">

                <div>


                    @if ($fo_data->lastPage() > 1)
                    <ul class="pagination">
                        <li class="{{ ($fo_data->currentPage() == 1) ? 'disabled' : '' }}">
                            <a class="btn btn-primary btn-sm me-1" href="{{ $fo_data->url(1) }}">First</a>
                        </li>
                        @for ($i = 1; $i <= $fo_data->lastPage(); $i++)
                            <li class="">
                                <a class="btn btn-primary btn-sm me-1 {{ ($fo_data->currentPage() == $i) ? 'active' : '' }}"
                                    href="{{ $fo_data->url($i) }}">{{ $i }}</a>
                            </li>
                            @endfor

                            <li>
                                <a class="btn btn-primary btn-sm mx-1 {{ ($fo_data->currentPage() == $fo_data->lastPage()) ? 'disabled' : '' }}"
                                    href="{{ $fo_data->url($fo_data->currentPage() + 1) }}">Next</a>
                            </li>
                    </ul>
                    <span>Total {{$fo_data->lastPage()}} Pages</span>
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    function changeStatus(id) {
        console.log(id);
        var url = '/fochagestatus/' + id;
        window.location.href = url;
    }
</script>
@endsection