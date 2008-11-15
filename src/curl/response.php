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
}

?>
