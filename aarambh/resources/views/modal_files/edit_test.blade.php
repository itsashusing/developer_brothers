@php
use App\Models\Test;
use App\Models\Subject;

$test= Test::find($request['id']);

@endphp

<div class="card-body p-2">
    <h5 class="mb-4">Edit Test </h5>
    <form class="row g-3" method="POST" action="{{ route('test')}}">
        @csrf
        @method('PUT')
        <div class="col-md-12">
            <input type="text" hidden name="id" value="{{$test->id}}">
            <label for="input3" class="form-label">Set Name<span class="star">★</span></label>
            <input type="text" id="input3" class="form-control" name="set" value="{{$test->set}}" />
            <input type="text" hidden name="subject_id" value="{{$test->subject_id}}">
        </div>
        <div class="col-md-12">
            <label class="form-label">Total question<span class="star">★</span></label>
            <input type="text" class="form-control" name="total_question" value="{{$test->total_question}}" />

        </div>

        <div class="col-md-12 form-group mt-4 d-flex justify-content-en d">
            <div class="d-md-flex d-grid align-items-center gap-3">
                <button type="submit" name="submit" class="btn btn-primary px-4">Submit</button>
            </div>
        </div>
    </form>
</div>
