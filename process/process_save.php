<?php
  require_once( '../db/db_connect.php' );

  if (isset($_POST['save_id'])) {
    $sql_update = "
    UPDATE info
    SET
    stamp=' ".$_POST['calculate_stamp']." ' ,
    coupon=' ".$_POST['calculate_coupon']." ' ,
    description=' ".$_POST['save_description']." ' ,
    visit=' ".$_POST['calculate_visit']." ' ,
    date= now()
    WHERE id=' ".$_POST['save_id']." ' ";
    $result = mysqli_query($link, $sql_update);

    if ($result === false) {
      echo "문제가 발생했습니다.<br>
      1) 데이터베이스 작동 확인<br>
      2) 수정된 정보 없음<br>
      1), 2) 확인해본 후 문제가 다시 발생한다면 관리자에게 문의해주세요";
    } else {
      echo
       "<script>
        alert('스탬프 [ {$_POST['save_plus']} ]개 적립');
       </script>";
       header('Location: ../main.php');
    }
  }
?>
