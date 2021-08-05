<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>회원가입</title>
      <link rel="stylesheet" type="text/css" href="../css/common.css">
      <link rel="stylesheet" type="text/css" href="../css/join.css">
      <script src="../js/page_join.js"></script>
  </head>
  <body>
    <div class="page_join_top_bottom_line"></div>
    <!-- container -->
    <div id="page_join_container">
      <!-- form -->
      <form class="" action="../process/process_join.php" method="post">
        <table class="page_join_table">
          <tr>
            <td class="page_join_table_colum">회원이름</td>
            <td class="page_join_table_cell">
              <input class="page_join_text" type="text" name="name" placeholder="  [회원이름]을 입력해주세요"  onfocus="this.placeholder=''" onblur="this.placeholder='  [ 회원이름 ]을 입력해주세요'">
            </td>
          </tr>
          <tr>
            <td class="page_join_table_colum"> 전화번호</td>
            <td class="page_join_table_cell">
              <input class="page_join_text" type="text" name="number" placeholder="  [전화번호 네자리]를 입력해주세요"  onfocus="this.placeholder=''" onblur="this.placeholder='  [ 전화번호 네자리 ]을 입력해주세요'">
            </td>
          </tr>
        </table>
        <!-- submit -->
        <div class="page_join_submit">
          <button type="button" class="common_img_button" onclick="page_join_send(this.form)" >
            <img src="../img/button/button_join2.png">
          </button>
        </div> <!--sumbit  -->
      </form> <!-- form -->
    </div> <!-- container -->
    <div class="page_join_top_bottom_line"></div>
  </body>
</html>
