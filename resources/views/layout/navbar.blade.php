<nav class="navbar navbar-expand-md navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Sewa Buku</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                @if (Auth::check() && Auth::user())
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('dashboard') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('buku.index') }}">Data Buku</a>
                    </li>
                @endif

                @if (Auth::check() && Auth::user()->level == 'admin')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('data_peminjam') }}">Data Peminjam</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('peminjaman') }}">Peminjaman</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.index') }}">User</a>
                    </li>
                @endif
            </ul>

            @if (Auth::check())
                <div class="d-flex align-items-center mx-3">
                    Hai,
                    <strong>
                        {{ Auth::user()->name }}
                    </strong>
                </div>
            @endif
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    this.closest('form').submit();"
                    class="btn btn-danger">Log Out</a>
            </form>
        </div>
    </div>
</nav>
