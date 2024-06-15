@php
use App\Models\SubCategory;
use App\Models\Category;
$sbcategory= SubCategory::find($request['id']);
$category= Category::where('status',1)->get();
@endphp
<div class="card-body p-2">
    <h5 class="mb-4">Edit Category </h5>
    <form class="row g-3" method="POST" action="{{ route('subcategory') }}">
        @csrf
        @method('PUT')
        <div class="col-md-12">
            <select class="form-select" name="category">
                @foreach ($category as $item)
                <option {{ ($item->id == $sbcategory->category_id) ? 'selected' : '' }} value="{{$item->id}}">{{$item->category_name}}</option>
                @endforeach
            </select>
            <label for="input3" class="form-label">Sub Category Name<span class="star">★</span></label>
            <input type="text" hidden name="id" value="{{$sbcategory->id}}">
            <input type="text" id="input3" class="form-control" name="subcategory" value="{{$sbcategory->sub_category_name}}" />
        </div>
        <div class="col-md-12 form-group mt-4 d-flex justify-content-end">
            <div class="d-md-flex d-grid align-items-center gap-3">
                <button type="submit" name="submit" class="btn btn-primary px-4">Submit</button>
            </div>
        </div>
    </form>
</div>
