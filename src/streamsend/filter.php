<?

require_once dirname(__FILE__) . '/object.php';

class StreamSendFilter extends StreamSendObject
{
	
	function class_name () { return 'Filter'; }
	function uri ()        { return '/audiences/:audience_id/filters'; }
	
}

?>