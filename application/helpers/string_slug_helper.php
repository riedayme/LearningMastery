<?php
/**
 * this function from cifire cms
 */
function slug($str = '', $sp = '-')
{
    $seotitle = '';

    if ( !empty($str) )
    {   
        $q_separator = preg_quote($sp, '#');

        $trans = array(
            '_' => $sp,
            '&.+?;' => '',
            '[^\w\d -]' => '',
            '\s+' => $sp,
            '('.$q_separator.')+' => $sp
        );

        $str = strip_tags($str);
        
        foreach ($trans as $key => $val)
        {
            $str = preg_replace('#'.$key.'#i'.(UTF8_ENABLED ? 'u' : ''), $val, $str);
        }
        
        $str = strtolower($str);
        $seotitle = trim(trim($str, $sp));
    }

    return $seotitle;
}
