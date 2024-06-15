<div class="{{ $class }}">
    <label for="{{ $id }}" class="form-label">{{ $label }}</label> <span class="star">★</span>
    <select id="{{ $id }}" name="{{ $name }}" class="form-select" {{ $required == "true" ? "required" : "" }}>
        <option value="">{{ $defaultSelect }}</option>
        @foreach ($query as $item1)
        <option {{ $value == $item1->id ? 'selected' : '' }} value="{{ $item1->id }}">
            {{ $item1->name }}
        </option>
        @endforeach
    </select>
</div>