<?php

namespace App\Http\Controllers;

use App\User;
use App\Tasks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;
use mysqli;

class RegisterController extends Controller
{

/*
 User Register method
 */    
    public function register(Request $request) {

        $validator = $request->validate([
            "firstname"    => "required|string|min:3|max:50",
            "lastname"  => "required|string|min:3|max:50",
            "email"  => "email|required|unique:users",
            'password' => 'required|confirmed|min:4',
            'password_confirmation' => 'required|min:4'
        ]);

        $task_user = new User();
 
        $task_user->firstname = $request->firstname;
        $task_user->lastname = $request->lastname;
        $task_user->email = $request->email;
        $task_user->password = Hash::make($request->password);
        $task_user->save();
        
        $credentials = $request->only('email', 'password');
 
        if (Auth::attempt($credentials)) {

            return redirect()->intended('dashboard')->with('success', 'Welcome!');
        }
        else{
            return redirect()->back()->with('error', 'Invalid Login details. Please try again');
        }

    }

/*
 User Login method
 */
    public function user_login(Request $request) {
        
        $validator = $request->validate([
            "email"  => "email|required",
            'password' => 'required|min:4'
        ]);

        $credentials = $request->only('email', 'password');
 
        if (Auth::attempt($credentials)) {
           
            return redirect()->intended('dashboard')->with('success', 'Welcome!');
        }
        else{
            return redirect()->back()->with('error', 'Invalid Login details. Please try again');
        }

    }

 /*
 Create Task method
 */
    public function createtask(Request $request)
    {
        $validator = $request->validate([
            "title"    => "required|string|max:255",
            "taskdesc"  => "required|string",
            'duedate' => 'required|date'
        ]);

/*
check if Task title exist *****
*/
$NoDuplicateTaskTitle = Tasks::where("title", "=", "" . $request->title . "")->where("user_id", "=", "".Auth::id()."")->get();

if(count($NoDuplicateTaskTitle) > 0){

return response()->json(['error'=>$request->title.' already exist ']);

}else{

    $task_user = new Tasks();
 
      $task_user->title = $request->title;
      $task_user->description = $request->taskdesc;
      $task_user->duedate = $request->duedate;
      $task_user->user_id = Auth::id();
      $task_user->status = 'open';
      $task_user->created_by = Auth::id();
      
      $task_user->save();
   
    return response()->json(['success'=>'Task added has been added by '.Auth::user()->firstname]);

}

    }

    public function showCreatedTasks()
    {

        return view('pages.created_tasks');

    }

 /*
 select Tasks based on input type and order by priority_status
 */
public function searchCriteria(Request $request)
{
    
if(!empty($request->searchTerm) && empty($request->taskDate) && empty($request->taskStatus)){

    // return 'search term= '.$request->searchTerm;
    $fetchTitleOnly = Tasks::where("title", "like", "%" . $request->searchTerm . "%")->where("user_id", "=", "".Auth::id()."")->orderBy('priority_status', 'desc')->paginate(5);
    
    if(count($fetchTitleOnly) > 0){

    return view('pages.searchterm01', compact('fetchTitleOnly'));


    }
    else{
        return redirect()->route('showSearch')->with('error', 'No result found');
    }
    
    }
    elseif(!empty($request->taskDate && empty($request->searchTerm) && empty($request->taskStatus))){

        //return 'task date= '.$request->taskDate;

    $fetchTaskDateOnly = Tasks::whereDate("created_at", "=", "" . $request->taskDate . "")->where("user_id", "=", "".Auth::id()."")->orderBy('priority_status', 'desc')->paginate(5);

    if(count($fetchTaskDateOnly) > 0){

        return view('pages.searchDate', compact('fetchTaskDateOnly'));
    
        }
        else{
            return redirect()->route('showSearch')->with('error', 'No result found');
        }


    }
    elseif(!empty($request->taskStatus) && empty($request->taskDate) && empty($request->searchTerm) ){
        
    // return 'task Status= '.$request->taskStatus;
    $fetchTaskStatusOnly = Tasks::where("status", "=", "" . $request->taskStatus . "")->where("user_id", "=", "".Auth::id()."")->orderBy('priority_status', 'desc')->paginate(5);

    if(count($fetchTaskStatusOnly) > 0){

        return view('pages.searchStatus', compact('fetchTaskStatusOnly'));
    
        }
        else{
            return redirect()->route('showSearch')->with('error', 'No result found');
        }


    }
    elseif(!empty($request->searchTerm) && !empty($request->taskDate) && empty($request->taskStatus) ){

    // return 'search Term = '.$request->searchTerm.' task date='.$request->taskDate;
    $srchTermNDate = Tasks::where("title", "like", "%" . $request->searchTerm . "%")->whereDate("created_at", "=", "" . $request->taskDate . "")->where("user_id", "=", "".Auth::id()."")->orderBy('priority_status', 'desc')->paginate(5);

    if(count($srchTermNDate) > 0){

    return view('pages.searchTrmNDate', compact('srchTermNDate'));
    
    }
    else{
        return redirect()->route('showSearch')->with('error', 'No result found');
    }

    }
    elseif(!empty($request->searchTerm) && !empty($request->taskStatus) && empty($request->taskDate) ){

    // return 'search Term= '.$request->searchTerm.' task status= '.$request->taskStatus;

    $srchTermNStatus = Tasks::where("title", "like", "%" . $request->searchTerm . "%")->where("status", "=", "" . $request->taskStatus . "")->where("user_id", "=", "".Auth::id()."")->orderBy('priority_status', 'desc')->paginate(5);

    if(count($srchTermNStatus) > 0){

    return view('pages.searchTermNStatus', compact('srchTermNStatus'));
    
    }
    else{
        return redirect()->route('showSearch')->with('error', 'No result found');
    }

    }
    elseif(!empty($request->taskDate) && !empty($request->taskStatus) && empty($request->searchTerm) ){

    // return 'task Date = '.$request->taskDate.' task date= '.$request->taskStatus;

    $srchDateNStatus = Tasks::where("status", "=", "" . $request->taskStatus . "")->whereDate("created_at", "=", "" . $request->taskDate . "")->where("user_id", "=", "".Auth::id()."")->orderBy('priority_status', 'desc')->paginate(5);

    if(count($srchDateNStatus) > 0){

    return view('pages.searchDateNStatus', compact('srchDateNStatus'));
    
    }
    else{
        return redirect()->route('showSearch')->with('error', 'No result found');
    }

    }
    elseif(!empty($request->searchTerm) && !empty($request->taskDate) && !empty($request->taskStatus) ){

    // return 'searchTerm = '.$request->searchTerm.' taskDate= '.$request->taskDate.' taskStatus='.$request->taskStatus;

    $srchTrmNDateNStatus = Tasks::where("title", "like", "%" . $request->searchTerm . "%")->where("status", "=", "" . $request->taskStatus . "")->whereDate("created_at", "=", "" . $request->taskDate . "")->where("user_id", "=", "".Auth::id()."")->orderBy('priority_status', 'desc')->paginate(5);

    if(count($srchTrmNDateNStatus) > 0){

    return view('pages.searchTrmNDateNStatus', compact('srchTrmNDateNStatus'));
    
    }
    else{
    
    return redirect()->route('showSearch')->with('error', 'No result found');

    }

    }
    elseif( last(request()->segments()) == 'search'){

    return redirect()->route('showSearch')->with('error', 'Specify search criteria');

    }
    else{

    return redirect()->route('showSearch')->with('error', 'Specify search criteria');

    }

}


/*
Show tasks
*/
public function viewTasks(User $HasMany){
    // $getTasksAssigned = Tasks::where("assigned_by", "=", "".Auth::id()."")->orderBy('priority_status', 'desc')->paginate(5);

$tasks =Tasks::where("user_id", "=", "".Auth::id()."")->orderBy('priority_status', 'desc')->paginate(5);
return view('pages.created_tasks', compact('tasks'));


}

/*
 * Set Task Priority
*/   
public function setPriority(Request $request)
 {
    $validator = $request->validate([
        "taskid"    => "integer|required",
        "priorityInput"  => "required|string"
    ]);

$setPriority = Tasks::find($request->taskid);
 
$setPriority->priority_status = $request->priorityInput;
 
$setPriority->save();

return response()->json(['success'=>'Task Priority has been set']);

}

/*
 * Set Task Status
*/ 
public function setStatus(Request $request)
 {
    $validator = $request->validate([
        "taskid"    => "integer|required",
        "selectStatus"  => "required|string"
    ]);

$setPriority = Tasks::find($request->taskid);
 
$setPriority->status = $request->selectStatus;
 
$setPriority->save();

return response()->json(['success'=>'Task Status has been set']);

}

/*
 * show Edit Task
*/ 
public function showEdit($id){

$singleTask = DB::table('tasks')->where('id', $id)->first();

return view('pages.showSingleTask')->with('taskSingle', $singleTask); 

 }

/*
 * process Edit Task
*/ 
 public function editTask(Request $request){  

if( empty($request->due_date) ){
    $dueDate=$request->DuedateEx;
}
else{
    $dueDate= $request->due_date;
}

if(empty($request->Title)){
    return redirect()->back()->with('success', 'Enter Task title');
}
elseif(empty($request->task_desc)){
    return redirect()->back()->with('success', 'Enter Task description');
}
elseif(empty($dueDate)){
    return redirect()->back()->with('success', 'Enter Dute date');
}
else{

$setPriority = Tasks::find($request->taskID);
 
$setPriority->title = $request->Title;
$setPriority->description = $request->task_desc;
$setPriority->duedate = $dueDate;
 
$setPriority->save();

return redirect()->back()->with('success', 'Task has been updated');

}

}
 
/*
 * Delete Task
*/ 
public function deleteTask(Request $request){  

Tasks::where('id', $request->taskid)->delete();

return response()->json(['success'=>'Task has been deleted']);

}

/*
 * Assign Task
*/ 
public function assignTask(Request $request)
 {

if( empty($request->userAssignee) ){
    return response()->json(['success'=>'Select User to do the Task']);
}
else{

$assignTask = Tasks::find($request->taskid);

$assignTask->assigned_by = $request->UserAssigner;

$assignTask->assigned_to = $request->userAssignee;

$assignTask->save();

return response()->json(['success'=>'Task has been assign to '.Auth::user()->firstname.' '.Auth::user()->lastname]);

}

}


/*
Tasks Assigned ***********
*/
public function tasksAssigned(){

    $getTasksAssigned = Tasks::where("assigned_by", "=", "".Auth::id()."")->orderBy('priority_status', 'desc')->paginate(5);

    return view('pages.taskAssigned', compact('getTasksAssigned'));
}

/*
Tasks Assigned ***********
*/
public function tasksReceived(){

    $getTasksReceived = Tasks::where("assigned_to", "=", "".Auth::id()."")->orderBy('priority_status', 'desc')->paginate(5);

    return view('pages.taskReceived', compact('getTasksReceived'));
}




}