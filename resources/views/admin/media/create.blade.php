@extends('layouts.admin')
@section('styles')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css">
@endsection()

@section('content')
	<h1>Upload Media</h1>
	<form action="{{ route('admin.media.store') }}" class="dropzone" id="my-awesome-dropzone" enctype="multipart/form-data">
		{{ csrf_field() }}
	</form>

@endsection()

@section('scripts')
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
@endsection()