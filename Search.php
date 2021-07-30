<?php
header("Content-Type:text/html; charset=utf-8");
?>

<html>

<?php
header("Content-Type:text/html; charset=utf-8");


?>
<!-- saved from url=(0076)http://mepopedia.com/~web102-a/midterm/hw03_1015445024/graphic%20design.html -->
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>查詢資料</title>
<link href="style.css" rel="stylesheet" type="text/css">
</head>

<body id="wrapper-02">
  <div id="header">
         <h1>查詢結果</h1>
  </div>
    
<div id="contents">
<?php   		
		include"db_connect.php";
		if($_POST['apply_id']!=''){
        $id=$_POST['apply_id'];
		$sql="SELECT* FROM dbo.申請人  WHERE  申請流水單號='$id'";
		}
		else{
			$sql="SELECT * FROM dbo.申請人 ";
        }
        
        $qury=sqlsrv_query($conn,$sql) or die("sql error".sqlsrv_errors());
		while($row=sqlsrv_fetch_array($qury)){
            echo '申請流水單號: '.$row['申請流水單號'].",".'申請人姓名: '.$row['申請人姓名']." ,".'病歷號碼: '.$row['病歷號碼']." ,".
            '申請人身分證字號: '.$row['申請人身分證字號']." ,".'聯絡電話: '.$row['聯絡電話']." ,".'證明文件: '.$row['證明文件']." ,
			".'申請原因: '.$row['申請原因']." <br><br>";
        }

        $sql5="SELECT* FROM dbo.代理申請人 WHERE  申請流水單號='$id'";
		$qury=sqlsrv_query($conn,$sql5) or die("sql error".sqlsrv_errors());
		while($row=sqlsrv_fetch_array($qury)){
            echo '代理申請人姓名: '.$row['代理申請人名字']." ,".'與病患關係: '.$row['與病患關係']." ,".
            '代理申請人身分證字號: '.$row['代理申請人身分證字號']." ,".'代理申請人聯絡電話: '.$row['代理申請人聯絡電話']
			." <br><br>";
        }



        echo '申請項目如下<br><br>';
        echo '門診病歷: <br>';
        $sql2="SELECT* FROM dbo.門診病歷 WHERE  申請流水單號='$id'";
        $qury=sqlsrv_query($conn,$sql2) or die("sql error is ".sqlsrv_errors());
		while($row=sqlsrv_fetch_array($qury)){
			echo $row['申請項目']."<br><br>";
        }
        

        echo '住院病歷: <br>';
        $sql="SELECT* FROM dbo.住院病歷 WHERE  申請流水單號='$id'";
        $qury=sqlsrv_query($conn,$sql) or die("sql error".sqlsrv_errors());
		while($row=sqlsrv_fetch_array($qury)){
			echo $row['申請項目']."<br><br>";
        }
        
        echo '<br>新生兒病歷: <br>';
        $sql3="SELECT* FROM dbo.新生兒病歷 WHERE  申請流水單號='$id'";
        $qury=sqlsrv_query($conn,$sql3) or die("sql error".sqlsrv_errors());
		while($row=sqlsrv_fetch_array($qury)){
            echo $row['申請項目']."<br><br>";
        }

        echo '<br>領件單: <br>';
        $sql4="SELECT* FROM dbo.領件單 WHERE  申請流水單號='$id'";
        $qury=sqlsrv_query($conn,$sql4) or die("sql error".sqlsrv_errors());
		while($row=sqlsrv_fetch_array($qury)){
            echo '主治醫師姓名: '.$row['主治醫師姓名']."<br><br>";
        }

        
     
?>
</div>


</body></html>