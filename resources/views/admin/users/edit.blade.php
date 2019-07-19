@extends('layouts.admin')

@section('content')
<h1>Edit Users</h1>
<div class="row">
	<div class="col-sm-3">
		<img src="{{ ($user->photo) ? $user->photo->file : url('images/noimage.jpg') }}" class="img-responsive img-rounded">
	</div>
	<div class="col-sm-9">
		<form method="post" action="{{ route('admin.users.update', $user->id) }}" enctype="multipart/form-data">
			{{ method_field('PATCH') }}
			{{ csrf_field() }}
			<div class="form-group">
				<label for="name">Name:</label>
				<input class="form-control" type="text" id="name" name="name" placeholder="Name" value="{{ $user->name }}"><br>
			</div>
			<div class="form-group">
				<label for="email">Email:</label>
				<input class="form-control" type="email" id="email" name="email" placeholder="Email" value="{{ $user->email }}"><br>	
			</div>
			<div class="form-group">
				<label for="password">Password:</label>
				<input class="form-control" type="password" id="password" name="password" placeholder="Password"><br>	
			</div>
			<div class="form-group">
		      <label for="role">Role:</label>
		      <select id="role" class="form-control" name="role_id">
		        @if($roles)
			        @foreach($roles as $id=>$role)
			        	@if($id == $user->role_id)
			        		<option value="{{ $id }}" selected="">{{ $role }}</option>
			        	@else
			        		<option value="{{ $id }}">{{ $role }}</option>
			        	@endif
			        @endforeach
		        @endif
		      </select>
		    </div>
			<div class="form-check">
		  		<input class="form-check-input" type="radio" name="is_active" id="status_active" value="1" {{ ($user->is_active) ? 'checked' : ''}}>
		  		<label class="form-check-label" for="status_active">Active</label>
			</div>
			<div class="form-check">
		  		<input class="form-check-input" type="radio" name="is_active" id="status_notactive" value="0" {{ ($user->is_active) ? '' : 'checked'}}>
		  		<label class="form-check-label" for="status_notactive">Not active</label>
			</div>
			<div class="form-group">
				<label class="form-check-label" for="InputFile">File upload:</label>
				<input type="file" class="form-control-file-lg" name="photo_id" id="InputFile">
			</div>
			<!-- @csrf -->
			<div class="form-group">
				<button class="btn btn-lg btn-info col-sm-3 col-xs-5">Update user</button>
			</div>	
		</form>
		<form method="post" action="{{ route('admin.users.destroy', $user->id) }}">
			{{ csrf_field() }}
			{{ method_field('DELETE') }}
			<div class="form-group">
				<button class="btn btn-lg btn-danger col-sm-3 col-xs-5 pull-right">Delete user</button>
			</div>
		</form>
	</div>
</div>
@include('includes.form_error')
@endsection