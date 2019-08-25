@extends('layouts.master.app')
@section('title')
@parent
- Chart Plan Edit
@stop

@section('pageHeading')
	<div class="page-heading">
	    <h1><i class='fa fa-flag'></i> Edit Chart Plan</h1>
	</div>
@stop

@section('content')
	<script src="{{ URL::asset('js/chartplans.js') }}"></script>
	<div class="col-md-12" >
		@include('layouts.master.messages')
        <div class="widget">
            <div class="widget-header transparent">
                <h2><strong>Edit Chart Plan</strong></h2>
            </div>
            <div class="widget-content">
            	<div class="col-md-12">
					<form id="editChartPlan" action="<?php echo action('ChartPlanController@postEditPlan'); ?>" method="post" enctype="multipart/form-data">
						<input name="editPlanId" type="hidden" value="{{$plan->id}}">
						<div class="form-group row clientSelectDiv">
							<div class="col-lg-4"><label class="control-label">Customer</label></div>
							<div class="col-lg-8">
								<input class="form-control" disabled value="{{ ($plan->user_id)? $plan->user->name : 'Default Plan'}}" />
							</div>
						</div>
						<div class="form-group row">
							<div class="col-lg-4"><label>Active</label></div>
							<div class="col-lg-8">
								<select name="isActive" class="form-control">
									<option value="1" {{ ($plan->active)? 'selected' : '' }} >Yes</option>
									<option value="0" {{ ($plan->active == 0)? 'selected' : '' }}>No</option>
								</select>
							</div>
						</div>
						<div class="form-group row expireDateDiv">
							<div class="col-lg-4"><label class="control-label">Select Plan Expire Date</label></div>
							<div class="col-lg-8">
								<div class="input-append date form_datetime" data-date="">
									<input name='planExpireDate' style="padding-left: 25px; width: 100%;" class="form-control" type="text" value="{{$plan->expireDate}}" readonly>
									<span class="add-on"><i class="icon-remove"></i></span>
									<span style="float: left;margin-top: -28px; margin-left: 3px;" class="add-on"><i class="icon-calendar"></i></span>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-lg-4"><label class="control-label">Plan Description</label></div>
							<div class="col-lg-8"><textarea class="form-control" name="planDescription">{{$plan->planDescription}}</textarea></div>
						</div>
						<hr/>
						<div class="planDatasets">

						</div>
						<div class="form-group row">
							<div class="col-lg-6">
								<a class="form-control btn btn-warning editChartPlanResetBtn" style="float: right;">Reset</a>
							</div>
							<div class="col-lg-6">
								<a class="form-control btn btn-success editChartPlanSaveBtn" style="float: right;">Update</a>
							</div>
						</div>
						{{ csrf_field() }}
					</form>
				</div>
			</div>
		</div>
	</div>
@stop