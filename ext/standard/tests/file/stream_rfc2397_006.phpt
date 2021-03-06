--TEST--
Stream: RFC2397 with corrupt? payload
--INI--
allow_url_fopen=1
--FILE--
<?php

$streams = array(
	"data:;base64,\0Zm9vYmFyIGZvb2Jhcg==",
	"data:;base64,Zm9vYmFy\0IGZvb2Jhcg==",
	'data:;base64,#Zm9vYmFyIGZvb2Jhcg==',
	'data:;base64,#Zm9vYmFyIGZvb2Jhc=',
	);

foreach($streams as $stream)
{
	try {
		var_dump(file_get_contents($stream));
	} catch (TypeError $e) {
		echo $e->getMessage(), "\n";
	}
}

?>
===DONE===
<?php exit(0); ?>
--EXPECTF--
file_get_contents() expects parameter 1 to be a valid path, string given
file_get_contents() expects parameter 1 to be a valid path, string given

Warning: file_get_contents(data:;base64,#Zm9vYmFyIGZvb2Jhcg==): failed to open stream: rfc2397: unable to decode in %sstream_rfc2397_006.php on line %d
bool(false)

Warning: file_get_contents(data:;base64,#Zm9vYmFyIGZvb2Jhc=): failed to open stream: rfc2397: unable to decode in %sstream_rfc2397_006.php on line %d
bool(false)
===DONE===
