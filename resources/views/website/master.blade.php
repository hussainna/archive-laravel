 <!DOCTYPE html>
    <html lang="en">
    <head>
    <meta name="csrf-token" content="{{csrf_token()}}">

        @include('website.pages.head')
    </head>
    <body>
    @csrf

        @include('website.pages.header')

        @yield('content')

        @include('website.pages.footer')

        <!--=============== SCROLL UP ===============-->
        <a href="#" class="scrollup" id="scroll-up">
            <i class='bx bx-up-arrow-alt scrollup__icon' ></i>
        </a>

        @include('website.pages.script')
    </body>
</html>
