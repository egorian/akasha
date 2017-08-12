<?php
require_once("classes/device.class.php");

class wink_device extends device
{
	protected $wink_type;
	protected $wink_idfield;
	protected $wink_localidfield;
	protected $local_access_capable;

	public function __construct()
	{
		parent::__construct();
	}

	public function get_wink_type()
	{
		return $this->wink_type;
	}

	public function set_wink_type($arg)
	{
		$this->wink_type = $arg;
	}

	public function get_wink_idfield()
	{
		return $this->wink_idfield;
	}

	public function set_wink_idfield($arg)
	{
		$this->wink_idfield = $arg;
	}

	public function get_wink_localidfield()
	{
		return $this->wink_localidfield;
	}

	public function set_wink_localidfield($arg)
	{
		$this->wink_localidfield = $arg;
	}

	public function is_local_access_capable()
	{
		if($this->local_access_capable==true) return true;
		else return false;
	}
}
?>
