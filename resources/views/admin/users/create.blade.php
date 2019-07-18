@extends('layouts.admin')

@section('content')
<h1>Create Users</h1>
<form method="post" action="{{ route('admin.users.store') }}" enctype="multipart/form-data">
	{{ csrf_field() }}
	<div class="form-group">
		<label for="name">Name:</label>
		<input class="form-control" type="text" id="name" name="name" placeholder="Name"><br>
	</div>
	<div class="form-group">
		<label for="email">Email:</label>
		<input class="form-control" type="email" id="email" name="email" placeholder="Email"><br>	
	</div>
	<div class="form-group">
		<label for="password">Password:</label>
		<input class="form-control" type="password" id="password" name="password" placeholder="Password"><br>	
	</div>
	<div class="form-group">
      <label for="role">Role:</label>
      <select id="role" class="form-control" name="role_id">
        <option selected>Choose...</option>
        @if($roles)
	        @foreach($roles as $id=>$role)
	        	<option value="{{ $id }}">{{ $role }}</option>
	        @endforeach
        @endif
      </select>
    </div>
	<div class="form-check">
  		<input class="form-check-input" type="radio" name="is_active" id="status_active" value="1" checked>
  		<label class="form-check-label" for="status_active">Active</label>
	</div>
	<div class="form-check">
  		<input checked="true" class="form-check-input" type="radio" name="is_active" id="status_notactive" value="0">
  		<label class="form-check-label" for="status_notactive">Not active</label>
	</div>
	<div class="form-group">
		<label class="form-check-label" for="InputFile">File upload:</label>
		<input type="file" class="form-control-file-lg" name="file" id="InputFile">
	</div>
	<!-- @csrf -->
	<div class="form-group">
		<button class="btn btn-info btn-lg">Create user</button>
	</div>	
</form>
@include('includes.form_error')
@endsection