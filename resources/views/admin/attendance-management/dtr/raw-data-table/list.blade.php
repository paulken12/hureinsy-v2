@extends('layouts.dashboard')

@section('content')
	<div class="full-container">
        <div class="remain-height pos-r scrollable">
            <div class="bgc-white bdrs-3">
                <table id="paf-list" class="table" cellspacing="0" width="100%">
					<thead>
						<tr class="text-primary">
							<th class="text-center">ID</th>
							<th>From</th>
							<th>To</th>
							<th class="text-center"></th>
						</tr>
					</thead>
					<tfoot>
						<tr class="text-primary">
							<th class="text-center">ID</th>
							<th>From</th>
							<th>To</th>
							<th class="text-center"></th>
						</tr>
					</tfoot>
					<tbody>
						@foreach ($dlist as $lists)
							<tr>
								<th class="text-center">{{$lists['id']}}</th>
								<td>{{$lists['date_start']}}</td>
								<td>{{$lists['date_end']}}</td>
								<td><a class="form-group text-center"><a class="btn btn-primary btn-sm" href="{{route('dtrlist.dtr', $lists['dtr_id'])}}">view</a></td>
							</tr>
						@endforeach
					</tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
