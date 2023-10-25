<!--  Add New Address Modal  --------->
<div class="modal fade" id="syncModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" style="width:600px; max-width:90vw;">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title-site text-center" >Sync Zone</h4>
      </div>
      <div class="modal-body">
        <div class="row" style="margin-left:0; margin-right:0;">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h4 class="text-center" id="txt-label">Waiting for action</h4>
          </div>
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="progress pos-rel progress-striped hide" style="background-color:#CCC;" id="txt-percent" data-percent="0%">
        			<div class="progress-bar progress-bar-primary" id="progress-bar" style="width: 0%;"></div>
        		</div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-xs btn-primary btn-100" id="btn-sync" onclick="startSync()">Sync</button>
        <button type="button" class="btn btn-xs btn-warning btn-100 hide" id="btn-stop" onclick="stopSync()">Pause</button>
        <button type="button" class="btn btn-xs btn-warning btn-100 hide" id="btn-finish" onclick="finishSync()">Pause</button>
        <button type="button" class="btn btn-xs btn-default btn-100" onclick="closeModal('syncModal')">Cancel</button>
      </div>
    </div>
  </div>
</div>
