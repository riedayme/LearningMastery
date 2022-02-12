<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');}

class M_Site_Meta_Data_Twitter_Card_Init extends CI_Model
{

	public function get_image($site_meta,$image = false){

		if (empty($image)) {

			if ($site_meta['default_image']) {

				$image = base_url('storage/uploads/site/'.$site_meta['default_image']);

			}
		}

		return $image;
	}	
}