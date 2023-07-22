<div class="navbar">
    <img src="{{ asset('images/logo.svg') }}" alt="logo">
    <div class="d-flex flex-row align-items-center justify-content-end">
        <div style="min-width: 100px"><x-language /></div>
        <span class="fw-bold d-none d-md-block mx-3 text-nowrap">{{ auth()->user()->fullName() }}</span>
        <form id="logout-form" action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="icon-button" type="submit">
                <img src="{{ asset('icons/logout.svg') }}" alt="logout">
            </button>
        </form>
    </div>
</div>
