<?php
require_once("classes/light.class.php");

class cree_light_bulb extends light
{
	function __construct()
	{
		parent::__construct();

		$this->set_spectrum_type("white");
		$this->wink_type = "light_bulb";
		$this->wink_idfield = "light_bulb_id";
		$this->device_type = "Cree light bulb";
                $this->local_access_capable = true;
	}
}

?>
