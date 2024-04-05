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
  <div class="col-md-12">
    <a href="{{ route('showCreatedTasks') }}" class="bckToPrev" title="Go Back"><i class="fa fa-arrow-left"></i> Go Back </a>
  </div>

     <form method="POST" action="{{ route('search') }}" >
 <div class="row srchRow">
    @csrf                     
<div class="position-relative form-group col-md-4">
<input type="text" name="searchTerm" id="searchTerm" placeholder="enter task title"  class="form-control" value="{{ old('searchTerm') }}" >
</div>
<div class="position-relative form-group col-md-2">
<input type="date" name="taskDate" id="taskDate" class="form-control" value="{{ old('taskDate') }}">
</div>
<div class="position-relative form-group col-md-4">
<select name="taskStatus" id="taskStatus" class="form-control">
@if (old('searchTerm'))
<option>{{ old('searchTerm') }}</option>
@endif
    <option value="">-select task status--</option>
    <option>open</option>
    <option>in progress</option>
    <option>completed</option>
</select>
</div>
<div class="form-group">
 <button type="submit" class="mt-1 btn btn-primary">{{ __('Search') }}</button>
</div>
</div>
 </form> 

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