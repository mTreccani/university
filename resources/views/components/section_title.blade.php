@props(['showBackButton' => false, 'link' => null, 'linkTitle' => null])

<div class="border-bottom d-flex flex-row justify-content-between align-items-baseline border-primary">
    <div class="d-flex flex-row align-items-center">
        @if($showBackButton)
            <a href="{{ url()->previous() }}" class="link-primary text-decoration-none">
                <img src="{{ asset('icons/chevron_left.svg') }}">
                {{ __('Indietro') }}
            </a>
        @endif
        <h3 class="text-primary fw-bold">{{ $slot ?? '' }}</h3>
    </div>
    @if(isset($link) && isset($linkTitle))
        <a href="{{ $link }}" class="link-primary text-decoration-none">
            {{ $linkTitle }}
            <img src="{{ asset('icons/chevron_right.svg') }}">
        </a>
    @endif
</div>
