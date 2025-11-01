<div class="ltn__breadcrumb-area ltn__breadcrumb-area-2 ltn__breadcrumb-color-white bg-overlay-theme-black-90 bg-image pt-115 pb-110" data-bg="{{ asset('assets/client/img/bg/9.jpg') }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="ltn__breadcrumb-inner ltn__breadcrumb-inner-2 justify-content-between">
                    <div class="section-title-area ltn__section-title-2">
                        <h1 class="section-title white-color">@yield('breadcrumb')</h1>
                    </div>
                    <div class="ltn__breadcrumb-list">
                        <ul>
                            <li><a href="/">Home</a></li>
                            <li>@yield('breadcrumb')</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>