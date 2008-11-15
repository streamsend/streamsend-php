<?

require_once dirname(__FILE__) . '/object.php';
require_once dirname(__FILE__) . '/../curl/request.php';

class StreamSendResource extends StreamSendObject
{

	var $url;
	var $uri;
	var $username;
	var $password;

	function StreamSendResource ($attrs = array())
	{
		parent::StreamSendObject($attrs);
		
		$this->url      = 'http://localhost:3000';
		$this->username = 'UsgK0ps18oEI';
		$this->password = 'KpS3FV1lXelfZoME';
		
		$this->__class_name = 'Resource';
	}
	
	function __find_by_id ($id)
	{
		$response = $this->__request('GET', "/$id");
		
		$parser = new XMLParser();

		$array = $parser->parse_into_array($response->body);
		$attrs = $array[Inflector::underscore($this->__class_name)];
		
		$class = "StreamSend" . $this->__class_name;
		
		$obj = new $class($attrs);
		
		return $obj;
	}
	
	function __find_first ($options = array())
	{
		$results = $this->__find_all($options);
		
		return array_shift($results);
	}
	
	function __find_all ($options = array())
	{
		$query_options = join('&', array_map(create_function('$a,$b', 'return "$a=$b";'), array_keys($options), array_values($options)));
		
		$response = $this->__request('GET', "?$query_options");
		
		$parser = new XMLParser();
		
		$array = $parser->parse_into_array($response->body);
		
		$class = "StreamSend" . $this->__class_name;
		$singular = Inflector::underscore($this->__class_name);
		$plural = Inflector::pluralize($singular);
		
		$people = $array[$plural][$singular];
		
		if (ArrayHelper::is_associative($people))
			$people = array($people);
		
		$objects = array();
		foreach ($people as $attrs)
			$objects[] = new $class($attrs);

		return $objects;
	}
	
	function __create ($data = null, $headers = null)
	{
		$response = $this->__request('POST', '', $data, $headers);
			
		if (preg_match('/\/(\d+)(\.xml)?$/', $response->headers['Location'], $matches))
			$this->attributes[$this->__primary_key] = $matches[1];
		
		return true;
	}
	
	function __update ()
	{
		$id = $this->id();
		
		$this->__request('PUT', "/{$id}");

		return true;
	}
	
	function __destroy ()
	{
		$id = $this->id();
		
		$response = $this->__request('DELETE', "/{$id}");

		return true;
	}
	
	function __request ($method, $path, $data = null, $headers = null)
	{		
		if (is_null($headers))
		{
			$headers = array(
				'Accept: application/xml',
				'Content-Type: application/xml'
			);
		}
		
		if (is_null($data))
		{
			$class_name = Inflector::underscore($this->__class_name);
			$data = "<$class_name>" . ArrayHelper::array_to_xml($this->attributes) . "</$class_name>";
		}
		
		$request = new CurlRequest();
		
		$request->headers = $headers;

		$request->url = $this->url . $this->__interpolated_uri() . $path;
		$request->username = $this->username;
		$request->password = $this->password;

		$request->set(CURLOPT_CUSTOMREQUEST, $method);
		$request->set(CURLOPT_SSL_VERIFYPEER, false);
		$request->set(CURLOPT_POSTFIELDS, $data);
		
		$response = $request->execute();
		
		return $response;
	}
	
	function __uri ()
	{
		if (is_null($this->uri))
			return "/" . Inflector::pluralize(Inflector::underscore($this->__class_name));
		
		return $this->uri;
	}
	
	function __interpolated_uri ()
	{	
		return preg_replace("/:(\w+)/e", "\$this->attributes['\\1']", $this->__uri());
	}

}

?>
