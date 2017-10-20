<?php
require_once("classes/wink_device.class.php");
require_once("classes/color.class.php");

class light extends wink_device
{
	protected $spectrum_type;
	protected $status_powered;
	protected $status_intensity;

	public function get_spectrum_type()
	{
		return $this->spectrum_type;
	}

	public function set_spectrum_type($arg)
	{
		$this->spectrum_type = $arg;
	}

	public function get_powered()
	{
		return $this->status_powered;
	}

	public function set_powered($arg)
	{
		$this->status_powered = $arg;
	}

	public function get_intensity()
	{
		return $this->status_intensity;
	}

	public function set_intensity($arg)
	{
		$this->status_intensity = $arg;
	}

	public function __construct()
	{
		parent::__construct();

		$this->commands["getstate"] = array(
			"required" => array(),
			"optional" => array()
			);

		$this->commands["poweron"] = array(
			"required" => array(),
			"optional" => array("intensity")
			);

		$this->commands["poweroff"] = array(
			"required" => array(),
			"optional" => array("intensity")
			);
	}

	public function process_command($cmd, $args = null)
	{
		if (!parent::process_command($cmd, $args))
			return false;

		switch ($cmd)
		{
			case "poweron":
				$intensity = 1.00;
				if ($args && array_key_exists("intensity", $args))
				{
					$intensity = $args["intensity"];
				}

				if ($this->spectrum_type == "color")
				{
					if ($args && array_key_exists("color", $args))
					{
						// If color param is set, currently, 2 requests
						// are needed to the Wink API.
						$colorParam = $args["color"];
						$colorObj = new Color();
						$colorObj->setColor($colorParam);
						$color=$colorObj->getHSB();
						$colorData = array(
							"desired_state" => array(
								"color_model" => "hsb",
								"hue" => $color["hue"],
								"saturation" => $color["saturation"],
								"brightness" => $color["brightness"]),
		                                        "nonce" => time()

						);
						$endpoint = "/light_bulbs/" . $this->id;
						$json_data = json_encode($colorData);
		                                $localendpoint = NULL;
                 		                $try_local = false;

		                                if($this->is_local_access_capable())
		                                {
		                                        $localendpoint = "/light_bulbs/" . $this->local_id;
		                                        $try_local=true;
		                                }

						WinkUtils::api_put($endpoint, $json_data,$localendpoint,$try_local);
					}

/*					$colorParam = "white";
					$colorObj = new Color();
					$colorObj->setColor($colorParam);
					$color=$colorObj->getHSB();
					$colorData = array("desired_state" => array(
						"color_model" => "hsb",
						"hue" => $color["hue"],
						"saturation" => $color["saturation"],
						"brightness" => $color["brightness"])
					);
					$endpoint = "/light_bulbs/" . $this->id;
					$json_data = json_encode($colorData);
					WinkUtils::api_put($endpoint, $json_data);
*/
				}

				$data = array("desired_state" => array(
					"powered" => true,
					"brightness" => $intensity),
                                        "nonce" => time()
				);

				$endpoint = "/light_bulbs/" . $this->id;
				$json_data = json_encode($data);
				$localendpoint = NULL;
				$try_local = false;

				if($this->is_local_access_capable())
				{
					$localendpoint = "/light_bulbs/" . $this->local_id;
					$try_local=true;
				}

				return WinkUtils::api_put($endpoint, $json_data,$localendpoint,$try_local);
				break;

			case "poweroff":
				$intensity = 1.00;
				if ($args && array_key_exists("intensity", $args))
				{
					$intensity = $args["intensity"];
				}

				$data = array("desired_state" => array(
					"powered" => false,
					"brightness" => $intensity),
					"nonce" => time()
				);

				$endpoint = "/light_bulbs/" . $this->id;
				$json_data = json_encode($data);
                                $localendpoint = NULL;
                                $try_local = false;

                                if($this->is_local_access_capable())
                                {
                                        $localendpoint = "/light_bulbs/" . $this->local_id;
                                        $try_local=true;
                                }

				return WinkUtils::api_put($endpoint, $json_data,$localendpoint,$try_local);
				break;
			case "getstate":
				$endpoint = "/light_bulbs/" . $this->id;
				$response = WinkUtils::api_get($endpoint);
				$json = json_decode($response, true);

				$ret = "ERR";
				$connected = $json['data']['last_reading']['connection'];
				if (!$connected)
				{
					echo $ret . " Not connected" . PHP_EOL;
					return false;
				}
				$powered = $json['data']['last_reading']['powered'];
				$intensity = sprintf("%.02f", $json['data']['last_reading']['brightness']);
				switch ($powered)
				{
					case true:
						$state = "ON";
						break;
					case false:
						$state = "OFF";
						break;
					default:
						return false;
						break;
				}
				$ret = $state . " " . $intensity;
				echo $ret . PHP_EOL;
				break;
			default:
				break;
		}
		return true;
	}
}

?>
