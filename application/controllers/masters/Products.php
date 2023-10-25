<?php
class Products extends PS_Controller{
	public $menu_code = 'DBPROD'; //--- Add/Edit Users
	public $menu_group_code = 'DB'; //--- System security
	public $title = 'เพิ่ม/แก้ไข รายการสินค้า';
	public $segment = 4;

  public function __construct()
  {
    parent::__construct();
    $this->home = base_url().'masters/products';
    $this->load->model('masters/products_model');
  }



  public function index()
  {
		$filter = array(
			'barcode' => get_filter('barcode', 'pd_barcode', ''),
			'code' => get_filter('code', 'pd_code', ''),
      'name' => get_filter('name', 'pd_name', ''),
      'style' => get_filter('style', 'pd_style', ''),
			'active' => get_filter('active', 'pd_active', 'all')
		);

    if($this->input->post('search'))
    {
      redirect($this->home);
    }
    else
    {
      //--- แสดงผลกี่รายการต่อหน้า
  		$perpage = get_rows();

  		$rows = $this->products_model->count_rows($filter);

  		$filter['data'] = $this->products_model->get_list($filter, $perpage, $this->uri->segment($this->segment));

  		//--- ส่งตัวแปรเข้าไป 4 ตัว base_url ,  total_row , perpage = 20, segment = 3
  		$init	= pagination_config($this->home.'/index/', $rows, $perpage, $this->segment);

  		$this->pagination->initialize($init);

      $this->load->view('masters/products/product_list', $filter);
    }
  }


  public function add_new()
  {
    $this->load->view('masters/products/product_add');
  }


  public function add()
  {
    $sc = TRUE;

    $code = $this->input->post('code');
    $name = $this->input->post('name');
    $barcode = $this->input->post('barcode');
    $style = $this->input->post('style');
    $cost = $this->input->post('cost');
    $price = $this->input->post('price');
    $active = $this->input->post('active') == 1 ? 1 : 0;

    if($this->products_model->is_exists_barcode($barcode))
    {
      $sc = FALSE;
      $this->error = "บาร์โค้ดซ้ำ";
    }

    if($sc === TRUE)
    {
      if($this->products_model->is_exists_code($code))
      {
        $sc = FALSE;
        $this->error = "รหัสซ้ำ";
      }
    }

    if($sc === TRUE)
    {
      $arr = array(
        'barcode' => $barcode,
        'code' => $code,
        'name' => $name,
        'style' => $style,
        'cost' => empty($cost) ? 0.00 : $cost,
        'price' => empty($price) ? 0.00 : $price,
        'active' => $active,
      );

      if( ! $this->products_model->add($arr))
      {
        $sc = FALSE;
        $this->error = "เพิ่มรหัสสินค้าไม่สำเร็จ";
      }
    }

    echo $sc === TRUE ? 'success' : $this->error;
  }


  public function edit($id)
  {
    $pd = $this->products_model->get_by_id($id);

    if( ! empty($pd))
    {
      $this->load->view('masters/products/product_edit', array('pd' => $pd));
    }
    else
    {
      $this->page_error();
    }
  }


  public function update()
  {
    $sc = TRUE;
    $id = $this->input->post('id');
    $code = $this->input->post('code');
    $name = $this->input->post('name');
    $barcode = $this->input->post('barcode');
    $style = $this->input->post('style');
    $cost = $this->input->post('cost');
    $price = $this->input->post('price');
    $active = $this->input->post('active') == 1 ? 1 : 0;

    if($this->products_model->is_exists_barcode($barcode, $id))
    {
      $sc = FALSE;
      $this->error = "บาร์โค้ดซ้ำ";
    }

    if($sc === TRUE)
    {
      if($this->products_model->is_exists_code($code, $id))
      {
        $sc = FALSE;
        $this->error = "รหัสซ้ำ";
      }
    }

    if($sc === TRUE)
    {
      $arr = array(
        'barcode' => $barcode,
        'code' => $code,
        'name' => $name,
        'style' => $style,
        'cost' => empty($cost) ? 0.00 : $cost,
        'price' => empty($price) ? 0.00 : $price,
        'active' => $active,
      );

      if( ! $this->products_model->update_by_id($id, $arr))
      {
        $sc = FALSE;
        $this->error = "แก้ไขรายการไม่สำเร็จ";
      }
    }

    echo $sc === TRUE ? 'success' : $this->error;
  }


  public function download_template($token)
  {
    //--- load excel library
    $this->load->library('excel');

    $this->excel->setActiveSheetIndex(0);
    $this->excel->getActiveSheet()->setTitle('Import template');

    //--- set report title header
    $this->excel->getActiveSheet()->setCellValue('A1', 'บาร์โค้ด');
    $this->excel->getActiveSheet()->setCellValue('B1', 'รหัสสินค้า');
    $this->excel->getActiveSheet()->setCellValue('C1', 'ชื่อสินค้า');
    $this->excel->getActiveSheet()->setCellValue('D1', 'รุ่น');
    $this->excel->getActiveSheet()->setCellValue('E1', 'ราคาทุน');
    $this->excel->getActiveSheet()->setCellValue('F1', 'ราคาขาย');

    $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth('20');
    $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth('30');
    $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth('50');
    $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth('30');
    $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth('20');
    $this->excel->getActiveSheet()->getColumnDimension('F')->setWidth('20');

    setToken($token);

    $file_name = "Import_product_template.xlsx";
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'); /// form excel 2007 XLSX
    header('Content-Disposition: attachment;filename="'.$file_name.'"');
    $writer = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
    $writer->save('php://output');
  }


  public function count_update_items()
  {
		$last_sync = $this->input->get('last_sync');
		$this->load->library('api');

		$count = $this->api->countUpdateItem($last_sync);

		if($count === FALSE)
		{
			echo "error";
		}
		else
		{
			echo $count;
		}
  }


  public function get_update_items($offset)
  {
		$sc = TRUE;

		$this->load->library('api');

    $last_sync = $this->input->get('last_sync');

		$limit = 100;

		$count = 0;

    $ds = $this->api->getUpdateItems($last_sync, $limit, $offset);

		if( ! empty($ds) && $ds->status === TRUE)
		{
			if( ! empty($ds->items))
	    {
	      foreach($ds->items as $rs)
	      {
	        $arr = array(
	          'barcode' => $rs->barcode,
	          'code' => $rs->code,
	          'name' => $rs->name,
	          'style' => $rs->style_code,
	          'cost' => $rs->cost,
	          'price' => $rs->price,
	          'last_sync' => date('Y-m-d H:i:s')
	        );

	        $id = $this->products_model->get_id_by_barcode($rs->barcode);

	        if( ! $id)
	        {
	          $this->products_model->add($arr);
	        }
	        else
	        {
	          $this->products_model->update_by_id($id, $arr);
	        }

	        $count++;
	      }
	    }
		}
		else
		{
			$sc = FALSE;
			$this->error = $this->api->error;
		}

    $arr = array(
			'status' => $sc === TRUE ? 'success' : 'failed',
			'message' => $sc === TRUE ? 'success' : $this->error,
			'updateCount' => $count
		);

		echo json_encode($arr);
  }


  public function get_items_last_sync($option = 'update')
  {
		$this->load->library('api');

		$last_sync = '2018-01-01 00:00:00';

		if($option != 'all')
		{
			$last_sync = $this->products_model->get_items_last_sync();
		}

		$count_items = $this->api->countUpdateItems($last_sync);

		if($count_items == FALSE)
		{
			$count_items = $this->api->error;
		}


    $arr = array('last_sync' => $last_sync, 'count_items' => empty($count_items) ? 0 : $count_items);

    echo json_encode($arr);
  }


  public function close_sync()
  {
    $sc = TRUE;
    if( ! $this->products_model->close_sync())
    {
      $sc = FALSE;
      $this->error = "Close sync failed";
    }

    echo $sc === TRUE ? 'success' : $thsi->error;
  }


  public function clear_filter()
  {
    $filter = array(
			'pd_barcode',
			'pd_code',
      'pd_name',
      'pd_style',
			'pd_active'
		);

    return clear_filter($filter);
  }
} //--- end class
 ?>
