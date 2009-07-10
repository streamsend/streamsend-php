<?

require_once dirname(__FILE__) . '/object.php';

class StreamSendLink extends StreamSendObject
{
	
	function class_name () { return 'Link'; }
	function uri ()        { return '/blasts/:blast_id/links'; }
	
}

?>