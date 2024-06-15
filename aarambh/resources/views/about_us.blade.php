@extends('template')
@section('content')
    <script src="{{ asset('public/assets/js/my/ckeditor/ckeditor.js') }}"></script>
    <h6 class="mb-0 text-uppercase">{{ $page_data['page_title'] }}</h6>
    <hr />
    <div class="card">
        <div class="card-body">
            <h3 class="mb-3 bg-dark text-light info_data" style="height: 54px; padding: 15px; font-size: 20px">
                {{ $page_data['page_title'] }}
            </h3>
            <form method="POST">
                @csrf
                <textarea name="description" class="ckeditor">{{ $page_data['get_table']->value('description') }}</textarea>
                <div class="form-group mt-4 d-flex justify-content-end">
                    <button type="submit" name="submit" value="{{ $page_data['get_table']->value('id') }}"
                        class="btn btn-primary px-4 mb-4"><i class='bx bx-plus me-0'></i>Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection
