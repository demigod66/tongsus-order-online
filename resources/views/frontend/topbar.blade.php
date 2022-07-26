<body>
    <div class="body">

        <div class="main-wrapper">
            <!-- Navigation-->
            <nav class="navbar navbar-fixed-top">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">
                        <img src="{{ asset('frontend/img/nav-logo.jpg') }}" width="80px" height="80px" alt="nav-logo">
                    </a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="{{ url('/') }}">Beranda</a></li>
                        <li><a href="{{ url('/halaman/list-produk')}}">Produk</a></li>
                        <li><a href="#">Contact</a></li>
                        @if (Auth::guest())
                        <li><a href="{{ route('login') }}">Login</a></li>
                        <li><a href="{{ route('register') }}">Register</a></li>
                        @endif
                        @if (Auth::check())
                        <li><a href="{{ url('/lihat-keranjang') }}">Keranjang</a></li>
                        <li><a href="{{ url('akun/pesanan ') }}">Akun</a></li>
                        <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">Logout</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form></li>
                        @endif
                    </ul>
                </div>
                <!--/.navbar-collapse -->
            </div>
        </nav>
