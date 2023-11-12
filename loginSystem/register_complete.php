<?php session_start(); ?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>


<!-- Register註冊 -->

<?php include("./mysql_connect.inc.php");

// 取得前端網頁輸入資料
$id = $_POST['id'];
$pw = $_POST['pw'];
$pw2 = $_POST['pw2'];

// 判斷帳號密碼是否為空值 null
// 確認密碼輸入是否正確 $pw == $pw2
if($id != null && $pw != null && $pw2 != null && $pw == $pw2){

    // 檢查帳號是否已存在
    $sqlCheck = "SELECT * FROM `users` where id = '$id'";
    // 執行SQL
    $resultCheck = mysqli_query($conn, $sqlCheck);
    // 返回數值
    $nums = mysqli_num_rows($resultCheck);

        // 0=FALSE 1=TRUE
        if($nums > 0){
            echo 'This user has been registered!';
            echo '<meta http-equiv=REFRESH CONTENT=2;url=./LOGIN-REGISTER.html>';
        }

        // 新增使用者資料
        else{
             $userInsert = "INSERT INTO `users` (id, pw) VALUES ('$id', '$pw')";
            if(mysqli_query($conn, $userInsert)){

                    // 創建使用者資料庫
                    $createDb = "CREATE DATABASE $id";
                    if($conn->query($createDb) === TRUE){
                        echo "Database created successfully! <br>";

                        // 在使用者資料庫建立資料表
                        // 連結至使用者資料庫
                        $connDB = new mysqli($DBHOST, $DBUSER, $DBPASSWD, $id);

                        // 創建 voc 資料表
                        // 複製資料表結構
                        $createTable1 = "CREATE TABLE $id.voc LIKE test.voc";
                        if($conn->query($createTable1) === TRUE){
                            echo "Table voc created successfully! <br>";
                                    
                                // 匯入單字
                                $insertVoc = "INSERT $id.voc SELECT * FROM test.voc";
                                if($conn->query($insertVoc) === TRUE){
                                    echo "Insert voc successfully! <br>";
                                }else{
                                    echo "Error insert voc: " . $conn->error;
                                    echo '單字匯入失敗!<br>';
                                    echo '<meta http-equiv=REFRESH CONTENT=2;url=./LOGIN-REGISTER.html>';
                                }
                                }else{
                                    echo "Error creating table: " . $conn->error;
                                    echo '註冊失敗!<br>';
                                    echo '<meta http-equiv=REFRESH CONTENT=2;url=./LOGIN-REGISTER.html>';
                                }

                            // 創建 learn 資料表
                            $createTable2 = "CREATE TABLE $id.learn LIKE test.learn";
                            if($connDB->query($createTable2) === TRUE){
                                 echo "Table learn created successfully! <br>";
                            }else{
                                echo "Error creating table: " . $connDB->error;
                                echo '註冊失敗!<br>';
                                echo '<meta http-equiv=REFRESH CONTENT=2;url=./LOGIN-REGISTER.html>';
                            }

                            // 創建 yes 資料表
                            $createTable3 = "CREATE TABLE $id.yes LIKE test.voc";
                            if($connDB->query($createTable3) === TRUE){
                                echo "Table yes created successfully! <br>";
                            }else{
                                echo "Error creating table: " . $connDB->error;
                                echo '註冊失敗!<br>';
                                echo '<meta http-equiv=REFRESH CONTENT=2;url=./LOGIN-REGISTER.html>';
                            }

                            // 創建 no 資料表
                            $createTable4 = "CREATE TABLE $id.no LIKE test.voc";
                            if($connDB->query($createTable4) === TRUE){
                                echo "Table no created successfully! <br>";
                                echo '註冊成功!';
                                echo '<meta http-equiv=REFRESH CONTENT=2;url=./LOGIN-REGISTER.html>';
                            }else{
                                echo "Error creating table: " . $connDB->error;
                                echo '註冊失敗!<br>';
                                echo '<meta http-equiv=REFRESH CONTENT=2;url=./LOGIN-REGISTER.html>';
                            }

                            // 創建 quiz 資料表
                            $createTable5 = "CREATE TABLE $id.quiz LIKE test.quiz";
                            if($connDB->query($createTable5) === TRUE){
                                echo "Table quiz created successfully! <br>";
                            }else{
                                echo "Error creating table: " . $connDB->error;
                                echo '註冊失敗!<br>';
                                echo '<meta http-equiv=REFRESH CONTENT=2;url=./LOGIN-REGISTER.html>';
                            }
                        }

                        else{
                            echo "Error creating database: " . $conn->error;
                            echo '註冊失敗!<br>';
                            echo '<meta http-equiv=REFRESH CONTENT=2;url=./LOGIN-REGISTER.html>';
                        }                    
                    }
            else{
                echo '新增使用者失敗!<br>';
                echo '<meta http-equiv=REFRESH CONTENT=2;url=./LOGIN-REGISTER.html>';
            }
        }        
}

else{
    echo '資料填寫錯誤!<br>';
    echo '<meta http-equiv=REFRESH CONTENT=2;url=./LOGIN-REGISTER.html>';
}

// 關閉連線
mysqli_close($conn);

// 關閉連線
mysqli_close($connDB);

?>