<?php

echo ("Thank you for your interest in RegmagiK."); 

function Name2SN($name)
{
	$sn = getenv('KEYSECRET');
	$len = mb_strlen($name);
	for ($i = 0; $i < $len; $i++)
	{
	  $letter = mb_substr($name, $i, 1);
	  if($letter == " ") continue;
	  $value = mb_convert_encoding($letter, 'UTF-16');
	  $b = ord($value[1])&0xff;
//    echo $b . " " . $letter."<br>";
	  $sn += (int)($sn/$b); 
	}
	return $sn;
}
mb_internal_encoding("UTF-8");
$name = $_GET["initals"] ." ". $_GET["name"] ." ". $_GET["email"];
//$name = "Cédric GEORGEOT cgeorgeot@e-novatic.fr";
echo $name. "<br>";

$x = log(Name2SN($name));

$binarydata = pack("d", $x);
$count = strlen($binarydata);
$hex = bin2hex($binarydata);

if($name == "  ") 
{
echo " <ul>
<li><a href=\"/\" >Home.</a>
<li><a href=\"/readme.htm\" >Order license.</a>
</ul>";
}
else
{
echo "<SOFTSHOP>".chunk_split($hex, 2, " ") . "." . $name . "</SOFTSHOP>";
}
?>
