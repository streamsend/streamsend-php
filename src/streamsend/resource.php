<?

require_once dirname(__FILE__) . '/../curl/request.php';

class StreamSendResource
{

	var $url;
	var $username;
	var $password;
	
	function &resource()
	{
		$resource = &$GLOBALS['StreamSendResource'];
		
		$class = get_class($resource);
		if (strtolower($class) != 'streamsendresource')
			$resource = new StreamSendResource();
		
		return $resource;
	}

	function StreamSendResource ()
	{
		$this->url      = defined('STREAMSEND_URL') ? STREAMSEND_URL : 'https://app.streamsend.com';
		$this->username = STREAMSEND_USERNAME;
		$this->password = STREAMSEND_PASSWORD;
	}
	
	function find ($class_name, $type, $options = array())
	{
		$class_name = "StreamSend" . $class_name;
		
		$class = new $class_name($options);
		
		switch ($type)
		{
			case "first":
				return $this->__find_first($class, $options);
			case "all":
				return $this->__find_all($class, $options);
			default:
				return $this->__find_by_id($class, $type);
		}
	}
	
	function __find_by_id ($class, $id)
	{
		$response = $this->__request($class, 'GET', "/$id");
		
		$parser = new XMLParser();

		$array = $parser->parse_into_array($response->body);
		$attrs = $array[Inflector::underscore($class->class_name())];
		
		$class_name = "StreamSend" . $class->class_name();
		
		return new $class_name($attrs);
	}
	
	function __find_first ($class, $options = array())
	{
		$results = $this->__find_all($class, $options);
		
		return array_shift($results);
	}
	
	function __find_all ($class, $options = array())
	{
		$query_options = join('&', array_map(create_function('$a,$b', 'return "$a=$b";'), array_keys($options), array_values($options)));
		
		$response = $this->__request($class, 'GET', "?$query_options");
		
		$parser = new XMLParser();
		
		$array = $parser->parse_into_array($response->body);
		
		$class_name = "StreamSend" . $class->class_name();
		$singular = Inflector::underscore($class->class_name());
		$plural = Inflector::pluralize($singular);
		
		$records = $array[$plural][$singular];
		
		if (ArrayHelper::is_associative($records))
			$records = array($records);
		
		$objects = array();
		foreach ($records as $attrs)
			$objects[] = new $class_name($attrs);

		return $objects;
	}
	
	function create ($object, $data = null, $headers = null)
	{
		if (is_null($data))
			$data = $object->to_xml();

		$response = $this->__request($object, 'POST', '', $data, $headers);
			
		if (preg_match('/\/(\d+)(\.xml)?$/', $response->headers['Location'], $matches))
			$object->attributes['id'] = $matches[1];
		
		return true;
	}
	
	function update ($object)
	{
		$this->__request($object, 'PUT', "/" . $object->id(), $object->to_xml());

		return true;
	}
	
	function destroy ($object)
	{
		$response = $this->__request($object, 'DELETE', "/" . $object->id());

		return true;
	}
	
	function __request ($object_or_class, $method, $path, $data = null, $headers = null)
	{		
		if (is_null($headers))
		{
			$headers = array(
				'Accept: application/xml',
				'Content-Type: application/xml'
			);
		}
		
		$request = new CurlRequest();
		
		$request->headers = $headers;

		$request->url = $this->url . $object_or_class->interpolated_uri() . $path;
		$request->username = $this->username;
		$request->password = $this->password;

		$request->set(CURLOPT_CUSTOMREQUEST, $method);
		$request->set(CURLOPT_SSL_VERIFYPEER, false);
		
		if (!empty($data))
			$request->set(CURLOPT_POSTFIELDS, $data);
		
		$response = $request->execute();
		
		return $response;
	}

}

?>
