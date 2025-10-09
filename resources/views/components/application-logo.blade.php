@props(['alt' => 'Logo'])

<img
    src="{{ asset('storage/images/book.png') }}"
    alt="{{ $alt }}"
    title="logo_home"
    {{ $attributes->merge(['class' => 'h-10 w-auto']) }}>
