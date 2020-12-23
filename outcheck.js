function outcheck() {
    var result = confirm("로그아웃 하시겠습니까?");
    if (result) {
        alert("로그아웃 되었습니다.")
        location.href = 'logout.php';
    } else {
        alert("취소되었습니다.")
    }
}