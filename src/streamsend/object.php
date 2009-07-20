<?

class SSObject
{
	
	var $attributes = array();

	function SSObject ($attrs = array())
	{
		if (preg_match_all("/:(\w+)/", $this->uri(), $matches))
		{
			$this->__uri = array();

			foreach ($matches[1] as $key)
				$this->__uri[$key] = ArrayHelper::array_delete($attrs, $key);
		}

		$this->attributes = $attrs;
	}
	
	function class_name () { return 'Object'; }
	function uri ()
	{
		return "/" . Inflector::pluralize(Inflector::underscore($this->class_name()));
	}
	
	function interpolated_uri ()
	{
		$options = $this->attributes;
		if (isset($this->__uri))
			$options = array_merge($options, $this->__uri);

		return preg_replace("/:(\w+)/e", "\$options['\\1']", $this->uri());
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
		$res = &SSResource::resource();
		$obj = $res->find($this->class_name(), $this->id());
		
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
		$res = &SSResource::resource();
		return $res->create($this);
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
		$res = &SSResource::resource();
		return $res->update($this);
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
		$res = &SSResource::resource();
		return $res->destroy($this);
	}
	
	function to_xml ($options = array())
	{
		if (empty($options['root']))
			$options['root'] = Inflector::underscore($this->class_name());

		return "<{$options['root']}>" . ArrayHelper::array_to_xml($this->attributes) . "</{$options['root']}>";	
	}
	
}

?>