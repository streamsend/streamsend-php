<?

require_once dirname(__FILE__) . '/object.php';

class StreamSendUpload extends StreamSendObject
{
	
	function class_name () { return 'Upload'; }
	
	function find ($type, $options = array())
	{
		return StreamSendResource::resource()->find('Upload', $type, $options);
	}

	function create_without_callbacks ()
	{
		return StreamSendResource::resource()->create($this, 
			array('data' => "@{$this->attributes['filename']}"),
			array('Accept: application/xml')
		);
	}
	
	function update () { return false; }
	function destroy () { return false; }

}

?>
