<?php

    require_once "pdftotext/pdftotext.php";
    require_once "const.php";
    function str_contains (string $haystack, string $needle)
    {
        return empty($needle) || strpos($haystack, $needle) !== false;
    }
	function BoyerMoore($text, $pattern) {
		$patlen = strlen($pattern);
		$textlen = strlen($text);
		$table = makeCharTable($pattern);
	
		for ($i=$patlen-1; $i < $textlen;) { 
			$t = $i;
			for ($j=$patlen-1; $pattern[$j]==$text[$i]; $j--,$i--) { 
				if($j == 0) return $i;
			}
			$i = $t;
			if(array_key_exists($text[$i], $table))
				$i = $i + max($table[$text[$i]], 1);
			else
				$i += $patlen;
		}
		return -1;
	}
	
	function makeCharTable($string) {
		$len = strlen($string);
		$table = array();
		for ($i=0; $i < $len; $i++) { 
			$table[$string[$i]] = $len - $i - 1; 
		}
		return $table;
	}
	function getHazCodes($cas_number) {
		if (!empty($_GET["cas"])){
			return null;
		}
		$timeStart=microtime(true);
		global $unknownHazCodes;
		global $allHazCodes;
		global $classAssoc;
		global $obscuredHazCodes;
		$foundHazCodes=array();
		$urls=array();
		$export=array();
		$query = urlencode($cas_number . ' sds filetype:pdf');
		$url = 'https://www.google.com/search?num=100&q=' . $query;
		$html = file_get_contents($url);
		preg_match_all('/https?:\/\/[^"]+\.pdf/', $html, $matches);
		foreach($matches[0] as $match) {
            try {
                $pdf=(new PdfToText($match));
                $pdf = $pdf -> Text;
            } catch (Exception $e){
                continue;
            }
			#echo"looking at $match<br>";
			if (BoyerMoore($pdf,$cas_number)>-1){
				#echo($match);
                //Looking for Haz codes in pdf
				if (empty(array_keys($foundHazCodes))){
					foreach ($allHazCodes as $code){
						if (BoyerMoore($pdf,$code)>-1){
							$urls[]=$match;
							$foundHazCodes[$code]="";
						}
					}
				}
				//Looping through found hazcodes
				foreach (array_keys($foundHazCodes) as $code){
					if (empty($foundHazCodes[$code])){
						//Derive class/category from const.php
						if (in_array($code,array_keys($classAssoc))){
							$foundHazCodes[$code]=$classAssoc[$code][0].">".$classAssoc[$code][1];
		
						//Derive class/category from const.php
						} else if (in_array($code,$unknownHazCodes)){
							foreach (array_keys($obscuredHazCodes[$code]) as $short){
								if (BoyerMoore($pdf,$short>-1)){
									$urls[]=$match;
									$foundHazCodes[$code]=$obscuredHazCodes[$code][$short][0].">".$obscuredHazCodes[$code][$short][1];
									break;
								}
							}
						}
					}
				}
				//Break if hazcodes + classes are found
				if(array_filter($foundHazCodes)==$foundHazCodes && !empty($foundHazCodes)){
					break;
				}

			//CAS not verifiable
			} else{
				continue;
			}
		}
		if (empty($foundHazCodes)){
			return NULL;
		}
		$urls=array_unique($urls);
		$foundHazCodes["urls"]=$urls;
		
		return $foundHazCodes;
	}
?>