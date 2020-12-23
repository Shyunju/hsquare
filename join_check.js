function check_input() {
    if (!document.join_form.uname.value)
    // join_form 이름을 가진 form 안의 uname 의 value가 없으면
    {
        alert("이메일를 입력하세요!");
        document.join_form.uname.focus();
        // 화면 커서 이동
        return;
    }
    if (!document.join_form.email.value) {
        alert("비밀번호를 입력하세요!");
        document.join_form.email.focus();
        return;
    }
    if (!document.join_form.pwd.value) {
        alert("비밀번호를 입력하세요!");
        document.join_form.pwd.focus();
        return;
    }
    if (!document.join_form.pnum.value) {
        alert("비밀번호를 입력하세요!");
        document.join_form.pnum.focus();
        return;
    }

    document.login_form.submit();
    // 모두 확인 후 submit()
}