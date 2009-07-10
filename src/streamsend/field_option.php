<?

require_once dirname(__FILE__) . '/object.php';

class StreamSendFieldOption extends StreamSendObject
{
	
	function class_name () { return 'FieldOption'; }
	function uri ()        { return '/audiences/:audience_id/fields/:field_id/options'; }
	
}

?>