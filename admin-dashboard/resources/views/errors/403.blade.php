@extends('layouts.master.app')
@section('title')
@parent
- 403
@stop

@section('pageHeading')
    <div class="page-heading">
        <h1><i class='fa fa-exclamation-triangle'></i> ACCESS DENIED</h1>
    </div>
@stop
<style type="text/css">
    .title {
        color: #e74c3c;
        font-size: 30px;
        margin-bottom: 40px;
        margin-top: 40px;
    }
</style>

@section('content')
    <div class="col-md-12" >    
        <div class="widget">
            <div class="widget-content">
                <div class="title text-center">You don't have permission to access this page.</div>
            </div>
        </div>
    </div>
@stop
