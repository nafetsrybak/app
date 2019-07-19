@extends('layouts.admin')

@section('content')
@if(session()->has('massage_text'))
<div class="alert alert-success" role="alert">
	<p>{{ session('massage_text') }}</p>
</div>
@endif
<h1>Users</h1>
<table class="table-responsive">
	<table class="table">
		<thead>
			<tr>
				<th>Id</th>
				<th class="col-sm-2">Photo</th>
				<th>Name</th>
				<th>Email</th>
				<th>Role</th>
				<th>Status</th>
				<th>Created</th>
				<th>Updated</th>
			</tr>
		</thead>
		<tbody>
			@if($users)
				@foreach($users as $user)
					<tr>
						<td>{{ $user->id }}</td>
						<td>
							<div class="thumbnail">
								<img src="{{ ($user->photo) ? $user->photo->file : '/images/noimage.jpg'}}">
							</div>
						</td>
						<td><a href="{{ route('admin.users.edit', $user->id) }}">{{ $user->name }}</a></td>
						<td>{{ $user->email }}</td>
						<td>{{ ($user->role) ?  $user->role->name : 'Has no role'}}</td>
						<td>{{ ($user->is_active) ? 'Active' : 'Not Active'}}</td>
						<td>{{ $user->created_at->diffForHumans() }}</td>
						<td>{{ $user->updated_at->diffForHumans() }}</td>
					</tr>
				@endforeach
			@endif
		</tbody>
	</table>
</table>
@endsection