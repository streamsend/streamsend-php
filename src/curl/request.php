<?

class CurlRequest
{
	var $__handle;

	var $response;
	var $info;

	var $headers = array();

	var $url;
	var $username;
	var $password;

	function CurlRequest ()
	{
		$this->__handle = curl_init();
	}

	function set ($option, $value)
	{
		curl_setopt($this->__handle, $option, $value);

		return $value;
	}

	function execute ()
	{
		$this->set(CURLOPT_URL, $this->url);

		if ($this->username && $this->password)
			$this->set(CURLOPT_USERPWD, "{$this->username}:{$this->password}");

		if (is_array($this->headers) && !empty($this->headers))
			curl_setopt($this->__handle, CURLOPT_HTTPHEADER, $this->headers);

		$this->response = new CurlResponse($this->__handle);

		return $this->response;
	}
}

?>