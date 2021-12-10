<?php
if(!function_exists('validate_email_id')){ 
	function validate_email_id($email) {
		if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            return true;
        } else {            
            return false;
        }
	}
}

if(!function_exists('remove_slashes')){ 
    function remove_slashes($value){
        if($value!=""){
            $value = stripslashes($value);
            $value = addslashes($value);
            $value = trim($value);
            return $value;
        }
    }   
}

if(!function_exists('timeDiff')){ 
    function timeDiff($firstTime,$lastTime)
    {
        $firstTime=strtotime($firstTime);
        $lastTime=strtotime($lastTime);
        $timeDiff=$lastTime-$firstTime;
        return $timeDiff;
    }
}


if(!function_exists('check_valid_file')){ 
	function check_valid_file($file, $mime_types_additional=array()) {

		$mime_types = array(
			// audio
			'audio/m4a' => 'm4a',
			'audio/x-wav' => 'wav',
			// videos
			'video/mp4' => 'mp4',
			'video/3gpp' => 'm4a',
			'video/quicktime' => 'mov',
			// images
			'image/png' => 'png',
			'image/jpeg' => 'jpe',
			'image/jpeg' => 'jpeg',
			'image/jpeg' => 'jpg',
			'image/gif' => 'gif',
			//text
			'text/plain' => 'txt',
			'text/html' => 'txt',
			// adobe
			'application/pdf' => 'pdf',
			// ms office
			'audio/ogg' => 'ogg',
			'image/svg+xml' => 'svg',
			'video/ogg' => 'ogv',
			'video/webm' => 'webm',
			
			'application/msword' => 'doc',
			'application/zip' => 'zip',
			'application/vnd.ms-excel' => 'xls',
			'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => 'docx',
			'application/vnd.openxmlformats-officedocument.wordprocessingml.template' => 'dotx',
			'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' => 'xlsx',
			'application/vnd.openxmlformats-officedocument.presentationml.presentation' => 'pptx',
			//Outlook mail message
			'application/vnd.ms-outlook' => 'msg',
			'application/CDFV2-corrupt'  => 'msg'
		);
	   	
		$mtype = false;
		if(function_exists('finfo_open')){
			$finfo = finfo_open(FILEINFO_MIME_TYPE);
			$mtype = finfo_file($finfo, $file);
			finfo_close($finfo);
		} 
		else if(function_exists('mime_content_type')){
			$mtype = mime_content_type($file);
		}
		if(array_key_exists($mtype, $mime_types)){
			return true;
		}
		else{
			return false;
		} 
	}
}
?>