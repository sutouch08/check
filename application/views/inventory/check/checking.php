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
		<?php if($doc->status == 'O' && ($this->pm->can_edit OR $this->pm->can_add)) : ?>
			<button type="button" class="btn btn-sm btn-primary" onclick="closeCheck()">ปิดการตรวจนับ</button>
		<?php endif; ?>
		<?php if($doc->status == 'C' && ($this->pm->can_edit OR $this->pm->can_add)) : ?>
			<button type="button" class="btn btn-sm btn-purple" onclick="reOpenCheck()">เปิดการตรวจนับ</button>
		<?php endif; ?>
		</p>
	</div>
</div><!-- End Row -->
<hr class=""/>
<div class="row">
	<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
		เลขที่ : <?php echo $doc->code; ?>
	</div>
	<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
		หัวข้อ : <?php echo $doc->subject; ?>
	</div>
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		สถานที่ : <?php echo $doc->zone_code .'&nbsp;&nbsp; : &nbsp;&nbsp;'.$doc->zone_name; ?>
	</div>
	<input type="hidden" id="check_id" value="<?php echo $doc->id; ?>" />
	<input type="hidden" id="allow_input_qty" value="<?php echo $doc->allow_input_qty; ?>" />
	<input type="hidden" id="row-no" value="1" />
</div>
<hr class="margin-top-15 margin-bottom-15">

<?php $this->load->view('inventory/check/check_control'); ?>

<?php $this->load->view('inventory/check/check_details'); ?>

<?php $this->load->view('inventory/check/check_template'); ?>

<script src="<?php echo base_url(); ?>scripts/inventory/check.js?v=<?php echo date('YmdH'); ?>"></script>
<script src="<?php echo base_url(); ?>scripts/inventory/check_control.js?v=<?php echo date('YmdH'); ?>"></script>
<script src="<?php echo base_url(); ?>scripts/beep.js"></script>

<?php $this->load->view('include/footer'); ?>
