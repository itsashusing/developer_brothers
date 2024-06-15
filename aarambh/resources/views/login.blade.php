<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('header_link')
    {{-- <title>{{ $page_data['page_title'] }} | Project</title> --}}
</head>

<body>
    <!--wrapper-->
    <div class="wrapper">
        <div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
            <div class="container">
                <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
                    <div class="col mx-auto">
                        <div class="card mb-0">
                            <div class="card-body">
                                <div class="p-4">
                                    <div class="mb-2 text-center">
                                        {{-- <img src="{{ asset('public/assets/images/app/logo.jpeg') }}" width="130"
                                            alt="logo" /> --}}
                                        <h2>App Logo</h2>
                                    </div>
                                    <div class="text-center mb-4">
                                        <p class="mb-0">Please log in to your account</p>
                                    </div>
                                    <div class="form-body">
                                        <form class="row g-3" method="POST" action="{{route('login')}}">
                                            @csrf
                                            {{-- <div class="col-12">
                                                <label for="role_id" class="form-label">Role</label>
                                                @php $get_table = \App\Models\Role::where('status', '1')->get(); @endphp
                                                <select name="role_id" id="role_id" class="form-select">
                                                    <option value="admin">Admin</option>
                                                    @foreach ($get_table as $row)
                                                        <option value="{{ $row->id }}">{{ $row->role_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div> --}}
                                            <div class="col-12">
                                                <label for="inputEmailAddress" class="form-label">Email</label>
                                                <input type="email" name="email" value="{{ old('email') }}"
                                                    class="form-control" id="inputEmailAddress"
                                                    placeholder="xyz@gmail.com">
                                            </div>
                                            <div class="col-12">
                                                <label for="inputChoosePassword" class="form-label">Password</label>
                                                <div class="input-group" id="show_hide_password">
                                                    <input type="password" name="password" value="{{ old('password') }}"
                                                        class="form-control border-end-0" id="inputChoosePassword"
                                                        placeholder="Enter Password">
                                                    <a onclick="show_hide_password('show_hide_password')"
                                                        href="javascript:;" class="input-group-text bg-transparent">
                                                        <i class='bx bx-hide'></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                {{-- <a href="{{ route('forgot_password') }}">Forgot Password ?</a> --}}
                                            </div>
                                            <div class="col-12">
                                                <div class="d-grid">
                                                    <button type="submit" name="submit" class="btn btn-primary">Sign
                                                        in</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('footer_link')
    @include('toaster')
</body>

</html>
