@extends('layouts.dashboard')

@section('content')
	@if(session('error'))
		<div class="alert alert-danger alert-dismissible fade show" role="alert">
			{{session('error')}}
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
	@elseif(session('success'))
		<div class="alert alert-success alert-dismissible fade show" role="alert">
			{{session('success')}}
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
	@endif	
    <div class="card">
        <div class="card-header">
			<div class="btn-toolbar justify-content-between">
            	<h4><i class="ti-list"></i> &nbsp; Requests for approval</h4>
	            <div class="dropdown">
					<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Archives
					</button>
					<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
						@foreach($archives as $date)
							<a class="dropdown-item" href="{{route('paf.approval.list', [$date['month'], $date['year']])}}">{{$date['monthname'] .' '. $date['year']}}</a>
						@endforeach		
					</div>
				</div>
			</div>
        </div>
        <div class="card-body">
			<table class="table table-striped table-md">
				<thead>
					<tr>
						<th scope="col">Request no.</th>
						<th scope="col">Employee id</th>
						<th scope="col">Purpose</th>
						<th scope="col">Requested by</th>
						<th scope="col">Assessed by</th>
						<th scope="col">Status</th>
						<th scope="col"></th>
					</tr>
				</thead>
				<tbody>
					@foreach ($requestList as $lists)
						<tr>
							<th scope="row">{{$lists->id}}</th>
							<td>{{empty($lists->employee_company_id) ? '' : $lists->employee_company_id}}</td>
							<td>{{empty($lists->contractChange->change_type) ? '' : $lists->contractChange->change_type}}</td>
							<td>{{empty($lists->requested_by_company_id) ? '' : $lists->requested_by_company_id}}</td>
							<td>{{empty($lists->assessed_by_company_id) ? '' : $lists->assessed_by_company_id}}</td>
							<td>{{$lists->masterPafStatus->request_status}} - {{$lists->masterPafSubStatus->sub_request_status}}</td>
							@if($lists->masterPafSubStatus->id == '2')
								<td class="form-group text-center"><a class="btn btn-primary btn-sm" href="{{route('paf.approval.list.show', $lists->id)}}">To Approve</a></td>
							@else
								<td class="form-group text-center"><a class="btn btn-secondary btn-sm" href="{{route('paf.approval.list.show', $lists->id)}}">View</a></td>
							@endif
						</tr>
					@endforeach
				</tbody>
			</table>
	    </div>
	    <div class="row mt-2">
	        <span class="mr-auto ml-auto">{{$requestList->links()}}</span>
	    </div>
    </div>
@endsection
