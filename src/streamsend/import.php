<?

require_once dirname(__FILE__) . '/object.php';

class SSImport extends SSObject
{
	
	function class_name () { return 'Import'; }
	function uri ()        { return '/audiences/:audience_id/imports'; }
	
	function find ($type, $options = array())
	{
		$res = &SSResource::resource();
		return $res->find('Import', $type, $options);
	}
	
	function waiting ()
	{
		return ($this->get('status') == 'waiting');
	}
	
	function in_progress ()
	{
		return ($this->get('status') == 'in progress');
	}
	
	function pending ()
	{
		return ($this->waiting() || $this->in_progress());
	}

}

?>