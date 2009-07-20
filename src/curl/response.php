<?

class CurlResponse
{
	var $info;
	var $body;
	var $headers = array();

	function CurlResponse ($handle = null)
	{
		if ($handle)
		{
			$this->headers = array();

			curl_setopt($handle, CURLOPT_HEADERFUNCTION, array(&$this, '__parse_header'));
			curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);

			$this->body = curl_exec($handle);
			$this->info = curl_getinfo($handle);
		}
	}

	function __parse_header ($handle, $header)
	{
		$details = split(':', $header, 2);

		if (count($details) == 2)
		{
			$key   = trim($details[0]);
			$value = trim($details[1]);

			$this->headers[$key] = $value;
		}

		return strlen($header);
	}

	function status_code ()
	{
		if (!isset($this->info['http_code']))
			return null;

		return $this->info['http_code'];
	}

	function is_success ()
	{
		$code = $this->status_code();

		if (is_null($code))
			return null;

		return $code >= 200 && $code < 300;
	}

	function is_redirect ()
	{
		$code = $this->status_code();

		if (is_null($code))
			return null;

		return $code >= 300 && $code < 400;
	}

	function is_failure ()
	{
		$code = $this->status_code();

		if (is_null($code))
			return null;

		return $code >= 400 && $code < 600;
	}
}

?>
