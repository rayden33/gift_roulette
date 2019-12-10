<!DOCTYPE>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
    <title>Лотерея "Колесо удачи"</title>
    <script type="text/javascript" src="http://yandex.st/jquery/1.4.4/jquery.min.js"></script>
    <!--noindex-->
    <link rel="shortcut icon" href="http://respect4script.mybb.ru/files/0013/37/be/11557.ico" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="http://st0.bbcorp.ru/style/Mybb_The_Button/Mybb_The_Button.css" />
</head>
<body>



<style type="text/css">
    .pages div.container {overflow:hidden}
</style>
<div id="pun-main" class="main pages">
    <div class="section">
        <h1><span>Лотерея "Колесо удачи"</span></h1>
        <div class="container">
            <!-- код на страницу -->
            <style type="text/css">
                .main.pages {
                    position:relative;
                    margin:auto;
                    margin-top:-90px;
                    height:1000px;
                    width:920px;
                    min-height:1030px;
                    z-index:2;
                }
                #Round, #center,
                #cover, #center-gif {
                    transition-duration: 0s;
                }
                #bgImg,
                #bgImg-2{
                    width:282px;
                    height:282px;
                    background: rgba(32,32,26,.93);
                    transition-duration: 9.8s;
                }
                #bgImg-2.active{
                    background: rgba(0,0,0,.42);
                }
            </style>
            <!-- случайный начальный угол поворота -->
            <script type="text/javascript">
                var startCorner = Math.floor(360*Math.random());
                document.write('<style type="text/css">#Round {transform: rotate('+startCorner+'deg);}</style>');
            </script>

            <style type="text/css">
                .wrp-round {
                    height:910px;
                    position: relative;
                    padding-top:156px;
                    padding:0;
                    text-align:center;
                }

                #bgImg,
                #bgImg-2,
                #center,
                #round-arrow,
                #arrow-a,
                #Round,
                .sector-frame {
                    border-radius:50%;
                    opacity:1.0;
                    display:block;
                    margin: auto;
                    left:0;right:0;top:0;bottom:0;
                    position:absolute;
                }
                #Round {
                    -webkit-transition-duration: 16.96s;
                    -moz-transition-duration:  16.96s;
                    -o-transition-duration: 16.96s;
                    -ms-transition-duration:  16.96s;
                    transition-duration: 16.96s;
                }
                .sector-frame {
                    border-radius: 0;
                    height:812px;
                    width:220px;
                    left:13px;right:-13px;
                    top-21px;bottom:21px;
                    z-index:-2;
                }
                .sector-frame.active {
                    z-index:0;
                }

                #arrow-a {
                    height:1px;
                    margin-top:16px;
                }
                #round-arrow {
                    margin-top:-31px;
                    z-index:100;
                }

                #center {
                    border:rgba(255,255,255,0.22) 5px solid;
                    cursor:pointer;
                    opacity:1.0;
                    transition-duration: 16.7s;
                }
                #center.firstClick {
                    opacity:0;
                    cursor:progress;
                }
                #center-gif{
                    border:none;
                }
                .wrp-round.active #center-gif{
                    display:none;
                }
                .wrp-round.active #center{
                    border-color:transparent;
                }
                .wrp-round.active #cover{
                    opacity:.1;
                    background-color:#988643;
                }
                #modal-wrp{
                    position: relative;
                    z-index: 99999;
                }
            </style>


            <div class="wrp-round">
                <div id="arrow-a"></div>
                <img id="round-arrow" src="http://savepic.net/6536368.png" border="0">
                <img id="Round" src="http://savepic.net/6627399.jpg" border="0">
                <img class="sector-frame a-1" src="http://savepic.net/6512676.png" border="0">
                <img class="sector-frame a-2" src="http://savepic.net/6529043.png" border="0">
                <img id="bgImg" src="http://savepic.net/6677589.png" border="0">
                <div id="bgImg-2"></div>
                <img id="center" src="http://savepic.net/6671467.png" border="0">

            </div>

            <!-- Настройки   -->
            <script type="text/javascript">

                var probability ={};
                probability.Lot = new Array (

                    ['red','Пустой лот',0], //0 - негативный итог; 1 - Деньги; 2 -  Призы или Бонусы;
                    ['blue','одна руна навыка',2],
                    ['green','500 Redsuns',1],
                    ['red','-50 жизней',0],
                    ['blue','уникальное украшение на выбор',2],
                    ['green','50 Redsuns',1],
                    ['red','-30 Энергии',0],
                    ['blue','украшение из лавки на выбор',2],
                    ['green','100 Redsuns',1],
                    ['red','Одна удачная охота',2],
                    ['blue','подарок из лавки на выбор',2],
                    ['green','250 Redsuns',1] //Последний элемент без запятой;

                )
                probability.Arr =[];
                //Вероятности выпадения;
                probability.red	= 72; //Вероятность красного
                probability.green	= 24; //Вероятность зеленого
                probability.blue	= 12; //Вероятность синего

            </script>
            <script type="text/javascript">
                (function(){

                    // Перемешивалка + Random
                    function Peremeshivalka(lng){
                        var a = {},i,out=[],n=0;
                        for(i=0;i<lng;i++)a[i]=i;
                        while (n!=lng){
                            i = Math.floor(lng*Math.random());
                            if(typeof(a[i])!='undefined'){
                                out.push(a[i]);
                                delete a[i];
                                n++;
                            }
                        }
                        return out[Math.floor(lng*Math.random())];
                    }

                    function probability_rationing(y,x){
                        for(j=0;j<probability[y];j++) {
                            probability.Arr.push(x);
                        }
                    }
                    for(i=0;i<probability.Lot.length;i++) {
                        probability_rationing(probability.Lot[i][0],[probability.Lot[i],i]);
                    }
                    var out = probability.Arr[Peremeshivalka(probability.Arr.length)],
                        negative  = !!out[0][2],
                        sector  = out[1];
                    out	  = out[0][1];//alert([sector,out,negative]);

//============== End Random ===========//

                    var N =probability.Lot.length; //Число секторов
                    var stRad = 360/N;	//!!!Целое число градусов!!!;
                    var delta_random = -14+28*Math.random();
                    var itogCorner = 6982+Math.floor(delta_random)-stRad*sector;//alert(Math.floor(delta_random))
                    $('<style type="text/css"> .wrp-round.active #Round {transform: rotate('+itogCorner+'deg);}</style>').appendTo('body');


                    function toggleSector(n,t){
                        $('.sector-frame:last').addClass('active');
                        var i = 0;
                        var timerId00 = setInterval( function() {i++;
                            if(i>n){clearInterval(timerId00);return;}
                            $('.sector-frame').toggleClass('active');
                        },t)
                    }

                    function record_function(){
                        if(noLogin) return;
                        $('#fr_dise2').remove();
                        var host = location.hostname;
                        var strFrame ='\
    [b]'+ UserLogin +'[/b], крутнув "Колесо удачи", получил(а) следующий результат:[quote][mark]'+out+'[/mark][/quote]'
                        strFrame = encodeURIComponent(strFrame);
                        var a = 'www.';   var host2 = a+host;
                        var lnk = 'http://'+host2+'/post.php?tid='+probability.TemaID;
                        var Nick = encodeURIComponent('Дайсы { '+UserID+','+UserLogin+' }');
                        var frame = '<iframe id="fr_dise2"  src="'+ lnk +'" name="frame_dise_2&'+host+'_dise_2&'+Nick+'_dise_2&'+strFrame+'"  width="2" height="2" style="border:none!important;position:absolute;z-index:-100;" scrolling="no"></iframe>';
                        $(frame).appendTo('.wrp-round');//Фрейм загружен;
                    }

                    $("img#center").one('click',function(){
                        $(this).addClass('firstClick');
                        setTimeout(function(){$('#bgImg-2').addClass('active')},10000);
                        setTimeout(function(){$('.wrp-round').addClass('active');},114);
                        var img = $(this);
                        setTimeout(function(){
                            $('.sector-frame').css({'transform':'rotate('+(Math.floor(delta_random)-3)+'deg)'});
                            setTimeout(function(){toggleSector(5,700);},240);
                        },17000)

                    });
                    $(function(){$('html,body').scrollTop($("#arrow-a").offset().top);});

                }());
            </script>
            <!--//End -->
        </div>
    </div>
</div>


</body>
</html>
