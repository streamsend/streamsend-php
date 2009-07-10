<?

require_once dirname(__FILE__) . '/object.php';

class StreamSendView extends StreamSendObject
{
	
	function class_name () { return 'View'; }
	function uri ()        { return '/blasts/:blast_id/views'; }
	
	function find ()    { return null; }
	
	function create ()  { return false; }
	function update ()  { return false; }
	function destroy () { return false; }
	
}

?>