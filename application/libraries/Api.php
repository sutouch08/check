<?php
class Api
{
  private $url;
  private $api_key;
  protected $ci;
	public $error;
  protected $timeout = 0; //-- time out in seconds;
  private $username = 'api@warrix';
  private $pwd = 'ZK11o15o15L12s$p0rt';

  public function __construct()
  {
		$this->ci =& get_instance();

    $this->url = trim(getConfig('IX_API_HOST'));
		if($this->url[-1] != '/')
		{
			$this->url .'/';
		}

    $this->api_key = trim(getConfig('IX_API_KEY'));
    $this->username = trim(getConfig('IX_API_USER'));
    $this->pwd = trim(getConfig('IX_API_PWD'));
  }


  public function countUpdateItems($last_sync)
  {
    $arr = array(
      "date" => $last_sync
    );

    $url = $this->url .'products/countUpdateItem';
    $header = array();
    $header[] = 'Content-Type: application/json';
    $header[] = 'X-API-KEY: '.$this->api_key;
    $curl = curl_init();

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_DIGEST);
    curl_setopt($curl, CURLOPT_USERPWD, "{$this->username}:{$this->pwd}");
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($arr));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $header);

    $response = curl_exec($curl);

    curl_close($curl);

    $res = json_decode($response);

    if( ! empty($res) && $res->status)
    {
      return $res->count;
    }
    else
    {
      $this->error = $response;
      return FALSE;
    }
  }



  public function getUpdateItems($last_sync, $limit = 100, $offset = 0)
	{
    $arr = array(
			"date" => $last_sync,
      "limit" => $limit,
      "offset" => $offset
		);

    $json = json_encode($arr);
		$url = $this->url .'products/getUpdateItem';
    $header = array();
    $header[] = 'Content-Type: application/json';
    $header[] = 'X-API-KEY: '.$this->api_key;

		$curl = curl_init();

		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_DIGEST);
    curl_setopt($curl, CURLOPT_USERPWD, "{$this->username}:{$this->pwd}");
		curl_setopt($curl, CURLOPT_POSTFIELDS, $json);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $header);

		$response = curl_exec($curl);

		curl_close($curl);

		$res = json_decode($response);

		if( ! empty($res) && $res->status)
		{
      return $res;
		}
		else
		{
			$this->error = $response;
			return FALSE;
		}
	}


  //-------------------- Shop zone ----------------------------------------//
  public function countUpdateZone()
  {
    $url = $this->url .'zone/countUpdateZone';
    $header = array();
    $header[] = 'Content-Type: application/json';
    $header[] = 'X-API-KEY: '.$this->api_key;
    $curl = curl_init();

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_DIGEST);
    curl_setopt($curl, CURLOPT_USERPWD, "{$this->username}:{$this->pwd}");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $header);

    $response = curl_exec($curl);

    curl_close($curl);

    $res = json_decode($response);

    if( ! empty($res) && $res->status)
    {
      return $res->count;
    }
    else
    {
      $this->error = $response;
      return FALSE;
    }
  }


  public function getUpdateZone($limit = 100, $offset = 0)
	{
    $arr = array(
      "limit" => $limit,
      "offset" => $offset
		);

    $json = json_encode($arr);
		$url = $this->url .'zone/getUpdateZone';
    $header = array();
    $header[] = 'Content-Type: application/json';
    $header[] = 'X-API-KEY: '.$this->api_key;
		$curl = curl_init();

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_DIGEST);
    curl_setopt($curl, CURLOPT_USERPWD, "{$this->username}:{$this->pwd}");
    curl_setopt($curl, CURLOPT_POSTFIELDS, $json);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $header);

		$response = curl_exec($curl);

		curl_close($curl);

		$res = json_decode($response);

		if( ! empty($res) && $res->status)
		{
      return $res;
		}
		else
		{
			$this->error = $response;
			return FALSE;
		}
	}


  public function getStockZone($zone_code)
  {
    $arr = array(
      "zone_code" => $zone_code
		);

    $json = json_encode($arr);
		$url = $this->url .'stock_zone/getStockZone';
    $header = array();
    $header[] = 'Content-Type: application/json';
    $header[] = 'X-API-KEY: '.$this->api_key;
		$curl = curl_init();

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_DIGEST);
    curl_setopt($curl, CURLOPT_USERPWD, "{$this->username}:{$this->pwd}");
    curl_setopt($curl, CURLOPT_POSTFIELDS, $json);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $header);

		$response = curl_exec($curl);

		curl_close($curl);

		$res = json_decode($response);

		if( ! empty($res))
		{
      if($res->status)
      {
        return $res;
      }
      else
      {
        $this->error = $res->error;
        return false;
      }
		}
		else
		{
			$this->error = $response;
			return FALSE;
		}
  }

} //-- end class

 ?>
