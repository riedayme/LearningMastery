<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');}

class M_Site_Meta_Data_OG_Init extends CI_Model
{

	public function get_image($site_meta,$image = false){

		$this->load->library('FastImage');

		if (!empty($image)) {

			// @$fastimage = new FastImage($image);

			// if ($fastimage->handle) {
			// 	list($width, $height) = $fastimage->getSize();
			// }else {
			// 	$width = 640;
			// 	$height = 640;	
			// }

			$width = 640;
			$height = 640;	
			
		}else {

			if ($site_meta['default_image']) {

				$image = base_url('storage/uploads/site/'.$site_meta['default_image']);

				if ($getsize = @getimagesize($image)) {
					$width = $getsize[0];
					$height = $getsize[1];
				}else{
					$width = 640;
					$height = 640;					
				}

			}

		}

		return [
			'url' => $image,
			'width' => $width,
			'height' => $height,
		];
	}
}