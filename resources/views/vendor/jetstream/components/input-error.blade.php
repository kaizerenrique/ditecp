@props(['for'])

@error($for)
    <p {{ $attributes->merge(['class' => 'text-sm dark:text-white']) }}>{{ $message }}</p>
@enderror
