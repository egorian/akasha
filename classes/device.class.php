<?php

class device
{
	protected $name;
	protected $id;
	protected $local_id;
	protected $commands;
	protected $device_type;

	public function get_name()
	{
		return $this->name;
	}

	public function set_name($arg)
	{
		$this->name = $arg;
	}

	public function get_id()
	{
		return $this->id;
	}

	public function set_id($arg)
	{
		$this->id = $arg;
	}

	public function get_local_id()
	{
		return $this->local_id;
	}

	public function set_local_id($arg)
	{
		$this->local_id = $arg;
	}

	public function get_device_type()
	{
		return $this->device_type;
	}

	public function set_device_type($arg)
	{
		$this->device_type = $arg;
	}

	public function __construct()
	{
		$this->device_type = "<device>";
		$this->commands = array();
		$this->commands["listcommands"] = array(
						   "required" => array(),
						   "optional" => array());
	}

	public static function listcommands($commands)
	{
		$ret = "Available commands:" . PHP_EOL;
		foreach ($commands as $command => $args)
		{
			$ret .= "  " . $command;
			foreach ($args["required"] as $req)
			{
				$ret .= " <" . $req . ">";
			}
			foreach ($args["optional"] as $opt)
			{
				$ret .= " [" . $opt . "]";
			}
			$ret .= PHP_EOL;
		}
		return $ret;
	}

	public function process_command($cmd, $args = null)
	{
		if (!array_key_exists($cmd, $this->commands))
		{
			// Command does not exist
			return false;
		}

		$missing_arg = null;
		foreach ($this->commands[$cmd]['required'] as $req_arg)
		{
			if ($args == null || !array_key_exists($req_arg, $args))
			{
				echo "ERROR: Missing argument for $cmd: $req_arg" . PHP_EOL;
				$missing_arg = $req_arg;
				break;
			}
		}

		if ($missing_arg)
		{
			// Required arguments not received
			return false;
		}

		switch ($cmd)
		{
			case "listcommands":
				echo device::listcommands($this->commands);
				break;
			default:
				break;

		}
		return true;
	}
}

?>
