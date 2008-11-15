<?

class StreamSendObject
{
	
	var $attributes = array();
	var $errors = array();
	
	var $__class_name;
	var $__primary_key;

	function StreamSendObject ($attrs = array())
	{
		$this->attributes = $attrs;
		
		$this->__class_name = 'Object';
		$this->__primary_key = 'id';
	}
	
	function id ()
	{
		return $this->attributes[$this->__primary_key];
	}
	
	function get ($key)
	{
		return $this->attributes[$key];
	}
	
	function reload ()
	{
		$obj = $this->find($this->id());
		
		$this->attributes = $obj->attributes;
		
		return true;
	}
	
	function find ($type, $options = array())
	{
		switch ($type)
		{
			case "first":
				return $this->__find_first($options);
			case "all":
				return $this->__find_all($options);
			default:
				return $this->__find_by_id($type);
		}
	}
	
	function save () { return $this->save_with_callbacks(); }
	
	function save_with_callbacks()
	{
		if ($this->new_record())
			return $this->create_with_callbacks();
		else
			return $this->update_with_callbacks();
	}
	
	function save_without_callbacks()
	{
		if ($this->new_record())
			return $this->create_without_callbacks();
		else
			return $this->update_without_callbacks();
	}
	
	function create () { return $this->create_with_callbacks(); }

	function create_with_callbacks ()
	{
		if (!$this->before_create())
			return false;
		if (!$this->create_without_callbacks())
			return false;
		if (!$this->after_create())
			return false;
			
		return true;
	}

	function before_create () { return true; }
	function after_create ()  { return true; }
	
	function create_without_callbacks ()
	{
		return $this->__create();
	}
	
	function update () { return $this->update_with_callbacks(); }
	
	function update_with_callbacks ()
	{
		if (!$this->before_update())
			return false;
		if (!$this->update_without_callbacks())
			return false;
		if (!$this->after_create())
			return false;
			
		return true;
	}
	
	function before_update () { return true; }
	function after_update ()  { return true; }
	
	function update_without_callbacks ()
	{
		return $this->__update();
	}
	
	function destroy () { return $this->destroy_with_callbacks(); }
	
	function destroy_with_callbacks ()
	{
		if (!$this->before_destroy())
			return false;
		if (!$this->destroy_without_callbacks())
			return false;
		if (!$this->after_destroy())
			return false;

		return true;
	}
	
	function destroy_without_callbacks ()
	{
		return $this->__destroy();
	}
	
}

?>