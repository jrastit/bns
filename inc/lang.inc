<?php

	require_once "../inc/text.inc";

	$lng="en";
	if (isset($_REQUEST['lang'])){
		if ($_REQUEST['lang'] == 'fr'){
			$lng="fr";
		}
	}else{
		$supportedLangs = array('fr', 'fr_FR');
		$languages = explode(',',$_SERVER['HTTP_ACCEPT_LANGUAGE']);
		foreach($languages as $lang)
		{
			$lang = substr($lang, 0, 2);

  	  if(in_array($lang, $supportedLangs))
	    {
        // Set the page locale to the first supported language found
        //$page->setLocale("fr_FR.UTF-8");
				$lng="fr";
        break;
  	  }
		}

		if ($lng == "en"){
  	      //$page->setLocale("en_US.UTF-8");
		}
	}
?>
