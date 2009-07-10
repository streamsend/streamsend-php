<?

require_once dirname(__FILE__) . '/object.php';

class StreamSendFromEmailAddress extends StreamSendObject
{
	
	function class_name () { return 'FromEmailAddress'; }
	
	function find ($type, $options = array())
	{
		return StreamSendResource::resource()->find('FromEmailAddress', $type, $options);
	}
	
	function update ()  { return false; }
	function destroy () { return false; }
	
}

?>