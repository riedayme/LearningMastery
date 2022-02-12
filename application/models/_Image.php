<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');}

class _Image extends CI_Model
{

	public function first_image($html){
		$doc = new DOMDocument();
		@$doc->loadHTML(html_entity_decode($html));

		$tags = $doc->getElementsByTagName('img');

		if (count($tags) > 0) {
			foreach ($tags as $tag) {
				$firstimage[] = $tag->getAttribute('src');
			}
			return @$firstimage[0];
		}else {
			return false;
		}
	}

	public function extract_image($image,$size,$site){
		if ($image) {

			$host_image = explode('/', $image);

			if ($host_image[0]) {

				$post_image = base_url('storage/uploads/'.$image);
				$post_image_thumbnail = base_url('storage/uploads/medium/'.$image);
			}else {

				$post_image = $image;

				if (strpos($image,'blogspot.com')) {
					$extract_image = explode('/', $image);
					$read_size = end($extract_image);
					$read_size = prev($extract_image);
					$post_image_thumbnail = str_replace($read_size, 's'.$size, $image);
				}else {
					$post_image_thumbnail = $image;
				}
			}
		}
		else {
			$post_image = false;
			$post_image_thumbnail = false;
		}

		$no_image = base_url('storage/uploads/site/'.$site['no_image']);

		return array(
			'original' => $post_image,
			'thumbnail' => $post_image_thumbnail,
			'no_image' => $no_image,
		);
	}
	
}