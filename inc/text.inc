<?php
$t['meta']['description']['fr']="Blockchain Name Service";
$t['meta']['description']['en']="Blockchain Name Service";

$t['menu']['index']['fr']="Acceuil";
$t['menu']['index']['en']="Home";
$t['menu']['register']['fr']="Enregistrement";
$t['menu']['register']['en']="Register";
$t['menu']['about']['fr']="A propos";
$t['menu']['about']['en']="About";

$t['flag']['en']['img']='Grossbritanien.gif';
$t['flag']['en']['name']='English';
$t['flag']['fr']['img']='Frankreich.gif';
$t['flag']['fr']['name']='Francais';

$t['intro']['tittle']['fr']="";
$t['intro']['tittle']['en']="<span style=\"color:#6D2E84;\">B</span><span style=\"color:#998786;\">NS</span>";

$t['intro']['baseline']['fr']="Blockchain Name Service";
$t['intro']['baseline']['en']="Blockchain Name Service";

$t['intro']['description']['fr']="Recherche parmis les enregistrements sur Ethereum";
$t['intro']['description']['en']="Search over records indexed on Ethereum";

$t['register']['baseline']['fr']="Blockchain Name Service Enregistrement";
$t['register']['baseline']['en']="Blockchain Name Service Register";

$t['register']['description']['fr']="Ajouter un enregistrements sur Ethereum";
$t['register']['description']['en']="Add a records on Ethereum";

$t['about']['baseline']['fr']="Blockchain Name Service A propos";
$t['about']['baseline']['en']="Blockchain Name Service About";

$t['about']['description']['fr']="BNS permet de rechercher de façon libre parmis les mots clefs enregistré sur la blockchain sans avoir besoin de DNS et de moteur de recherche";
$t['about']['description']['en']="BNS give the possibility to search over records stored onto the blockchain without the need of DNS and search engine";

$t['cookies']['advise']['fr']="En poursuivant votre navigation sur ce site, vous acceptez l’utilisation de cookies pour réaliser des statistiques de visites";
$t['cookies']['advise']['en']="By continuing your visit to this site, you accept the use of cookies to make visits statistics";
$t['cookies']['ok']['fr']="Ok";
$t['cookies']['ok']['en']="Ok";

function t($section, $item){
	global $lng, $t;
  if (isset($t[$section][$item][$lng]) && !empty($t[$section][$item][$lng])){
  	echo $t[$section][$item][$lng];
  }else{
   	echo $t[$section][$item]["en"];
  }
}

function t_list($section){
	global $lng, $t;
	foreach ($t[$section] as $item){
		echo '<h5 class="text-justify"><span style="color:#41D57F;font-size:1em;font-weight: bold;margin-right:0.4em;">@</span>'.$item[$lng].'</h5>';
	}
}

function vpn_lines($section){
	global $lng, $t;
  $i = 1;
	foreach ($t[$section] as $item){
  if ($i % 2 == 0){
    echo "<tr class='table-active'>";
  }else{
    echo "<tr>";
  }
?>
      <th scope="row"><?php echo $item['title'][$lng]; ?></th>
      <td>
<?php
      if (!isset($item['vpn']) || $item['vpn'] == 1){
          ?><i class="fa fa-check animated" style="color:#41D57F;"></i><?php
      }
?>
      </td>
      <td>
<?php
      if (isset($item['vpn'])){
        if ($item['vpn'] == 1){
         ?><i class="fa fa-check animated" style="color:#41D57F;"></i><?php
        }else if ($item['vpn'] == 2){
         ?><i class="fa fa-frown animated" style="color:red;"></i><?php
        }
      }
?>
      </td>
    </tr>
<?php
    $i++;
	}
}


function product_t($section){
  global $t;
?>
  <div class="col-xs-12 col-sm-12 col-md-4 mx-auto"  style="margin-bottom:1em">
    <p><i class="fa fa-<?php echo $t[$section]["icon"]; ?> product-icon text-danger"></i></p>
    <h4 style="min-height:2.5em;"><?php t($section, 'title') ?></h4>
    <p class="text-justify lead add-padding" data-meaningful="true"><?php t($section, 'description') ?></p>
    <?php /*<p class="text-center lead add-padding" data-meaningful="true"><a class="btn btn-outline-danger" target="_blank" href="<?php t($section, 'link') ?>" role="button">Source</a></p> */?>
  </div>
<?php
}

function product2_t($section){
  global $t;
?>  
  <div class="col-xs-12 col-sm-12 col-md-4 mx-auto"  style="margin-bottom:1em">
    <p><i class="fa fa-<?php echo $t[$section]["icon"]; ?> product-icon text-success"></i></p>
    <h4><?php t($section, 'title') ?></h4>
    <p class="lead add-padding" data-meaningful="true"><?php t($section, 'description') ?></p>
  </div>
<?php
}

function benefit_t($section){
  global $t;
?> 
  <div class="row">
    <div class="col-xs-12 col-sm-6 col-md-6 mx-auto"  style="margin-bottom:1em">    </div>
    <div class="col-xs-12 col-sm-6 col-md-6 mx-auto text-align-left"  style="margin-bottom:1em">
      <!-- <p><i class="fa fa-<?php echo $t[$section]["icon"]; ?> product-icon"></i></p> -->
      <!-- <h4 style="min-height:2.5em;"><?php t($section, 'title') ?></h4> -->
      <p class="text-left lead add-padding" data-meaningful="true"><i class="fa fa-<?php echo $t[$section]["icon"]; ?> benefit-icon"> </i> <?php t($section, 'title') ?></p>
    </div>
    

  </div>
<?php
}

function product_t2($section){
  global $t;
?>  
  <div class="col-xs-12 col-sm-6 col-md-4 mx-auto"  style="margin-bottom:1em">    
  </div>
<?php
}

function button_next_black($section){
?>
<div class="row d-none d-sm-block">
  <div class="col-xs-12 col-sm-12 mx-auto justify-content-center align-self-center">
    <a href="#<?php echo $section; ?>" class="btn btn-circle-black js-scroll-trigger">
      <i class="fa fa-angle-double-down animated"></i>
    </a>
 	</div>
</div>
<?php
}

function button_next_white($section){
?>
<div class="row d-none d-sm-block">
  <div class="col-xs-12 col-sm-12 mx-auto justify-content-center align-self-center">
    <a href="#<?php echo $section; ?>" class="btn btn-circle js-scroll-trigger">
      <i class="fa fa-angle-double-down animated"></i>
    </a>
 	</div>
</div>
<?php
}

function threat_t($section){
?>
<div class="col-xs-12 col-sm-4 mx-auto justify-content-center" style="margin-bottom:1em">            
  <div class="rounded-circle number-round">
    <div class="number-round-cell">
       <b><?php t($section, 'title') ?></b>
    </div>
  </div>
  <p class="text-center lead" data-meaningful="true"><?php t($section, 'description') ?></p>
</div>

<?php
}


?>

