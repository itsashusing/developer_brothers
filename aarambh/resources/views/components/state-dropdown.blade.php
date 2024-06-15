<div class="{{ $class }}">
    <label for="{{ $id }}" class="form-label">{{ $label }}</label> <span class="star">★</span>
    <select id="{{ $id }}" name="{{ $name }}"
        onchange="print_response('{{ $url }}', sendObj({'_token' : '{{ csrf_token() }}', 'id' : this.value}), '#{{ $nextFieldId }}')"
        @required(true) class="form-select">
        <option value="">{{ $defaultSelect }}</option>
        @if ($value !== '')
            @foreach ($query as $item1)
                <option {{ $value == $item1->id ? 'selected' : '' }} value="{{ $item1->id }}">
                    {{ $item1->state_name }}</option>
            @endforeach
        @endif
    </select>
</div>
