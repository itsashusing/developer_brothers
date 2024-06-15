@extends('template')
@section('content')
    @php
        use App\Helper\PermissionHelper;
        $p = new PermissionHelper();
        $field_array = [
            'Dashboard' => [
                'route_name' => 'admin_dashboard',
                'view' => '1',
                'create' => '1',
                'edit' => '1',
                'activeInactive' => '1',
            ],
            'Users List' => [
                'route_name' => 'users_lists',
                'view' => '1',
                'create' => '1',
                'edit' => '1',
                'activeInactive' => '1',
            ],
            'Payment Request' => [
                'route_name' => 'payment_requests',
                'view' => '1',
                'create' => '1',
                'edit' => '1',
                'activeInactive' => '1',
            ],
            'Withdrawal Request' => [
                'route_name' => 'withdrawal_requests',
                'view' => '1',
                'create' => '1',
                'edit' => '1',
                'activeInactive' => '1',
            ],
            'UPI Setting' => [
                'route_name' => 'upi_setting',
                'view' => '1',
                'create' => '1',
                'edit' => '1',
                'activeInactive' => '1',
            ],
            'Contact US' => [
                'route_name' => 'contact_us',
                'view' => '1',
                'create' => '1',
                'edit' => '1',
                'activeInactive' => '1',
            ],
            'Banner Image' => [
                'route_name' => 'banner_image',
                'view' => '1',
                'create' => '1',
                'edit' => '1',
                'activeInactive' => '1',
            ],
            'Terms & Conditions' => [
                'route_name' => 'terms_condition',
                'view' => '1',
                'create' => '1',
                'edit' => '1',
                'activeInactive' => '1',
            ],
            'Privacy Policy' => [
                'route_name' => 'privacy_policy',
                'view' => '1',
                'create' => '1',
                'edit' => '1',
                'activeInactive' => '1',
            ],
            'About US' => [
                'route_name' => 'about_us',
                'view' => '1',
                'create' => '1',
                'edit' => '1',
                'activeInactive' => '1',
            ],
        ];
    @endphp

    <div class="card">
        <div class="card-body p-4">
            <h5 class="mb-4">Permission</h5>
            <form class="row g-3" method="POST">
                @csrf
                <div class="col-md-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Page Name</th>
                                <th>View</th>
                                <th>Add</th>
                                <th>Edit</th>
                                <th>Active / Inactive</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($field_array as $key => $value)
                                <tr>
                                    <td>{{ $key }}</td>
                                    @foreach ($value as $value_key => $value_item)
                                        @if ($value_key !== 'route_name')
                                            <td>
                                                <div class="form-check form-switch ml-3 m-0">
                                                    <input type="checkbox"
                                                        {{ $p->roleId($page_data['role_id'])->getPermission($value['route_name'], $value_key) == 1 ? 'checked' : '' }}
                                                        name="insert_array[{{ $value['route_name'] }}][{{ $value_key }}]"
                                                        id="{{ $value_key . '_' . $key }}"
                                                        onclick="checkBox('{{ $value_key . '_' . $key }}')"
                                                        value="{{ $value_item }}" class="form-check-input" role="switch">
                                                </div>
                                            </td>
                                        @endif
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-md-12 form-group mt-4 d-flex justify-content-end">
                    <div class="d-md-flex d-grid align-items-center gap-3">
                        <button type="submit" name="submit" class="btn btn-primary px-4">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        function checkBox(elementId) {
            var entityName = elementId.split('_').pop();
            var viewCheckBoxesArray = document.querySelectorAll('[id$="' + entityName + '"]');
            var getViewCheckBox = document.getElementById(viewCheckBoxesArray[0].id);
            var getAddCheckBox = document.getElementById(viewCheckBoxesArray[1].id);
            var getEditCheckBox = document.getElementById(viewCheckBoxesArray[2].id);
            var getActiveInactiveCheckBox = document.getElementById(viewCheckBoxesArray[3].id);

            if (getAddCheckBox.checked == true || getEditCheckBox.checked == true || getActiveInactiveCheckBox.checked ==
                true) {
                getViewCheckBox.checked = true;
                getViewCheckBox.disabled = true;
            } else {
                getViewCheckBox.disabled = false;
            }
        }
    </script>
@endsection
