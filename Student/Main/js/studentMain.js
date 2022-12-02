document.querySelector("#accountButton").addEventListener(("click"), function() {
    var studentID = window.localStorage.getItem("studentID");
    window.location = `/Student/Account/php/account.php?person=${studentID}`;
});