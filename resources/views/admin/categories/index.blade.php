@extends('layouts.admin')

@section('content')
	@if(session()->has('massage_text'))
		<div class="alert alert-success" role="alert">
			<p>{{ session('massage_text') }}</p>
		</div>
	@endif
	<h1>Categories</h1>
	<div class="row">
		<div class="col-sm-6">
			<form method="post" action="{{ route('admin.categories.store') }}">
			{{ csrf_field() }}
			<div class="form-group">
				<label for="name">Name of category:</label>
				<input class="form-control" type="text" id="name" name="name" placeholder="Category name"><br>
			</div>
			<div class="form-group">
				<button class="btn btn-info btn-lg">Create category</button>
			</div>	
		</form>
		</div>
		<div class="col-sm-6">
			<table class="table">
				<thead>
					<tr>
						<th>Id</th>
						<th>Name</th>
						<th>Created</th>
						<th>Updated</th>
					</tr>
				</thead>
				<tbody>
					@if($categories)
						@foreach($categories as $category)
							<tr>
								<td>{{ $category->id }}</td>
								<td><a href="{{ route('admin.categories.edit', $category->id) }}">{{ $category->name }}</a></td>
								<td>{{ $category->created_at->diffForHumans() }}</td>
								<td>{{ $category->updated_at->diffForHumans() }}</td>
							</tr>
						@endforeach
					@endif()
				</tbody>
			</table>
		</div>
	</div>
	<div class="row">
		@include('includes.form_error')
	</div>
@endsection()