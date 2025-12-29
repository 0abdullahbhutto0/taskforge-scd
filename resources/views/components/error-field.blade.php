@props(['name'])

@error($name)
    <p class="text-red-500 font-extralight m-2">{{ $message }}</p>
@enderror
