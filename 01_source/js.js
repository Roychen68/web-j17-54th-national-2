$(document).ready(function () {
    $.get("api/session.php",function (res) {
        if (res == true) {
            $("#logout-btn").show()
        } else {
            $("#logout-btn").css("display","none")
        }
    })
})
function logout() {
    $.post("api/logout.php",function () {
        location.href = "index.html"
    })
}
function check() {
    $.get("api/session.php",function (res) {
        if (res == true) {
            location.href = "bus.html"
        } else {
            $("div#login").modal("show")
        }
    })
}
function VailidNumber(number) {
    return (
        number !== '' &&
        number >= 0
    )
}
function VailidValue(value) {
    return (
        value !== ''
    )
}
function cancel() {
    $("div.modal").modal("hide")
}
function back() {
    get()
}
$("div.logo").click(function () {
    location.href = "index.html"
})
$("div.modal").on("hidden.bs.modal",function () {
    $("input.form-control").val("")
})