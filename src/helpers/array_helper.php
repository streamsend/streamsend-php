<?

class ArrayHelper
{
	
	function is_associative ($array)
	{
	    if (!is_array($array) || empty($array))
	        return false;

	    $keys = array_keys($array);

	    return array_keys($keys) !== $keys;
	}

	function array_to_xml ($array, $name=null)
	{
	    $xml = '';

	    foreach ($array as $key => $value)
	    {
	        $key = is_null($name) ? $key : $name;

	        $key = strtolower(preg_replace('/[\s_]+/', '-', $key));

	        if (is_array($value))
	        {
	            if (ArrayHelper::is_associative($value))
	                $xml .= "<{$key}>" . ArrayHelper::array_to_xml($value) . "</{$key}>";
	            else
				{
					$singular = Inflector::singularize($key);
				
					if ($singular != $key)
						$xml .= "<{$key}>" . ArrayHelper::array_to_xml($value, $singular) . "</{$key}>";
					else
		                $xml .= ArrayHelper::array_to_xml($value, $key);
				}
	        }
	        else
	            $xml .= "<{$key}>{$value}</{$key}>";
	    }

	    return $xml;
	}

	function array_delete (&$array, $key)
	{
	    if (!isset($array[$key]))
	        return null;

	    $value = $array[$key];

	    unset($array[$key]);

	    return $value;
	}

	
}

?>