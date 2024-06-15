@php
use App\Models\Category;
$category= Category::where('status',1)->get();

@endphp

<div class="card-body p-2">
    <h5 class="mb-4">Add Subcription </h5>

    <form class="row g-3" method="POST" action="{{ route('subscription') }}">
        @csrf
        <div class="col-md-6">
            <div>
                <label for="category-select" class="form-label">Select Category<span class="star">★</span></label>
                <select onchange="getSubCat(this.value)" class="form-select" required name="category" id="category-select">
                    <option value="">Select Category</option>
                    @foreach ($category as $item)
                    <option value="{{$item->id}}">{{$item->category_name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div>
                <label class="form-label">Select Sub Category<span class="star">★</span></label>
                <select class="form-select" name="subcategory" required id="subcategory-select">
                    <option value="">Select SubCategory</option>
                    {{-- Ajex --}}
                </select>
            </div>
        </div>
        <div class="col-md-12">
            <label for="input3" class="form-label">Subscription<span class="star">★</span></label>
            <input type="text" id="input3" class="form-control" name="subscription" required />
        </div>
        <div class="col-md-12">
            <label class="form-label">Cost<span class="star">★</span></label>
            <input type="number" class="form-control" name="cost" required />
        </div>
        <div class="col-md-12">
            <label class="form-label">Duration (Days)<span class="star">★</span></label>
            <input type="number" class="form-control" name="duration" required />
        </div>
        <div class="col-md-12 form-group mt-4 d-flex justify-content-en d">
            <div class="d-md-flex d-grid align-items-center gap-3">
                <button type="submit" name="submit" class="btn btn-primary px-4">Submit</button>
            </div>
        </div>
    </form>
</div>
