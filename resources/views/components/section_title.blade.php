<div class="border-bottom d-flex flex-row justify-content-between align-items-baseline border-primary">
    <h3 class="text-primary fw-bold">{{ $title }}</h3>
    @if($link && $linkTitle)
        <a href="{{ $link }}" class="link-primary text-decoration-none">
            {{ $linkTitle }}
            <img src="{{ asset('icons/chevron_right.svg') }}">
        </a>
    @endif
</div>
