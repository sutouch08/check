<?php $this->load->view('include/header'); ?>
<div class="row">
	<div class="col-lg-4 col-md-4 col-sm-4 hidden-xs padding-5">
    <h3 class="title"><?php echo $this->title; ?></h3>
  </div>
	<div class="col-xs-12 visible-xs">
		<h3 class="title-xs"><?php echo $this->title; ?></h3>
	</div>
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 padding-5">
		<p class="pull-right top-p">
      <button type="button" class="btn btn-sm btn-warning" onclick="goBack()"><i class="fa fa-arrow-left"></i> &nbsp; Back</button>
		</p>
	</div>
</div><!-- End Row -->
<hr class=""/>
<div class="row">
  <div class="col-lg-1-harf col-md-1-harf col-sm-2-harf col-xs-6 padding-5">
    <label>วันที่</label>
    <input type="text" class="form-control input-sm text-center" name="date_add" id="date_add" value="<?php echo date('d-m-Y'); ?>" readonly/>
  </div>

  <div class="col-lg-3 col-md-3-harf col-sm-4-harf col-xs-6 padding-5">
    <label>หัวข้อ</label>
    <input type="text" class="form-control input-sm" name="subject" id="subject" value="" />
  </div>

  <div class="col-lg-2-harf col-md-1-harf col-sm-2-harf col-xs-6 padding-5">
    <label>โซน</label>
    <input type="text" class="form-control input-sm" name="zone_code" id="zone_code" value=""/>
  </div>

  <div class="col-lg-5 col-md-1-harf col-sm-2-harf col-xs-6 padding-5">
    <label class="not-show">โซน</label>
    <input type="text" class="form-control input-sm" name="zone_name" id="zone_name" value="" readonly/>
  </div>

  <div class="col-lg-10-harf col-md-10-harf col-sm-10-harf col-xs-9 padding-5">
    <label>หมายเหตุ</label>
    <input type="text" class="form-control input-sm" name="remark" id="remark" value="" />
  </div>
  <div class="col-lg-1-harf col-md-1-harf col-sm-1-harf col-xs-3 padding-5">
    <label class="display-block not-show">btn</label>
    <button type="button" class="btn btn-xs btn-success btn-block" onclick="add()"><i class="fa fa-plus"></i> Add</button>
  </div>
</div>
<hr class="margin-top-15">


<script src="<?php echo base_url(); ?>scripts/inventory/check.js?v=<?php echo date('Ymd'); ?>"></script>

<?php $this->load->view('include/footer'); ?>
