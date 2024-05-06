@extends('admin.layout')
@section('title')
FO leads
@endsection
@section('content')
<div>
    <div class="d-flex justify-content-end gap-2">
        <a class="btn btn-primary mb-4 " href="{{ route('addLeads') }}">Add Lead</a>
        <a href="{{route('export')}}" class="btn btn-success mb-4">Export All leads</a>
    </div>
    {{-- Table start form here --}}
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Fo leads Data Table</h3>
        </div><!-- /.box-header -->
        <div class="box-body table-responsive">
            <table id="example2" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>S.No.</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Address</th>

                        <th>Created Time </th>
                        <th>Remaining <small class="text-muted">minutes</small></th>
                        <th>Expiry <small class="text-muted">minutes</small></th>
                        <th>Status</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($leads as $key => $lead)

                    <tr>
                        <td> {{$key+1}}</td>
                        <td>{{$lead->name}}</td>
                        <td>{{$lead->email}}</td>
                        <td>{{$lead->mobile}}</td>
                        <td> {{$lead->address}}</td>
                        <td>{{$lead->created_at}} </td>
                        <td>
                            {{$lead->created_at->addMinutes($lead->time)->diffInMinutes(now()) }}
                        </td>
                        <td> {{ $lead->time }}</td>
                        <td>
                            @if ($lead->status == 1)

                            <span class="badge bg-success">Open</span>
                            @elseif($lead->status == 0)
                            <span class="badge bg-danger">Close</span>
                            @elseif($lead->status == 2)
                            <span class="badge bg-warning">Timeout</span>
                            @elseif($lead->status == 3)
                            <span class="badge bg-warning">Not Assign</span>
                            @endif

                        </td>

                    </tr>
                    @endforeach


                </tbody>


            </table>
            <div class="d-flex justify-content-end mt-2">
                <div>
                    @if ($leads->lastPage() > 1)
                    <ul class="pagination">
                        <li class="{{ ($leads->currentPage() == 1) ? 'disabled' : '' }}">
                            <a class="btn btn-primary btn-sm me-1" href="{{ $leads->url(1) }}">First</a>
                        </li>
                        @for ($i = 1; $i <= $leads->lastPage(); $i++)
                            <li class="">
                                <a class="btn btn-primary btn-sm me-1 {{ ($leads->currentPage() == $i) ? 'active' : '' }}"
                                    href="{{ $leads->url($i) }}">{{ $i }}</a>
                            </li>
                            @endfor

                            <li>
                                <a class="btn btn-primary btn-sm mx-1 {{ ($leads->currentPage() == $leads->lastPage()) ? 'disabled' : '' }}"
                                    href="{{ $leads->url($leads->currentPage() + 1) }}">Next</a>
                            </li>


                    </ul>
                    <span class="m-0">Total {{$leads->lastPage()}} Pages</span>
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    function changeStatus(id) {
        console.log(id);
        var url = '/leadschagestatus/' + id;
        window.location.href = url;
    }
</script>
@endsection