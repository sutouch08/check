
	<form id="documentForm" method="post" action="<?php echo $this->home; ?>/update_config">

    <div class="row">
      <div class="col-lg-1-harf col-md-3 col-sm-3 col-xs-4 padding-5">
				<label>Prefix</label>
				<input type="text" class="form-control input-sm text-center prefix"
				maxlength="3" name="PREFIX_CHECK" onkeyup="validPrefix(this)"
				value="<?php echo $PREFIX_CHECK; ?>"/>
			</div>
      <div class="col-lg-1-harf col-md-3 col-sm-3 col-xs-4 padding-5">
				<label>Running digit</label>
				<select class="form-control input-sm" name="RUN_DIGIT_QUOTATION">
					<option value="3" <?php echo is_selected('3', $RUN_DIGIT_CHECK); ?>>3</option>
					<option value="4" <?php echo is_selected('4', $RUN_DIGIT_CHECK); ?>>4</option>
					<option value="5" <?php echo is_selected('5', $RUN_DIGIT_CHECK); ?>>5</option>
					<option value="6" <?php echo is_selected('6', $RUN_DIGIT_CHECK); ?>>6</option>
					<option value="7" <?php echo is_selected('7', $RUN_DIGIT_CHECK); ?>>7</option>
				</select>
			</div>

			<div class="col-lg-1-harf col-md-3 col-sm-3 col-xs-4 padding-5">
				<label class="display-block not-show">save</label>
				<?php if($this->pm->can_edit OR $this->pm->can_add) : ?>
	      	<button type="button" class="btn btn-xs btn-success input-small" onClick="checkDocumentSetting()"><i class="fa fa-save"></i> บันทึก</button>
				<?php endif; ?>
			</div>
		</div>
  </form>
