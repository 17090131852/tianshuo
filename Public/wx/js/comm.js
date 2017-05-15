//点击签到按钮
$(".signBtn").click(function () {
    $('.pImg').addClass('dn');
    $('.signSuc').removeClass('dn');
})
$('.newIcon').click(function () {
    $(".ps").toggle();
    $('.emoji-mod ').hide()
})
window.location ="#foot";
$('.newIcon1').click(function () {
    $('.emoji-mod ').toggle()
    $(".ps").hide();
});
$('#emojiInput').focus(function () {
    $('.emoji-mod ').hide()
});
$("#sendmsg").click(function () {
    $('.emoji-mod ').hide()
});
$('.newText')