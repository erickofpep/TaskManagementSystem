<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    <title>Task Management System | Touch Stack Technologies</title>
    @include('layouts.head')
</head>

<body>
    <div class="app-container app-theme-white body-tabs-shadow">
        <div class="app-container">
            <div class="h-100">
                <div class="h-100 no-gutters row">

                @yield('MainPage')

                </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@include('layouts.footer')
</body>

</html>