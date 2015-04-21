<?php
/**********************************************************
 * Class:   smartSMSSolutions
 * Desc:    An Unofficial PHP5 wrapper for consuming services provided by smartsmssolutions.com
 * License: Apache 2.0
 * Author:  Joseph Cobhams
 * URL:     http://www.vyrenmedia.com
 * Version: 0.1a
 **********************************************************/
class smartSMSSolutions
{
	private $api_url = "http://api.smartsmssolutions.com/smsapi.php?";
    private $user;
    private $pass;

    public function __construct($user,$pass){ $this->user=$user; $this->pass=$pass; }

	public function sendMSG($sender,$recpients,$message)
	{
        $api_data_string='';
        $api_data = array("username"=>urlencode($this->user), "password"=>urlencode($this->pass), "sender"=>urlencode($sender), "recipient"=>urlencode($recpients),  "message"=>urlencode($message) );
        foreach($api_data as $k=>$v){$api_data_string.=$k.'='.$v.'&';} $api_data_string=rtrim($api_data_string,'&');
        $url=$this->api_url.$api_data_string;
        $ch = curl_init($url); curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); curl_setopt($ch, CURLOPT_HEADER, 0);
        $result = curl_exec($ch); curl_close($ch);
		return $this->handleResponse($result);
	}

    public function queryBalance()
    {
        $api_data_string='';
        $api_data = array("username"=>urlencode($this->user), "password"=>urlencode($this->pass), "balance"=>urlencode("true"));
        foreach($api_data as $k=>$v){$api_data_string.=$k.'='.$v.'&';} $api_data_string=rtrim($api_data_string,'&');
        $url=$this->api_url.$api_data_string;
        $ch = curl_init($url); curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); curl_setopt($ch, CURLOPT_HEADER, 0);
        $result = curl_exec($ch); curl_close($ch);
        return $this->handleResponse($result);
    }

    private function handleResponse($response)
    {
        $resp_array = explode(" ",$response);
        if(strtolower($resp_array[0])=='ok'){ return json_encode(array("status"=>"success", "message"=>"Total Units Used: ".$resp_array[1]." Numbers Failed: ".$resp_array[3]) ); }
        if(is_numeric($resp_array[0])){return json_encode(array("state"=>"error","code"=>$resp_array[0],"message"=>$this->errorMap($resp_array[0])));}
    }

    private function errorMap($code)
    {
        $errormap = array(
            "2904"=>"SMS Sending Failed",
            "2905"=>"Invalid username/password combination",
            "2906"=>"Credit exhausted",
            "2907"=>"Gateway unavailable",
            "2908"=>"Invalid schedule date format",
            "2909"=>"Unable to schedule",
            "2910"=>"Username is empty",
            "2911"=>"Password is empty",
            "2912"=>"Recipient is empty",
            "2913"=>"Message is empty",
            "2914"=>"Sender is empty",
            "2915"=>"One or more required fields are empty",
            "2916"=>"Sender ID not allowed"
        );
        return $errormap[$code];
    }
}

?>