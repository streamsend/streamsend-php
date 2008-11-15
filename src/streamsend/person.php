<?

require_once dirname(__FILE__) . '/resource.php';

class StreamSendPerson extends StreamSendResource
{

	function StreamSendPerson ($attrs = array())
	{
		parent::StreamSendResource($attrs);

		$this->__class_name = 'Person';
		$this->uri = '/audiences/:audience_id/people';
	}
	
	function find_by_email_address ($email_address)
	{
		return $this->find('first', array('email_address' => $email_address));
	}

}

?>