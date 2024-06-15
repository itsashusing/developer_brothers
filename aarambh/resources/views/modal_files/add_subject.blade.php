@php
use App\Models\Category;
$category= Category::all();

@endphp

</script>
<div class="card-body p-2">
    <h5 class="mb-4">Add Subject </h5>
    <form class="row g-3" method="POST" action="{{ route('subject') }}" enctype="multipart/form-data">
        @csrf
        <div class="col-md-6">
            <div>
                <label for="category-select" class="form-label">Select Category<span class="star">★</span></label>
                <select onchange="getSubCat(this.value)" class="form-select" name="category" id="category-select">
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
                <select class="form-select" name="subcategory" id="subcategory-select">
                    <option value="">Select SubCategory</option>
                    {{-- Ajex --}}
                </select>
            </div>
        </div>

        <div class="col-md-12">
            <label for="input3" class="form-label">Subject Name<span class="star">★</span></label>
            <input type="text" id="input3" class="form-control" name="subject_name" />
        </div>
        <div class="col-md-12">
            <label class="form-label">Upload image<span class="star">★</span></label>
            <input type="file" class="form-control" name="image" />
            <span class="text-danger">Upload image in 200*200 </span>
        </div>
        <div class="col-md-12 form-group mt-4 d-flex justify-content-en d">
            <div class="d-md-flex d-grid align-items-center gap-3">
                <button type="submit" name="submit" class="btn btn-primary px-4">Submit</button>
            </div>
        </div>
    </form>
</div>
