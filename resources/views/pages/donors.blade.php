@extends('layout')

@section('title',!isset($donors) ? __('donorsPage.title', ["websiteTitle" => __('general.websiteTitle')]) : __('donorsPage.tabTitleWhileResults').' '.$searchedBloodGroup.', '.__('registerPage.wilaya').': '.$searchedWilaya.' '.__('registerPage.daira').': '.$searchedDaira )
<!-- Primary Meta Tags -->
@section('metaTitle', !isset($donors) ? __('donorsPage.title', ["websiteTitle" => __('general.websiteTitle')]) : __('donorsPage.tabTitleWhileResults').' '.$searchedBloodGroup.', '.__('registerPage.wilaya').': '.$searchedWilaya.' '.__('registerPage.daira').': '.$searchedDaira)
@section('metaDescription', __('donorsPage.pageDescription'))

<!-- Open Graph / Facebook -->
@section('metaOGurl', url()->full())
@section('metaOGtitle', !isset($donors) ? __('donorsPage.title', ["websiteTitle" => __('general.websiteTitle')]) : __('donorsPage.tabTitleWhileResults').' '.$searchedBloodGroup.', '.__('registerPage.wilaya').': '.$searchedWilaya.' '.__('registerPage.daira').': '.$searchedDaira)
@section('metaOGdescription', __('donorsPage.pageDescription'))
@section('metaOGimage', asset('imgs/vialsOfBlood.jpg'))
@section('metaOGLocale', Lang::locale() === "ar" ? Lang::locale()."_DZ" : Lang::locale()."_FR")

<!-- Twitter -->
@section('metaTwitterUrl', url()->full())
@section('metaTwitterTitle', !isset($donors) ? __('donorsPage.title', ["websiteTitle" => __('general.websiteTitle')]) : __('donorsPage.tabTitleWhileResults').' '.$searchedBloodGroup.', '.__('registerPage.wilaya').': '.$searchedWilaya.' '.__('registerPage.daira').': '.$searchedDaira)
@section('metaTwitterDescription', __('donorsPage.pageDescription'))
@section('metaTwitterImage', asset('imgs/vialsOfBlood.jpg'))

@section('head')
    @if(Route::currentRouteName() === 'donorsSearch')
        <meta name="robots" content="noindex">
    @endif
    @vite(['resources/css/donorsPage.css', 'resources/css/stats.css'])
@endsection

@section('body')
    <x-main-nav-bar donorsActive="active"/>
    <div class="separator"> </div>
    <x-search-blood-form />

    <div class="searchResult container d-flex flex-wrap gap-4 justify-content-center">

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger text-center" role="alert">
                    {{ $error }}
                </div>
            @endforeach
        @endif

        @if(isset($donors))

                @if( !count($donors))
                    <div class="alert alert-danger text-center noDonorsMsg" role="alert">
                        {{ __('donorsPage.noDonorsMsg') }}
                    </div>
                @else
                    <div class="resultTitle alert alert-success text-center fs-3" role="alert">{{ __('donorsPage.donorsSearchResultText') }} <span class="text-danger fw-bold">{{ $searchedBloodGroup }}</span> {{ __('registerPage.wilaya') }}: <span class="text-danger fw-bold">{{ $searchedWilaya }}</span>, {{ __('registerPage.daira') }}: <span class="text-danger fw-bold">{{ $searchedDaira }}</span>.</div>
                    @foreach($donors as $donor)
                        <div class="container shadow-lg donorCard d-flex flex-column">
                            <div class="donorInfo px-3 py-3 row">
                                <div class="infos col-9">
                                    <span class="text-danger fs-4"><strong class="text-dark">{{ __('registerPage.wilaya') }}: </strong>{{ $searchedWilaya }}</span>
                                    <br>
                                    <span class="text-danger fs-4"><strong class="text-dark">{{ __('registerPage.daira') }}: </strong>{{ $searchedDaira }}</span>
                                </div>

                                <div class="bloodGroup col-3 d-flex align-items-center">
                                    <span class="text-danger">{{ $searchedBloodGroup }}</span>
                                </div>
                            </div>

                            <div class="donorPhone bg-danger p-3 bg-light row">
                                <a class="col-4 d-lg-none" href="tel:{{ $donor['phone'] }}"><button class="btn btn-success w-100" type="button"><i class="fas fa-phone-alt"></i></button></a>
                                <strong class="align-items-center justify-content-center d-flex col-8 col-lg-12 text-lg-center text-success fs-4" style="user-select: all;"><i class="fas fa-phone-alt text-white d-none d-lg-inline bg-success rounded-circle phoneIcon"></i><span>{{ $donor['phone'] }}</span></strong>
                            </div>
                        </div>
                    @endforeach
                    {{ $donors->withQueryString()->links() }}
                @endif

        @endif


    </div>

    <x-stats />
    <x-footer />
@endsection

@section('beforeBodyEnd')
    @vite([
        'resources/js/donorsPage.js',
        'resources/js/donorsSearchFormValidation.js',
        'resources/js/gettingDairas.js',
    ])
@endsection
