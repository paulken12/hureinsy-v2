@extends('layouts.dashboard')

@section('content')
    <div class="full-container">
        <div class="remain-height pos-r scrollable">
            <div class="bgc-white bdrs-3">
				<span class="align-middle">
  					<h3 class="pt-3 text-center">Masters Lists</h3>
					<hr>
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
				</span>
                <table id="masters-list" class="table" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th class="text-center">ID</th>
							<th>Key</th>
							<th>Address type</th>
							<th class="text-center">Action</th>
							<th class="text-center">
                				<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_add"><i class="ti-plus"></i></button>
                			</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th class="text-center">ID</th>
							<th>Key</th>
							<th>Address type</th>
							<th class="text-center">Action</th>
							<th class="text-center">
                				<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_add"><i class="ti-plus"></i></button>
                			</th>
						</tr>
					</tfoot>
					<tbody>
						@foreach($master as $list)
							<tr>
								<td scope="row" class="text-center">{{$list->id}}</th>
								<td>{{$list->key}}</td>
								<td>{{$list->address_type}}</td>
								<td class="text-center">
									<a class="btn btn-primary btn-sm" href="{{route('setting.masters.address.edit', $list->id)}}">Edit</a>
									<a class="btn btn-danger btn-sm" href="{{route('setting.masters.address.destroy', $list->id)}}">Delete</a>
								</td>
								<td class="text-center"></td>
							</tr>
						@endforeach
					</tbody>
                </table>
            </div>
        </div>
    </div>
    
{{--MODAL FOR CREATING--}}
<form action="{{route('setting.masters.address.store')}}" method="post">	
	{{csrf_field()}}	
	<div class="modal fade" id="modal_add" tabindex="-1" role="dialog" aria-labelledby="modal_add" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="modal_add_title">Add Address</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				</div>
				<div class="modal-body">
					@include('admin.master.address.create')
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
