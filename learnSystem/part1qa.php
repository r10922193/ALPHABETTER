<?php error_reporting(E_ALL^E_NOTICE);
include ("../filterSystem/personaldb_connect.inc.php");


	// 取得最近一次學習單字數 $maxv
	$sqlMax = "SELECT MAX(learnNum) FROM `learn`";
    $rsMax = mysqli_query($conn, $sqlMax);
    $row = mysqli_fetch_array($rsMax, MYSQLI_NUM);
    $max = $row[0];

	// 取得此次遊戲單字存入 $words 陣列
	$sqlWord = "SELECT word FROM `learn` WHERE learnNum = $max ORDER BY RAND()";
	$rsWord = mysqli_query($conn, $sqlWord);
	$words = array();
	$id = 0;
	while($row = mysqli_fetch_array($rsWord, MYSQLI_NUM)) {
        $words[$id] = $row[0];
        $id++;
    }

	$alphabet[17][17] = "";
	$id=0;
	while ($id < count($words)) {   //尋訪每個單字
	 	$len = strlen($words[$id]);   //單字長度
		$orient = random_int(1, 4);   //select orientation 1— 2| 3\ 4/
		$arrow = random_int(0, 1);   //select direction
		if ($orient == 1 || $orient == 2) {
			$line = random_int(0, 17);   //select line
		}else {
			$line = random_int($len-1, 35-$len);   //0-34
		}
		switch ($orient) {
		    case 1:
		        $start = random_int(0, 18-$len);   //start position
		        if ($arrow == 0) {   //left to right
		        	for ($j=$start; $j < $start+$len; $j++) {   //check if valid
		        		if ($alphabet[$line][$j] != "" && $alphabet[$line][$j] != $words[$id][$j-$start]) {
		        			break 2;
		        		}
		        	}
		        	for ($j=$start; $j < $start+$len; $j++) {   //place word
		        		$alphabet[$line][$j] = $words[$id][$j-$start];
		        	}
		        	$id++;
		        }else {   //right to left
		        	for ($j=17-$start; $j > 17-$start-$len; $j--) {   //check if valid
		        		if ($alphabet[$line][$j] != "" && $alphabet[$line][$j] != $words[$id][17-$start-$j]){
		        			break 2;
		        		}
		        	}
		        	for ($j=17-$start; $j > 17-$start-$len; $j--) {  //place word
		        		$alphabet[$line][$j] = $words[$id][17-$start-$j];
		        	}
		        	$id++;
		        }
		        break;
		    case 2:
		        $start = random_int(0, 18-$len);
		        if ($arrow == 0) {   //up to down
		        	for ($i=$start; $i < $start+$len; $i++) {   //check if valid
		        		if ($alphabet[$i][$line] != "" && $alphabet[$i][$line] != $words[$id][$i-$start]) {
		        			break 2;
		        		}
		        	}
		        	for ($i=$start; $i < $start+$len; $i++) {   //place word
		        		$alphabet[$i][$line] = $words[$id][$i-$start];
		        	}
		        	$id++;
		        }else {   //right to left
		        	for ($i=17-$start; $i > 17-$start-$len; $i--) {   //check if valid
		        		if ($alphabet[$i][$line] != "" && $alphabet[$i][$line] != $words[$id][17-$start-$i]){
		        			break 2;
		        		}
		        	}
		        	for ($i=17-$start; $i > 17-$start-$len; $i--) {   //place word
		        		$alphabet[$i][$line] = $words[$id][17-$start-$i];
		        	}
		        	$id++;
		        }
		        break;
		    case 3:
		    	if ($line < 18) {
		    		$total = $line + 1;
		    	}else {
		    		$total = 35 - $line;
		        }
		        $start = random_int(0, $total-$len);
		        if ($arrow == 0) {   //leftup to rightdown
		        	if ($line < 18) {   //first position
		        		$i = 0;
		        		$j = 17-$line;
		        	}else {
		        		$i = $line-17;
		        		$j = 0;
		        	}
		        	for ($k=$start; $k < $start+$len; $k++) {   //check if valid
		        		if ($alphabet[$i+$k][$j+$k] != "" && $alphabet[$i+$k][$j+$k] != $words[$id][$k-$start]) {
		        			break 2;
		        		}
		        	}
		        	for ($k=$start; $k < $start+$len; $k++) {   //place word
		        		$alphabet[$i+$k][$j+$k] = $words[$id][$k-$start];
		        	}
		        	$id++;
		        }else {   //rightdown to leftup
		        	if ($line < 18) {   //first position
		        		$i = $line;
		        		$j = 17;
		        	}else {
		        		$i = 17;
		        		$j = 34-$line;
		        	}
		        	for ($k=$start; $k < $start+$len; $k++) {   //check if valid
		        		if ($alphabet[$i-$k][$j-$k] != "" && $alphabet[$i-$k][$j-$k] != $words[$id][$k-$start]){
		        			break 2;
		        		}
		        	}
		        	for ($k=$start; $k < $start+$len; $k++) {   //place word
		        		$alphabet[$i-$k][$j-$k] = $words[$id][$k-$start];
		        	}
		        	$id++;
		        }
		        break;
		    case 4:
				if ($line < 18) {
		    		$total = $line + 1;
		    	}else {
		    		$total = 35 - $line;
		        }
		        $start = random_int(0, $total-$len);
		        if ($arrow == 0) {   //rightup to leftdown
		        	if ($line < 18) {   //first position
		        		$i = 0;
		        		$j = $line;
		        	}else {
		        		$i = $line-17;
		        		$j = 17;
		        	}
		        	for ($k=$start; $k < $start+$len; $k++) {   //check if valid
		        		if ($alphabet[$i+$k][$j-$k] != "" && $alphabet[$i+$k][$j-$k] != $words[$id][$k-$start]) {
		        			break 2;
		        		}
		        	}
		        	for ($k=$start; $k < $start+$len; $k++) {   //place word
		        		$alphabet[$i+$k][$j-$k] = $words[$id][$k-$start];
		        	}
		        	$id++;
		        }else {   //leftdown to rightup
		        	if ($line < 18) {   //first position
		        		$i = $line;
		        		$j = 0;
		        	}else {
		        		$i = 17;
		        		$j = $line-17;
		        	}
		        	for ($k=$start; $k < $start+$len; $k++) {   //check if valid
		        		if ($alphabet[$i-$k][$j+$k] != "" && $alphabet[$i-$k][$j+$k] != $words[$id][$k-$start]){
		        			break 2;
		        		}
		        	}
		        	for ($k=$start; $k < $start+$len; $k++) {   //place word
		        		$alphabet[$i-$k][$j+$k] = $words[$id][$k-$start];
		        	}
		        	$id++;
		        }
		        break;
		}
	}
	
	