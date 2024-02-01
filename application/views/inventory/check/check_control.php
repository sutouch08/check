<?php $disabled = $doc->allow_input_qty == 1 ? '' : 'disabled'; ?>

<div class="row">
  <div class="col-lg-1 col-md-1 col-sm-1-harf col-xs-3 padding-5">
    <input type="number" class="form-control input-sm text-center focus" name="qty" id="qty" value="1" placeholder="Qty" <?php echo $disabled; ?>/>
  </div>

  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 padding-5">
    <input type="text" class="form-control input-sm text-center focus" name="barcode" id="barcode" placeholder="แสกนบาร์โค้ดเพื่อตรวจนับ"autofocus />
  </div>
  <div class="col-lg-1 col-md-1-harf col-sm-1-harf col-xs-3 padding-5">
    <button type="button" class="btn btn-xs btn-primary btn-block" id="btn-check" onclick="doChecking()">ตรวจนับ</button>
  </div>

  <div class="divider visible-xs"></div>

  <div class="col-lg-4 col-md-2-harf col-sm-2 hidden-xs">&nbsp;</div>
  <div class="col-lg-1-harf col-md-2 col-sm-2 col-xs-6">
    <button type="button" class="btn btn-xs btn-warning btn-block" onclick="inputView()">เรียกดูรายการล่าสุด (F3)</button>
  </div>

  <div class="col-lg-1-harf col-md-2 col-sm-2 col-xs-6">
    <button type="button" class="btn btn-xs btn-success btn-block" onclick="clearSheet()">เคลียร์พื้นที่ (F2)</button>
  </div>
</div>

<hr class="margin-top-15 margin-bottom-15"/>
