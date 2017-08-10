<?php

$down = new DownImg();
$i = 0;
while($i++ < 5000) {
	$down->run();	
}


class DownImg {
	const URL = 'http://10.2.1.51:28081/weaver/weaver.file.MakeValidateCode?seriesnum_=2';

	const IMG_DIR = '../img';

	public function run() {
		$img = CURL::get(static::URL);
		file_put_contents(static::IMG_DIR.'/'.md5($img).'.png', $img);
	}
}

class CURL {
		public static function get($url, $postArr=[], $header=array(), $retry=2, $time=3000, $ctime=3000){
		// echo $url;die();
	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt($ch, CURLOPT_TIMEOUT, $time);
	    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $ctime);
	    if(!empty($postArr)){
	        curl_setopt($ch, CURLOPT_POST, true);
	        // curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postArr));
	        curl_setopt($ch, CURLOPT_POSTFIELDS, $postArr);
	    }
	    if(!empty($header)){
	        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
	    }
	    while($retry-- > 0 && false === ($ret = curl_exec($ch))){
	    	echo 'error';
	        // log_message('error', "CALL $url FAILED ".curl_error($ch));
	    }
	   
	    return $ret;
	}
}





