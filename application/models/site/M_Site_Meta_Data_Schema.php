<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');}

class M_Site_Meta_Data_Schema extends CI_Model
{

	public function generate($data,$breadcrumb = false,$courses = false){

		$person_same_as = json_encode(explode(',', $data['content']['person_sameAs']),JSON_UNESCAPED_SLASHES);
		$person_worksfor_same_as = json_encode(explode(',', $data['content']['person_worksFor_sameAs']),JSON_UNESCAPED_SLASHES);
		$organization_sameAs = json_encode(explode(',', $data['content']['organization_sameAs']),JSON_UNESCAPED_SLASHES);

		if ($data['type'] == 'Person') {
			$json_data[] = '
			<script type="application/ld+json">{
				"@context": "https://schema.org",
				"@id": "'.base_url().'#person",
				"@type": "Person",
				"name": "'.$data['content']['person_name'].'",
				"alternateName": "'.$data['content']['person_alternateName'].'",
				"gender": "'.$data['content']['person_gender'].'",
				"height": "'.$data['content']['person_height'].'",
				"birthDate": "'.$data['content']['person_birthDate'].'",
				"birthPlace": "'.$data['content']['person_birthPlace'].'",
				"nationality": "'.$data['content']['person_nationality'].'",
				"image": "'.base_url('storage/uploads/site/'.$data['content']['person_image']).'",
				"alumniOf": "'.$data['content']['person_alumniOf'].'",
				"memberOf": "'.$data['content']['person_memberOf'].'",
				"address": {
					"@type": "PostalAddress",
					"streetAddress": "'.$data['content']['person_streetAddress'].'",
					"addressLocality": "'.$data['content']['person_addressLocality'].'",
					"addressRegion": "'.$data['content']['person_addressRegion'].'",
					"postalCode": "'.$data['content']['person_postalCode'].'"
				},
				"email": "'.$data['content']['person_email'].'",
				"telephone": "'.$data['content']['person_telephone'].'",
				"url": "'.$data['content']['person_url'].'",
				"jobTitle": "'.$data['content']['person_jobTitle'].'",
				"worksFor": [
				{
					"@type": "Organization",
					"name": "'.$data['content']['person_worksFor_name'].'",
					"sameAs": '.$person_worksfor_same_as.'
				}
				],
				"sameAs": '.$person_same_as.'
			}
			</script>';//
		}else {
			$json_data[] = '<script type="application/ld+json">{
				"@context":"http://schema.org",
				"@id": "'.base_url().'#organization",
				"@type":"Organization",
				"name":"'.$data['content']['organization_name'].'",
				"url":"'.$data['content']['organization_url'].'",
				"contactPoint":[  
				{  
					"@type":"ContactPoint",
					"telephone":"'.$data['content']['organization_contactPoint_telephone'].'",
					"contactType":"'.$data['content']['organization_contactPoint_contactType'].'"
				}
				],
				"logo":"'.base_url('storage/uploads/site/'.$data['content']['organization_logo_url']).'",
				"sameAs": '.$organization_sameAs.'
			}</script>';
		}

		if ($breadcrumb) {

			$json_data[] = '   
			<script type="application/ld+json">
				{
					"@context": "https://schema.org",
					"@type": "BreadcrumbList",
					"itemListElement": [{
						"@type": "ListItem",
						"position": 1,
						"name": "'.$breadcrumb['category']['name'].'",
						"item": "'.$breadcrumb['category']['url'].'"
					},{
						"@type": "ListItem",
						"position": 2,
						"name": "'.$breadcrumb['title'].'",
						"item": "'.base_url(uri_string()).'"
					}]
				}
			</script>';
		}


		if ($courses) {
			$json_data[] = '
			<script type="application/ld+json">
				{
					"@context": "https://schema.org",
					"@type": "Course",
					"name": "'.$courses['title'].'",
					"description": "'.$courses['description'].'"
				}
			</script>';
		}


		return implode('', $json_data);
	}

}