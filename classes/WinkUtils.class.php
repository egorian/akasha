<?php
require_once("devices/cree_light_bulb.class.php");
require_once("devices/ge_jasco_binary.class.php");
require_once("devices/ge_jasco_dimmer.class.php");
require_once("devices/ge_zigbee_light.class.php");
require_once("devices/schlage_zwave_lock.class.php");
require_once("devices/sylvania_sylvania_rgbw.class.php");
require_once("devices/sylvania_sylvania_rgbw_flex.class.php");
require_once("devices/generic_zwave_light_bulb_scene_switch_multilevel.class.php");
require_once("devices/linear_wadwaz_1.class.php");
require_once("devices/linear_wapirz_1.class.php");
require_once("devices/generic_zwave_thermostat.class.php");
require_once("devices/hub_2.class.php");
require_once("devices/ge_jasco-dimmer-in-wall.class.php");
require_once("devices/lutron_p-pkg1w-wh-d.class.php");

class WinkUtils extends device
{
	static function new_device($model_name, $id, $name, $local_id = NULL)
	{
		$obj = null;
		switch ($model_name)
		{
			case "BE469":
				$obj = new schlage_zwave_lock();
				$obj->set_id($id);
				$obj->set_local_id($local_id);
				$obj->set_name($name);
				break;
			case "Binary Switch":
				$obj = new ge_jasco_binary();
				$obj->set_id($id);
				$obj->set_local_id($local_id);
				$obj->set_name($name);
				break;
			case "Cree light bulb":
				$obj = new cree_light_bulb();
				$obj->set_id($id);
				$obj->set_local_id($local_id);
				$obj->set_name($name);
				break;
			case "Dimmer":
				$obj = new ge_jasco_dimmer();
				$obj->set_id($id);
				$obj->set_local_id($local_id);
				$obj->set_name($name);
				break;
			case "GE Light Bulb":
				$obj = new ge_zigbee_light();
				$obj->set_id($id);
				$obj->set_local_id($local_id);
				$obj->set_name($name);
				break;
			case "generic_zwave_thermostat":
				$obj = new generic_zwave_thermostat();
				$obj->set_id($id);
				$obj->set_local_id($local_id);
				$obj->set_name($name);
				break;
			case "Lightify Smart+ RGBW Bulb":
				$obj = new sylvania_sylvania_rgbw();
				$obj->set_id($id);
				$obj->set_local_id($local_id);
				$obj->set_name($name);
				break;
			case "Lightify RGBW Flex":
				$obj = new sylvania_sylvania_rgbw_flex();
				$obj->set_id($id);
				$obj->set_local_id($local_id);
				$obj->set_name($name);
				break;
			case "Generic Z-Wave Light Bulb":
				$obj = new generic_zwave_light_bulb_scene_switch_multilevel();
				$obj->set_id($id);
				$obj->set_local_id($local_id);
				$obj->set_name($name);
				break;
			case "In-Wall Smart Dimmer":
				$obj = new ge_jasco_dimmer_in_wall();
				$obj->set_id($id);
				$obj->set_local_id($local_id);
				$obj->set_name($name);
				break;
			case "Caseta Wireless Dimmer & Pico":
				$obj = new lutron_p_pkg1w_wh_d();
				$obj->set_id($id);
				$obj->set_local_id($local_id);
				$obj->set_name($name);
				break;
			case "Door / Window Sensor":
				$obj = new linear_wadwaz_1();
				$obj->set_id($id);
				$obj->set_local_id($local_id);
				$obj->set_name($name);
				break;
			case "Z-Wave Passive Infrared (PIR) Sensor":
				$obj = new linear_wapirz_1();
				$obj->set_id($id);
				$obj->set_local_id($local_id);
				$obj->set_name($name);
				break;
			case "Hub 2":
				$obj = new hub_2();
				$obj->set_id($id);
				$obj->set_local_id($local_id);
				$obj->set_name($name);
				break;
			default:
				break;
		}
		return $obj;
	}

	static function get_info_from_model($model_name)
	{
		$type = null;
		$idfield = null;
		$local_access_enabled = null;

		switch ($model_name)
		{
			case "HUB":
			case "Hub":
			case "Hub 2":
				$type = "hub";
				$idfield = $type . "_id";
				break;
			case "BE469":
				$type = "lock";
				$idfield = $type . "_id";
				break;
			case "Binary Switch":
				$type = "binary_switch";
				$idfield = $type . "_id";
				break;
			case "Connected Bulb Remote":
				$type = "remote";
				$idfield = $type . "_id";
				break;
			case "GE Light Bulb":
			case "Lightify RGBW Flex":
			case "Cree light bulb":
			case "Lightify Smart+ RGBW Bulb":
			case "Generic Z-Wave Light Bulb":
			case "In-Wall Smart Dimmer":
			case "Caseta Wireless Dimmer & Pico":
			case "Dimmer":
				$type = "light_bulb";
				$idfield = $type . "_id";
				$local_access_enabled = true;
				break;
			case "Egg Minder":
				$type = "eggtray";
				$idfield = $type . "_id";
				break;
			case "generic_zwave_thermostat":
				$type = "thermostat";
				$idfield = $type . "_id";
				break;
			case "Nimbus":
				$type = "cloud_clock";
				$idfield = $type . "_id";
				break;
			case "Pivot Power Genius":
				$type = "powerstrip";
				$idfield = $type . "_id";
				break;
			case "Smoke + Carbon Monoxide Detector":
				$type = "smoke_detector";
				$idfield = $type . "_id";
				break;
			case "Wireless Siren & Strobe":
				$type = "siren";
				$idfield = $type . "_id";
				break;
			case "Door / Window Sensor":
				$type = "sensor_pod";
				$idfield = $type . "_id";
				break;
			case "Z-Wave Passive Infrared (PIR) Sensor":
				$type = "sensor_pod";
				$idfield = $type . "_id";
				break;
			default:
				break;
		}

		return array("type" => $type, "idfield" => $idfield, "localaccessenabled" => $local_access_enabled);
	}

	static function get_type_from_model($model_name)
	{
		$info = get_info_from_model($model_name);
		return $info['type'];
	}

	static function get_idfield_from_model($model_name)
	{
		$info = get_info_from_model($model_name);
		return $info['idfield'];
	}

	static function api_get($endpoint)
	{
		global $config;
		$token = $config['wink']['token_access'];
		$URL   = $config['wink']['URL'];

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $URL . $endpoint);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $token));
		$response = curl_exec($ch);
		curl_close($ch);
		return $response;
	}

	static function api_put($endpoint, $data, $localendpoint=NULL, $try_local=false)
	{
		global $config;
		$ch = curl_init();

		if(($config['wink']['HUB_URL']!=NULL)&&($config['wink']['HUB_URL']!="")&&($config['wink']['local_access_token']!=NULL)&&($config['wink']['local_access_token']!="")&&($config['wink']['local_access_enabled']==true)&&($try_local))
		{
			$URL=$config['wink']['HUB_URL'];
			$token = $config['wink']['local_access_token'];

			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT ,0);
			curl_setopt($ch, CURLOPT_TIMEOUT, 5);   //Set a 5 second limit for CURL to execute the request to the local hub
			curl_setopt($ch, CURLOPT_URL, $URL . $localendpoint);
		        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);   //Have to ignore the Hub SSL Cert
		        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
			echo "Trying local";

		}
		else
		{
			$URL= $config['wink']['URL'];
			$token = $config['wink']['token_access'];
			curl_setopt($ch, CURLOPT_URL, $URL . $endpoint);

		}

		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $token));
		$response = curl_exec($ch);
		$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
echo "Code".$http_code;
		if (!curl_errno($ch)) {   //Local Hub responded but have to verify the response code.
			switch ($http_code) {
			    case 200:  // OK, we need to inform the Cloud about the local action https://github.com/KraigM/homebridge-wink/wiki/Investigation-of-an-Unofficial-Wink-API
				       //https://github.com/KraigM/homebridge-wink/pull/81
				      //https://github.com/KraigM/homebridge-wink/blob/8f4a717b42d8dabb4778c9c3975969056198ef3d/lib/winkapi.js  Line 157
				if(($config['wink']['local_access_enabled']==true)&&($try_local))
				{
					$obj=json_decode($data,true);
					$nonce=$obj["nonce"];

					$CloudData = explode("/",$endpoint);  $CloudData[1]=substr(trim($CloudData[1]), 0, -1);
					$CloudDataArray = array(
						"locally_activated_objects" => array(
							"object_type" => $CloudData[1],
							"object_id" => $CloudData[2]
						),
						"nonce" => $nonce
					);

//				$json_data = json_encode(array_merge($CloudDataArray,json_decode($data,true)));
//   			   	$response=self::api_put($endpoint, $json_data);
	   			   	$response=self::api_put($endpoint, json_encode($CloudDataArray));
					echo "Local!!:"; var_dump($response);
				}
			      break;
			    default:
				if($try_local)  //Failed to make the request to the local hub, so we have to retry pointing to the cloud server.
				{  echo "Not local".$http_code;
				   $response=self::api_put($endpoint, $data);
				}
			  }
		} else
		{
		$config_file = "config.php";
                $str=file_get_contents($config_file);
                $str=str_replace('$config["wink"]["local_access_enabled"] = true;', '$config["wink"]["local_access_enabled"] = false;',$str);
                file_put_contents($config_file, $str);

		 $response=self::api_put($endpoint, $data);   //Local Hub not responding, retrying to the cloud.
		}
		curl_close($ch);

		return $response;
	}
}
?>
