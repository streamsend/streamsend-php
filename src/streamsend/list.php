<?

require_once dirname(__FILE__) . '/object.php';

class StreamSendList extends StreamSendObject
{
	
	function class_name () { return 'List'; }
	function uri ()        { return '/audience/:audience_id/lists'; }
	
	function find ($type, $options = array())
	{
		return StreamSendResource::resource()->find('List', $type, $options);
	}
	
}

?>