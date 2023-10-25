<?php
class Shop_model extends CI_Model
{
  private $tb = "shop";

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


  public function delete($id)
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



  public function count_rows(array $ds = array())
  {
    if( isset($ds['code']) && $ds['code'] != '')
    {
      $this->db
      ->group_start()
      ->like('code', $ds['code'])
      ->or_like('name', $ds['code'])
      ->group_end();
    }

    if( isset($ds['warehouse']) && $ds['warehouse'] != '')
    {
      $this->db
      ->group_start()
      ->like('warehouse_code', $ds['warehouse'])
      ->or_like('warehouse_name', $ds['warehouse'])
      ->group_end();
    }

    if( isset($ds['is_consignment']) && $ds['is_consignment'] != 'all')
    {
      $this->db->where('is_consignment', $ds['is_consignment']);
    }

    if( isset($ds['allow_input_qty']) && $ds['allow_input_qty'] != 'all')
    {
      $this->db->where('allow_input_qty', $ds['allow_input_qty']);
    }

    if( isset($ds['active']) && $ds['active'] != 'all')
    {
      $this->db->where('active', $ds['active']);
    }

    return $this->db->count_all_results($this->tb);
  }


  public function get_list(array $ds = array(), $limit = 20, $offset = 0)
  {
    if( isset($ds['code']) && $ds['code'] != '')
    {
      $this->db
      ->group_start()
      ->like('code', $ds['code'])
      ->or_like('name', $ds['code'])
      ->group_end();
    }

    if( isset($ds['warehouse']) && $ds['warehouse'] != '')
    {
      $this->db
      ->group_start()
      ->like('warehouse_code', $ds['warehouse'])
      ->or_like('warehouse_name', $ds['warehouse'])
      ->group_end();
    }

    if( isset($ds['is_consignment']) && $ds['is_consignment'] != 'all')
    {
      $this->db->where('is_consignment', $ds['is_consignment']);
    }

    if( isset($ds['allow_input_qty']) && $ds['allow_input_qty'] != 'all')
    {
      $this->db->where('allow_input_qty', $ds['allow_input_qty']);
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


  public function is_exists_code($code, $id = NULL)
  {
    if( ! empty($id))
    {
      $this->db->where('id !=', $id);
    }

    return $this->db->where('code', $code)->count_all_results($this->tb);
  }


  public function is_exists_transection($zone_id)
  {
    return $this->db->where('zone_id', $zone_id)->count_all_results('checks');
  }


  public function close_sync()
  {
    $arr = array(
      'sync_at' => now(),
      'sync_by' => $this->_user->uname,
      'sync_status' => 1
    );

    return $this->db->insert('shop_sync_logs', $arr);
  }

} //--- end classs
?>
