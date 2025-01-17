<nav class="navbar navbar-expand-xl navbar-light bg-white shadow-sm sticky-lg-top">
    <div class="container">
        <a class="navbar-brand" href="{{ url('') }}">
            <img src="{{ asset(Lang::locale() === "ar" ? 'imgs/linatabara3Logo.png' : 'imgs/linatabara3LogoAscii.png') }}" alt="Linatabara3 Logo" height="40px">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between" id="navbarToggler">

            <div class="languageSwitcher text-center">
                <a href="{{ LaravelLocalization::getLocalizedURL(LaravelLocalization::getCurrentLocaleNative() === 'Français' ? 'ar' : 'fr', null, [], true) }}" style="{{ LaravelLocalization::getCurrentLocale() === 'fr' ? "font-family: 'Noto Kufi Arabic', sans-serif;" : "font-family: 'Nunito', sans-serif;" }}" class="px-3 mt-2 mt-lg-0 btn btn-danger btn-sm py-1">{{ LaravelLocalization::getCurrentLocaleNative() === 'Français' ? 'العربية' : 'Francais' }}</a>
            </div>

            <ul class="navbar-nav mb-2 mb-lg-0 fw-bold">
                <li class="nav-item">
                    <a class="nav-link {{ $homeActive ?? '' }}" aria-current="page" href="{{ route('homePage') }}">{{ __('homePage.home') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $donorsActive ?? '' }}" href="{{ route('donorsPage') }}">{{ __('homePage.donors') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $aboutActive ?? '' }}" href="{{ route('aboutPage') }}">{{ __('homePage.about') }}</a>
                </li>
                <li class="nav-item">

                    <button type="button" class="nav-link btn btn-link" data-bs-toggle="modal" data-bs-target="#contactModal">
                        {{ __('homePage.contact') }}
                    </button>

                </li>
            </ul>

            @auth
            <div class="dropdown d-flex justify-content-center">
                <button class="btn btn-danger dropdown-toggle" type="button" id="accountDropDownMenu" data-bs-toggle="dropdown" aria-expanded="false">{{ Auth::user()->email }}</button>
                <ul class="dropdown-menu" aria-labelledby="accountDropDownMenu">
                    <li><a class="dropdown-item" href="{{ route('dashboard') }}">{{ __('homePage.myAccount') }}</a></li>

                    <li>
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <input class="dropdown-item" type="submit" value="{{ __('general.logOut') }}">
                        </form>
                    </li>

                </ul>
            </div>
            @else
            <div class="d-flex flex-column flex-xl-row">
                <a href="{{ route('register') }}" class="btn btn-danger px-4 py-2 fw-bold d-flex align-items-center">{{ __('homePage.register') }} <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-suit-heart-fill" viewBox="0 0 16 16">
                        <path d="M4 1c2.21 0 4 1.755 4 3.92C8 2.755 9.79 1 12 1s4 1.755 4 3.92c0 3.263-3.234 4.414-7.608 9.608a.513.513 0 0 1-.784 0C3.234 9.334 0 8.183 0 4.92 0 2.755 1.79 1 4 1z"/></svg></a>
                <a href="{{ route('login') }}" class="text-dark text-decoration-none d-flex align-items-center justify-content-center mt-3 ms-xl-4 mt-xl-0">{{ __('homePage.myAccount') }}</a>
            </div>
            @endauth

        </div>
    </div>
</nav>

