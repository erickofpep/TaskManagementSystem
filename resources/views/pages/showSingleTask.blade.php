<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    <title>Edit - @if($taskSingle->title) {{ $taskSingle->title }} @endif - Task Management System | Touch Stack Technologies</title>
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
                    
                <div class="main-card mb-3 card" style="margin-bottom: 120px !important;">
     <div class="card-body">

     <div class="col-md-12">
    <a href="{{ route('showCreatedTasks') }}" class="bckToPrev" title="Go Back"><i class="fa fa-arrow-left"></i>  Go Back </a>
  </div>

 
  @if ($message = Session::get('success'))
    <div class="alert alert-success col-sm-12 msgAlrts">
        <p>{{ $message }}</p>
    </div>
 @endif


  <form method="POST" action="{{ route('edit_task') }}" >
     @csrf
 <div class="row srchRow">

 <div class="col-md-3"></div>

 <div class="col-md-6">

 <div class="position-relative form-group">
    <label for="exampleEmail" class>Title</label>
    <input type="hidden" name="taskID" id="taskID" value="@if($taskSingle->id) {{ $taskSingle->id }} @endif">
    <input type="text" name="Title" id="Title" placeholder=""  class="form-control" value="@if($taskSingle->title) {{ $taskSingle->title }} @endif" required>
    </div>

    <div class="position-relative form-group">
    <label for="exampleEmail" class>Description</label>
    <textarea name="task_desc" id="task_desc" placeholder="" rows="6" class="form-control" value="" required>@if($taskSingle->description) {{ $taskSingle->description }} @endif</textarea>
    </div>
    
    <div class="position-relative form-group">
    <label for="exampleEmail" class>Due date:</label>
    <input type="text" class="dtInptExst" name="DuedateEx" id="DuedateEx" value="@if($taskSingle->duedate) {{ $taskSingle->duedate }} @endif" >
    <input type="date" name="due_date" id="due_date" placeholder=""  class="form-control" value="">
    </div>

    <div class="col-md-12 form-group" style="text-align: center;">
 <button type="submit" class="mt-1 btn btn-primary col-md-8">{{ __('Save') }}</button>
</div>

    </div>
    <div class="col-md-3"></div>

</form>
  
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
