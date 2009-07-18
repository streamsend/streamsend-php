<?

require_once dirname(__FILE__) . '/object.php';

class SSList extends SSObject
{
	
	function class_name () { return 'List'; }
	function uri ()        { return '/audiences/:audience_id/lists'; }
	
	function find ($type, $options = array())
	{
		$res = &SSResource::resource();
		return $res->find('List', $type, $options);
	}
	
}

?>