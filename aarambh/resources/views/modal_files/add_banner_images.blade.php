<div class="card-body p-2">
    <h5 class="mb-4">Add Banner Image</h5>
    <form class="row g-3" method="POST" action="{{ route('homebanner') }}" enctype="multipart/form-data">
        @csrf
        <div class="col-md-12">
            <label for="input3" class="form-label">Description<span class="star">★</span></label>
            <input type="text" id="input3" class="form-control" name="description" />
        </div>
        <div class="col-md-12">
            <label for="input3" class="form-label">Banner Image<span class="star">★</span></label>
            <input type="file" id="input3" class="form-control" name="image" accept=".jpg,.png,.jpeg" {{-- onchange="imageValidate(this, '300', '200', '500')" --}} />
            <small class="text-danger m-0">Image allow type(jpg, jpeg, png) and size 300*200</small>
        </div>
        <div class="col-md-12 form-group mt-4 d-flex justify-content-end">
            <div class="d-md-flex d-grid align-items-center gap-3">
                <button type="submit" name="submit" class="btn btn-primary px-4">Submit</button>
            </div>
        </div>
    </form>
</div>
