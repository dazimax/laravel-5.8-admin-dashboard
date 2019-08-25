@extends('layouts.master.app')
@section('title')
@parent
- Chart Plan Create
@stop

@section('pageHeading')
	<div class="page-heading">
	    <h1><i class='fa fa-flag'></i> Create Chart Plan</h1>
	</div>
@stop

@section('content')
	<script src="{{ URL::asset('js/chartplans.js') }}"></script>
	<div class="col-md-12" >
		@include('layouts.master.messages')
        <div class="widget">
            <div class="widget-header transparent">
                <h2><strong>Create Chart Plan</strong></h2>
            </div>
            <div class="widget-content">
            	<div class="col-md-12">
					<form id="saveChartPlan" action="<?php echo action('ChartPlanController@postSavePlan'); ?>" method="post" enctype="multipart/form-data">
						<div class="form-group row clientSelectDiv">
							<div class="col-lg-4"><label class="control-label">Select A Customer<span style="color: red">*</span></label></div>
							<div class="col-lg-8">
								<select name="clientSelect" class="form-control">
									<option value="0">Select a Customer</option>
									@foreach($clients as $client)
										<option value="{{ $client->id }}">{{ $client->name }} </option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-lg-12 row text-center">
							<div class="alert alert-info" role="alert">
								<strong>Note :</strong> If Selected as Default -> Yes, This will be used as the demo plan for newly registered clients
							</div>
						</div>
						<div class="form-group row">
							<div class="col-lg-4"><label>Is Default</label></div>
							<div class="col-lg-8">
								<select name="isDefault" class="form-control">
									<option value="1">Yes</option>
									<option selected value="0">No</option>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-lg-4"><label>Active</label></div>
							<div class="col-lg-8">
								<select name="isActive" class="form-control">
									<option value="1">Yes</option>
									<option value="0">No</option>
								</select>
							</div>
						</div>
						<div class="form-group row expireDateDiv">
							<div class="col-lg-4"><label class="control-label">Select Plan Expire Date</label></div>
							<div class="col-lg-8">
								<div class="input-append date form_datetime" data-date="">
									<input name='planExpireDate' style="padding-left: 25px; width: 100%;" class="form-control" type="text" value="" readonly>
									<span class="add-on"><i class="icon-remove"></i></span>
									<span style="float: left;margin-top: -28px; margin-left: 3px;" class="add-on"><i class="icon-calendar"></i></span>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-lg-4"><label class="control-label">Plan Description</label></div>
							<div class="col-lg-8"><textarea class="form-control" name="planDescription"></textarea></div>
						</div>
						<hr/>
						<div class="planDatasets">

						</div>
						<div class="form-group row">
							<div class="col-lg-6">
								<a class="form-control btn btn-warning createChartPlanResetBtn" style="float: right;">Reset</a>
							</div>
							<div class="col-lg-6">
								<a class="form-control btn btn-success createChartPlanSaveBtn" style="float: right;">Create</a>
							</div>
						</div>
						{{ csrf_field() }}
					</form>
				</div>
			</div>
		</div>
	</div>
@stop