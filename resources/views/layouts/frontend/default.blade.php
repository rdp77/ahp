@include('layouts.components.header')

<body>
    @include('layouts.frontend.components.nav')
    @include('layouts.frontend.components.hero')
    @include('layouts.frontend.components.callout')
    @include('layouts.frontend.components.feature')
    @include('layouts.frontend.components.search')
    @include('layouts.frontend.components.rate')
    @include('layouts.frontend.components.footer')
    @include('layouts.frontend.components.feedback')
    @include('layouts.components.footer')
    @yield('script')
</body>

</html>