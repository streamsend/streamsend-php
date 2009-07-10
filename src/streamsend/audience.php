<?

require_once dirname(__FILE__) . '/object.php';

class StreamSendAudience extends StreamSendObject
{
	
	function class_name () { return 'Audience'; }
	
	function find ($type, $options = array())
	{
		return StreamSendResource::resource()->find('Audience', $type, $options);
	}
	
	function create () { return false; }
	function destroy () { return false; }
	
}

?>