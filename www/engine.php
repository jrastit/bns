<?php

function file_get_contents_curl($url)
{
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

    $data = curl_exec($ch);
    curl_close($ch);

    return $data;
}

function is_valid_domain_name($domain_name)
{
    return (preg_match("/^([a-z\d](-*[a-z\d])*)(\.([a-z\d](-*[a-z\d])*))*$/i", $domain_name) //valid chars check
            && preg_match("/^.{1,253}$/", $domain_name) //overall length check
            && preg_match("/^[^\.]{1,63}(\.[^\.]{1,63})*$/", $domain_name)   ); //length of each label
}


if (isset($_GET["dns"]) && is_valid_domain_name($_GET["dns"])) {
    //echo("$ip is a valid IP address");
 

echo '<div class="row"><div class="col-sm-6">';

$html = file_get_contents_curl("https://" . $_GET["dns"] ."/");

//parsing begins here:
$doc = new DOMDocument();
@$doc->loadHTML($html);

$xpath = new DOMXPath($doc);
$query = '//*/meta[starts-with(@property, \'og:\')]';
$metas = $xpath->query($query);

$title = null;
$description = null;
$image = null;

foreach ($metas as $meta) {
    $property = $meta->getAttribute('property');
    $content = $meta->getAttribute('content');
    if ($property == "og:image"){
	$image = $content;
	}
    if ($property == "og:title"){
	$title = $content;
	}
    if ($property == "og:description"){
	$description = $content;
	}
    //echo '<h1>Meta '.$property.' <span>'.$content.'</span></h1>';
}

if ($image){
	echo '<img src="'.$image.'" class="img-fluid" />';
}

$nodes = $doc->getElementsByTagName('title');

if (!$title){
	$title = $nodes->item(0)->nodeValue;
}

if (!$description){
	$metas = $doc->getElementsByTagName('meta');

for ($i	= 0; $i < $metas->length; $i++)	
	{
    $meta = $metas->item($i);
    if($meta->getAttribute('name') == 'description')
        $description = $meta->getAttribute('content');
    if($meta->getAttribute('name') == 'keywords')
        $keywords = $meta->getAttribute('content');
}
}

echo '</div><div class="col-sm-6">';

if ($title){
	echo '<h3 style="margin:1em;">'.$title.'</h3>';;
}

if ($description){
	echo '<p>'.$description.'</p>';;
}

echo '</div></div>';

//get and display what you need:


/*
echo "Title: $title". '<br/><br/>';
echo "Description: $description". '<br/><br/>';
echo "Keywords: $keywords";
*/
}else {
    echo($_GET["dns"]." is not a valid host address");
}

?>
