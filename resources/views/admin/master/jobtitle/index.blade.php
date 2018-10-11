@extends('layouts.dashboard')

@section('content')
	@if(session('success'))
		<div class="alert alert-success alert-dismissible fade show" role="alert">
			{{session('success')}}
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
	@endif	
	@if(count($errors))
		<div class="alert alert-warning alert-dismissible fade show" role="alert">
			@foreach($errors->all() as $err)
				<li>{!!$err!!}</li>
			@endforeach
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
	@endif
    <div class="card">
        <div class="card-header">
			<div class="btn-toolbar justify-content-between">
            	<h4><i class="ti-list"></i> &nbsp; Masters Lists</h4>
				<div>
					<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_add"><i class="ti-plus"></i></button>
				</div>
			</div>
        </div>
        <div class="card-body">
			<table class="table table-striped table-md">
				<thead>
					<tr>
						<th scope="col">ID</th>
						<th scope="col">Job Titles</th>
						<th scope="col">Description</th>
						<th scope="col">Created at</th>
						<th scope="col">Updated at</th>
						<th scope="col" class="form-group text-center">Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($master as $list)
						<tr>
							<th scope="row">{{$list->id}}</th>
							<td>{{$list->job_titles}}</td>
							<td>{{$list->description}}</td>
							<td>{{$list->created_at}}</td>
							<td>{{$list->updated_at}}</td>
							<td class="form-group text-center">
								<a class="btn btn-primary btn-sm" href="{{route('setting.masters.titles.edit', $list->id)}}">Edit</a>
								<a class="btn btn-danger btn-sm" href="{{route('setting.masters.titles.destroy', $list->id)}}">Delete</a>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
	    </div>
	    <div class="row mt-2">
	        <span class="mr-auto ml-auto">{{$master->links()}}</span>
	    </div>
    </div>

{{--MODAL FOR CREATING--}}
<form action="{{route('setting.masters.titles.store')}}" method="post">	
	{{csrf_field()}}	
	<div class="modal fade" id="modal_add" tabindex="-1" role="dialog" aria-labelledby="modal_add" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="modal_add_title">Add Departments</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				</div>
				<div class="modal-body">
					@include('admin.master.jobtitle.create')
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Add</button>
				</div>
			</div>
		</div>
	</div>
</form>

@endsection
