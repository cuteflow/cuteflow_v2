<?php

	$strLangShort 		= $_REQUEST['language'];
	if ($strLangShort == '')
	{
		$strLangShort 		= $_REQUEST['strLanguage'];
	}
	$strFilename		= 'gui_'.$strLangShort.'.langprop';
	$strLanguagePath	= "../language_files/".$strFilename;

	$pFile = @fopen($strLanguagePath, "r");
	if ($pFile == null)
	{
		$strLanguagePath	= "language_files/".$strFilename;
	
		$pFile = @fopen($strLanguagePath, 'r');
		
		if ($pFile == null)
		{
			$strLanguagePath	= "../../language_files/".$strFilename;
		
			$pFile = @fopen($strLanguagePath, 'r');
		}
	}
	
	$arrTranslation;
	if (null != $pFile)
	{
		while (!feof ($pFile)) 
		{
		    $strLine = trim(fgets($pFile, 4096));
		    
		    if ( (substr($strLine,0,1) != "#") && (strlen($strLine) > 0) && (substr($strLine,0,5)!="_jotl"))
		    {			    
		    	$nPos = strpos($strLine, "=");
		    	$strId = substr($strLine, 0, $nPos);
		    	$strRest = trim(substr($strLine, $nPos+1));
			    	    	
		    	$arrInfos = explode("@@@", $strRest);
		    	$strValue = $arrInfos[0];
		    	
		    	$arrTranslation[$strId] = $strValue;
		    }
		    else
		    {
		    	$nPos 			= strpos($strLine, "=");
		    	$strConfig 		= substr($strLine, 0, $nPos);
		    	$splitConfig 	= explode (".", $strConfig);
		    	
		    	if (count($splitConfig)>1)
				{
					if ($splitConfig[2] == 'encoding')
					{
					$DEFAULT_CHARSET = trim(substr($strLine, $nPos+1));
					}
				}
		    }
		}		
		fclose($pFile);
	}
	$CIRCULATION_MNGT_ADDCIRCULATION;
	
	
	foreach($arrTranslation as $key => $value)
	{
		$$key = $value;
	}
	
	function escapeSingle($string)
	{
		return str_replace("'", "\\'", $string);
	}
	
	function escapeDouble($string)
	{
		return str_replace("\"", "\\\"", $string);
	}
?>