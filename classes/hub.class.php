<?php
require_once("classes/wink_device.class.php");

class hub extends wink_device
{
	protected $status_locked;

	public function __construct()
	{
		parent::__construct();

                $this->commands["getstate"] = array(
                        "required" => array(),
                        "optional" => array()
                        );
	}

	public function process_command($cmd, $args = null)
	{
		if (!parent::process_command($cmd, $args))
			return false;

		switch ($cmd)
		{
			case "getstate":
				$endpoint = "/hubs/" . $this->id;
				$response = WinkUtils::api_get($endpoint);
				$json = json_decode($response, true);
				$ret = "ERR";
				$connected = $json['data']['last_reading']['connection'];
				if (!$connected)
				{
					echo $ret . " Not connected" . PHP_EOL;
					return false;
				}
				else
				{
					echo "Connected" . PHP_EOL;
				}
				break;
			default:
				break;
		}
		return true;
	}

}
?>
