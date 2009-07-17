<?

class SSObject
{
	
	var $attributes = array();

	function SSObject ($attrs = array())
	{		
		$this->attributes = $attrs;
	}
	
	function class_name () { return 'Object'; }
	function uri ()        { return null; }
	
	function interpolated_uri ()
	{
		$uri = $this->uri();
		
		if (is_null($uri))
			$uri = "/" . Inflector::pluralize(Inflector::underscore($this->class_name()));
			
		return preg_replace("/:(\w+)/e", "\$this->attributes['\\1']", $uri);
	}
	
	function id ()
	{
		return $this->attributes['id'];
	}
	
	function get ($key)
	{
		return $this->attributes[$key];
	}
	
	function new_record ()
	{
		$id = $this->id();
		
		return is_null($id) || empty($id);
	}
	
	function reload ()
	{
		$obj = SSResource::resource()->find($this->class_name(), $this->id());
		
		$this->attributes = $obj->attributes;
		
		return true;
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
		return SSResource::resource()->create($this);
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
		return SSResource::resource()->update($this);
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
		return SSResource::resource()->destroy($this);
	}
	
	function to_xml ($options = array())
	{
		if (empty($options['root']))
			$options['root'] = Inflector::underscore($this->class_name());

		return "<{$options['root']}>" . ArrayHelper::array_to_xml($this->attributes) . "</{$options['root']}>";	
	}
	
}

?>