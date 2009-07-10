<?

require_once dirname(__FILE__) . '/object.php';

class StreamSendPerson extends StreamSendObject
{

	function class_name () { return 'Person'; }
	function uri ()        { return '/audiences/:audience_id/people'; }
	
	function find ($type, $options = array())
	{
		return StreamSendResource::resource()->find('Person', $type, $options);
	}
	
	function find_by_email_address ($email_address, $options = array())
	{
		$options['email_address'] = $email_address;
		
		return StreamSendResource::resource()->find('Person', 'first', $options);
	}

}

?>