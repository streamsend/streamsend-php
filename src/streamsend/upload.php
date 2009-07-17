<?

require_once dirname(__FILE__) . '/object.php';

class SSUpload extends SSObject
{
	
	function class_name () { return 'Upload'; }
	
	function find ($type, $options = array())
	{
		return SSResource::resource()->find('Upload', $type, $options);
	}

	function create_without_callbacks ()
	{
		return SSResource::resource()->create($this, 
			array('data' => "@{$this->attributes['filename']}"),
			array('Accept: application/xml')
		);
	}
	
	function update () { return false; }
	function destroy () { return false; }

}

?>
