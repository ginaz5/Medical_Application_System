<?php
header("Content-Type:text/html; charset=utf-8");


?>

<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>申請病歷</title>
<link href="style.css" rel="stylesheet" type="text/css">
</head>

<body id="wrapper-02">
  <div id="header">
         <h1>申請病歷</h1>
  </div>
    
<div id="contents">

<?php  
        
        /* 申請人資料 */
        $apply_date=$_POST['apply_date'];
		$aName=$_POST['a-Name'];
		$aRecordNum=$_POST['aRecordNum'];
		$aPhone=$_POST['aPhone'];
        $aID=$_POST['aID'];
        
        /* 代理申請人 */
		$agName=$_POST['ag-Name'];
		$agRelation=$_POST['agRelation'];
		$agPhone=$_POST['agPhone'];
        $agID=$_POST['agID'];
        

        /* 證明文件 */
        $pr = $_POST['proofDoc'];
        if($pr === '0'){
            $proofDoc ='委託書正本';
        }
        if($pr === '1'){
            $proofDoc ='病患重症昏迷, 相關文件';
        }
        if($pr === '2'){
            $proofDoc ='病患死亡, 死亡證明書';
        }
        if($pr === '3'){
            $proofDoc ='病患未成年, 戶口名簿正本';
        }

        /* 申請原因 */
        $r = $_POST['reason'];
        if( $r === '0'){
            $reason ='轉院';
        }
        if( $r === '1'){
            $reason ='自行保留';
        }
        if( $r === '2'){
            $reason ='投保';
        }
        if( $r === '3'){
            $reason = '理賠';
        }
        if( $r === '4'){
            $reason = '其他';
        }

         /* 申請項目 */
         $tmp =  substr($_POST['med_record'],0,3);
         $med_record = $_POST['med_record'];
         
         if($tmp==='OPD'){
            $med_table = '門診病歷';
         }
         if($tmp==='IPT'){
            $med_table = '住院病歷';
         }
         if($tmp==='bab'){
            $med_table = '新生兒病歷';
         }
         // 門診
         if( $med_record === 'OPD_1'){
            $med_record ='門、急診病歷';
        }
        if( $med_record === 'OPD_2'){
            $med_record ='病理報告';
        }
        if( $med_record === 'OPD_3'){
            $med_record ='檢驗報告';
        }
        if( $med_record === 'OPD_4'){
            $med_record ='心電圖';
        }
        if( $med_record === 'OPD_5'){
            $med_record ='放射科';
        }
        if( $med_record === 'OPD_6'){
            $med_record ='超音波';
        }
        if( $med_record === 'OPD_7'){
            $med_record ='內視鏡';
        }
        if( $med_record === 'OPD_8'){
            $med_record ='手術紀錄';
        }
        if( $med_record === 'OPD_9'){
            $med_record ='診斷證明書';
        }
        if( $med_record === 'OPD_10'){
            $med_record ='其他';
        }
        // 住院病歷
        if( $med_record === 'IPT_1'){
            $med_record ='住院病歷摘要';
        }
        if( $med_record === 'IPT_2'){
            $med_record ='病理報告';
        }
        if( $med_record === 'IPT_3'){
            $med_record ='檢驗報告';
        }
        if( $med_record === 'IPT_4'){
            $med_record ='心電圖';
        }
        if( $med_record === 'IPT_5'){
            $med_record ='放射科';
        }
        if( $med_record === 'IPT_6'){
            $med_record ='超音波';
        }
        if( $med_record === 'IPT_7'){
            $med_record ='內視鏡';
        }
        if( $med_record === 'IPT_8'){
            $med_record ='手術紀錄';
        }
        if( $med_record === 'IPT_9'){
            $med_record ='診斷證明書';
        }
        if( $med_record === 'IPT_10'){
            $med_record ='其他';
        }

        // 新生兒病歷
        if( $med_record === 'baby_1'){
            $med_record ='體檢紀錄表';
        }
        if( $med_record === 'baby_2'){
            $med_record ='檢驗報告';
        }
        if( $med_record === 'baby_3'){
            $med_record ='腳印';
        }
        if( $med_record === 'baby_4'){
            $med_record ='超音波';
        }
        if( $med_record === 'baby_5'){
            $med_record ='其他';
        }

        $drName = $_POST['drName']; 

        include 'db_connect.php';
       
        header("Content-Type:text/html; charset=utf-8");		
        $apply_id = rand(1,100); // 流水單號
        
        
        // 申請人
		$sql="INSERT INTO dbo.申請人 (申請流水單號, 申請日期, 申請人姓名, 病歷號碼, 申請人身分證字號, 聯絡電話, 證明文件, 申請原因)
        VALUES ($apply_id, '$apply_date', '$aName', $aRecordNum, $aID, $aPhone, '$proofDoc','$reason')";
        $query=sqlsrv_query($conn,$sql) or die("Oops something went wrong : sql ERROR".sqlsrv_errors());

        
        // 代理申請人
        $sql2="INSERT INTO dbo.代理申請人 (申請流水單號, 代理申請人名字, 與病患關係, 代理申請人身分證字號, 代理申請人聯絡電話) 
        VALUES ('$apply_id', '$agName','$agRelation', '$agID', '$agPhone')";
        $query=sqlsrv_query($conn,$sql2)or die("sql error".sqlsrv_errors());
       
        //申請項目
        $sql3="INSERT INTO dbo.$med_table (申請流水單號, 申請項目)
        VALUES ('$apply_id', '$med_record')";
        $query=sqlsrv_query($conn,$sql3)or die("sql error".sqlsrv_errors());
        
        // 領件單
        $sql4="INSERT INTO dbo.領件單 (申請流水單號, 主治醫師姓名, 申請人姓名, 病歷號碼)
        VALUES ('$apply_id', '$drName', '$aName', '$aRecordNum')";
        $query=sqlsrv_query($conn,$sql4)or die("sql error".sqlsrv_errors());
        

        
        echo '感謝您的填寫, 您的申請單號為:'.$apply_id;
        echo '<br>';
        echo 'Application has been submited successfully, your applicaion ID number is '.$apply_id;
?>
			 
             </p>
       </div>


      
</div>


</body></html>


