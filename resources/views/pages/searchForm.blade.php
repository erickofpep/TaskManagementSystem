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
    <option value="open">open</option>
    <option value="in_progress">in progress</option>
    <option value="completed">completed</option>
</select>
</div>
<div class="form-group">
 <button type="submit" class="mt-1 btn btn-primary">{{ __('Search') }}</button>
</div>
</div>
 </form> 