<!-- Modal/Shared data -->
<div id="shared-data-modal" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Shared data</h4>
            </div>
            <div class="modal-body">
                <form id="form-data-shared" action="/device/shared-data" method="post" class="form-inline">
                    <div class="form-group">
                        <select name="tag" data-live-search="true">
                            @if($datasets->isEmpty())
                                <option value="default-value" selected="selected">Without datasets</option>
                            @else
                                @foreach($datasets as $dataset)
                                    <option value="{{ $dataset->tag }}">{{ $dataset->tag }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-default" type="submit">View</button>
                    </div>
                </form>
                <hr>
                <!-- Data table -->
                <table id="shared-data-table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Value</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
