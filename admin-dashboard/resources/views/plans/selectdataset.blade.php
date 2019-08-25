<div class="col-lg-12 row text-center" style="margin-bottom: 10px"><label class="control-label"><h4><strong>Select DataSets for the Plan</strong></h4></label></div>
<div class="col-lg-12 row text-center">
    <div class="alert alert-info" role="alert">
        <strong>Note :</strong> Selecting a Dataset will add all the charts under it to the Chart Plan. Click the Dataset title to view Charts
    </div>
</div>
<div class="col-lg-12 row">
    <div class="dataset-wrapper">
        @foreach($datasets as $dataset)
            <div class="panel panel-default dataset-accordian defaultDatasetPanel" >
                <div class="panel-heading" role="tab" id="dataset-heading-{{ $dataset->id }}">
                    <h4 class="panel-title">
                        <a role="button" class="dataset-panel-title" data-toggle="collapse" data-parent="#accordion" href="#collapse-dataset-{{ $dataset->id }}" aria-expanded="true" aria-controls="collapse-dataset-{{ $dataset->id }}">
                            {{ $dataset->name }}
                        </a>
                    </h4>
                    <input class="datasetCheck" style="transform: scale(1.5);float:right;display: inline-block;margin-top: -17px;" type="checkbox" {{ (in_array($dataset->id,$planDatasets)) ? 'checked' : '' }} data-id="{{ $dataset->id }}" name="datasetCheck">
                </div>
                <div id="collapse-dataset-{{ $dataset->id }}" class="panel-collapse collapse out" role="tabpanel" aria-labelledby="dataset-heading-{{ $dataset->id }}">
                    <div class="panel-body">
                        @if(count($dataset->charts) == 0)
                            No charts were created to this DataSet yet
                        @else
                            <ul class="dataset-chart-list">
                                @foreach($dataset->charts as $chart)
                                    <li> <a href="/chart/view/{{$chart->id}}">{{$chart->chart_name}}</a></li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
