<?

require_once dirname(__FILE__) . '/object.php';

class SSField extends SSObject
{
	
	function class_name () { return 'Field'; }
	function uri ()        { return '/audiences/:audience_id/fields'; }
	
}

?>