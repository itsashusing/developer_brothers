@php
use App\Models\Category;
$category= Category::find($request['id']);
@endphp
<div class="card-body p-2">
    <h5 class="mb-4">Edit Category </h5>
    <form class="row g-3" method="POST" action="{{ route('category') }}">
        @csrf
        @method('PUT')
        <div class="col-md-12">
            <label for="input3" class="form-label">Category Name<span class="star">★</span></label>
            <input type="text" hidden name="id" value="{{$category->id}}">
            <input type="text" id="input3" class="form-control" name="category" value="{{$category->category_name}}" />
        </div>
        <div class="col-md-12 form-group mt-4 d-flex justify-content-end">
            <div class="d-md-flex d-grid align-items-center gap-3">
                <button type="submit" name="submit" class="btn btn-primary px-4">Submit</button>
            </div>
        </div>
    </form>
</div>
