<?php
require_once("classes/light.class.php");

class sylvania_sylvania_rgbw extends light
{
	function __construct()
	{
		parent::__construct();

		$this->set_spectrum_type("color");
		$this->wink_type = "light_bulb";
		$this->wink_idfield = "light_bulb_id";
		$this->device_type = "Lightify Smart+ RGBW Bulb";
		$this->commands["poweron"] = array(
			"required" => array(),
			"optional" => array("intensity","color")
			);
                $this->local_access_capable = true;
	}
}

?>
