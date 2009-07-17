<?

require_once dirname(__FILE__) . '/object.php';

class SSMembership extends SSObject
{
	
	function class_name () { return 'Membership'; }
	function uri ()        { return '/audiences/:audience_id/memberships'; }

	function update ()  { return false; }
	
}

?>