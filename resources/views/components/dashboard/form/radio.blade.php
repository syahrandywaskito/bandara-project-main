{{-- @props(['id', 'for', 'value', 'name']) --}}

<div class="flex items-center justify-center ps-4">
    <input id="{{ $id }}" type="radio" value="{{ $value }}" name="{{ $name }}" class="w-4 h-4 text-secondary-light bg-base-light border-base-dark" {{ $checked === 'checked' ? 'checked' : '' }}>
    <label for="{{ $id }}" class="w-full ms-2 py-1.5 text-xs md:text-sm font-medium text-base-dark hover:text-indigo-500">
        {{ $slot }}
    </label>
</div>