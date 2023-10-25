<?php
class Shop extends PS_Controller
{
  public $menu_code = 'DBSHOP'; //--- Add/Edit Users
	public $menu_group_code = 'DB'; //--- System security
	public $title = 'เพิ่ม/แก้ไข โซน';
	public $segment = 4;

  public function __construct()
  {
    parent::__construct();
    $this->home = base_url().'masters/shop';
    $this->load->model('masters/shop_model');
  }



  public function index()
  {
		$filter = array(
			'code' => get_filter('code', 'shop_code', ''),
      'warehouse' => get_filter('warehouse', 'shop_warehouse', ''),
      'is_consignment' => get_filter('is_consignment', 'shop_is_consignment', 'all'),
      'allow_input_qty' => get_filter('allow_input_qty', 'shop_allow_input_qty', 'all'),
			'active' => get_filter('active', 'shop_active', 'all')
		);

    if($this->input->post('search'))
    {
      redirect($this->home);
    }
    else
    {
      //--- แสดงผลกี่รายการต่อหน้า
  		$perpage = get_rows();

  		$rows = $this->shop_model->count_rows($filter);

  		$filter['data'] = $this->shop_model->get_list($filter, $perpage, $this->uri->segment($this->segment));

  		//--- ส่งตัวแปรเข้าไป 4 ตัว base_url ,  total_row , perpage = 20, segment = 3
  		$init	= pagination_config($this->home.'/index/', $rows, $perpage, $this->segment);

  		$this->pagination->initialize($init);

      $this->load->view('masters/shop/shop_list', $filter);
    }
  }

  public function add_new()
  {
    if($this->pm->can_add)
    {
      $this->load->view('masters/shop/shop_add');
    }
    else
    {
      $this->permission_page();
    }
  }


  public function add()
  {
    $sc = TRUE;

    $code = $this->input->post('code');
    $name = $this->input->post('name');
    $warehouse_code = $this->input->post('warehouse_code');
    $warehouse_name = $this->input->post('warehouse_name');
    $allow_input_qty = $this->input->post('allow_input_qty') == 1 ? 1 : 0;
    $active = $this->input->post('active') == 1 ? 1 : 0;

    if($this->shop_model->is_exists_code($code))
    {
      $sc = FALSE;
      $this->error = "รหัสซ้ำ";
    }

    if($sc === TRUE)
    {
      $arr = array(
        'code' => $code,
        'name' => $name,
        'warehouse_code' => $warehouse_code,
        'warehouse_name' => $warehouse_name,
        'allow_input_qty' => $allow_input_qty,
        'active' => $active,
        'create_by' => $this->_user->uname
      );

      if( ! $this->shop_model->add($arr))
      {
        $sc = FALSE;
        $this->error = "เพิ่มโซนไม่สำเร็จ";
      }
    }

    echo $sc === TRUE ? 'success' : $this->error;
  }

  public function edit($id)
  {
    $shop = $this->shop_model->get_by_id($id);

    if( ! empty($shop))
    {
      $this->load->view('masters/shop/shop_edit', array('shop' => $shop));
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
    $warehouse_code = $this->input->post('warehouse_code');
    $warehouse_name = $this->input->post('warehouse_name');
    $allow_input_qty = $this->input->post('allow_input_qty') == 1 ? 1 : 0;
    $active = $this->input->post('active') == 1 ? 1 : 0;

    if($this->shop_model->is_exists_code($code, $id))
    {
      $sc = FALSE;
      $this->error = "รหัสซ้ำ";
    }

    if($sc === TRUE)
    {
      $arr = array(
        'code' => $code,
        'name' => $name,
        'warehouse_code' => $warehouse_code,
        'warehouse_name' => $warehouse_name,
        'allow_input_qty' => $allow_input_qty,
        'active' => $active,
        'date_upd' => now(),
        'update_by' => $this->_user->uname
      );

      if( ! $this->shop_model->update_by_id($id, $arr))
      {
        $sc = FALSE;
        $this->error = "แก้ไขโซนไม่สำเร็จ";
      }
    }

    echo $sc === TRUE ? 'success' : $this->error;
  }


  public function delete()
  {
    $sc = TRUE;
    $id = $this->input->post('id');

    if( ! empty($id))
    {
      if($this->pm->can_delete)
      {
        if( empty($this->shop_model->is_exists_transection($id)))
        {
          if( ! $this->shop_model->delete($id))
          {
            $sc = FALSE;
            $this->error = "Delete failed";
          }
        }
        else
        {
          $sc = FALSE;
          $this->error = "Delete failed : Transection exists";
        }
      }
      else
      {
        $sc = FALSE;
        set_error('permission');
      }
    }
    else
    {
      $sc = FALSE;
      $this->error = "Missing required parameter";
    }

    echo $sc === TRUE ? 'success' : $this->error;
  }


  public function count_update_items()
  {
		$this->load->library('api');

		$count = $this->api->countUpdateZone();

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

		$limit = 100;

		$count = 0;

    $ds = $this->api->getUpdateZone($limit, $offset);

		if( ! empty($ds) && $ds->status === TRUE)
		{
			if( ! empty($ds->items))
	    {
	      foreach($ds->items as $rs)
	      {
          if( ! empty($rs->name))
          {
            $arr = array(
              'code' => $rs->code,
              'name' => $rs->name,
              'warehouse_code' => $rs->warehouse_code,
              'warehouse_name' => $rs->warehouse_name,
              'is_consignment' => empty($rs->is_consignment) ? 0 : 1
            );

            $zone = $this->shop_model->get_by_code($rs->code);

            if(empty($zone))
            {
              $this->shop_model->add($arr);
            }
            else
            {
              $this->shop_model->update_by_id($zone->id, $arr);
            }
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


  public function get_items_last_sync()
  {
		$this->load->library('api');

		$count_items = $this->api->countUpdateZone();

		if($count_items == FALSE)
		{
			$count_items = $this->api->error;
		}

    $arr = array('count_items' => empty($count_items) ? 0 : $count_items);

    echo json_encode($arr);
  }


  public function close_sync()
  {
    $sc = TRUE;
    if( ! $this->shop_model->close_sync())
    {
      $sc = FALSE;
      $this->error = "Close sync failed";
    }

    echo $sc === TRUE ? 'success' : $thsi->error;
  }

  public function clear_filter()
  {
    $filter = array(
			'shop_code',
			'shop_warehouse',
      'shop_is_consignment',
      'shop_allow_input_qty',
			'shop_active'
		);

    return clear_filter($filter);
  }
} //--- end class

 ?>
