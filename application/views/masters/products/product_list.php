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
			<?php if($this->pm->can_add) : ?>
				<button type="button" class="btn btn-xs btn-success top-btn" onclick="addNew()"><i class="fa fa-plus"></i> &nbsp; เพิ่มใหม่</button>
        <button type="button" class="btn btn-xs btn-info btn-100 top-btn" onclick="preSync('update')"><i class="fa fa-refresh"></i> &nbsp; Sync</button>
  			<button type="button" class="btn btn-xs btn-info btn-100 top-btn" onclick="preSync('all')"><i class="fa fa-refresh"></i> &nbsp; Sync All</button>
			<?php endif; ?>
			<button type="button" class="btn btn-xs btn-primary top-btn" onclick="getUploadFile()"><i class="fa fa-file-excel-o"></i> &nbsp; Imoprt</button>
			<button type="button" class="btn btn-xs btn-purple top-btn" onclick="getTemplate()"><i class="fa fa-download"></i> &nbsp; template</button>
		</p>
	</div>
</div><!-- End Row -->
<hr class=""/>
<form id="searchForm" method="post" action="<?php echo current_url(); ?>">
<div class="row">
  <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 padding-5">
    <label>บาร์โค้ด</label>
    <input type="text" class="form-control input-sm" name="barcode" id="barcode" value="<?php echo $barcode; ?>" />
  </div>

  <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 padding-5">
    <label>รหัสสินค้า</label>
    <input type="text" class="form-control input-sm" name="code" id="code" value="<?php echo $code; ?>" />
  </div>

  <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 padding-5">
    <label>ชื่อสินค้า</label>
    <input type="text" class="form-control input-sm" name="name" id="name" value="<?php echo $name; ?>" />
  </div>

	<div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 padding-5">
    <label>รุ่นสินค้า</label>
    <input type="text" class="form-control input-sm" name="style" id="style" value="<?php echo $style; ?>" />
  </div>

	<div class="col-lg-1 col-md-1 col-sm-2 col-xs-4 padding-5">
    <label>Active</label>
		<select class="form-control input-sm" name="active" onchange="getSearch()">
			<option value="all">All</option>
			<option value="1" <?php echo is_selected('1', $active); ?>>Yes</option>
			<option value="0" <?php echo is_selected('0', $active); ?>>No</option>
		</select>
  </div>

	<div class="col-lg-1-harf col-md-1-harf col-sm-1-harf col-xs-4 padding-5">
    <label class="display-block not-show">buton</label>
    <button type="submit" class="btn btn-xs btn-primary btn-block"><i class="fa fa-search"></i> Search</button>
  </div>
	<div class="col-lg-1-harf col-md-1-harf col-sm-1-harf col-xs-4 padding-5">
    <label class="display-block not-show">buton</label>
    <button type="button" class="btn btn-xs btn-warning btn-block" onclick="clearFilter()"><i class="fa fa-retweet"></i> Reset</button>
  </div>
</div>

<input type="hidden" name="search" value="1" />
</form>
<hr class="margin-top-15">
<?php echo $this->pagination->create_links(); ?>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 table-responsive">
		<table class="table table-striped table-bordered table-hover" style="min-width:1490px;">
			<thead>
				<tr>
					<th class="fix-width-80"></th>
					<th class="fix-width-60 middle text-center">#</th>
					<th class="fix-width-150 middle text-center">บาร์โค้ด</th>
					<th class="fix-width-200 middle text-center">รหัสสินค้า</th>
					<th class="fix-width-200 middle text-center">รหัสเก่า</th>
          <th class="fix-width-300 middle text-center">ชื่อสินค้า</th>
					<th class="fix-width-150 middle text-center">รุ่น</th>
          <th class="fix-width-100 middle text-center">ทุน</th>
					<th class="fix-width-100 middle text-center">ราคา</th>
					<th class="fix-width-60 middle text-center">สถานะ</th>
					<th class="min-width-150 middle">ปรับปรุงล่าสุด</th>
				</tr>
			</thead>
			<tbody>
			<?php if(!empty($data)) : ?>
				<?php $no = $this->uri->segment(4) + 1; ?>
				<?php foreach($data as $rs) : ?>
					<tr id="row-<?php echo $rs->id; ?>" class="font-size-12">
						<td class="middle text-center">
							<?php if($this->pm->can_edit) : ?>
								<button type="button" class="btn btn-minier btn-warning" onclick="getEdit('<?php echo $rs->id; ?>')">
									<i class="fa fa-pencil"></i>
								</button>
							<?php endif; ?>
							<?php if($this->pm->can_delete) : ?>
								<button type="button" class="btn btn-minier btn-danger" onclick="getDelete('<?php echo $rs->code; ?>', <?php echo $rs->id; ?>)">
									<i class="fa fa-trash"></i>
								</button>
							<?php endif; ?>
						</td>
						<td class="middle text-center no"><?php echo $no; ?></td>
						<td class="middle"><?php echo $rs->barcode; ?></td>
						<td class="middle"><?php echo $rs->code; ?></td>
						<td class="middle"><?php echo $rs->old_code; ?></td>
            <td class="middle"><?php echo $rs->name; ?></td>
						<td class="middle"><?php echo $rs->style; ?></td>
            <td class="middle text-right"><?php echo number($rs->cost, 2); ?></td>
						<td class="middle text-right"><?php echo number($rs->price, 2); ?></td>
						<td class="middle text-center"><?php echo is_active($rs->active); ?></td>
						<td class="middle"><?php echo (! empty($rs->date_upd) ? thai_date($rs->date_upd, TRUE) : NULL); ?></td>
					</tr>
					<?php $no++; ?>
				<?php endforeach; ?>
			<?php endif; ?>
			</tbody>
		</table>
	</div>
</div>
<?php $this->load->view('masters/products/import_items'); ?>
<?php $this->load->view('masters/products/sync_modal'); ?>

<script src="<?php echo base_url(); ?>scripts/masters/products.js?v=<?php echo date('Ymd'); ?>"></script>
<script src="<?php echo base_url(); ?>scripts/masters/sync_products.js?v=<?php echo date('Ymd'); ?>"></script>

<?php $this->load->view('include/footer'); ?>
