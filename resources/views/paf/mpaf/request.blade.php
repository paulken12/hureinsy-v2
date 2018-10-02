@extends('layouts.dashboard')

@section('content')
<div class="full-container">
	<div class="card  remain-height pos-r scrollable">
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
		<div class="card-header">
			<div class="btn-toolbar justify-content-between">
				<h4><i class="ti-write"></i> &nbsp; <strong>Personnel Action Form</strong></h4>
				<form action="{{route('paf.search.result')}}" method="post">
					{{csrf_field()}}	
					<div class="input-group">
						<input type="text" id="raj_id" name="raj_id" class="form-control" title="employee ID" placeholder="Enter employee ID" required>
						<div class="input-group-append">
							<button class="btn btn-secondary" type="submit"><i class="ti-search"></i></button>
						</div>	
					</div>
				</form>
			</div>
		</div>

		<form action="{{route('paf.search.result.store')}}" method="post">	
			<div class="card-body">
				{{csrf_field()}}

				<h4><i class="ti-user"></i> &nbsp; <strong>Employee Information</strong></h4>
				<hr>
		
				<div class="row">
					<div class="col">
						<div class="form-group">
							<label for="raj_id"><strong>Employee ID:</strong></label>
							<input type="text" id="raj_id" name="raj_id" class="form-control-plaintext" title="raj_id" value="{{$employee_info->company_id}}" readonly>
						</div>
					</div>
					<div class="col">
						<div class="form-group">
							<label for="name"><strong>Name of Employee:</strong></label>
							<input type="text" id="name" name="name" class="form-control-plaintext" title="Name" value="{{$employee_info->first_name}} {{$employee_info->middle_name}} {{$employee_info->last_name}}" readonly>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col">
						<div class="form-group">
							<label for="date_hired"><strong>Date Hired</strong></label>
							<input type="text" id="date_hired" name="date_hired" class="form-control-plaintext" title="Date_hired" readonly>
						</div>
					</div>
					<div class="col">
						<div class="form-group">
							<label for="team"><strong>Team</strong></label>
							<input type="text" id="team" name="team" class="form-control-plaintext" title="Team" readonly>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col">
						<div class="form-group">
							<label for="position"><strong>Position</strong></label>
							<input type="text" id="position" name="position" class="form-control-plaintext" title="Position" readonly>
						</div>
					</div>
					<div class="col">
						<div class="form-group">
							<label for="department"><strong>Department</strong></label>
							<input type="text" id="department" name="department" class="form-control-plaintext" title="Department" readonly>
						</div>
					</div>
				</div>

				<hr>
				<h4><i class="ti-pencil"></i> &nbsp; <strong>Nature of Action</strong></h4>
				<hr>

				<div class="row">
					<div class="col">
						<div class="form-group">
							<label for="employment_status"><strong>Employment Status</strong></label>
							<select name="employment_status" id="employment_status" class="form-control" required>
								<option value="" >--select--</option>
								@foreach ($employment_status as $employment)
									<option value="{{$employment->key}}">{{$employment->employment_status}}</option>
								@endforeach
							</select>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col">
						<div class="form-group">
							<label for="remarks"><strong>Remarks</strong></label>
							<input type="text" id="remarks" name="remarks" class="form-control" title="Remarks">
						</div>
					</div>
				</div>	

				<div id="accordion">
					@include('paf.mpaf.include.job')
					@include('paf.mpaf.include.schedule')
					@include('paf.mpaf.include.compensation')
				</div>
				
				<hr>
				<div class="row">
					<div class="col">
						<div class="form-group text-center">
							<button class="btn btn-success" type="submit">Request to Human Resource</button>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
@endsection