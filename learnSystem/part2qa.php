<?php include("../filterSystem/personaldb_connect.inc.php");
error_reporting(E_ALL^E_NOTICE);

 	// 取得最近一次學習數 $max
	$sqlMax = "SELECT MAX(learnNum) FROM `learn`";
    $rsMax = mysqli_query($conn, $sqlMax);
    $row = mysqli_fetch_array($rsMax, MYSQLI_NUM);
	$max = $row[0];
	
  	// 取得此次遊戲單字存入 $words 陣列
	$sqlWord = "SELECT word, ch FROM `learn` WHERE learnNum = $max ORDER BY RAND()";
	$rsWord = mysqli_query($conn, $sqlWord);
	$words = array();
	$chs = array();
	$id = 0;
	while($row = mysqli_fetch_array($rsWord, MYSQLI_NUM)) {
        $words[$id] = $row[0];
        $chs[$id] = $row[1];
        $id++;
	}
	
  	// 出題程式邏輯
	$alphabet[14][14] = "";
	$id = 0;
	while ($id < count($words)){   //尋訪每個單字
		$len = strlen($words[$id]);   //word length
		$position[$len-1][2] = -1;   //array to store position and letter
		$num = 0;
		while ($num < strlen($words[$id])){   //go through letters in word
			$letter = $words[$id][$num];
			if ($num == 0){   //1st letter
				do{
				    $i = random_int(0, 14);
					$j = random_int(0, 14);
					if ($alphabet[$i][$j] != "" && $alphabet[$i][$j] != $letter){   //判斷位置 valid
						$bool = TRUE;
					}else{
						$position[$num][0] = $i;
						$position[$num][1] = $j;
						$position[$num][2] = $letter;
						judge($i, $j);   //set array $ints to valid direction
						$num++;   //move on to next letter
						break 1;
					}
				}while ($bool);
			}else{   //other letters
				do{
					$i = $position[$num-1][0];   //prev position
					$j = $position[$num-1][1];
					$count = count($ints);   //count number of remain valid place
					$select = $ints[array_rand($ints, 1)];   //select relative position
					$key = array_search($select, $ints);
					$ints = array_splice($ints,$key,1);   //delete element have been selected
					select($select);   //select absolute position $i $j
					for ($a = 0; $a < $num; $a++){    //check previous position
						if ($position[$a][0] == $i && $position[$a][1] == $j){
							if ($count == 1){   //all fail then return 1st letter
								$num = 0;
								break 2;
							}
							break 2;
						}
					}

					if ($alphabet[$i][$j] != "" && $alphabet[$i][$j] != $letter){  //判斷位置 valid
						if ($count == 1){   //all fail then return 1st letter
							$num = 0;
							break 1;
						}
						$bool = TRUE;

					}else{
						$position[$num][0] = $i;
						$position[$num][1] = $j;
						$position[$num][2] = $letter;
						judge($i, $j);   //set array $ints to valid direction
						$num++;   //move on to next letter
						break 1;
					}

				} while ($bool);
			}
		}

		for ($b = 0; $b < $len; $b++){    //place to alphabet
			$inum = $position[$b][0];
			$jnum = $position[$b][1];
			$alphabet[$inum][$jnum] = $words[$id][$b];
		}
		
		$id++;
	}
 
	// $alphabet[$i][$j] judge for edge
	function judge($i, $j){
		global $ints;
		if ($i==0 && $j==0){   //左上角
			$ints = array(5,7,8);
		}else if ($i==0 && $j==14){   //右上角
			$ints = array(4,6,7);
		}else if ($i==14 && $j==0){   //左下角
			$ints = array(2,3,5);
		}else if ($i==14 && $j==14){   //右下角
			$ints = array(1,2,4);
		}else if ($i==0){   //上
			$ints = array(4,5,6,7,8);
		}else if ($j==0){   //左
			$ints = array(2,3,5,7,8);
		}else if ($j==14){   //右
			$ints = array(1,2,4,6,7);
		}else if ($i==14){   //下
			$ints = array(1,2,3,4,5);
		}else{   //其他
			$ints = array(1,2,3,4,5,6,7,8);
		}
	}

	// 抽選出的數字對應格子
	function select($select){
		global $i,$j;
		if ($select==1){
			$i=$i-1;
			$j=$j-1;
		}else if ($select==2){
			$i=$i-1;
			$j=$j;
		}else if ($select==3){
			$i=$i-1;
			$j=$j+1;
		}else if ($select==4){
			$i=$i;
			$j=$j-1;
		}else if ($select==5){
			$i=$i;
			$j=$j+1;
		}else if ($select==6){
			$i=$i+1;
			$j=$j-1;
		}else if ($select==7){
			$i=$i+1;
			$j=$j;
		}else if ($select==8){
			$i=$i+1;
			$j=$j+1;
		}
	}

?>