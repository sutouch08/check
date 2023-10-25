<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auto_complete extends CI_Controller
{
  public $ms;
  public function __construct()
  {
    parent::__construct();
  }

  public function get_zone_code_and_name()
  {
    $txt = trim($_REQUEST['term']);
    $sc = array();

    $rs = $this->db
    ->select('code, name')
    ->where('active', 1)
    ->group_start()
    ->like('code', $txt)
    ->or_like('name', $txt)
    ->group_end()
    ->limit(50)
    ->get('shop');

    if($rs->num_rows() > 0)
    {
      foreach($rs->result() as $rd)
      {
        $sc[] = array('code' => $rd->code, 'name' => $rd->name, 'label' => $rd->code.' | '.$rd->name);
      }
    }

    echo json_encode($sc);
  }

} //-- end class
?>
