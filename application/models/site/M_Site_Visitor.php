<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');}

class M_Site_Visitor extends CI_Model
{

    public $table_lms_courses = 'tb_lms_courses';
    public $table_blog_post = 'tb_blog_post';
    public $table_site_visitor = 'tb_site_visitor';

    public function record($site){


        if (!$this->agent->is_robot()) {

            $post = $this->post_data();

            /**
             * if ip db = ip user
             * if date = date today
             * if url = url user
             */
            $check = $this->db
            ->where('ip',$post['ip'])
            ->where('DATE(date) = DATE(CURDATE())')
            ->where('url',$post['url'])
            ->get($this->table_site_visitor);

            if ($check->num_rows() < 1) {

                if ($site['page_type'] != 'lesson') {
                    $this->_Process_MYSQL->insert_data($this->table_site_visitor, $post);
                }

                if ($site['modules'] == 'blog' AND $site['page_type'] == 'post') {
                    $this->db->set('views','views+1',FALSE)
                    ->where('permalink',$this->uri->segment(2))
                    ->update($this->table_blog_post);
                }
                elseif ($site['modules'] == 'lms' AND $site['page_type'] == 'courses') {
                    $this->db->set('views','views+1',FALSE)
                    ->where('permalink',$this->uri->segment(2))
                    ->update($this->table_lms_courses);
                }

            }else {
                $this->db->set('hits','hits+1',FALSE)
                ->where('ip',$post['ip'])
                ->where('DATE(date) = CURDATE()')
                ->where('url',$post['url'])
                ->update($this->table_site_visitor);
            }

        }

    }

    public function post_data(){

        $url = base_url(uri_string());
        $country = $this->get_country();
        $browser = $this->get_browser();
        $platform = $this->get_platform();
        $referrer = $this->get_referrer();

        # create post data
        $post_data =  array(
            'ip' => $country['ip'],
            'date' => date('Y-m-d H:i:s'),
            'browser' => $browser,
            'os' => $platform,
            'country_name' => $country['name'],
            'country_code' => $country['code'],
            'hits' => 1,
            'url' => $url,
            'referrer' => $referrer,
            );

        return $post_data;
    }

    public function get_ip(){
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) { 
            $ip = $_SERVER['HTTP_CLIENT_IP']; 
        } 
        else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) { 
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR']; 
        } 
        else { 
            $ip = $_SERVER['REMOTE_ADDR']; 
        } 

        return $ip;
    }

    public function get_country(){

        if (empty($this->session->userdata('country_code')) AND empty($this->session->userdata('country_name'))) {

            $data_country = json_decode(@file_get_contents("https://ipinfo.io/{$this->get_ip()}"));

            if (!empty($data_country->country)) {
                $ip = $data_country->ip;
                $country_name = $this->country_name($data_country->country);
                $country_code = $data_country->country;
            }else {
                $ip = $this->get_ip();
                $country_name = 'Other';
                $country_code = 'Other';
            }

            $this->session->set_userdata('ip',$ip);
            $this->session->set_userdata('country_name',$country_name);
            $this->session->set_userdata('country_code',$country_code);

        }

        $ip = $this->session->userdata('ip');        
        $country_name = $this->session->userdata('country_name');        
        $country_code = $this->session->userdata('country_code');

        $data = [
        'ip' => $ip,
        'name' => $country_name,
        'code' => $country_code,
        ];

        return $data;        
    }

    public function get_browser(){
        if ($this->agent->is_browser()){
            $browser = $this->agent->browser();
        }elseif ($this->agent->is_robot()){
            $browser = $this->agent->robot(); 
        }elseif ($this->agent->is_mobile()){
            $browser = $this->agent->mobile();
        }else{
            $browser ='Unknown Browser';
        }

        return $browser;
    }

    public function get_platform(){
        if ($this->agent->platform()) {
            $os = $this->agent->platform();
        }else {
            $os = 'Unknown Platform';
        }

        return $os;
    }

    public function get_referrer(){
        if ($this->agent->is_referral())
        {
            $referrer =  $this->agent->referrer();
        }else {
            $referrer = '';
        }

        return $referrer;
    }

    public function country_name($code){
        $countries = array( "BD" => "Bangladesh", "BE" => "Belgium", "BF" => "Burkina Faso", "BG" => "Bulgaria", "BA" => "Bosnia and Herzegovina", "BB" => "Barbados", "WF" => "Wallis and Futuna", "BL" => "Saint Barthelemy", "BM" => "Bermuda", "BN" => "Brunei", "BO" => "Bolivia", "BH" => "Bahrain", "BI" => "Burundi", "BJ" => "Benin", "BT" => "Bhutan", "JM" => "Jamaica", "BV" => "Bouvet Island", "BW" => "Botswana", "WS" => "Samoa", "BQ" => "Bonaire, Saint Eustatius and Saba ", "BR" => "Brazil", "BS" => "Bahamas", "JE" => "Jersey", "BY" => "Belarus", "BZ" => "Belize", "RU" => "Russia", "RW" => "Rwanda", "RS" => "Serbia", "TL" => "East Timor", "RE" => "Reunion", "TM" => "Turkmenistan", "TJ" => "Tajikistan", "RO" => "Romania", "TK" => "Tokelau", "GW" => "Guinea-Bissau", "GU" => "Guam", "GT" => "Guatemala", "GS" => "South Georgia and the South Sandwich Islands", "GR" => "Greece", "GQ" => "Equatorial Guinea", "GP" => "Guadeloupe", "JP" => "Japan", "GY" => "Guyana", "GG" => "Guernsey", "GF" => "French Guiana", "GE" => "Georgia", "GD" => "Grenada", "GB" => "United Kingdom", "GA" => "Gabon", "SV" => "El Salvador", "GN" => "Guinea", "GM" => "Gambia", "GL" => "Greenland", "GI" => "Gibraltar", "GH" => "Ghana", "OM" => "Oman", "TN" => "Tunisia", "JO" => "Jordan", "HR" => "Croatia", "HT" => "Haiti", "HU" => "Hungary", "HK" => "Hong Kong", "HN" => "Honduras", "HM" => "Heard Island and McDonald Islands", "VE" => "Venezuela", "PR" => "Puerto Rico", "PS" => "Palestinian Territory", "PW" => "Palau", "PT" => "Portugal", "SJ" => "Svalbard and Jan Mayen", "PY" => "Paraguay", "IQ" => "Iraq", "PA" => "Panama", "PF" => "French Polynesia", "PG" => "Papua New Guinea", "PE" => "Peru", "PK" => "Pakistan", "PH" => "Philippines", "PN" => "Pitcairn", "PL" => "Poland", "PM" => "Saint Pierre and Miquelon", "ZM" => "Zambia", "EH" => "Western Sahara", "EE" => "Estonia", "EG" => "Egypt", "ZA" => "South Africa", "EC" => "Ecuador", "IT" => "Italy", "VN" => "Vietnam", "SB" => "Solomon Islands", "ET" => "Ethiopia", "SO" => "Somalia", "ZW" => "Zimbabwe", "SA" => "Saudi Arabia", "ES" => "Spain", "ER" => "Eritrea", "ME" => "Montenegro", "MD" => "Moldova", "MG" => "Madagascar", "MF" => "Saint Martin", "MA" => "Morocco", "MC" => "Monaco", "UZ" => "Uzbekistan", "MM" => "Myanmar", "ML" => "Mali", "MO" => "Macao", "MN" => "Mongolia", "MH" => "Marshall Islands", "MK" => "Macedonia", "MU" => "Mauritius", "MT" => "Malta", "MW" => "Malawi", "MV" => "Maldives", "MQ" => "Martinique", "MP" => "Northern Mariana Islands", "MS" => "Montserrat", "MR" => "Mauritania", "IM" => "Isle of Man", "UG" => "Uganda", "TZ" => "Tanzania", "MY" => "Malaysia", "MX" => "Mexico", "IL" => "Israel", "FR" => "France", "IO" => "British Indian Ocean Territory", "SH" => "Saint Helena", "FI" => "Finland", "FJ" => "Fiji", "FK" => "Falkland Islands", "FM" => "Micronesia", "FO" => "Faroe Islands", "NI" => "Nicaragua", "NL" => "Netherlands", "NO" => "Norway", "NA" => "Namibia", "VU" => "Vanuatu", "NC" => "New Caledonia", "NE" => "Niger", "NF" => "Norfolk Island", "NG" => "Nigeria", "NZ" => "New Zealand", "NP" => "Nepal", "NR" => "Nauru", "NU" => "Niue", "CK" => "Cook Islands", "XK" => "Kosovo", "CI" => "Ivory Coast", "CH" => "Switzerland", "CO" => "Colombia", "CN" => "China", "CM" => "Cameroon", "CL" => "Chile", "CC" => "Cocos Islands", "CA" => "Canada", "CG" => "Republic of the Congo", "CF" => "Central African Republic", "CD" => "Democratic Republic of the Congo", "CZ" => "Czech Republic", "CY" => "Cyprus", "CX" => "Christmas Island", "CR" => "Costa Rica", "CW" => "Curacao", "CV" => "Cape Verde", "CU" => "Cuba", "SZ" => "Swaziland", "SY" => "Syria", "SX" => "Sint Maarten", "KG" => "Kyrgyzstan", "KE" => "Kenya", "SS" => "South Sudan", "SR" => "Suriname", "KI" => "Kiribati", "KH" => "Cambodia", "KN" => "Saint Kitts and Nevis", "KM" => "Comoros", "ST" => "Sao Tome and Principe", "SK" => "Slovakia", "KR" => "South Korea", "SI" => "Slovenia", "KP" => "North Korea", "KW" => "Kuwait", "SN" => "Senegal", "SM" => "San Marino", "SL" => "Sierra Leone", "SC" => "Seychelles", "KZ" => "Kazakhstan", "KY" => "Cayman Islands", "SG" => "Singapore", "SE" => "Sweden", "SD" => "Sudan", "DO" => "Dominican Republic", "DM" => "Dominica", "DJ" => "Djibouti", "DK" => "Denmark", "VG" => "British Virgin Islands", "DE" => "Germany", "YE" => "Yemen", "DZ" => "Algeria", "US" => "United States", "UY" => "Uruguay", "YT" => "Mayotte", "UM" => "United States Minor Outlying Islands", "LB" => "Lebanon", "LC" => "Saint Lucia", "LA" => "Laos", "TV" => "Tuvalu", "TW" => "Taiwan", "TT" => "Trinidad and Tobago", "TR" => "Turkey", "LK" => "Sri Lanka", "LI" => "Liechtenstein", "LV" => "Latvia", "TO" => "Tonga", "LT" => "Lithuania", "LU" => "Luxembourg", "LR" => "Liberia", "LS" => "Lesotho", "TH" => "Thailand", "TF" => "French Southern Territories", "TG" => "Togo", "TD" => "Chad", "TC" => "Turks and Caicos Islands", "LY" => "Libya", "VA" => "Vatican", "VC" => "Saint Vincent and the Grenadines", "AE" => "United Arab Emirates", "AD" => "Andorra", "AG" => "Antigua and Barbuda", "AF" => "Afghanistan", "AI" => "Anguilla", "VI" => "U.S. Virgin Islands", "IS" => "Iceland", "IR" => "Iran", "AM" => "Armenia", "AL" => "Albania", "AO" => "Angola", "AQ" => "Antarctica", "AS" => "American Samoa", "AR" => "Argentina", "AU" => "Australia", "AT" => "Austria", "AW" => "Aruba", "IN" => "India", "AX" => "Aland Islands", "AZ" => "Azerbaijan", "IE" => "Ireland", "ID" => "Indonesia", "UA" => "Ukraine", "QA" => "Qatar", "MZ" => "Mozambique" );

        return $countries[$code];
    }

}