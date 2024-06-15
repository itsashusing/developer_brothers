@php $admin_login = \App\Models\Admin_login::where('id', session()->get('id'))->first(); @endphp

<div class="card-body p-2">
    <h5 class="mb-4">Admin Profile</h5>
    <form class="row g-3" method="POST" action="{{ route('change_email') }}">
        @csrf
        <div class="col-md-12">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" value="{{ $admin_login->name }}" class="form-control" id="name" placeholder="Please enter name" @required(true)>
        </div>
        <div class="col-md-12">
            <label for="email_id_validate" class="form-label">Email</label>
            <input type="text" name="email_id" oninput="emailChangeListner('{{ $admin_login->email }}')" value="{{ $admin_login->email }}" class="form-control" id="email_id_validate" placeholder="Please enter email" @required(true)>
        </div>
        <div class="col-md-12">
            <label for="mobile_number" class="form-label">Mobile Number</label>
            <input type="text" name="mobile_number" value="{{ $admin_login->mobile }}" class="form-control" id="mobile_number" placeholder="Please enter mobile number" @required(true)>
        </div>
        <div class="col-md-12 d-none" id="otp_admin">
            <label for="otp" class="form-label">OTP</label>
            <input type="text" name="otp" class="form-control" id="otp" placeholder="Please enter OTP">
            <p id="timer"></p>
        </div>
        <div class="col-md-12">
            <label for="profile_image" class="form-label">Profile Image</label> <span class="star">★</span>
            <input type="file" id="profile_image" class="form-control" name="profile_image" accept=".jpg,.png,.jpeg" onchange="validateSquareImage(this, '500')" />
            <small class="text-danger m-0">Image allow type(jpg, jpeg, png) and Only square image</small>
        </div>

        <div class="col-md-12 form-group mt-4 d-flex justify-content-end">
            <div class="d-md-flex d-grid align-items-center gap-3">
                <button type="button" id="send_otp_btn" onclick="send_otp(); ajaxSend('{{ url('admin/change_email') }}', sendObj({'send_email' : true, 'email_id' : getValueToForm('email_id'), '_token' : '{{ csrf_token() }}'}));" name="submit_change_password" class="btn btn-primary px-4 d-none">Send OTP</button>
                <button type="submit" id="submit_btn" name="submit" class="btn btn-primary px-4">Submit</button>
            </div>
        </div>
    </form>
</div>
