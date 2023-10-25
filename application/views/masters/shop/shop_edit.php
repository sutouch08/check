<?php $this->load->view('include/header'); ?>
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 padding-5 hidden-xs">
    <h3 class="title"><?php echo $this->title; ?></h3>
  </div>
  <div class="col-lg-12 visible-xs padding-5">
    <h3 class="title-xs"><?php echo $this->title; ?></h3>
  </div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 padding-5">
		<p class="pull-right top-p">
			<button type="button" class="btn btn-sm btn-warning" onclick="goBack()"><i class="fa fa-arrow-left"></i> Back</button>
		</p>
	</div>
</div><!-- End Row -->
<hr class="margin-bottom-15"/>
<div class="row">
	<form class="form-horizontal" id="addForm" method="post" action="<?php echo $this->home."/add"; ?>">
	<div class="row">
		<div class="form-group">
			<label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label no-padding-right">รหัสโซน</label>
			<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 padding-5">
				<input type="text" name="code" id="code" class="width-100" maxlength="50" value="<?php echo $shop->code; ?>" onkeyup="validCode(this)" />
			</div>
			<div class="help-block col-xs-12 col-sm-reset inline grey" id="code-error">Allow only [a-z, A-Z, 0-9, "-", "_" ]</div>
		</div>
		<div class="form-group">
			<label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label no-padding-right">ชื่อโซน</label>
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 padding-5">
				<input type="text" name="name" id="name" class="width-100" maxlength="100" value="<?php echo $shop->name; ?>" />
			</div>
			<div class="help-block col-xs-12 col-sm-reset inline red" id="name-error"></div>
		</div>

		<div class="form-group">
			<label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label no-padding-right">รหัสคลัง</label>
			<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 padding-5">
				<input type="text" name="warehouse_code" id="warehouse_code" class="width-100" maxlength="8" value="<?php echo $shop->warehouse_code; ?>" onkeyup="validCode(this)" />
			</div>
			<div class="help-block col-xs-12 col-sm-reset inline grey" id="warehoouse_code-error">Allow only [a-z, A-Z, 0-9, "-", "_" ]</div>
		</div>
		<div class="form-group">
			<label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label no-padding-right">ชื่อคลัง</label>
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 padding-5">
				<input type="text" name="warehouse_name" id="warehouse_name" class="width-100" maxlength="100" value="<?php echo $shop->warehouse_name; ?>" />
			</div>
			<div class="help-block col-xs-12 col-sm-reset inline red" id="warehouse_name-error"></div>
		</div>

		<div class="form-group">
			<label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label no-padding-right">ใส่จำนวนได้</label>
			<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 padding-5">
				<label style="padding-top:5px;">
					<input name="allow_input_qty" id="allow_input_qty" class="ace ace-switch ace-switch-7" type="checkbox" value="1" <?php echo is_checked('1', $shop->allow_input_qty); ?>/>
					<span class="lbl"></span>
				</label>
			</div>
			<div class="help-block col-xs-12 col-sm-reset inline red"></div>
		</div>

		<div class="form-group">
			<label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label no-padding-right">Active</label>
			<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 padding-5">
				<label style="padding-top:5px;">
					<input name="active" id="active" class="ace ace-switch ace-switch-7" type="checkbox" value="1" <?php echo is_checked('1', $shop->active); ?> />
					<span class="lbl"></span>
				</label>
			</div>
			<div class="help-block col-xs-12 col-sm-reset inline red"></div>
		</div>

    <div class="divider-hidden"></div>
    <div class="divider-hidden"></div>
    <div class="divider-hidden"></div>

		<div class="form-group">
			<label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label no-padding-right not-show">update</label>
			<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 padding-5">
				<button type="button" class="btn btn-sm btn-success btn-100" onclick="update()"><i class="fa fa-save"></i> Update</button>
			</div>
			<div class="help-block col-xs-12 col-sm-reset inline red"></div>
		</div>

		<input type="hidden" id="shop_id" value="<?php echo $shop->id; ?>"/>
	</div>
	</form>
</div><!--/ row  -->

<script src="<?php echo base_url(); ?>scripts/masters/shop.js?v=<?php echo date('Ymd'); ?>"></script>
<script src="<?php echo base_url(); ?>scripts/code_validate.js"></script>
<?php $this->load->view('include/footer'); ?>
