<?

$paths = array(
	'/streamsend/*.php',
	'/curl/*.php',
	'/helpers/*.php'
);

foreach ($paths as $path)
{
	foreach (glob(dirname(__FILE__) . $path) as $file)
		require_once $file;
}

?>