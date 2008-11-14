<?

class XMLParser
{

	var $__elements;
	var $__index;
	
	function XMLParser () {}
	
	function parse_into_array ($xml)
	{
		$parser = xml_parser_create();
		xml_parse_into_struct($parser, $xml, $this->__elements);
		xml_parser_free($parser);
		
		$this->__index = 0;
		
		return $this->__parse_block_into_array();
	}
	
	function __parse_block_into_array ()
	{
		$hash = array();
		
		while ($this->__index < count($this->__elements))
		{
			$element = &$this->__elements[$this->__index];
			
			$this->__index++;
			
			$key = Inflector::underscore($element['tag']);
			
			$attributes = array();
			if (isset($element['attributes']))
			{
				foreach ($element['attributes'] as $k => $v)
					$attributes[strtolower($k)] = $v;
			}
			
			$value = null;
			
			switch($element['type'])
			{
				case 'open':
					$value = $this->__parse_block_into_array();					
					break;
				case 'complete':
					$value = $element['value'];
					
					if (isset($attributes['encoding']) && $attributes['encoding'] == 'base64')
						$value = base64_decode($value);
					break;
				case 'close':
					return $hash;
				default:
					// ignore other element types
			}
			
			if (!is_null($value))
			{	
				if (isset($hash[$key]))
				{
					if (!is_array($hash[$key]) || ArrayHelper::is_associative($hash[$key]))
						$hash[$key] = array($hash[$key], $value);
					else	
						array_push($hash[$key], $value);
				}
				else
					$hash[$key] = $value;
			}
				
			$this->__index++;
		}
		
		return $hash;
	}
	
}

?>