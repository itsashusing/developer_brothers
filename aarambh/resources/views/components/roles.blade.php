<div class="{{ $class }}">
    <label for="{{ $id }}" class="form-label">{{ $label }}</label>
    <select id="{{ $id }}" name="{{ $name }}" @required(true) class="form-select">
        <option value="">{{ $defaultSelect }}</option>
        @foreach ($query as $item1)
            <option {{ $value == $item1->id ? 'selected' : '' }} value="{{ $item1->id }}">
                {{ $item1->role_name }}</option>
        @endforeach
    </select>
</div>
