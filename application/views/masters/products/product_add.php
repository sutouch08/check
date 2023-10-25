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
			<label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label no-padding-right">รหัสสินค้า</label>
			<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 padding-5">
				<input type="text" name="code" id="code" class="width-100" maxlength="50" value="" onkeyup="validCode(this)" autofocus required />
			</div>
			<div class="help-block col-xs-12 col-sm-reset inline grey" id="code-error">Allow only [a-z, A-Z, 0-9, "-", "_" ]</div>
		</div>
		<div class="form-group">
			<label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label no-padding-right">ชื่อสินค้า</label>
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 padding-5">
				<input type="text" name="name" id="name" class="width-100" maxlength="100" value="" required />
			</div>
			<div class="help-block col-xs-12 col-sm-reset inline red" id="name-error"></div>
		</div>

		<div class="form-group">
			<label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label no-padding-right">รุ่นสินค้า</label>
			<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 padding-5">
				<input type="text" name="style" id="style" maxlength="50" class="width-100" value="" required />
			</div>
			<div class="help-block col-xs-12 col-sm-reset inline red" id="style-error"></div>
		</div>

		<div class="form-group">
			<label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label no-padding-right">บาร์โค้ด</label>
			<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 padding-5">
				<input type="text" name="barcode" id="barcode" maxlength="50" class="width-100" value="" />
			</div>
			<div class="help-block col-xs-12 col-sm-reset inline red" id="barcode-error"></div>
		</div>


		<div class="form-group">
			<label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label no-padding-right">ราคาทุน</label>
			<div class="col-lg-1-harf col-md-1-harf col-sm-2 col-xs-6 padding-5">
				<input type="number" step="any" name="cost" id="cost" class="width-100" value="" required />
			</div>
			<div class="help-block col-xs-12 col-sm-reset inline red" id="cost-error"></div>
		</div>

		<div class="form-group">
			<label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label no-padding-right">ราคาขาย</label>
			<div class="col-lg-1-harf col-md-1-harf col-sm-2 col-xs-6 padding-5">
				<input type="number" step="any" name="price" id="price" class="width-100" value="" required />
			</div>
			<div class="help-block col-xs-12 col-sm-reset inline red" id="price-error"></div>
		</div>

		<div class="form-group">
			<label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label no-padding-right">Active</label>
			<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 padding-5">
				<label style="padding-top:5px;">
					<input name="active" id="active" class="ace ace-switch ace-switch-7" type="checkbox" value="1" checked />
					<span class="lbl"></span>
				</label>
			</div>
			<div class="help-block col-xs-12 col-sm-reset inline red"></div>
		</div>

    <div class="divider-hidden"></div>
    <div class="divider-hidden"></div>
    <div class="divider-hidden"></div>

		<div class="form-group">
			<label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label no-padding-right not-show">บันทึก</label>
			<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 padding-5">
				<button type="button" class="btn btn-sm btn-success btn-100" onclick="add()"><i class="fa fa-save"></i> บันทึก</button>
			</div>
			<div class="help-block col-xs-12 col-sm-reset inline red"></div>
		</div>

		<input type="hidden" name="valid" id="valid" value=""/>
	</div>
	</form>
</div><!--/ row  -->

<script src="<?php echo base_url(); ?>scripts/masters/products.js?v=<?php echo date('Ymd'); ?>"></script>
<script src="<?php echo base_url(); ?>scripts/code_validate.js"></script>
<?php $this->load->view('include/footer'); ?>
