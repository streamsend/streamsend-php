<?

require_once dirname(__FILE__) . '/resource.php';

class StreamSendList extends StreamSendResource
{
	
	function StreamSendList ($attrs = array())
	{
		parent::StreamSendResource($attrs);
		
		$this->__class_name = 'List';
		$this->uri = '/audience/:audience_id/lists';
	}
}

?>