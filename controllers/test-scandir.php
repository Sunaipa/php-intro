<?php

function getFolderContent($path){
    $content = scandir($path);
	$content = array_filter($content, function($item){
		return $item != "." && $item != "..";
	});
    $html = "<ul>";

    foreach($content as $item){
    	if(is_file($item)){
    		$html .= "<li>$item</li>";
    	} else {
    		$html .= getFolderContent($item);
    	}
    }
    
    $html .= "</ul>";
    
    return $html;
}
