<?php
require_once("classes/hub.class.php");

class hub_2 extends hub
{
	function __construct()
	{
		parent::__construct();

		$this->wink_type = "hub";
		$this->wink_idfield = "hub_id";
		$this->device_type = "Hub 2";
	}
}

?>
