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
function VailidMail(value) {
    return (
        value !== '' &&
        value.includes("@")
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
count()
function count() {
    $.post("api/get.php",{action: "participants"},function (res) {
        const participants = JSON.parse(res)
        console.log(participants.length);
        $("#participants-setting-link").append(`<span class="count-badge">${participants.length}</span>`)
    })
}