@extends('layouts.dashboard')

@section('content')
	<div class="full-container">
        <div class="remain-height pos-r scrollable">
            <div class="bgc-white bdrs-3">
				<span class="align-middle">
  					<h3 class="pt-3 text-center">Requests for assessment</h3>
					<hr>
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
				</span>
                <table id="paf-list" class="table" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th class="text-center">Request no.</th>
							<th>Employee Name</th>
							<th>Purpose</th>
							<th>Requested by</th>
							<th>Status</th>
							<th class="text-center">
								<div class="dropdown">
									<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										Archives
									</button>
									<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
										@foreach($archives as $date)
											<a class="dropdown-item" href="{{route('paf.assessment.list', [$date['month'], $date['year']])}}">{{$date['monthname'] .' '. $date['year']}} <small><span class="badge badge-pill badge-info">{{$date['published']}}</span></small></a>
										@endforeach		
									</div>
								</div>
							</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th class="text-center">Request no.</th>
							<th>Employee Name</th>
							<th>Purpose</th>
							<th>Requested by</th>
							<th>Status</th>
							<th class="text-center"></th>
						</tr>
					</tfoot>
					<tbody>
						@foreach ($requestList as $lists)
							<tr>
								<th class="text-center">{{empty($lists->id) ? '' : $lists->id}}</th>
								<td>{{empty($lists->employee_company_id) ? '' : '('. $lists->employee_company_id .') '.
										$get_employee->where('company_id', $lists->employee_company_id)->pluck('last_name')->first() .', '.
										$get_employee->where('company_id', $lists->employee_company_id)->pluck('first_name')->first()}}
								</td>
								<td>{{empty($lists->contractChange->change_type) ? '' : $lists->contractChange->change_type}}</td>
								<td>{{empty($lists->requested_by_company_id) ? '' : '('. $lists->requested_by_company_id .') '.
										$get_employee->where('company_id', $lists->requested_by_company_id)->pluck('last_name')->first() .', '.
										$get_employee->where('company_id', $lists->requested_by_company_id)->pluck('first_name')->first()}}
								</td>
								<td>{{$lists->masterPafStatus->request_status}} - {{$lists->masterPafSubStatus->sub_request_status}}</td>
								@if($lists->masterPafSubStatus->id == '1')
										<td class="text-center"><a class="btn btn-primary btn-sm" href="{{route('paf.assessment.list.show', $lists->id)}}">To Assess</a></td>
								@else
										<td class="text-center"><a class="btn btn-secondary btn-sm" href="{{route('paf.assessment.list.show', $lists->id)}}">View</a></td>
								@endif
							</tr>
						@endforeach
					</tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
