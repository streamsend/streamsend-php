<?

require_once dirname(__FILE__) . '/object.php';

class SSUnsubscribe extends SSObject
{
	
	function class_name () { return 'Unsubscribe'; }
	function uri ()        { return '/blasts/:blast_id/unsubscribes'; }
	
	function create ()  { return false; }
	function update ()  { return false; }
	function destroy () { return false; }
	
}

?>