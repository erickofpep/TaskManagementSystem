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

 <div class="col-md-12 tblWrap">

<table class="mb-0 table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Title</th>
                                                    <th>Description</th>
                                                    <th>date added</th>
                                                    <th>due date</th>
                                                    <th>Priority</th>
                                                    <th>status</th>
                                                    <th></th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
@php $num=1; @endphp

@foreach($fetchTaskDateOnly as $details)
                                                <tr>
                                                    <th scope="row">@php echo $num ++ @endphp</th>
                                                    <td>@if( $details->title ) {{ $details->title }} @endif</td>
                                                    <td>@if( $details->description ) {{ $details->description }} @endif</td>
                                                    <td>{{ \Carbon\Carbon::parse($details->created_at)->format('j F, Y') }}<!--2024-2-3--></td>
                                                    <td>{{ \Carbon\Carbon::parse($details->duedate)->format('j F, Y') }}<!--2024-2-3--></td>
                                                    <td>
                                    @if( $details->priority_status == 3 )
                                     <span class="btn btn-success priorityBtn" id="{{ $details->id }}">High</span>
                                     @elseif( $details->priority_status == 2 )
                                    <span class="btn btn-info priorityBtn" id="{{ $details->id }}">Medium</span>
                                    @elseif( $details->priority_status == 1 )
                                    <span class="btn btn-warning priorityBtn" id="{{ $details->id }}">Low</span>
                                    @else
                                    <span class="btn btn-danger priorityBtn" id="{{ $details->id }}">set priority</span>
                                    
                                   @endif
                                </td>
          <td>
   @if( $details->status == 'open' )
   <span class="btn btn-warning setStatusBtn" id="{{ $details->id }}">open</span>
   @elseif( $details->status == 'in_progress' )
   <span class="btn btn-info setStatusBtn" id="{{ $details->id }}">in progress</span>
   @elseif( $details->status == 'completed' )
   <span class="btn btn-success setStatusBtn" id="{{ $details->id }}">completed</span>
   @else
  <span class="btn btn-grey setStatusBtn" id="{{ $details->id }}">set status</span>
   @endif   
</td>
<td class="tdCntr">@if( empty($details->assigned_to) ) <span class="assngTsk assngTskBtn" id="{{ $details->id }}">assign task</span> @else
@php 
$assignedToUser= App\User::find($details->assigned_to);
@endphp
<div class="asgnTxt assngTskBtn">assigned to <br /><b>{{ $assignedToUser->firstname }} {{ $assignedToUser->lastname }}</b></div>
@endif  </td>
<td><a href="{{ route('show_edit',['id' =>$details->id]) }}" title="Edit Task"><i class="fa fa-edit" title="Edit"></i></a>
                                                    &nbsp; &nbsp;
                                                    <i class="fa fa-trash dltTaskBtns" title="Delete" id="{{ $details->id }}"></i></td>
                        </tr>
@endforeach
                                            </tbody>
                                        </table>

 
  <div class="col-md-12 pgntn">
 {{ $fetchTaskDateOnly->links() }}
 </div>

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