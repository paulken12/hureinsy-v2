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
	<form action="{{route('setting.masters.address.update', $master->id)}}" method="post">	
		{{csrf_field()}}
	    <div class="card">
	        <div class="card-header">
				<div class="btn-toolbar justify-content-between">
	            	<h4><i class="ti-list"></i> &nbsp; Edit</h4>
				</div>
	        </div>
	        <div class="card-body">
				<table class="table table-striped table-md">
					<thead>
						<tr>
							<th scope="col">ID</th>
							<th scope="col">Key</th>
							<th scope="col">Address type</th>
							<th scope="col">Created at</th>
							<th scope="col">Updated at</th>
							<th scope="col" class="form-group text-center">Action</th>
						</tr>
					</thead>																
					<tbody>
						<tr>	
							<th scope="row">{{$master->id}}</th>
							<td><input type="text" id="key" name="key" class="form-control" value="{{$master->key}}" required	></td>
							<td><input type="text" id="address_type" name="address_type" class="form-control" value="{{$master->address_type}}" required></td>
							<td>{{$master->created_at}}</td>
							<td>{{$master->updated_at}}</td>
							<td class="form-group text-center">
								<a class="btn btn-danger btn-sm" href="{{route('setting.masters.address.destroy', $id)}}">Delete</a>
								<a class="btn btn-secondary btn-sm" href="{{route('setting.masters.address')}}">Cancel</a>
								<button type="submit" class="btn btn-primary btn-sm">Save Changes</button>
							</td>
						</tr>
					</tbody>
				</table>
		    </div>
	    </div>
	</form>
@endsection
