<?

require_once dirname(__FILE__) . '/object.php';

class SSFilter extends SSObject
{
	
	function class_name () { return 'Filter'; }
	function uri ()        { return '/audiences/:audience_id/filters'; }
	
}

?>