> This project is no longer maintained and our API has changed.
> Please see our current API docs here: http://app.streamsend.com/docs/api/index.html

= StreamSend PHP API

A set of classes for interacting with the StreamSend XML API

=== Dependencies

* PHP 4.x, 5.x

== Usage

To use the classes, simply require <tt>src/streamsend.php</tt> in your code.
Also, you must define two constants for your username and password so that
you can properly authenticate with the API:

  require_once 'streamsend-php/src/streamsend.php';

  define('STREAMSEND_USERNAME', 'abc');
  define('STREAMSEND_PASSWORD', '123');

== Documentation

Documentation for the PHP classes is available at http://wiki.github.com/streamsend/streamsend-php.

Documentation for the StreamSend XML API is available at 
http://app.streamsend.com/docs/api/index.html.

== License

The StreamSend PHP API is released under the MIT license.
