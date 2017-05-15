//进度条
$('.strip').each(function (i , v) {
    $(this).css({width:$(this).parents('.actass').siblings('a').text()})
});



//数量自加减
function addMin(v){
    baseNum = $('.carnoNum').val();
    if(v==1 && baseNum<999){
        baseNum++;
        $('.carnoNum').val(baseNum);
        price = $('.price').val();
        num = $('.carnoNum').val();
        $('.total').val(Math.round(price*num));
    }else if(v==0 && baseNum>0){
        baseNum--;
        $('.carnoNum').val(baseNum);
        price = $('.price').val();
        num = $('.carnoNum').val();
        $('.total').val(Math.round(price*num));
    }else{
        return false;
    }
}
//    切换组件
$('.JsClick').find('li').click(function () {
    var ind = $(this).index();
    $('.JsClick').find('li').removeClass('actList');
    $(this).addClass('actList');
    $('.tab').hide();
    $('.tab').eq(ind).show();
});
//    切换组件
$('.JsClick1').find('li').click(function () {
    var ind = $(this).index();
    type = ind; //当前等级类型
    $('.JsClick1').find('li').removeClass('actList');
    $(this).addClass('actList');
    $('.tabcar').hide();
    $('.tabcar').eq(ind).show();
    //ajax 调用查询评论
    getdata(page);
});

var page     = 1;
var pagesize = 2;
var type     = 0;
$(function(){
    pageNav.pre="上一页";
    pageNav.next="下一页";

    getdata(page);
});

/**
 * 得到评论
 * @param page
 */
function  getdata(page){
    var goods_id = $("input[name='goods_id']").val();

    url='/AjaxGoods/getCommentByLevel';
    $.get(url,{page:page,pagesize:pagesize,goods_id:goods_id,type:type},function(data){
        if(data.data!='undefined'){
            divid = '#comm'+type;
            $(divid).html('');
            if(data.data==null || data.data==''){
                $(divid).append('暂无数据');
                pageNav.go(page,0);
                $('#pageNav').hide();
            }else{
                if(data.pagetotal>1){
                    $('#pageNav').show();
                    pageNav.go(page,data.pagetotal);
                }
                $.each(data.data, function(key, val) {
                    // name         = data.data[key]['member_name'];
                    // firststr     = name.substr(1,1);
                    // laststr      = name.substr(name.length-1,1);
                    // dispose_name = firststr+'*'+laststr;
                    str = '<div class="text"><p>'+data.data[key]['member_name']+'</p><p>';
                    str += data.data[key]['content']+"</p><p class='color888'>";
                    str += data.data[key]['createdate']+"</p></div>";
                    $(divid).append(str);
                });
            }
        }
    },'json');
}
 