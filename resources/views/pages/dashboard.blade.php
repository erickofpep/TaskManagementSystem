<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    <title>Dashboard - Task Management System | Touch Stack Technologies</title>
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
                    <div class="mb-3 card">
    <div class="card-header-tab card-header">
        <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
        </div>
 
    </div>
    <div class="no-gutters row">
        
    @if ($message = Session::get('success'))
    <div class="alert alert-success col-sm-12 msgAlrts">
        <p>{{ $message }} {{ auth()->user()->firstname }} {{ auth()->user()->lastname }}</p>
    </div>
 @endif
        
        <div class="col-sm-6 col-md-4 col-xl-4">
            <div class="card no-shadow rm-border bg-transparent widget-chart text-left">
                <div class="icon-wrapper rounded-circle">
                    <div class="icon-wrapper-bg opacity-10 bg-warning"></div>
                    <i class="pe-7s-note2 text-dark opacity-8"></i>
                </div>
                <a href="{{ route('showCreatedTasks') }}" title="Total Tasks" style="text-decoration: none;">
                <div class="widget-chart-content">
                    <div class="widget-subheading">
@php $totalTasks = DB::table('tasks')->where('user_id','=',auth()->user()->id)->count();
@endphp 
Total tasks created</div>
                    <div class="widget-numbers">{{ $totalTasks }}</div>
                </div>
                </a>
            </div>
            <div class="divider m-0 d-md-none d-sm-block"></div>
        </div>

        <div class="col-sm-6 col-md-4 col-xl-4">
            <div class="card no-shadow rm-border bg-transparent widget-chart text-left">
                <div class="icon-wrapper rounded-circle">
                    <div class="icon-wrapper-bg opacity-9 bg-success"></div>
                    <i class="pe-7s-note2 text-white"></i>
                </div>
            <a href="#" title="Tasks completed" style="text-decoration: none;">
                <div class="widget-chart-content">
                    <div class="widget-subheading">
@php $totalTsksCmpltd=DB::table('tasks')->where('status','completed')->where('user_id',Auth::user()->id)->count();
@endphp
Tasks completed</div>
                    <div class="widget-numbers text-success"><span> {{$totalTsksCmpltd}}</span></div>
                </div>
        </a>        
            </div>
        </div>

        <div class="col-sm-12 col-md-4 col-xl-4">
            <div class="card no-shadow rm-border bg-transparent widget-chart text-left">
                <div class="icon-wrapper rounded-circle">
                    <div class="icon-wrapper-bg opacity-9 bg-success"></div>
                    <i class="pe-7s-note2 text-white"></i>
                </div>
            <a href="#" title="Tasks overdue" style="text-decoration: none;">
                <div class="widget-chart-content">
                    <div class="widget-subheading">
@php $totalTsksOvrDue=DB::table('tasks')->where('user_id',Auth::user()->id)->whereDate('duedate', '<', today())->count();
@endphp
                    Tasks overdue</div>
                    <div class="widget-numbers text-success"><span>{{ $totalTsksOvrDue }}</span></div>
                </div>
        </a>        
            </div>
        </div>

    </div>
    <div class="text-center d-block p-3 card-footer">
    </div>
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