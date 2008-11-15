<?

require_once dirname(__FILE__) . '/resource.php';

class StreamSendUpload extends StreamSendResource
{

	function StreamSendUpload ($attrs = array())
	{
		parent::StreamSendResource($attrs);

		$this->__class_name = 'Upload';
	}

	function create_without_callbacks ()
	{
		return $this->__create(array('data' => "@{$this->attributes['filename']}"), array('Accept: application/xml'));
	}

}

?>
