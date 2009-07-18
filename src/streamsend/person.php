<?

require_once dirname(__FILE__) . '/object.php';

class SSPerson extends SSObject
{

	function class_name () { return 'Person'; }
	function uri ()        { return '/audiences/:audience_id/people'; }
	
	function find ($type, $options = array())
	{
		$res = &SSResource::resource();
		return $res->find('Person', $type, $options);
	}
	
	function find_by_email_address ($email_address, $options = array())
	{
		$options['email_address'] = $email_address;
		
		$res = &SSResource::resource();
		return $res->find('Person', 'first', $options);
	}

}

?>