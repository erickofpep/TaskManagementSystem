@extends('pages.master')

@section('MainPage')
<div class="d-none d-lg-block col-lg-4">
                        <div class="slider-light">
                            <div class="slick-slider">
                                <div>
                                    <div class="position-relative h-100 d-flex justify-content-center align-items-center" tabindex="-1">
                                        <div class="slide-img-bg" style="background-image: url('assets/images/touchstackLogo.svg');"></div>
                                    </div>
                                </div>
                                <div>
                                    <div class="position-relative h-100 d-flex justify-content-center align-items-center" tabindex="-1">
                                        <div class="slide-img-bg" style="background-image: url('assets/images/touchstackLogo.svg');"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
<div class="h-100 bg-white justify-content-center align-items-center col-md-12 col-lg-8 rghtPnlWrap"> <!--  d-flex -->
                        <div class="mx-auto app-login-box col-sm-12 col-md-10 col-lg-9">
                            <div class="app-logo lgoWrapHm" >
                                <span ></span>
                            
                            <div  class="lgoTEXTHm">
                            Task Management System  
                            </div>
                            
                                </div>

<div role="group" class="btn-group-sm nav btn-group">
@if( isset($_GET['ct']) && $_GET['ct'] =='register' )
<a data-toggle="" href="?ct=register" class="btn-shadow active btn btn-primary">Register</a>
@else
<a data-toggle="" href="?ct=register" class="btn-shadow btn btn-primary">Register</a>
@endif

@if( isset($_GET['ct']) && $_GET['ct'] =='register' )
<a data-toggle="" href="?ct=login" class="btn-shadow active btn btn-primary">Login</a>
@else
<a data-toggle="" href="?ct=login" class="btn-shadow btn btn-primary">Login</a>
@endif


</div>

@if( isset($_GET['ct']) && $_GET['ct'] =='register' )

   @include('layouts.register')

@elseif( isset($_GET['ct']) && $_GET['ct'] =='login' )

    @include('layouts.login')

@else

    @include('layouts.register')

@endif

@endsection
