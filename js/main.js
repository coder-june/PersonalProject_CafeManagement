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
  document.getElementById('calculate_visit').value = Number(visit)+1;
  document.getElementById('calculate_coupon').value = coupon;
  document.getElementById('calculate_stamp').value = stamp;
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
    document.getElementById('calculate_coupon').value = coupon;
  } else{
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
  document.getElementById('calculate_visit').value= "";
  document.getElementById('stamp_plus').value= "0";
  document.getElementById('stamp_plus').type= "hidden";
  document.getElementById('coupon_minus').value= "0";
  document.getElementById('coupon_minus').type= "hidden";
}

function save(f) {
    var ex_stamp = f.save_stamp.value;
    var ex_coupon = f.save_coupon.value;
    var stamp = f.calculate_stamp.value;
    var coupon = f.calculate_coupon.value;
    if (confirm("스탬프 적립 [ "+ex_stamp+" ▶ "+stamp+" ]\n쿠폰 사용 [ " +ex_coupon+" ▶ "+coupon+" ]\n저장하시겠습니까?")) {
      f.submit();
    }
}
