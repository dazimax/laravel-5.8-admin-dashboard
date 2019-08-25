@extends('layouts.master.app')
@section('title')
@parent
- Data import
@stop

@section('pageHeading')
	<div class="page-heading">
	    <h1><i class='fa fa-flag'></i> View Plans</h1>
	</div>
@stop

@section('content')
	<div class="col-md-12" >	
		@include('layouts.master.messages')
        <div class="widget">
            <div class="widget-header transparent">
                <h2 class="pull-left"><strong> Plans</strong></h2>
<!--                 <div class="additional-btn">-->
<!--                    <a href="#" class="hidden reload"><i class="icon-ccw-1"></i></a>-->
<!--                    <a href="#" class="widget-toggle"><i class="icon-down-open-2"></i></a>-->
<!--                    <a href="#" class="widget-close"><i class="icon-cancel-3"></i></a>-->
<!--                </div> -->
            </div>
            <div class="widget-content">
				<div class="table-responsive">
					<table class="table table-hover">
						<thead>
							<tr>
								<th class="text-left">User Name</th>
								<th class="text-center">Is Default</th>
								<th class="text-center">Status</th>
								<th class="text-center">Expire Date</th>
								<th class="text-center">Created At</th>
								<th class="text-center" width="2%"></th>
								<th class="text-center" width="2%"></th>
							</tr>
						</thead> 
						<tbody> 
							@if(count($plans) > 0)
								@foreach ($plans as $plan)
									@if(!$plan->user_id || ($plan->user_id && isset($plan->user)))
										<?php
										$dt = new DateTime($plan->created_at);
										$tz = new DateTimeZone('Asia/Colombo');
										$dt->setTimezone($tz);
										$createdAt =  $dt->format('Y-m-d H:i:s');
										?>
										<tr>
											<td>{{ ($plan->user_id)? $plan->user->name : 'Default Plan'}}</td>
											<td class="text-center">{{ ($plan->is_default)? 'Yes' : 'No' }}</td>
											<td class="text-center">{{ ($plan->active)? 'Active' : 'Inactive' }}</td>
											<td class="text-center">{{ $plan->expireDate}}</td>
											<td class="text-center">{{ $createdAt }}</td>
											<td width="2%" class="text-center"><a class="btn btn-info" data-toggle="tooltip" title="View List" href="/chartPlan/edit/{{$plan->id}}"><span class="fa fa-pencil"></span></a></td>
											<td width="2%" class="text-center"><a class="btn btn-danger" href="#" title="Remove" data-user = {{($plan->user_id)? $plan->user->name : 'Default User Plan'}} data-id={{ $plan->id }} data-toggle="modal" data-target="#deletePlanModal"><span class="fa fa-trash"></span></a></td>
										</tr>
									@endif
								@endforeach
							@else
								<tr class="not_found">
									<td colspan="6">No results were found.</td>
								</tr>
							@endif	
						</tbody> 
					</table>
					{{ $plans->links() }}
				</div>
            </div>
        </div>
	</div>
	{{ csrf_field() }}
	<!-- Modal -->
	<div class="modal fade" id="deletePlanModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">Delete User Chart Plan</h4>
	      </div>
	      <div class="modal-body">
	         Are you sure you want to delete the chart plan for this user <strong id="planUserId"></strong> ?
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
	        <a  href="" class="btn btn-primary deleteUrl">Yes</a>
	      </div>
	    </div>
	  </div>
	</div>

	<script type="text/javascript">
		$('#deletePlanModal').on('show.bs.modal', function (event) {
			var button = $(event.relatedTarget);
			var planUser = button.data('user');
			var deleteId = button.data('id');
			var modal = $(this);
			modal.find('.modal-body strong').html(planUser);
			modal.find('a.deleteUrl').prop('href','/chartPlan/delete/'+deleteId);
		});
	</script>	

@stop