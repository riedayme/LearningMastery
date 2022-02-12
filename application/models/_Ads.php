<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');}

class _Ads extends CI_Model
{
	function inject_ads($ads,$content) {

		if ($ads['status'] != 'active') return $content;
		if (strpos($content, '<p') === FALSE) {  return $content; }

		$ChapterCount = $ads['loop_ads']; 
		$content = explode("<p", $content);

		$new_content = '';
		for ($i = 0; $i < count($content); $i++) {
			if ($i == $ChapterCount) {
				$new_content .= $ads['content']; 
				$ChapterCount = $ChapterCount+$ads['loop_ads'];
			}

			if($i>0) {
				$new_content.= "<p".$content[$i];
			} else {
				$new_content.= $content[$i];
			}
		}

		return $new_content;			
	}	
}