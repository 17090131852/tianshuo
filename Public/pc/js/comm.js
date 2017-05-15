$('.jiantou').click(function () {
   $('.foot').toggleClass('badmin')
});
var  setInt;
var tab=document.getElementById("Rbox");
var tab1=document.getElementById("list");
var tab2=document.getElementById("list2");
tab2.innerHTML=tab1.innerHTML;

$('#btns').click(function () {
    $('.startImg').hide();
    $('.rComm').removeClass('dn');
    $(this).text('结束');
    if(!$('#btns').hasClass('btnend')){
        $(this).addClass('btnend');
        setInt=setInterval(admin,20);
    }else {
        $(this).removeClass('btnend');
        clearInterval(setInt);
        for(i = 0 ; i < $('li').length; i++ ){
            if($('li').eq(i).offset().top>-30){
                $('li').eq(i).addClass('haha');
                console.log()
            }else { $('li').eq(i).hide()}

        }$.each($('.haha'), function(i,val){
            if(i>9){$('.haha').eq(i).hide()}});
        $('.RBox').css({overflowY:'scroll'});
        $('.rCTitle').show();
        $(this).addClass('dn');
        $('#see').removeClass('dn')
    }
});
function admin(){
    if(tab2.offsetTop-tab.scrollTop<=0)
        tab.scrollTop-=tab1.offsetHeight;
    else{
        tab.scrollTop=tab.scrollTop+20
    }
}