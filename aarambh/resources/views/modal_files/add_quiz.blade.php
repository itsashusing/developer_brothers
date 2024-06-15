@php
use App\Models\Test;
$test= Test::find($request['id'])
@endphp

<div class="card-body p-2">
    <h5 class="mb-4">Add Quiz </h5>
    <form class="row g-3" method="POST" action="{{ route('quiz') }}">
        @csrf
        <div class="col-md-12">
            <input type="text" hidden name="id" value="{{$test->id}}">
            <label for="input3" class="form-label">Question<span class="star">★</span></label>
            <input type="text" id="input3" class="form-control" name="question" />
        </div>
        <div class="col-md-6">
            <label for="input3" class="form-label">Option 1<span class="star">★</span></label>
            <input type="text" id="input3" class="form-control" name="option1" />
        </div>
        <div class="col-md-6">
            <label for="input3" class="form-label">Option 2<span class="star">★</span></label>
            <input type="text" id="input3" class="form-control" name="option2" />
        </div>
        <div class="col-md-6">
            <label for="input3" class="form-label">Option 3<span class="star">★</span></label>
            <input type="text" id="input3" class="form-control" name="option3" />
        </div>
        <div class="col-md-6">
            <label for="input3" class="form-label">Option 4<span class="star">★</span></label>
            <input type="text" id="input3" class="form-control" name="option4" />
        </div>
        <div class="col-md-12">
            <label for="input3" class="form-label">Right Answer<span class="star">★</span></label>
            <select class="form-select" name="right_answer">
                <option> Select option</option>
                <option value="1">Option 1</option>
                <option value="2">Option 2</option>
                <option value="3">Option 3</option>
                <option value="4">Option 4</option>
            </select>
        </div>
        <div class="col-md-12 form-group mt-4 d-flex justify-content-en d">
            <div class="d-md-flex d-grid align-items-center gap-3">
                <button type="submit" name="submit" class="btn btn-primary px-4">Submit</button>
            </div>
        </div>
    </form>
</div>
