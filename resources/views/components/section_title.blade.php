@props(['backRoute' => null, 'link' => null, 'linkTitle' => null])

<div class="border-bottom d-flex flex-row justify-content-between align-items-baseline border-primary">
    <div class="d-flex flex-row align-items-center mb-2">
        @if(isset($backRoute))
            <a href="{{ $backRoute }}" class="icon-button-border me-2">
                <img src="{{ asset('icons/chevron_left.svg') }}">
            </a>
        @endif
        <h3 class="text-primary fw-bold m-0">{{ $slot ?? '' }}</h3>
    </div>
    @if(isset($link) && isset($linkTitle))
        <a href="{{ $link }}" class="link-primary text-decoration-none">
            {{ $linkTitle }}
            <img src="{{ asset('icons/chevron_right.svg') }}">
        </a>
    @endif
</div>
