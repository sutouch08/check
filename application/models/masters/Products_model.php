<?php
class Products_model extends CI_Model
{
  private $tb = "products";

  public function __construct()
  {
    parent::__construct();
  }

  public function add(array $ds = array())
  {
    if( ! empty($ds))
    {
      if($this->db->insert($this->tb, $ds))
      {
        return $this->db->insert_id();
      }
    }

    return FALSE;
  }


  public function update_by_id($id, array $ds = array())
  {
    if( ! empty($ds))
    {
      return $this->db->where('id', $id)->update($this->tb, $ds);
    }

    return FALSE;
  }


  public function update_by_code($code, array $ds = array())
  {
    if( ! empty($ds))
    {
      return $this->db->where('code', $code)->update($this->tb, $ds);
    }

    return FALSE;
  }


  public function delete_by_id($id)
  {
    return $this->db->where('id', $id)->delete($this->tb);
  }


  public function get_by_id($id)
  {
    $rs = $this->db->where('id', $id)->get($this->tb);

    if($rs->num_rows() === 1)
    {
      return $rs->row();
    }

    return NULL;
  }

  public function get_by_code($code)
  {
    $rs = $this->db->where('code', $code)->get($this->tb);

    if($rs->num_rows() === 1)
    {
      return $rs->row();
    }

    return NULL;
  }


  public function get_by_old_code($code)
  {
    $rs = $this->db->where('old_code', $code)->get($this->tb);

    if($rs->num_rows() > 0)
    {
      return $rs->row();
    }

    return NULL;
  }


  public function get_by_barcode($barcode)
  {
    $rs = $this->db->where('barcode', $barcode)->order_by('id', 'DESC')->limit(1)->get($this->tb);

    if($rs->num_rows() > 0)
    {
      return $rs->row();
    }

    return NULL;
  }


  public function get_id_by_barcode($barcode)
  {
    $rs = $this->db->where('barcode', $barcode)->order_by('id', 'DESC')->limit(1)->get($this->tb);

    if($rs->num_rows() > 0)
    {
      return $rs->row()->id;
    }

    return NULL;
  }


  public function is_exists_id($id)
  {
    $count = $this->db->where('id', $id)->count_all_results($this->tb);

    return $count > 0 ? TRUE : FALSE;
  }


  public function count_rows(array $ds = array())
  {
    if( isset($ds['barcode']) && $ds['barcode'] != '')
    {
      $this->db->like('barcode', $ds['barcode']);
    }

    if( isset($ds['code']) && $ds['code'] != '')
    {
      $this->db
      ->group_start()
      ->like('code', $ds['code'])
      ->or_like('old_code', $ds['code'])
      ->group_end();
    }

    if( isset($ds['name']) && $ds['name'] != '')
    {
      $this->db->like('name', $ds['name']);
    }

    if( isset($ds['style']) && $ds['style'] != '')
    {
      $this->db->like('style', $ds['style']);
    }

    if( isset($ds['active']) && $ds['active'] != 'all')
    {
      $this->db->where('active', $ds['active']);
    }

    return $this->db->count_all_results($this->tb);
  }


  public function get_list(array $ds = array(), $limit = 20, $offset = 0)
  {
    if( isset($ds['barcode']) && $ds['barcode'] != '')
    {
      $this->db->like('barcode', $ds['barcode']);
    }

    if( isset($ds['code']) && $ds['code'] != '')
    {
      $this->db
      ->group_start()
      ->like('code', $ds['code'])
      ->or_like('old_code', $ds['code'])
      ->group_end();
    }

    if( isset($ds['name']) && $ds['name'] != '')
    {
      $this->db->like('name', $ds['name']);
    }

    if( isset($ds['style']) && $ds['style'] != '')
    {
      $this->db->like('style', $ds['style']);
    }

    if( isset($ds['active']) && $ds['active'] != 'all')
    {
      $this->db->where('active', $ds['active']);
    }

    $rs = $this->db->order_by('code', 'ASC')->limit($limit, $offset)->get($this->tb);

    if($rs->num_rows() > 0)
    {
      return $rs->result();
    }

    return NULL;
  }


  public function is_exists_barcode($barcode, $id = NULL)
  {
    if( ! empty($id))
    {
      $this->db->where('id !=', $id);
    }

    $count = $this->db->where('barcode', $barcode)->count_all_results($this->tb);

    return $count > 0 ? TRUE : FALSE;
  }


  public function is_exists_code($code, $id = NULL)
  {
    if( ! empty($id))
    {
      $this->db->where('id !=', $id);
    }

    $count =  $this->db->where('code', $code)->count_all_results($this->tb);

    return $count > 0 ? TRUE : FALSE;
  }


  public function get_items_last_sync()
	{
		$rs = $this->db->select_max('sync_at')->where('sync_status', 1)->get('products_sync_logs');

		if($rs->num_rows() === 1)
    {
      return $rs->row()->sync_at === NULL ? date('2019-01-01 00:00:00') : $rs->row()->sync_at;
    }

    return date('2019-01-01 00:00:00');
	}


  public function close_sync()
  {
    $arr = array(
      'sync_at' => now(),
      'sync_by' => $this->_user->uname,
      'sync_status' => 1
    );

    return $this->db->insert('products_sync_logs', $arr);
  }

} //--- end classs
?>
