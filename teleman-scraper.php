<?php
require "simple_html_dom.php";
error_reporting(E_ALL & ~E_NOTICE);

function konwertuj_date($data_u){
	$sr = strtotime($data_u);
	if(!empty($sr)){
		$data = date('Y-m-d',$sr);
	}else{
		die("Nieprawidłowa data!");
	}
	return $data;
}


$kanal = 'tvn';
$data = date('Y-m-d');


function raw_json_encode($input, $flags = 0) {
    $fails = implode('|', array_filter(array(
        '\\\\',
        $flags & JSON_HEX_TAG ? 'u003[CE]' : '',
        $flags & JSON_HEX_AMP ? 'u0026' : '',
        $flags & JSON_HEX_APOS ? 'u0027' : '',
        $flags & JSON_HEX_QUOT ? 'u0022' : '',
    )));
    $pattern = "/\\\\(?:(?:$fails)(*SKIP)(*FAIL)|u([0-9a-fA-F]{4}))/";
    $callback = function ($m) {
        return html_entity_decode("&#x$m[1];", ENT_QUOTES, 'UTF-8');
    };
    return preg_replace_callback($pattern, $callback, json_encode($input, $flags));
}

if(empty($data)){
	$URL = "https://www.teleman.pl/program-tv/stacje/$kanal?hour=-1";
}else{
	$URL = "https://www.teleman.pl/program-tv/stacje/$kanal?date=$data&hour=-1";
}

$TVPROGRAM = Array();
$I = 0;
$html = file_get_html($URL);
$tree = $html->find('ul[class=stationItems]')[0];
$li = $tree->find('li[id^=prog]');
foreach($li as $o){
    $TVPROGRAM[$I] = Array();
    
    if(!empty(@$o->find('em')[0]->innertext)){
        $TVPROGRAM[$I]["time"] = strip_tags(@$o->find('em')[0]->innertext);
    }
    
    if(!empty(@$o->find(".detail")[0]->find("a")[0]->innertext)){
        $TVPROGRAM[$I]["nazwa"] = @$o->find(".detail")[0]->find("a")[0]->innertext;
    }
    
    if(!empty($o->find(".detail")[0]->find("p")[0]->innertext)){
        $TVPROGRAM[$I]["typ"] = $o->find(".detail")[0]->find(".genre")[0]->innertext;
    }
    
	if(!empty($o->find(".detail")[0]->find("p[!class]")[0]->innertext)){
		$TVPROGRAM[$I]["opis"] = $o->find(".detail")[0]->find("p[!class]")[0]->innertext;
	}
	
    $I++;
}
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
print raw_json_encode($TVPROGRAM);
?>
