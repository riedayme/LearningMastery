<?php

function ctsubstr($string,$length,$dot = '...'){
    $string = strip_tags(html_entity_decode($string));
    $newstring = (strlen($string) > $length) ? substr($string, 0 , $length). $dot : $string;
    return $newstring;
}
