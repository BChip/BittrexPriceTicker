<?php
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_URL,"https://bittrex.com/api/v1.1/public/getmarketsummaries");
	$result = curl_exec($ch);
	curl_close($ch);
	
	$json = json_decode($result);

foreach($json->result as $market) {
	if($market->BaseVolume >= 10){
    echo str_replace("BTC-", " | ", ($market->MarketName)), '-';
    
		if (($market->Last) <= $lastPrice){ 
    		echo '<font color="red">', number_format(($market->Last), 8), '</font>&nbsp';//Price went down.
            $lastPrice = ($market->Last);
    	}else{ 
    		echo '<font color="green">', number_format(($market->Last), 8), '</font>&nbsp'; //Price went up.
            $lastPrice = ($market->Last); 
        }
    
	}else{
    	//Do Nothing
	}
}
/*<font size="12" color="green"><b>&#65514;</b></font>*/
