<!--process_join if문에 문제가 있을 떄 실행되는 부분이 잘 아됨 이부분 확인할 것  -->

<?php
require_once( '../db/db_connect.php' );

settype($_POST['number'], 'integer');
$filtered = array(
  'name' => mysqli_real_escape_string($link, $_POST['name']),
  'number' => mysqli_real_escape_string($link, $_POST['number'])
);
$sql = "
INSERT INTO info
 (name, number, stamp, coupon, visit,date)
  VALUES (
     '{$filtered['name']}',
     '{$filtered['number']}',
     '0',
     '0',
     '0',
     now()
   );
";
$reslt = mysqli_query($link, $sql);

  if ($result === false) {
    echo "문제가 발생했습니다.<br>
    1) 데이터베이스 작동 확인<br>
    2) 입력된 정보 없음 또는 허가되지 않은 문자 사용<br>
    1), 2) 확인해본 후 문제가 다시 발생한다면 관리자에게 문의해주세요";
  } else {
    echo
     "<script>
      alert('[ {$filtered['name']} ]님의 회원가입이 완료 되었습니다. ({$filtered['number']})');
      self.close();
     </script>";
  }

?>
