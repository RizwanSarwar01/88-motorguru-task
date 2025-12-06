@props(['id', 'name', 'options', 'selectedOption', 'placeholder'])

<select 
    name="{{ $name }}" 
    id="{{ $id }}" 
    class="block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
>
    <option value="">{{ $placeholder }}</option>
    @foreach ($options as $option)
        <option value="{{ $option->id }}" {{ old($name, $selectedOption) == $option->id ? 'selected' : '' }}>
            {{ $option->name }}
        </option>
    @endforeach
</select>
