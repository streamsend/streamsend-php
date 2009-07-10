<?

require_once dirname(__FILE__) . '/object.php';

class StreamSendField extends StreamSendObject
{
	
	function class_name () { return 'Field'; }
	function uri ()        { return '/audiences/:audience_id/fields'; }
	
}

?>