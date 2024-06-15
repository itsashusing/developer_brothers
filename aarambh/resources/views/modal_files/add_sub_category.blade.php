@php
use App\Models\Category;
$category= Category::where('status',1)->get();

@endphp

<div class="card-body p-2">
    <h5 class="mb-4">Add Sub Category </h5>
    <form class="row g-3" method="POST" action="{{ route('subcategory') }}">
        @csrf
        <select class="form-select" name="category">
            @foreach ($category as $item)
            <option value="{{$item->id}}">{{$item->category_name}}</option>
            @endforeach
        </select>
        <div class="col-md-12">
            <label for="input3" class="form-label">SubCategory Name<span class="star">★</span></label>
            <input type="text" id="input3" class="form-control" name="subcategory" />
        </div>
        <div class="col-md-12 form-group mt-4 d-flex justify-content-en d">
            <div class="d-md-flex d-grid align-items-center gap-3">
                <button type="submit" name="submit" class="btn btn-primary px-4">Submit</button>
            </div>
        </div>
    </form>
</div>
