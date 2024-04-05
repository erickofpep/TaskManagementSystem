<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    <title>Search Tasks - Task Management System | Touch Stack Technologies</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('layouts.head')
</head>

<body>
<div class="app-container app-theme-white body-tabs-shadow fixed-header fixed-sidebar">
        
        @include('layouts/admin_header')
        
        <div class="app-main">
        @include('layouts/side_menu')
            
            <div class="app-main__outer">
                <div class="app-main__inner">
                <div class="tabs-animation">
                    
    <div class="main-card mb-3 card">
     <div class="card-body">

     @include('pages/searchForm')

@if ($message = Session::get('error'))
    <div class="alert alert-danger col-sm-12 msgAlrts">
        <p>{{ $message }}</p>
    </div>
 @endif




 
       </div>
     </div>
                
                </div>
    @include('layouts/dash_footer_upper')
            </div>
        </div>
    </div>

@include('layouts/dash_footer_drawers')

@include('layouts/dash_footer_bottom')

</body>

</html>