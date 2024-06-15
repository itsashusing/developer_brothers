@php
use App\Models\Category;
use App\Models\SubCategory;
$category= Category::where('status',1)->with('subcategory')->get();
@endphp

@extends('template')
@section('content')
<script src="{{ asset('public/assets/js/my/ckeditor/ckeditor.js') }}"></script>
<h6 class="mb-0 text-uppercase">{{$page_data['page_title']}}</h6>
<hr />
<div class="card">
    <div class="card-body">
        {{$page_data['get_table']}}

        <form class="row g-3" method="POST" action="{{route('addnews')}}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="col-md-6">
                <div>
                    <label for="category-select" class="form-label">Select Category<span class="star">★</span></label>
                    <select onchange="getSubCat(this.value)" class="form-select" name="category" id="category-select">
                        <option value="">Select Category</option>
                        @foreach ($category as $item)
                        <option {{($item->id == $page_data['get_table']->category_id ) ? 'selected' : ''}} value="{{$item->id}}">{{$item->category_name}}</option>
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
            <div class="col-md-12 md-3">
                <input type="text" name="id" value="{{$page_data['get_table']->id}}">
                <label for="input3" class="form-label">Title<span class="star">★</span></label>
                <input type="text" id="input3" class="form-control" name="title" value="{{$page_data['get_table']->title}}" />
            </div>
            <div class="col-md-12 md-3">
                <label for="input3" class="form-label">Description<span class="star">★</span></label>
                <textarea name="description" class="ckeditor" cols="30" rows="10">{{$page_data['get_table']->description }}</textarea>
            </div>
            <div class="col-md-12 md-3">
                <label class="form-label">Image<span class="star">★</span></label>
                <input type="file" class="form-control" accept=".jpg,.png,.jpeg" name="image" />
            </div>
            <div class="form-group mt-4 d-flex justify-content-end">
                <button type="submit" name="submit" class="btn btn-primary px-4 mb-4"><i class='bx bx-plus me-0'></i>Save</button>
            </div>
        </form>
    </div>
</div>
@endsection
