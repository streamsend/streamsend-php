<?

require_once dirname(__FILE__) . '/object.php';

class SSBounce extends SSObject
{
	
	function class_name () { return 'Bounce'; }
	function uri ()        { return '/blasts/:blast_id/bounces'; }
	
	function find ()    { return null; }
	
	function create ()  { return false; }
	function update ()  { return false; }
	function destroy () { return false; }
	
}

?>