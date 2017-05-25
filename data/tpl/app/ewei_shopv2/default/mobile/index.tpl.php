<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_top', TEMPLATE_INCLUDEPATH)) : (include template('_top', TEMPLATE_INCLUDEPATH));?>
    <script>

        $(document).ready(function(){
            function decodeUnicode(str) {
                str = str.replace(/\\/g, "%");
                return unescape(str);
            }
            function get(name)
            {
                var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
                var r = window.location.search.substr(1).match(reg);
                if(r!=null)return  unescape(r[2]); return null;
            }
            var lihtml = "";
            var li_hunqing = "";
            var li_wenhua="";
            var li_qiye="";

            $.ajax({
                url: "<?php  echo mobileUrl('json')?>",
                type: 'get',
                dataType: 'json',
                data: {"page": 5,"pagesize":1},
                success : function(m){
                    console.log(m);
                    var  data = m.result.suc;

                    if(data.lipin.length!==0){
                        $.each(data.lipin,function(index, el) {
                            lihtml +='<li><div class="_show" data-id="'+el.id+'"><div class="img"><img src="'+el.img+'" alt="" /></div><div class="show " ><h3>'+el.biaoti+'</h3><p><span>产品特性:</span>'+el.jieshao+'</p><p><span class="price">¥'+el.price+'</span><s>¥'+el.oldprice+'</s></p></div></div><div class="oh to_buy" ><p class="fl" style="margin-top:.05rem;"><span>评价</span><span>('+el.pingjia+')</span></p><p class="fr btn_buy">点击购买</p></div></li>'
                        });
                        $("#lipin").append(lihtml);
                    }
                    if(data.hunqing.length!==0){
                        $.each(data.hunqing,function(index, el) {
                            li_hunqing +='<li><div class="_show" data-id="'+el.id+'"><div class="img"><img src="'+el.img+'" alt="" /></div><div class="show " ><h3>'+el.biaoti+'</h3><p class="lh"><span>介绍:</span>'+el.jieshao+'</p><p><span>套餐亮点:</span>'+el.liangdian+'</p><p><span class="price">¥'+el.price+'</span><s>¥'+el.oldprice+'</s></p></div></div><div class="oh to_buy" ><p class="fl" style="margin-top:.05rem;"><span>评价</span><span>('+el.pingjia+')</span></p><p class="fr btn_buy">点击购买</p></div></li>'
                        });
                        $("#hunqing").append(li_hunqing);
                    }
                    if(data.wenhua.length!==0){
                        $.each(data.wenhua,function(index, el) {
                            li_wenhua +='<li><div class="_show" data-id="'+el.id+'"><div class="img"><img src="'+el.img+'" alt="" /></div><div class="show " ><h3>'+el.biaoti+'</h3><p class="lh"><span>介绍:</span>'+el.jieshao+'</p><p><span class="price">¥'+el.price+'</span><s>¥'+el.oldprice+'</s></p></div></div><div class="oh to_buy" ><p class="fl" style="margin-top:.05rem;"><span>评价</span><span>('+el.pingjia+')</span></p><p class="fr btn_buy">点击购买</p></div></li>'
                        });
                        $("#wenhua").append(li_wenhua);
                    }
                    if(data.qiye.length!==0){
                        $.each(data.qiye,function(index, el) {
                            li_qiye +='<li><div class="_show" data-id="'+el.id+'"><div class="img"><img src="'+el.img+'" alt="" /></div><div class="show " ><h3>'+el.biaoti+'</h3><p class="lh"><span>介绍:</span>'+el.jieshao+'</p><p><span class="price">¥'+el.price+'</span><s>¥'+el.oldprice+'</s></p></div></div><div class="oh to_buy" ><p class="fl" style="margin-top:.05rem;"><span>评价</span><span>('+el.pingjia+')</span></p><p class="fr btn_buy">点击购买</p></div></li>'
                        });
                        $("#qiye").append(li_qiye);
                    }
                },
                error : function(data){
                }
            })


            var imgs="";
            var biaoti="";
            var price="";
            var oldprice="";

            $(document).on('click','.btn_buy',function(){
                imgs=$(this).closest("li").children("._show").children('.img').children('img').attr('src');
                biaoti=$(this).closest("li").children("._show").children('.show').children('h3').text();
                price=$(this).closest("li").children("._show").children('.show').children('p').children('.price').text();
                oldprice=$(this).closest("li").children("._show").children('.show').children('p').children('s').text();
                $(".show_img").children('img').attr("src",imgs);
                $(".wenzi").children('.biaoti').text(biaoti);
                $(".price").text(price);
                $(".oldprice").text(oldprice);
                $(".show_box").show();
                $(".bg_bg").show();
            });

            $(".close").click(function(){
                $(".show_box").hide();
                $(".bg_bg").hide();
            });
            $(".bg_bg").click(function(){
                $(".show_box").hide();
                $(".bg_bg").hide();
            });




            $(".jia").click(function(){

                var input0=0;
                input0=$(".shuliang").children('input').val();
                input0++;
                $(".shuliang").children('input').val(input0);

            });

            $(".jian").click(function(){
                var input0=$(".shuliang").children('input').val();
                if(input0>1){
                    input0--;
                    $(".shuliang").children('input').val(input0);
                }else{
                    return false;
                }


            });

            $(document).on('click','._show',function(){
                var id=$(this).data('id');
                location.href="my_detail.html?id="+id;

            })

        })

    </script>
    <style>
        .weui_cells {
             margin-top: 0em;
            background-color: #fff;
            line-height: 1.41176471;
            font-size: 17px;
            overflow: hidden;
            position: relative;
        }
    </style>

</head>
<body>
<!-- banner开始-->
<figure id="focus" class="focus">
    <div class="bd">
        <ul>
            <li><a href="#"><img src="../addons/ewei_shopv2/static/biaofu/img/banner001.png" /></a></li>
            <li><a href="#"><img src="../addons/ewei_shopv2/static/biaofu/img/banner001.png" /></a></li>
            <li><a href="#"><img src="../addons/ewei_shopv2/static/biaofu/img/banner001.png" /></a></li>
            <li><a href="#"><img src="../addons/ewei_shopv2/static/biaofu/img/banner001.png" /></a></li>
            <li><a href="#"><img src="../addons/ewei_shopv2/static/biaofu/img/banner001.png" /></a></li>
        </ul>
    </div>
    <ol>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
    </ol>
</figure>
<script type="text/javascript">
    TouchSlide({
        slideCell:"#focus",
        titCell:"ol", //开启自动分页 autoPage:true ，此时设置 titCell 为导航元素包裹层
        mainCell:".bd ul",
        effect:"leftLoop",
        autoPlay:true,//自动播放
        autoPage:true //自动分页
    });
</script>
<!-- banner结束-->
<div class="clearfix"></div>

<!--内容开始-->
<div class="list_bigbox">

        <div class="weui_cells weui_cells_access">
            <a class="weui_cell " href="list01.html?a=lipin">
                <div class="weui_cell_bd weui_cell_primary">
                    <p>礼品类</p>
                </div>
                <div class="weui_cell_ft">查看更多</div>
            </a>
        </div>

    <div class="pd cont" style="padding:0;padding-left: .1rem;">

        <ul id="lipin">

        </ul>
    </div>
</div>
<!--内容结束-->
<!--内容开始-->
<div class="list_bigbox">
    <div class="weui_cells weui_cells_access">
        <a class="weui_cell " href="list02.html">
            <div class="weui_cell_bd weui_cell_primary">
                <p>婚庆服务类</p>
            </div>
            <div class="weui_cell_ft">查看更多</div>
        </a>
    </div>

    <div class="pd cont" style="padding:0;padding-left: .1rem;">
        <ul id="hunqing">

        </ul>
    </div>
</div>
<!--内容结束-->

<!--内容开始-->
<div class="list_bigbox">
    <div class="weui_cells weui_cells_access">
        <a class="weui_cell " href="list03.html">
            <div class="weui_cell_bd weui_cell_primary">
                <p>中国传统文化服务类</p>
            </div>
            <div class="weui_cell_ft">查看更多</div>
        </a>
    </div>
    <div class="pd cont" style="padding:0;padding-left: .1rem;">
        <ul class="wenhua" id="wenhua">

        </ul>
    </div>
</div>
<!--内容结束-->

<!--内容开始-->
<div class="list_bigbox">
    <div class="weui_cells weui_cells_access">
        <a class="weui_cell " href="list04.html">
            <div class="weui_cell_bd weui_cell_primary">
                <p>企业管理服务类</p>
            </div>
            <div class="weui_cell_ft">查看更多</div>
        </a>
    </div>

    <div class="pd cont" style="padding:0;padding-left: .1rem;">
        <ul id="qiye">

        </ul>
    </div>
</div>
<!--内容结束-->

<div class="bg_bg"></div>

<div class="show_box">
    <div class="clearfix big_box" style="">
        <div class="show_img"><img src="../addons/ewei_shopv2/static/biaofu/img/show_img01.png" alt="" style="height:1.5rem;width:1.5rem;"></div>
        <div class="wenzi">
            <p class="biaoti"></p>
            <p><span class="price"></span><s style="color:#ababab;" class="oldprice"></s></p>
        </div>
        <div class="close"><i class="iconfont" style="font-size: .3rem;">&#xe62a;</i></div>
    </div>
    <div class="pr">
        <div class="left">购买数量</div>
        <div class="right">
            <span class="jia"><i class="iconfont">&#xe68e;</i></span>
            <span class="shuliang"><input type="text" value="1"></span>
            <span class="jian"><i class="iconfont">&#xe6e0;</i></span>
        </div>
    </div>
    <div class="buy_current">立即购买</div>
</div>

<div class="show_box02">
    <div class="clearfix" style="border-bottom: 1px solid #ccc;">
        <div class="show_img"><img src="../addons/ewei_shopv2/static/biaofu/img/gif3.png" alt="" style="height:1.5rem;width:1.5rem;"></div>
        <div class="wenzi">
            <p></p>
            <p><span class="price"><!-- ¥50 --></span><s style="color:#ababab;" class="oldprice"><!-- ¥650 --></s></p>
        </div>
        <div class="close"><i class="iconfont" style="font-size: .3rem;">&#xe62a;</i></div>
    </div>
    <div>
        <p>购买分类</p>
        <ul class="fenlei" id="fenlei">

        </ul>
    </div>
    <div class="pr" style="border-top:1px solid #ccc;">
        <div class="left">购买数量</div>
        <div class="right">
            <span><i class="iconfont">&#xe6e0;</i></span>
            <span><input type="text" value="1"></span>
            <span><i class="iconfont">&#xe68e;</i></span>
        </div>

    </div>
    <div class="buy_current">立即购买</div>
</div>





<!--内容结束-->
<div style="height:1.5rem;"></div>
<footer>
    <div class="left" >
        <a href="index.html"  style="color:#0099ff;"><span class="icon icon-29"></span>商城首页</a>
    </div>
    <div class="right">
        <a href="<?php  echo mobileUrl('member')?>"><span class="icon icon-84"></span>我的账户</a>
    </div>
</footer>


</body>
</html>




