<?php
require_once("classes/light.class.php");

class lutron_p_pkg1w_wh_d extends light
{
	function __construct()
	{
		parent::__construct();

		$this->set_spectrum_type("white");
		$this->wink_type = "light_bulb";
		$this->wink_idfield = "light_bulb_id";
		$this->device_type = "Caseta Wireless Dimmer & Pico";
                $this->local_access_capable = true;
	}
}

?>
