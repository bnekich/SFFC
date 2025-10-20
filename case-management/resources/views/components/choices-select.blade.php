<div>
    <label for="{{ $id }}" class="block text-sm font-medium text-gray-700">{{ $label }}</label>
    <select id="{{ $id }}"
        class="choices-select mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
        name="{{ $name }}{{ $multiple ? '[]' : '' }}" data-url="{{ $url }}"
        data-note-type="{{ $noteType ?? '' }}" data-label-key="{{ $labelKey ?? 'name' }}"
        {{ $multiple ? 'multiple' : '' }}></select>
</div>
