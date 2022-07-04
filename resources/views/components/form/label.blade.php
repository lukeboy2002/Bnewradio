@props(['name'])

<label for="{{ $name }}"
       class="block text-xs font-medium text-gray-900"
>
    {{ ucwords($name) }}
</label>
