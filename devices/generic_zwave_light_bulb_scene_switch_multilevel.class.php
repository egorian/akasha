<?php
require_once("classes/light.class.php");

class generic_zwave_light_bulb_scene_switch_multilevel extends light
{
	function __construct()
	{
		parent::__construct();

		$this->set_spectrum_type("white");
		$this->wink_type = "light_bulb";
		$this->wink_idfield = "light_bulb_id";
		$this->device_type = "Generic Z-Wave Light Bulb";
                $this->local_access_capable = true;
	}
}

?>
