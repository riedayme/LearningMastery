<div class="c-field u-mb-medium col-md-6">
	<label class="c-field__label">Set Timezone</label>
	<select required="" name="time_zone" class="c-select select2 has-search">
		<option <?php echo ($site['time_zone'] == 'Pacific/Midway') ? 'selected' : ''; ?> value="Pacific/Midway">(UTC-11:00) Midway Island</option>
		<option <?php echo ($site['time_zone'] == 'Pacific/Samoa') ? 'selected' : ''; ?> value="Pacific/Samoa">(UTC-11:00) Samoa</option>
		<option <?php echo ($site['time_zone'] == 'Pacific/Honolulu') ? 'selected' : ''; ?> value="Pacific/Honolulu">(UTC-10:00) Hawaii</option>
		<option <?php echo ($site['time_zone'] == 'US/Alaska') ? 'selected' : ''; ?> value="US/Alaska">(UTC-09:00) Alaska</option>
		<option <?php echo ($site['time_zone'] == 'America/Los_Angeles') ? 'selected' : ''; ?> value="America/Los_Angeles">(UTC-08:00) Pacific Time (US &amp; Canada)</option>
		<option <?php echo ($site['time_zone'] == 'America/Tijuana') ? 'selected' : ''; ?> value="America/Tijuana">(UTC-08:00) Tijuana</option>
		<option <?php echo ($site['time_zone'] == 'US/Arizona') ? 'selected' : ''; ?> value="US/Arizona">(UTC-07:00) Arizona</option>
		<option <?php echo ($site['time_zone'] == 'America/Chihuahua') ? 'selected' : ''; ?> value="America/Chihuahua">(UTC-07:00) Chihuahua</option>
		<option <?php echo ($site['time_zone'] == 'America/Chihuahua') ? 'selected' : ''; ?> value="America/Chihuahua">(UTC-07:00) La Paz</option>
		<option <?php echo ($site['time_zone'] == 'America/Mazatlan') ? 'selected' : ''; ?> value="America/Mazatlan">(UTC-07:00) Mazatlan</option>
		<option <?php echo ($site['time_zone'] == 'US/Mountain') ? 'selected' : ''; ?> value="US/Mountain">(UTC-07:00) Mountain Time (US &amp; Canada)</option>
		<option <?php echo ($site['time_zone'] == 'America/Managua') ? 'selected' : ''; ?> value="America/Managua">(UTC-06:00) Central America</option>
		<option <?php echo ($site['time_zone'] == 'US/Central') ? 'selected' : ''; ?> value="US/Central">(UTC-06:00) Central Time (US &amp; Canada)</option>
		<option <?php echo ($site['time_zone'] == 'America/Mexico_City') ? 'selected' : ''; ?> value="America/Mexico_City">(UTC-06:00) Guadalajara</option>
		<option <?php echo ($site['time_zone'] == 'America/Mexico_City') ? 'selected' : ''; ?> value="America/Mexico_City">(UTC-06:00) Mexico City</option>
		<option <?php echo ($site['time_zone'] == 'America/Monterrey') ? 'selected' : ''; ?> value="America/Monterrey">(UTC-06:00) Monterrey</option>
		<option <?php echo ($site['time_zone'] == 'Canada/Saskatchewan') ? 'selected' : ''; ?> value="Canada/Saskatchewan">(UTC-06:00) Saskatchewan</option>
		<option <?php echo ($site['time_zone'] == 'America/Bogota') ? 'selected' : ''; ?> value="America/Bogota">(UTC-05:00) Bogota</option>
		<option <?php echo ($site['time_zone'] == 'US/Eastern') ? 'selected' : ''; ?> value="US/Eastern">(UTC-05:00) Eastern Time (US &amp; Canada)</option>
		<option <?php echo ($site['time_zone'] == 'US/East') ? 'selected' : ''; ?> value="US/East-Indiana">(UTC-05:00) Indiana (East)</option>
		<option <?php echo ($site['time_zone'] == 'America/Lima') ? 'selected' : ''; ?> value="America/Lima">(UTC-05:00) Lima</option>
		<option <?php echo ($site['time_zone'] == 'America/Bogota') ? 'selected' : ''; ?> value="America/Bogota">(UTC-05:00) Quito</option>
		<option <?php echo ($site['time_zone'] == 'Canada/Atlantic') ? 'selected' : ''; ?> value="Canada/Atlantic">(UTC-04:00) Atlantic Time (Canada)</option>
		<option <?php echo ($site['time_zone'] == 'America/Caracas') ? 'selected' : ''; ?> value="America/Caracas">(UTC-04:30) Caracas</option>
		<option <?php echo ($site['time_zone'] == 'America/La_Paz') ? 'selected' : ''; ?> value="America/La_Paz">(UTC-04:00) La Paz</option>
		<option <?php echo ($site['time_zone'] == 'America/Santiago') ? 'selected' : ''; ?> value="America/Santiago">(UTC-04:00) Santiago</option>
		<option <?php echo ($site['time_zone'] == 'Canada/Newfoundland') ? 'selected' : ''; ?> value="Canada/Newfoundland">(UTC-03:30) Newfoundland</option>
		<option <?php echo ($site['time_zone'] == 'America/Sao_Paulo') ? 'selected' : ''; ?> value="America/Sao_Paulo">(UTC-03:00) Brasilia</option>
		<option <?php echo ($site['time_zone'] == 'America/Argentina') ? 'selected' : ''; ?> value="America/Argentina/Buenos_Aires">(UTC-03:00) Buenos Aires</option>
		<option <?php echo ($site['time_zone'] == 'America/Argentina') ? 'selected' : ''; ?> value="America/Argentina/Buenos_Aires">(UTC-03:00) Georgetown</option>
		<option <?php echo ($site['time_zone'] == 'America/Godthab') ? 'selected' : ''; ?> value="America/Godthab">(UTC-03:00) Greenland</option>
		<option <?php echo ($site['time_zone'] == 'America/Noronha') ? 'selected' : ''; ?> value="America/Noronha">(UTC-02:00) Mid-Atlantic</option>
		<option <?php echo ($site['time_zone'] == 'Atlantic/Azores') ? 'selected' : ''; ?> value="Atlantic/Azores">(UTC-01:00) Azores</option>
		<option <?php echo ($site['time_zone'] == 'Atlantic/Cape_Verde') ? 'selected' : ''; ?> value="Atlantic/Cape_Verde">(UTC-01:00) Cape Verde Is.</option>
		<option <?php echo ($site['time_zone'] == 'Africa/Casablanca') ? 'selected' : ''; ?> value="Africa/Casablanca">(UTC+00:00) Casablanca</option>
		<option <?php echo ($site['time_zone'] == 'Europe/London') ? 'selected' : ''; ?> value="Europe/London">(UTC+00:00) Edinburgh</option>
		<option <?php echo ($site['time_zone'] == 'Etc/Greenwich') ? 'selected' : ''; ?> value="Etc/Greenwich">(UTC+00:00) Greenwich Mean Time : Dublin</option>
		<option <?php echo ($site['time_zone'] == 'Europe/Lisbon') ? 'selected' : ''; ?> value="Europe/Lisbon">(UTC+00:00) Lisbon</option>
		<option <?php echo ($site['time_zone'] == 'Europe/London') ? 'selected' : ''; ?> value="Europe/London">(UTC+00:00) London</option>
		<option <?php echo ($site['time_zone'] == 'Africa/Monrovia') ? 'selected' : ''; ?> value="Africa/Monrovia">(UTC+00:00) Monrovia</option>
		<option <?php echo ($site['time_zone'] == 'UTC">') ? 'selected' : ''; ?> value="UTC">(UTC+00:00) UTC</option>
		<option <?php echo ($site['time_zone'] == 'Europe/Amsterdam') ? 'selected' : ''; ?> value="Europe/Amsterdam">(UTC+01:00) Amsterdam</option>
		<option <?php echo ($site['time_zone'] == 'Europe/Belgrade') ? 'selected' : ''; ?> value="Europe/Belgrade">(UTC+01:00) Belgrade</option>
		<option <?php echo ($site['time_zone'] == 'Europe/Berlin') ? 'selected' : ''; ?> value="Europe/Berlin">(UTC+01:00) Berlin</option>
		<option <?php echo ($site['time_zone'] == 'Europe/Berlin') ? 'selected' : ''; ?> value="Europe/Berlin">(UTC+01:00) Bern</option>
		<option <?php echo ($site['time_zone'] == 'Europe/Bratislava') ? 'selected' : ''; ?> value="Europe/Bratislava">(UTC+01:00) Bratislava</option>
		<option <?php echo ($site['time_zone'] == 'Europe/Brussels') ? 'selected' : ''; ?> value="Europe/Brussels">(UTC+01:00) Brussels</option>
		<option <?php echo ($site['time_zone'] == 'Europe/Budapest') ? 'selected' : ''; ?> value="Europe/Budapest">(UTC+01:00) Budapest</option>
		<option <?php echo ($site['time_zone'] == 'Europe/Copenhagen') ? 'selected' : ''; ?> value="Europe/Copenhagen">(UTC+01:00) Copenhagen</option>
		<option <?php echo ($site['time_zone'] == 'Europe/Ljubljana') ? 'selected' : ''; ?> value="Europe/Ljubljana">(UTC+01:00) Ljubljana</option>
		<option <?php echo ($site['time_zone'] == 'Europe/Madrid') ? 'selected' : ''; ?> value="Europe/Madrid">(UTC+01:00) Madrid</option>
		<option <?php echo ($site['time_zone'] == 'Europe/Paris') ? 'selected' : ''; ?> value="Europe/Paris">(UTC+01:00) Paris</option>
		<option <?php echo ($site['time_zone'] == 'Europe/Prague') ? 'selected' : ''; ?> value="Europe/Prague">(UTC+01:00) Prague</option>
		<option <?php echo ($site['time_zone'] == 'Europe/Rome') ? 'selected' : ''; ?> value="Europe/Rome">(UTC+01:00) Rome</option>
		<option <?php echo ($site['time_zone'] == 'Europe/Sarajevo') ? 'selected' : ''; ?> value="Europe/Sarajevo">(UTC+01:00) Sarajevo</option>
		<option <?php echo ($site['time_zone'] == 'Europe/Skopje') ? 'selected' : ''; ?> value="Europe/Skopje">(UTC+01:00) Skopje</option>
		<option <?php echo ($site['time_zone'] == 'Europe/Stockholm') ? 'selected' : ''; ?> value="Europe/Stockholm">(UTC+01:00) Stockholm</option>
		<option <?php echo ($site['time_zone'] == 'Europe/Vienna') ? 'selected' : ''; ?> value="Europe/Vienna">(UTC+01:00) Vienna</option>
		<option <?php echo ($site['time_zone'] == 'Europe/Warsaw') ? 'selected' : ''; ?> value="Europe/Warsaw">(UTC+01:00) Warsaw</option>
		<option <?php echo ($site['time_zone'] == 'Africa/Lagos') ? 'selected' : ''; ?> value="Africa/Lagos">(UTC+01:00) West Central Africa</option>
		<option <?php echo ($site['time_zone'] == 'Europe/Zagreb') ? 'selected' : ''; ?> value="Europe/Zagreb">(UTC+01:00) Zagreb</option>
		<option <?php echo ($site['time_zone'] == 'Europe/Athens') ? 'selected' : ''; ?> value="Europe/Athens">(UTC+02:00) Athens</option>
		<option <?php echo ($site['time_zone'] == 'Europe/Bucharest') ? 'selected' : ''; ?> value="Europe/Bucharest" selected="selected">(UTC+02:00) Bucharest</option>
		<option <?php echo ($site['time_zone'] == 'Africa/Cairo') ? 'selected' : ''; ?> value="Africa/Cairo">(UTC+02:00) Cairo</option>
		<option <?php echo ($site['time_zone'] == 'Africa/Harare') ? 'selected' : ''; ?> value="Africa/Harare">(UTC+02:00) Harare</option>
		<option <?php echo ($site['time_zone'] == 'Europe/Helsinki') ? 'selected' : ''; ?> value="Europe/Helsinki">(UTC+02:00) Helsinki</option>
		<option <?php echo ($site['time_zone'] == 'Europe/Istanbul') ? 'selected' : ''; ?> value="Europe/Istanbul">(UTC+02:00) Istanbul</option>
		<option <?php echo ($site['time_zone'] == 'Asia/Jerusalem') ? 'selected' : ''; ?> value="Asia/Jerusalem">(UTC+02:00) Jerusalem</option>
		<option <?php echo ($site['time_zone'] == 'Europe/Helsinki') ? 'selected' : ''; ?> value="Europe/Helsinki">(UTC+02:00) Kyiv</option>
		<option <?php echo ($site['time_zone'] == 'Africa/Johannesburg') ? 'selected' : ''; ?> value="Africa/Johannesburg">(UTC+02:00) Pretoria</option>
		<option <?php echo ($site['time_zone'] == 'Europe/Riga') ? 'selected' : ''; ?> value="Europe/Riga">(UTC+02:00) Riga</option>
		<option <?php echo ($site['time_zone'] == 'Europe/Sofia') ? 'selected' : ''; ?> value="Europe/Sofia">(UTC+02:00) Sofia</option>
		<option <?php echo ($site['time_zone'] == 'Europe/Tallinn') ? 'selected' : ''; ?> value="Europe/Tallinn">(UTC+02:00) Tallinn</option>
		<option <?php echo ($site['time_zone'] == 'Europe/Vilnius') ? 'selected' : ''; ?> value="Europe/Vilnius">(UTC+02:00) Vilnius</option>
		<option <?php echo ($site['time_zone'] == 'Asia/Baghdad') ? 'selected' : ''; ?> value="Asia/Baghdad">(UTC+03:00) Baghdad</option>
		<option <?php echo ($site['time_zone'] == 'Asia/Kuwait') ? 'selected' : ''; ?> value="Asia/Kuwait">(UTC+03:00) Kuwait</option>
		<option <?php echo ($site['time_zone'] == 'Europe/Minsk') ? 'selected' : ''; ?> value="Europe/Minsk">(UTC+03:00) Minsk</option>
		<option <?php echo ($site['time_zone'] == 'Africa/Nairobi') ? 'selected' : ''; ?> value="Africa/Nairobi">(UTC+03:00) Nairobi</option>
		<option <?php echo ($site['time_zone'] == 'Asia/Riyadh') ? 'selected' : ''; ?> value="Asia/Riyadh">(UTC+03:00) Riyadh</option>
		<option <?php echo ($site['time_zone'] == 'Europe/Volgograd') ? 'selected' : ''; ?> value="Europe/Volgograd">(UTC+03:00) Volgograd</option>
		<option <?php echo ($site['time_zone'] == 'Asia/Tehran') ? 'selected' : ''; ?> value="Asia/Tehran">(UTC+03:30) Tehran</option>
		<option <?php echo ($site['time_zone'] == 'Asia/Muscat') ? 'selected' : ''; ?> value="Asia/Muscat">(UTC+04:00) Abu Dhabi</option>
		<option <?php echo ($site['time_zone'] == 'Asia/Baku') ? 'selected' : ''; ?> value="Asia/Baku">(UTC+04:00) Baku</option>
		<option <?php echo ($site['time_zone'] == 'Europe/Moscow') ? 'selected' : ''; ?> value="Europe/Moscow">(UTC+04:00) Moscow</option>
		<option <?php echo ($site['time_zone'] == 'Asia/Muscat') ? 'selected' : ''; ?> value="Asia/Muscat">(UTC+04:00) Muscat</option>
		<option <?php echo ($site['time_zone'] == 'Europe/Moscow') ? 'selected' : ''; ?> value="Europe/Moscow">(UTC+04:00) St. Petersburg</option>
		<option <?php echo ($site['time_zone'] == 'Asia/Tbilisi') ? 'selected' : ''; ?> value="Asia/Tbilisi">(UTC+04:00) Tbilisi</option>
		<option <?php echo ($site['time_zone'] == 'Asia/Yerevan') ? 'selected' : ''; ?> value="Asia/Yerevan">(UTC+04:00) Yerevan</option>
		<option <?php echo ($site['time_zone'] == 'Asia/Kabul') ? 'selected' : ''; ?> value="Asia/Kabul">(UTC+04:30) Kabul</option>
		<option <?php echo ($site['time_zone'] == 'Asia/Karachi') ? 'selected' : ''; ?> value="Asia/Karachi">(UTC+05:00) Islamabad</option>
		<option <?php echo ($site['time_zone'] == 'Asia/Karachi') ? 'selected' : ''; ?> value="Asia/Karachi">(UTC+05:00) Karachi</option>
		<option <?php echo ($site['time_zone'] == 'Asia/Tashkent') ? 'selected' : ''; ?> value="Asia/Tashkent">(UTC+05:00) Tashkent</option>
		<option <?php echo ($site['time_zone'] == 'Asia/Calcutta') ? 'selected' : ''; ?> value="Asia/Calcutta">(UTC+05:30) Chennai</option>
		<option <?php echo ($site['time_zone'] == 'Asia/Kolkata') ? 'selected' : ''; ?> value="Asia/Kolkata">(UTC+05:30) Kolkata</option>
		<option <?php echo ($site['time_zone'] == 'Asia/Calcutta') ? 'selected' : ''; ?> value="Asia/Calcutta">(UTC+05:30) Mumbai</option>
		<option <?php echo ($site['time_zone'] == 'Asia/Calcutta') ? 'selected' : ''; ?> value="Asia/Calcutta">(UTC+05:30) New Delhi</option>
		<option <?php echo ($site['time_zone'] == 'Asia/Calcutta') ? 'selected' : ''; ?> value="Asia/Calcutta">(UTC+05:30) Sri Jayawardenepura</option>
		<option <?php echo ($site['time_zone'] == 'Asia/Katmandu') ? 'selected' : ''; ?> value="Asia/Katmandu">(UTC+05:45) Kathmandu</option>
		<option <?php echo ($site['time_zone'] == 'Asia/Almaty') ? 'selected' : ''; ?> value="Asia/Almaty">(UTC+06:00) Almaty</option>
		<option <?php echo ($site['time_zone'] == 'Asia/Dhaka') ? 'selected' : ''; ?> value="Asia/Dhaka">(UTC+06:00) Astana</option>
		<option <?php echo ($site['time_zone'] == 'Asia/Dhaka') ? 'selected' : ''; ?> value="Asia/Dhaka">(UTC+06:00) Dhaka</option>
		<option <?php echo ($site['time_zone'] == 'Asia/Yekaterinburg') ? 'selected' : ''; ?> value="Asia/Yekaterinburg">(UTC+06:00) Ekaterinburg</option>
		<option <?php echo ($site['time_zone'] == 'Asia/Rangoon') ? 'selected' : ''; ?> value="Asia/Rangoon">(UTC+06:30) Rangoon</option>
		<option <?php echo ($site['time_zone'] == 'Asia/Bangkok') ? 'selected' : ''; ?> value="Asia/Bangkok">(UTC+07:00) Bangkok</option>
		<option <?php echo ($site['time_zone'] == 'Asia/Bangkok') ? 'selected' : ''; ?> value="Asia/Bangkok">(UTC+07:00) Hanoi</option>
		<option <?php echo ($site['time_zone'] == 'Asia/Jakarta') ? 'selected' : ''; ?> value="Asia/Jakarta">(UTC+07:00) Jakarta</option>
		<option <?php echo ($site['time_zone'] == 'Asia/Novosibirsk') ? 'selected' : ''; ?> value="Asia/Novosibirsk">(UTC+07:00) Novosibirsk</option>
		<option <?php echo ($site['time_zone'] == 'Asia/Hong_Kong') ? 'selected' : ''; ?> value="Asia/Hong_Kong">(UTC+08:00) Beijing</option>
		<option <?php echo ($site['time_zone'] == 'Asia/Chongqing') ? 'selected' : ''; ?> value="Asia/Chongqing">(UTC+08:00) Chongqing</option>
		<option <?php echo ($site['time_zone'] == 'Asia/Hong_Kong') ? 'selected' : ''; ?> value="Asia/Hong_Kong">(UTC+08:00) Hong Kong</option>
		<option <?php echo ($site['time_zone'] == 'Asia/Krasnoyarsk') ? 'selected' : ''; ?> value="Asia/Krasnoyarsk">(UTC+08:00) Krasnoyarsk</option>
		<option <?php echo ($site['time_zone'] == 'Asia/Kuala_Lumpur') ? 'selected' : ''; ?> value="Asia/Kuala_Lumpur">(UTC+08:00) Kuala Lumpur</option>
		<option <?php echo ($site['time_zone'] == 'Australia/Perth') ? 'selected' : ''; ?> value="Australia/Perth">(UTC+08:00) Perth</option>
		<option <?php echo ($site['time_zone'] == 'Asia/Singapore') ? 'selected' : ''; ?> value="Asia/Singapore">(UTC+08:00) Singapore</option>
		<option <?php echo ($site['time_zone'] == 'Asia/Taipei') ? 'selected' : ''; ?> value="Asia/Taipei">(UTC+08:00) Taipei</option>
		<option <?php echo ($site['time_zone'] == 'Asia/Ulan_Bator') ? 'selected' : ''; ?> value="Asia/Ulan_Bator">(UTC+08:00) Ulaan Bataar</option>
		<option <?php echo ($site['time_zone'] == 'Asia/Urumqi') ? 'selected' : ''; ?> value="Asia/Urumqi">(UTC+08:00) Urumqi</option>
		<option <?php echo ($site['time_zone'] == 'Asia/Irkutsk') ? 'selected' : ''; ?> value="Asia/Irkutsk">(UTC+09:00) Irkutsk</option>
		<option <?php echo ($site['time_zone'] == 'Asia/Tokyo') ? 'selected' : ''; ?> value="Asia/Tokyo">(UTC+09:00) Osaka</option>
		<option <?php echo ($site['time_zone'] == 'Asia/Tokyo') ? 'selected' : ''; ?> value="Asia/Tokyo">(UTC+09:00) Sapporo</option>
		<option <?php echo ($site['time_zone'] == 'Asia/Seoul') ? 'selected' : ''; ?> value="Asia/Seoul">(UTC+09:00) Seoul</option>
		<option <?php echo ($site['time_zone'] == 'Asia/Tokyo') ? 'selected' : ''; ?> value="Asia/Tokyo">(UTC+09:00) Tokyo</option>
		<option <?php echo ($site['time_zone'] == 'Australia/Adelaide') ? 'selected' : ''; ?> value="Australia/Adelaide">(UTC+09:30) Adelaide</option>
		<option <?php echo ($site['time_zone'] == 'Australia/Darwin') ? 'selected' : ''; ?> value="Australia/Darwin">(UTC+09:30) Darwin</option>
		<option <?php echo ($site['time_zone'] == 'Australia/Brisbane') ? 'selected' : ''; ?> value="Australia/Brisbane">(UTC+10:00) Brisbane</option>
		<option <?php echo ($site['time_zone'] == 'Australia/Canberra') ? 'selected' : ''; ?> value="Australia/Canberra">(UTC+10:00) Canberra</option>
		<option <?php echo ($site['time_zone'] == 'Pacific/Guam') ? 'selected' : ''; ?> value="Pacific/Guam">(UTC+10:00) Guam</option>
		<option <?php echo ($site['time_zone'] == 'Australia/Hobart') ? 'selected' : ''; ?> value="Australia/Hobart">(UTC+10:00) Hobart</option>
		<option <?php echo ($site['time_zone'] == 'Australia/Melbourne') ? 'selected' : ''; ?> value="Australia/Melbourne">(UTC+10:00) Melbourne</option>
		<option <?php echo ($site['time_zone'] == 'Pacific/Port_Moresby') ? 'selected' : ''; ?> value="Pacific/Port_Moresby">(UTC+10:00) Port Moresby</option>
		<option <?php echo ($site['time_zone'] == 'Australia/Sydney') ? 'selected' : ''; ?> value="Australia/Sydney">(UTC+10:00) Sydney</option>
		<option <?php echo ($site['time_zone'] == 'Asia/Yakutsk') ? 'selected' : ''; ?> value="Asia/Yakutsk">(UTC+10:00) Yakutsk</option>
		<option <?php echo ($site['time_zone'] == 'Asia/Vladivostok') ? 'selected' : ''; ?> value="Asia/Vladivostok">(UTC+11:00) Vladivostok</option>
		<option <?php echo ($site['time_zone'] == 'Pacific/Auckland') ? 'selected' : ''; ?> value="Pacific/Auckland">(UTC+12:00) Auckland</option>
		<option <?php echo ($site['time_zone'] == 'Pacific/Fiji') ? 'selected' : ''; ?> value="Pacific/Fiji">(UTC+12:00) Fiji</option>
		<option <?php echo ($site['time_zone'] == 'Pacific/Kwajalein') ? 'selected' : ''; ?> value="Pacific/Kwajalein">(UTC+12:00) International Date Line West</option>
		<option <?php echo ($site['time_zone'] == 'Asia/Kamchatka') ? 'selected' : ''; ?> value="Asia/Kamchatka">(UTC+12:00) Kamchatka</option>
		<option <?php echo ($site['time_zone'] == 'Asia/Magadan') ? 'selected' : ''; ?> value="Asia/Magadan">(UTC+12:00) Magadan</option>
		<option <?php echo ($site['time_zone'] == 'Pacific/Fiji') ? 'selected' : ''; ?> value="Pacific/Fiji">(UTC+12:00) Marshall Is.</option>
		<option <?php echo ($site['time_zone'] == 'Asia/Magadan') ? 'selected' : ''; ?> value="Asia/Magadan">(UTC+12:00) New Caledonia</option>
		<option <?php echo ($site['time_zone'] == 'Asia/Magadan') ? 'selected' : ''; ?> value="Asia/Magadan">(UTC+12:00) Solomon Is.</option>
		<option <?php echo ($site['time_zone'] == 'Pacific/Auckland') ? 'selected' : ''; ?> value="Pacific/Auckland">(UTC+12:00) Wellington</option>
		<option <?php echo ($site['time_zone'] == 'Pacific/Tongatapu') ? 'selected' : ''; ?> value="Pacific/Tongatapu">(UTC+13:00) Nuku'alofa</option>
	</select>
</div>	