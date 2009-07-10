<?

require_once dirname(__FILE__) . '/object.php';

class StreamSendImport extends StreamSendObject
{
	
	function class_name () { return 'Import'; }
	function uri ()        { return '/audiences/:audience_id/imports'; }
	
	function find ($type, $options = array())
	{
		return StreamSendResource::resource()->find('Import', $type, $options);
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