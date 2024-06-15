<div class="card-body p-2">
    <h5 class="mb-4">Add Category </h5>
    <form class="row g-3" method="POST" action="{{ route('category') }}">
        @csrf
        <div class="col-md-12">
            <label for="input3" class="form-label">Category Name<span class="star">★</span></label>
            <input type="text" id="input3" class="form-control" name="category" />
        </div>
        <div class="col-md-12 form-group mt-4 d-flex justify-content-en d">
            <div class="d-md-flex d-grid align-items-center gap-3">
                <button type="submit" name="submit" class="btn btn-primary px-4">Submit</button>
            </div>
        </div>
    </form>
</div>
