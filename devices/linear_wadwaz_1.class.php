<?php
require_once("classes/sensor.class.php");

class linear_wadwaz_1 extends sensor
{
	function __construct()
	{
		parent::__construct();

		$this->set_sensor_type("linear_wadwaz_1");
		$this->wink_type = "sensor_pod";
		$this->wink_idfield = "sensor_pod_id";
		$this->device_type = "Door / Window Sensor";
	}
}

?>
