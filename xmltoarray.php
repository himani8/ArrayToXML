# ArrayToXML
conver array to XML in PHP


function arrayToXml($array, $rootElement = null, $xml = null) {
	$_xml = $xml;
 	
	if ($_xml === null) {
		
	   	$_xml = new SimpleXMLElement($rootElement !== null ? $rootElement : '<root/>');
	   	//$_xml->registerXPathNamespace('air', 'http://www.travelport.com/schema/air_v42_0');
	   //	$_xml = $_xml->xpath('xmlns:air');
	}
	
	if (is_array ( $array ) == true and count ( $array ) > 0) {
		foreach ($array as $key => $value) { 
			if ($key == '@attr') { 
				foreach ($value as $a_key => $a_value) {
					//add attribute
					$_xml->addAttribute($a_key,$a_value);
				}	
			} else { 
				if (is_array($value)) {
					arrayToXml($value, $key, $_xml->addChild($key));
				} else {
					$_xml->addChild($key, $value);
				}
			}
		}
	}
	return $_xml->asXML();
	
}

echo arrayToXml($array, '<OptionalServicesTotal/>');
