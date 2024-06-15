@php
use App\Models\Gallery;
$gallery= Gallery::find($request['id']);
@endphp
<div class="card-body p-2">
    <h5 class="mb-4">Edit Gallery Item </h5>
    <form class="row g-3" method="POST" action="{{ route('gallery') }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="col-md-12">
            <input type=" text" hidden name="id" value="{{$gallery->id}}">
            <label for="input3" class="form-label">Title<span class="star">★</span></label>
            <input type="text" id="input3" class="form-control" name="title" value="{{$gallery->title}}" />
        </div>
        <div class="col-md-12">
            <label class="form-label">File<span class="star">★</span></label>
            <input type="file" class="form-control" name="video" accept=".mp4" />
        </div>
        <div class="col-md-12 form-group mt-4 d-flex justify-content-en d">
            <div class="d-md-flex d-grid align-items-center gap-3">
                <button type="submit" name="submit" class="btn btn-primary px-4">Submit</button>
            </div>
        </div>
    </form>
</div>
