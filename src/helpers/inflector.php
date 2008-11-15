<?

class Inflector
{
	
	function underscore ($camel_cased_word)
	{
		$word = preg_replace('/([A-Z]+)([A-Z][a-z])/', '\1_\2', $camel_cased_word);
		$word = preg_replace('/([a-z\d])([A-Z])/', '\1_\2', $word);
		$word = preg_replace('/[-\s]+/', '_', $word);
		$word = strtolower($word);
		
		return $word;
	}
	
	function pluralize ($word)
	{
		global $INFLECTIONS;

        return Inflector::__inflect($INFLECTIONS['plural']);
	}
	
	function singularize ($word)
	{
		global $INFLECTIONS;
		
        return Inflector::__inflect($INFLECTIONS['singular']);
	}

	function __inflect ($word, $inflections)
	{
		foreach ($inflections as $inflection)
		{
			list($find, $replace) = $inflection;
			
			$new = preg_replace($find, $replace, $word);
			
			if ($new != $word)
				return $new;
		}
		
		return $word;
	}

}

$INFLECTIONS = array(
	'plural' => array(
		array('/(p)erson/i', '\\1eople'),
		array('/$/', 's')
	),
	'singular' => array(
		array('/(p)eople/i', '\\1erson'),
		array('/s$/i', '')
	)
);

?>
