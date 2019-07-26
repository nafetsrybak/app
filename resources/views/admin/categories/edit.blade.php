@extends('layouts.admin')

@section('content')
	<h1>Update category</h1>
	<div class="row">
		<div class="col-sm-6">
			<form method="post" action="{{ route('categories.update', $category->id) }}">
				{{ method_field('PATCH') }}
				{{ csrf_field() }}
				<div class="form-group">
					<label for="name">Name of category:</label>
					<input class="form-control" type="text" id="name" name="name" placeholder="Category name" value="{{ $category->name }}"><br>
				</div>
				<div class="form-group">
					<button class="btn btn-lg btn-info col-sm-5 col-xs-5">Update category</button>
				</div>	
			</form>
			<form method="post" action="{{ route('categories.destroy', $category->id) }}">
				{{ csrf_field() }}
				{{ method_field('DELETE') }}
				<div class="form-group">
					<button class="btn btn-lg btn-danger col-sm-5 col-xs-5 pull-right">Delete category</button>
				</div>
			</form>
		</div>
	</div>
	<div class="row">
		@include('includes.form_error')
	</div>
@endsection()