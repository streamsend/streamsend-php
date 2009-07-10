<?

require_once dirname(__FILE__) . '/object.php';

class StreamSendMembership extends StreamSendObject
{
	
	function class_name () { return 'Membership'; }
	function uri ()        { return '/audiences/:audience_id/memberships'; }

	function update ()  { return false; }
	
}

?>