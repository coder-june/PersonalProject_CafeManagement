function page_join_send(f) {
  var name = f.name.value;
  var number = f.number.value;

  var num_check=/^[0-9]*$/;

  if (!num_check.test(number)) {
    alert("숫자만 입력해주세요");
  } else {
    if (number.length!=4) {
      alert("전화번호 '네자리' 를 정확히 입력해주세요");
    }else {

      f.submit();
    }
  }
}
