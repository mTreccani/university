<div class="offcanvas offcanvas-start show"
     data-bs-backdrop="false"
     tabindex="-1"
     id="offcanvas"
>
    <div class="d-flex justify-content-end p-3">
        <button type="button" class="btn-close text-reset d-md-none" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="offcanvas-user">
            <div class="offcanvas-user-image">
                <img src="{{ asset('images/logo.svg') }}" alt="Logo" />
            </div>
            <div class="offcanvas-user-name">
                <span class="fw-bold">Matteo Treccani</span>
                <a href="{{ route('login') }}" class="text-sm">Logout</a>
            </div>
        </div>
        <a class="offcanvas-item" href="{{ route('student.dashboard', 'A') }}">Dashboard</a>
        <a class="offcanvas-item" href="{{ route('student.career', 'A') }}">Career</a>
        <a class="offcanvas-item" href="{{ route('student.bookings', 'A') }}">Bookings</a>
    </div>
</div>

<script>
    const myOffcanvas = document.getElementById('offcanvas')
    myOffcanvas.addEventListener('hide.bs.offcanvas', event => {
        if (window.innerWidth > 768) {
            event.preventDefault()
        }
    });
    window.addEventListener('resize', () => {
        if (window.innerWidth > 768) {
            myOffcanvas.classList.add('show')
        }
    });
</script>
