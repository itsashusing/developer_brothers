<div class="{{ $class }}">
    <label for="{{ $id }}" class="form-label">{{ $label }}</label> <span class="star">★</span>
    <select id="{{ $id }}" name="{{ $name }}"
        onchange="print_response('{{ $url }}', sendObj({'_token' : '{{ csrf_token() }}', 'id' : this.value}), '#{{ $nextFieldId }}')"
        class="form-select" @required(true)>
        <option value="">{{ $defaultSelect }}</option>
        @foreach ($query as $item1)
            <option {{ $value == $item1->id ? 'selected' : '' }} value="{{ $item1->id }}">
                {{ $item1->country_name }}</option>
        @endforeach
    </select>
</div>
