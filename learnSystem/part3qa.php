<?php include("../filterSystem/personaldb_connect.inc.php");
error_reporting(E_ALL^E_NOTICE);


	// 取得最近一次學習數 $max
	$sqlMax = "SELECT MAX(learnNum) FROM `learn`";
    $rsMax = mysqli_query($conn, $sqlMax);
    $row = mysqli_fetch_array($rsMax, MYSQLI_NUM);
    $max = $row[0];
	
	//取得此次遊戲單字存入 $words 陣列
	$sqlWord = "SELECT word, en FROM `learn` WHERE learnNum = $max ORDER BY LENGTH(word) DESC";
	$rsWord = mysqli_query($conn, $sqlWord);
	$words = array();
	$chs = array();
	$id = 0;
	while($row = mysqli_fetch_array($rsWord, MYSQLI_NUM)){
        $words[$id] = $row[0];
        $chs[$id] = $row[1];
        $id++;
    }
	
	// 出題程式邏輯
	$alphabet = array();   //宣告表格陣列
	$vert[9][2] = -1;   //store vertical
	$hori[9][2] = -1;   //store horizonal
	$inAlpha[9] = -1;   //id of placed words
	$placed = 0;   //number of placed words
	$cross[9][1] = -1;   //record connect cell
	$horizonal = 0;
	$vertical = 0;

	// place 1st word
	for ($i=0; $i < strlen($words[0]); $i++) {   //place to alphabet
		$alphabet[$i][17] = $words[0][$i];
	}
	$inAlpha[$placed] = 0;
	$placed++;
	$vert[0][0] = 0;   //store index in $words 
	$vert[0][1] = 0;   //store initial row
	$vert[0][2] = 17;   //store initial column
	$vertical++;

	// place 2nd word
	for ($id=1; $id < count($words); $id++) { 
		for ($l1=strlen($words[0])-1; $l1 >= 0; $l1--) {   //1st word
			for ($l2=0; $l2 < strlen($words[$id]); $l2++) {   //search same letter
				if ($words[0][$l1] == $words[$id][$l2]) {
					$cross[$placed-1][0] = $l1;   //connect row
					$cross[$placed-1][1] = 17;   //connect column
					$hori[0][0] = $id;   //store index in $words 
					$hori[0][1] = $l1;   //store initial row
					$hori[0][2] = 17-$l2;   //store initial column
					$horizonal++;
					for ($j=17-$l2; $j < strlen($words[$id])+17-$l2; $j++) {   //place to alphabet
						$alphabet[$l1][$j] = $words[$id][$j-17+$l2];
					}
					$inAlpha[1] = $id;
					break 3;
				}
			}
		}
	}
	$placed++;

	// exception?if no word fit 2nd word
	// place other words
	for ($id=1; $id < count($words); $id++) {
		if (in_array($id, $inAlpha)) continue;   //if have been placed then skip
		for ($w=$placed-1; $w >=0 ; $w--) {   //compare with placed words
			for ($l1=0; $l1 < strlen($words[$inAlpha[$w]]); $l1++) { 
				for ($l2=0; $l2 < strlen($words[$id]); $l2++) {   //search same letter
					if ($words[$inAlpha[$w]][$l1] == $words[$id][$l2]) {   //if same
						for ($d=0; $d < $vertical; $d++) {   //hori or vert
							if ($vert[$d][0] == $inAlpha[$w]) {
								$dir = "vert";
								$i = $vert[$d][1];
								$j = $vert[$d][2];
								$ci = $i+$l1;
								$cj = $j;
								$pi = $ci;
								$pj = $cj-$l2; 
								if ($pj < 0) break 2;
								break 1;
							}
						}

						for ($d=0; $d < $horizonal; $d++) {   //hori or vert
							if ($hori[$d][0] == $inAlpha[$w]) {
								if ($id==9 && $inAlpha[$w]==0) {
									echo $d.",".$words[$hori[$d][0]];
								}
								$dir = "hori";
								$i = $hori[$d][1];
								$j = $hori[$d][2];
								$ci = $i;
								$cj = $j+$l1;
								$pi = $ci-$l2;
								$pj = $cj;
								if ($pi < 0) break 2;
								break 1;
							}
						}		

						for ($c=0; $c < $placed-1; $c++) { 
							if ($cross[$c][0] == $ci && $cross[$c][1] == $cj) {   //if the cell have placed
								break 2;
							}
							if ($cross[$c][0] == $ci-1 && $cross[$c][1] == $cj-1) {   //左上
								break 2;
							}
							if ($cross[$c][0] == $ci-1 && $cross[$c][1] == $cj) {   //上
								break 2;
							}
							if ($cross[$c][0] == $ci-1 && $cross[$c][1] == $cj+1) {   //右上
								break 2;
							}
							if ($cross[$c][0] == $ci && $cross[$c][1] == $cj-1) {   //左
								break 2;
							}
							if ($cross[$c][0] == $ci && $cross[$c][1] == $cj+1) {   //右
								break 2;
							} 
							if ($cross[$c][0] == $ci+1 && $cross[$c][1] == $cj-1) {   //左下
								break 2;
							}
							if ($cross[$c][0] == $ci+1 && $cross[$c][1] == $cj) {   //下
								break 2;
							}
							if ($cross[$c][0] == $ci+1 && $cross[$c][1] == $cj+1) {   //右下
								break 2;
							}
						}

						if ($dir == "vert") {   //place horizonal
							for ($v=$pj; $v < strlen($words[$id])+$pj; $v++) { 
								if ($alphabet[$pi][$v] != "" && $alphabet[$pi][$v] != $words[$id][$v-$pj]) {
									break 2;
								}
							}
							if ($alphabet[$pi][strlen($words[$id])+$pj] != "") {   //右
									break 1;
							}
							if ($alphabet[$pi][$pj-1] != "") {   //左
									break 1;
							}
							$cross[$placed-1][0] = $ci;   //connect row
							$cross[$placed-1][1] = $cj;   //connect column
							$hori[$horizonal][0] = $id;   //store index in $words 
							$hori[$horizonal][1] = $pi;   //store initial row
							$hori[$horizonal][2] = $pj;   //store initial column
							$horizonal++;
							for ($v=$pj; $v < strlen($words[$id])+$pj; $v++) {   //place to alphabet
								$alphabet[$pi][$v] = $words[$id][$v-$pj];
							}
							$inAlpha[$placed] = $id;
							$placed++;
							break 3;
						}

						if ($dir == "hori") {   //place vertical
							for ($h=$pi; $h < strlen($words[$id])+$pi; $h++) { 
								if ($alphabet[$h][$pj] != "" && $alphabet[$h][$pj] != $words[$id][$h-$pi]) {
									break 2;
								}
							}							
							if ($alphabet[strlen($words[$id])+$pi][$pj] != "") {   //上
									break 1;
							}
							if ($alphabet[$pi-1][$pj] != "") {   //下
									break 1;
							}
							$cross[$placed-1][0] = $ci;   //connect row
							$cross[$placed-1][1] = $cj;   //connect column
							$vert[$vertical][0] = $id;   //store index in $words 
							$vert[$vertical][1] = $pi;   //store initial row
							$vert[$vertical][2] = $pj;   //store initial column
							$vertical++;
							for ($h=$pi; $h < strlen($words[$id])+$pi; $h++) {   //place to alphabet
								$alphabet[$h][$pj] = $words[$id][$h-$pi];
							}
							$inAlpha[$placed] = $id;
							$placed++;
							break 3;
						}
					}
				}
			}
		}
	}

	// place remain words
	// record problem number
	$vertIndex[$vertical-1][1] = -1;
	$horiIndex[$horizonal-1][1] = -1;
	$ver = 0;
	$hor = 0;
	$pro = false;
	$pronum = 0;
	for ($a=0; $a < 36; $a++) { 
		for ($b=0; $b < 36; $b++) { 
			if ($alphabet[$a][$b] != "") {
				$pro = false;
				for ($v=0; $v < $vertical; $v++) {
					if ($vert[$v][1] == $a && $vert[$v][2] == $b) {
						$pronum++;
						$ver++;
						$vertIndex[$ver-1][0] = $pronum;   //problem num
						$vertIndex[$ver-1][1] = $vert[$v][0];   //word id
						$pro = true;
						break 1;
					}
				}
				for ($h=0; $h < $horizonal; $h++) { 
					if ($hori[$h][1] == $a && $hori[$h][2] == $b) {
						if ($pro) {
							$hor++;
							$horiIndex[$hor-1][0] = $pronum;   //problem num
							$horiIndex[$hor-1][1] = $hori[$h][0];   //word id
							break 1;
						}else {
							$pronum++;
							$hor++;
							$horiIndex[$hor-1][0] = $pronum;   //problem num
							$horiIndex[$hor-1][1] = $hori[$h][0];   //word id
							break 1;
						}	
					}
				}
			}
		}
	}
?>	
