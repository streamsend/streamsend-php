<?

require_once dirname(__FILE__) . '/object.php';

class SSFromEmailAddress extends SSObject
{
	
	function class_name () { return 'FromEmailAddress'; }
	
	function find ($type, $options = array())
	{
		$res = &SSResource::resource();
		return $res->find('FromEmailAddress', $type, $options);
	}
	
	function update ()  { return false; }
	function destroy () { return false; }
	
}

?>