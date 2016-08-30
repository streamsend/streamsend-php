<?

require_once dirname(__FILE__) . '/object.php';

class SSBlast extends SSObject
{
	
	function class_name () { return 'Blast'; }
    function uri ()        { return '/audiences/1/blasts'; }
    
	
    function find ($type, $options = array())
    {
        $res = &SSResource::resource();
        return $res->find('Blast', $type, $options);
    }
}

?>