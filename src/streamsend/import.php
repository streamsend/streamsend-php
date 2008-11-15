<?

require_once dirname(__FILE__) . '/resource.php';

class StreamSendImport extends StreamSendResource
{

	function StreamSendImport ($attrs = array())
	{
		parent::StreamSendResource($attrs);
		
		$this->__class_name = 'Import';
		$this->uri = '/audiences/:audience_id/imports';
	}
	
	function waiting ()
	{
		return ($this->get('status') == 'waiting');
	}
	
	function in_progress ()
	{
		return ($this->get('status') == 'in progress');
	}
	
	function pending ()
	{
		return ($this->waiting() || $this->in_progress());
	}

}

?>