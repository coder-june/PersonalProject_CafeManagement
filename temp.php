<?php
  require_once( './db/db_connect.php' );

  if (isset($_POST['search'])) {
    $sql_search = "SELECT * FROM info WHERE number=' ".$_POST['search']." ' " ;
    $result= mysqli_query($link, $sql_search);
    $count = mysqli_num_rows($result);
  }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Cafe</title><script src="" charset="utf-8"></script>
    <link rel="stylesheet" type="text/css" href="./css/common.css">
    <link rel="stylesheet" type="text/css" href="./css/main.css">

    <!--javascript  -->
    <script type="text/javascript">
      function page_join_open(){
        window.open('./page/page_join.php', "회원가입", "width=470, height=170, left=850, top=170" );
      }
      function page_notice_open(){
        window.open('./page/page_notice.php', "공지사항", "width=420, height=450, left=880, top=170" );
      }
      function search_send(f) {
        var search_content = f.search.value;
        var search_content_check = /^[0-9]*$/;

        if (!search_content_check.test(search_content) || search_content.length!=4) {
          alert("전화번호 '네자리' 를 정확히 입력해주세요");
        } else{
          f.submit();
        }
      }
      function check_one(id, name, number, stamp, coupon, description, visit, date) {
        document.getElementById('2nd_table_id').value = id;
        document.getElementById('2nd_table_name').value = name;
        document.getElementById('2nd_table_number').value = number;
        document.getElementById('2nd_table_date').innerHTML = date;
        document.getElementById('2nd_table_stamp').value = stamp;
        document.getElementById('2nd_table_coupon').value = coupon;
        document.getElementById('2nd_table_visit').value = visit;
        document.getElementById('2nd_table_description').value = description;
      }
      function plus_stamp() {
        var stamp = Number(document.getElementById('2nd_table_stamp').value);
        var coupon = Number(document.getElementById('2nd_table_coupon').value);
        var stamp_plus = document.getElementById('stamp_plus');
        var stamp_plus_value = Number(stamp_plus.value);
        var total = plus(stamp, stamp_plus_value);

        if (stamp_plus.type == 'hidden') {
          stamp_plus.setAttribute("type","text");
        }

        stamp_plus_value++;
        total++;

        var ten_digit = Math.floor(total/10)*10;

        stamp_plus.value = stamp_plus_value;
        document.getElementById('calculate_stamp').value = total - ten_digit;

        if (total%10==0) {
          alert("쿠폰 1개 적립");
          coupon++;
          document.getElementById('2nd_table_coupon').value = coupon;
          document.getElementById('calculate_stamp').value = total - ten_digit;

        } else{
          // alert("111");
          document.getElementById('calculate_stamp').value = total - ten_digit;
        }
      }

      function plus(Left, Right) {
        return Number(Left) + Number(Right);
      }

      function minus_coupon() {
        var coupon = Number(document.getElementById('2nd_table_coupon').value); //기존 쿠폰
        var coupon_minus = document.getElementById('coupon_minus'); //차감할 쿠폰 전체 값
        var coupon_minus_value = Number(coupon_minus.value);

        if (coupon_minus.type == 'hidden') {
          coupon_minus.setAttribute("type","text");
        }

        coupon_minus_value++;
        coupon_minus.value = coupon_minus_value;

        var total = minus(coupon, coupon_minus_value );

        if (total<0) {
          alert("쿠폰 갯수를 확인해주세요 보유쿠폰 : "+coupon);
        }else {
          document.getElementById('calculate_coupon').value = total;
        }
      }

      function minus(Left, Right) {
        return Number(Left) - Number(Right);
      }

      function refresh() {
        document.getElementById('2nd_table_id').value = "";
        document.getElementById('2nd_table_name').value = "";
        document.getElementById('2nd_table_number').value = "";
        document.getElementById('2nd_table_date').innerHTML = "";
        document.getElementById('2nd_table_stamp').value = "";
        document.getElementById('2nd_table_coupon').value = "";
        document.getElementById('2nd_table_visit').value = "";
        document.getElementById('2nd_table_description').value = "";
        document.getElementById('coupon_minus').type = 'hidden';
        document.getElementById('coupon_minus').value = '0';
        document.getElementById('stamp_plus').type = 'hidden';
        document.getElementById('stamp_plus').value = '0';
        document.getElementById('calculate_stamp').value= "";
        document.getElementById('calculate_coupon').value= "";
      }

      function save(f) {
        var id = f.save_id.value;
        var name =f.save_name.value;
        var number =f.save_number.value;
        var stamp =f.save_stamp.value;
        var stamp_plus =f.save_plus.value;
        var coupon =f.save_coupon.value;
        var coupon_minus =f.save_minus.value;
        var description =f.save_description.value;
        var visit =f.save_visit.value;

        f.submit();
      }
    </script>

  </head>
  <body>
    <!-- top : search -->
    <div id="main_top_search_container">
      <table class="common_array_table">
        <tr>
          <td >
            <button type="button" class="common_img_button" onclick="" >
              <img src="./img/button/button_calculate.png">
            </button>
          </td>
          <td>
            <button type="button" class="common_img_button" onclick="page_notice_open()" >
              <img src="./img/button/button_notice.png">
            </button>
          </td>
          <td>
            <button type="button" class="common_img_button" onclick="page_join_open()" >
              <img src="./img/button/button_join.png">
            </button>
          </td>
          <!-- search bar set : search/button -->
          <div>
            <form action="./temp.php" method="POST">
              <td class="main_top_search_array_td">
                 <input type="search" name="search" class="main_top_search_number" placeholder="[전화번호 네자리]를 입력해주세요"  onfocus="this.placeholder='' " onblur="this.placeholder='[전화번호 네자리]를 입력해주세요'">
               </td>
              <td>
                <button type="button" class="button_search_square" onclick="search_send(this.form)" >
                  <img src="./img/button/button_search_square.png">
                </button>
              </td>
            </form> <!-- form self search -->
          </div> <!--search bar set  -->
        </tr>
      </table>
    </div><div class="common_space"></div><!-- top container  -->

    <!-- middle : result -->
    <div id="main_middle_result_container">
      <div class="main_middle_title">회원정보</div><div class="common_space2"></div>
      <!--1st middle table -->
      <div>
        <table class="main_middle_tables" >
          <tr class="main_1st_table_column_tr">
            <td class="main_1st_table_column_checkbox_td"> <img src="./img/img/img_check.png"> </td>
            <td class="main_1st_table_column_td"> 회원이름 </td>
            <td class="main_1st_table_column_td"> 전화번호 </td>
            <td class="main_1st_table_column_td"> 스탬프 </td>
            <td class="main_1st_table_column_td"> 쿠폰 </td>
          </tr>
        <?php
          if (isset($_POST['search']) && $count!=0) {
            $i=1;
            while ($row = mysqli_fetch_array($result)) {
              $filtered = array(
                'id' => htmlspecialchars($row['id']),
                'name' => htmlspecialchars($row['name']),
                'number' => htmlspecialchars($row['number']),
                'stamp' => htmlspecialchars($row['stamp']),
                'coupon' => htmlspecialchars($row['coupon']),
                'visit' =>  htmlspecialchars($row['visit']),
                'description' => htmlspecialchars($row['description']),
                'date' => htmlspecialchars($row['date'])
              );
            if ( $i%2==0 ) {
            ?>
            <tr tr class="main_1st_table_cell_even_tr">
              <td class="main_1st_table_cell_checkbox_td">
                <input type="button" value="" class="checkone"
                 onclick="check_one(
                 '<?=$filtered['id']?>',
                 '<?=$filtered['name']?>',
                 '<?=$filtered['number']?>',
                 '<?=$filtered['stamp']?>',
                 '<?=$filtered['coupon']?>',
                 '<?=$filtered['description']?>',
                 '<?=$filtered['visit']?>',
                 '<?=$filtered['date']?>'
                 )">
              </td>
              <td class="main_1st_table_cell_td"><?=$filtered['name']?></td>
              <td class="main_1st_table_cell_td"><?=$filtered['number']?></td>
              <td class="main_1st_table_cell_td"><?=$filtered['stamp']?></td>
              <td class="main_1st_table_cell_td"><?=$filtered['coupon']?></td>
            </tr>
            <?php
            }//if(even)
            else {
            ?>
              <tr class="main_1st_table_cell_odd_tr">
                <td class="main_1st_table_cell_checkbox_td">
                  <input type="button"  value="" class="checkone" onclick="check_one(
                   '<?=$filtered['id']?>',
                   '<?=$filtered['name']?>',
                   '<?=$filtered['number']?>',
                   '<?=$filtered['stamp']?>',
                   '<?=$filtered['coupon']?>',
                   '<?=$filtered['description']?>',
                   '<?=$filtered['visit']?>',
                   '<?=$filtered['date']?>'
                   )">
                </td>
                <td class="main_1st_table_cell_td"><?=$filtered['name']?></td>
                <td class="main_1st_table_cell_td"><?=$filtered['number']?></td>
                <td class="main_1st_table_cell_td"><?=$filtered['stamp']?></td>
                <td class="main_1st_table_cell_td"><?=$filtered['coupon']?></td>
              </tr>
            <?php
          } //else(odd)
            $i=$i+1;
          } //while
        }//if(isset)
          else {
            ?>
              <tr class="main_1st_table_cell_odd_tr">
                <td colspan="5" class="main_1st_table_cell_td">회원정보가 없습니다</td>
              </tr>
            <?php
          } //else(isset)
        ?>
        </table>
      </div><div class="common_space2"></div><hr><div class="common_space2"></div> <!-- 1st middle table -->

      <!-- 2nd middle table -->
      <form class="" action="./page/page_save.php" method="get">
        <div>
          <table class="main_middle_tables">
            <tr>
              <input id="2nd_table_id" name="save_id" type="hidden" value="">
              <td class="main_2nd_table_column_1"> 회원이름</td>
              <td class="main_2nd_table_cell_1">
                <input type="text" id="2nd_table_name" class="main_2nd_table_cell_1" name="save_name" value="" readonly >
              </td>
              <td class="main_2nd_table_column_1">스탬프</td>
              <td class="main_2nd_table_cell_2">
                <input type="text" id="2nd_table_stamp" class="main_2nd_table_cell_2" name="save_stamp" value="" readonly >
              </td>
              <td class="main_2nd_table_stamp_coupon_control_cell" >
                <input id="stamp_plus" class="main_2nd_table_stamp_coupon_control_input" type="hidden" name="save_plus"  value="0">
              </td>
              <td class="main_2nd_table_cell_2">
                <input class="plus_minus_botton" type="button" value="+" onclick="plus_stamp()">
              </td>
            </tr>
            <tr>
              <td class="main_2nd_table_column_1">전화번호</td>
              <td class="main_2nd_table_cell_1">
                <input type="text" id="2nd_table_number" class="main_2nd_table_cell_1" name="save_number" value="" readonly>
              </td>
              <td class="main_2nd_table_column_1">누적방문</td>
              <td colspan="3" class="main_2nd_table_cell_colspan">
                <input type="text" id="2nd_table_visit" class="main_2nd_table_cell_colspan" name="save_visit" value="" readonly >
              </td>
            </tr>
            <tr>
              <td class="main_2nd_table_column_1">최근방문</td>
              <td id="2nd_table_date" class="main_2nd_table_cell_1"></td>
              <td class="main_2nd_table_column_1">쿠폰</td>
              <td class="main_2nd_table_cell_2">
                <input type="text" id="2nd_table_coupon" class="main_2nd_table_cell_2" name="save_coupon" value="" readonly >
              </td>
              <td class="main_2nd_table_stamp_coupon_control_cell">
                <input id="coupon_minus" class="main_2nd_table_stamp_coupon_control_input" name="save_minus" type="hidden" value="0">
              </td>
              <td class="main_2nd_table_cell_2">
                <input class="plus_minus_botton" type="button" value="-" onclick="minus_coupon()">
              </td>
            </tr>
            <tr>
              <td class="main_2nd_table_column_2">특이사항<br>(최대 180자)</td>
              <td colspan="5" class="main_2nd_table_textarea_cell">
                <textarea id="2nd_table_description" name="save_description" class="main_2nd_table_textarea"></textarea>
              </td>
            </tr>
          </table>
        </div><div class="common_space2"></div><!-- 2nd middle table -->

        <!-- middle function -->



        <input type="text" id="calculate_stamp" name="" value="">
        <input type="text" id="calculate_coupon" name="" value="">




        <div>
          <table class="common_array_table">
              <td>
                <button type="button" class="common_img_button" onclick="refresh()" >
                  <img src="./img/button/button_refresh.png">
                </button>
              </td>
              <td>
                <button type="button" class="common_img_button" onclick="save(this.form)" >
                   <img src="./img/button/button_save.png">
                </button>
      </form> <!-- form page_save -->
            </td>
          </tr>
        </table>
      </div><!-- middle function -->
    </div><div class="common_space"></div> <!--middle container -->

    <!-- bottom : ect -->
    <div id="main_bottom_container"> </div>
  </body>
</html>
