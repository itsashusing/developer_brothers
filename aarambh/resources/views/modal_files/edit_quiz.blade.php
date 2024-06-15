@php
use App\Models\Quiz;
$quiz= Quiz::find($request['id']);
@endphp
<div class="card-body p-2">
    <h5 class="mb-4">Edit Quiz </h5>
    <form class="row g-3" method="POST" action="{{ route('quiz') }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="col-md-12">
            <input type=" text" hidden name="id" value="{{$quiz->id}}">
            <label for="input3" class="form-label">Question<span class="star">★</span></label>
            <input type="text" id="input3" class="form-control" name="question" value="{{$quiz->question}}" />
        </div>
        <div class="col-md-6">
            <label for="input3" class="form-label">Option 1<span class="star">★</span></label>
            <input type="text" id="input3" class="form-control" name="option1" value="{{$quiz->option1}}" />
        </div>
        <div class="col-md-6">
            <label for="input3" class="form-label">Option 2<span class="star">★</span></label>
            <input type="text" id="input3" class="form-control" name="option2" value="{{$quiz->option2}}" />
        </div>
        <div class="col-md-6">
            <label for="input3" class="form-label">Option 3<span class="star">★</span></label>
            <input type="text" id="input3" class="form-control" name="option3" value="{{$quiz->option3}}" />
        </div>
        <div class="col-md-6">
            <label for="input3" class="form-label">Option 4<span class="star">★</span></label>
            <input type="text" id="input3" class="form-control" name="option4" value="{{$quiz->option4}}" />
        </div>
        <div class="col-md-12">
            <select class="form-select" name="right_answer">
                <option {{$quiz->right_answer==1 ? "selected": ''}} value="1">Option 1</option>
                <option {{$quiz->right_answer==2 ? "selected": ''}} value="2">Option 2</option>
                <option {{$quiz->right_answer==3 ? "selected": ''}} value="3">Option 3</option>
                <option {{$quiz->right_answer==4 ? "selected": ''}} value="4">Option 4</option>
            </select>
        </div>
        <div class="col-md-12 form-group mt-4 d-flex justify-content-en d">
            <div class="d-md-flex d-grid align-items-center gap-3">
                <button type="submit" name="submit" class="btn btn-primary px-4">Submit</button>
            </div>
        </div>
    </form>
</div>
