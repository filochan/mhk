



<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head id="Head1"><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><title>
  曼哈頓 代理
</title>
    <link href="<?php echo base_url('assets/css/style.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('assets/css/main.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('assets/css/account.css'); ?>" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="<?php echo base_url('assets/css/new.css'); ?>" type="text/css" />
    <script src="<?php echo base_url('assets/js/jquery-1.10.2.min.js'); ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets//Scripts/jquery-plugin/checkOnLine.js'); ?>" type="text/javascript"></script>
    <script type="text/javascript">
        function show() {
            $('#dddd').animate({ scrollTop: 100000 }, 200);
            $("#xsly").show();
        }

        function Guan() {
            $("#xsly").hide();
        }
        ///另開視窗
        function openwindow(url, Wd, Hi, Na) {

            var url;     //網頁位置;
            var name = Na;    //網頁名稱;
            var iWidth = 1085;  //視窗的寬度;
            var iHeight = window.innerHeight; //視窗的高度;
            var iTop = (window.screen.availHeight - 65 - iHeight) / 2;  //視窗的垂直位置;
            var iLeft = (window.screen.availWidth - 10 - iWidth) / 2;   //視窗的水平位置;
            //window.open(url, name, 'height=' + iHeight + ',innerHeight=' + iHeight + ',width=' + iWidth + ',innerWidth=' + iWidth + ',top=' + iTop + ',left=' + iLeft + ',status=no,location=no,toolbar=no,scrollbars=yes');
            window.open(url, name, 'height=' + Hi + ',width=' + Wd + ',top=' + iTop + ',left=' + iLeft + ',status=no,location=no,toolbar=no,scrollbars=yes,resizable=yes');
        }

        $(document).ready(function () {

        });

    </script>
    
    <link href="<?php echo base_url('assets/Scripts/jquery-plugin/jqueryui/themes/base/base.css'); ?>" rel="stylesheet"
        type="text/css" />
    <link href="<?php echo base_url('assets/Scripts/jquery-plugin/jqueryui/themes/cupertino/jquery-ui.cupertino.min.css'); ?>"
        rel="stylesheet" type="text/css" />
    <script src="<?php echo base_url('assets/Scripts/jquery-plugin/jqueryui/jquery-ui.min-1.11.1.js'); ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/Scripts/jquery-plugin/jquery.url.js'); ?>" type="text/javascript"></script>
    <link href="<?php echo base_url('assets/Styles/treeview/jquery.treeview.css'); ?>" rel="stylesheet" type="text/css" />
   <script src="<?php echo base_url('assets/Scripts/jquery-plugin/jquery.layout-1.4.3.js'); ?>" type="text/javascript"></script>
    <link href="<?php echo base_url('assets/Scripts/jquery-plugin/jquery.jqGrid/ui.jqgrid.css'); ?>" rel="stylesheet"
        type="text/css" />

    <script src="<?php echo base_url('assets/Scripts/jquery-plugin/jquery.jqGrid/jquery.jqGrid.min.js'); ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/Scripts/jquery-plugin/jquery.jqGrid/i18n/grid.locale-tw.js'); ?>" type="text/javascript"></script>
    
    <style type="text/css">
        .right { text-align: right; margin: 0; padding-right: 5px !important; }
        
        #tbodyList tr td.red { color: #d10000; }     
        #tbodyList tr td.blue { color: #0081ff !important; }
        #tbodyList tr td.green { color: #007200; }
        
        #tbodyList tr td.MemID a { cursor: pointer; color: #0081ff !important; }
        #tbodyList tr td.SysAmount a { cursor: pointer; color: #0081ff !important; }
        
        .hide { display: none; }
        
        #divMenu a { margin-left: 5px; cursor: pointer; color:#0081ff; }
        #tblhead td { vertical-align: middle; }
        
        .nvareport{
            margin-right:50px;
         }
    </style>
 
    <script type="text/javascript">
        var rptype = 2;

        $(document).ready(function () {


        });

        function getDates(dtype, num) {
            var dates = { d1: '', d2: '' };
            num = parseInt(num);
            var d = new Date();
            var d2 = new Date();
            if (dtype == 'd') {
                //d2 = addDays(d, num);
                d.setDate(d.getDate() + num);
                dates.d1 = getDateString(d);
                dates.d2 = getDateString(d);
            }
            else if (dtype == 'w') {
                var day = d.getDay();
                if (day == 0) {
                    d.setDate(d.getDate() + (num * 7) - d.getDay() - 6);
                    d2.setDate(d2.getDate() + (num * 7) - d2.getDay());
                }
                else {
                    d.setDate(d.getDate() + (num * 7) - d.getDay() + 1);
                    d2.setDate(d2.getDate() + (num * 7) - d2.getDay() + 7);
                }
                dates.d1 = getDateString(d);
                dates.d2 = getDateString(d2);
            }
            else if (dtype == 'm') {

               var y = d.getFullYear();
               var m =d.getMonth();

               d = new Date(y, m + num, 1); //this is first day of current month
               d2 = new Date(y, m + num + 1, 0);

               dates.d1 = getDateString(d);
               dates.d2 = getDateString(d2);
            }
            return dates;
        }

        function getDateString(date) {
            var mt = date.getMonth() +1;
 
            var day = date.getDate();
            if (mt < 10) {
                mt = "0" + mt;
            }
            if (day < 10) {
                day = "0" + day;
            }
            var val = date.getFullYear() + "-" + mt + "-" + day;    
            return val;
        }

        jQuery(function ($) {
            $.datepicker.regional['zh-TW'] = {
                closeText: '关闭',
                prevText: '&#x3c;上月',
                nextText: '下月&#x3e;',
                currentText: '今天',
                monthNames: ['一月', '二月', '三月', '四月', '五月', '六月',
                '七月', '八月', '九月', '十月', '十一月', '十二月'],
                monthNamesShort: ['一', '二', '三', '四', '五', '六',
                '七', '八', '九', '十', '十一', '十二'],
                dayNames: ['星期日', '星期一', '星期二', '星期三', '星期四', '星期五', '星期六'],
                dayNamesShort: ['周日', '周一', '周二', '周三', '周四', '周五', '周六'],
                dayNamesMin: ['日', '一', '二', '三', '四', '五', '六'],
                weekHeader: '周',
                dateFormat: 'yy-mm-dd',
                firstDay: 1,
                isRTL: false,
                showMonthAfterYear: true,
                yearSuffix: ''
            };
            $.datepicker.setDefaults($.datepicker.regional['zh-TW']);
        });

    </script>
</head>
<body>
<div class="aspNetHidden">
<input type="hidden" name="__EVENTTARGET" id="__EVENTTARGET" value="" />
<input type="hidden" name="__EVENTARGUMENT" id="__EVENTARGUMENT" value="" />
<input type="hidden" name="__VIEWSTATE" id="__VIEWSTATE" value="/wEPDwUJNzg2NjE2OTE1D2QWAmYPZBYCAgMPZBYIZg8PFgIeBFRleHQFHeabvOWTiOmgkyDlrZDluLPomZ8gLSA5bTYxMDY2ZGQCBA8PFgIfAAUG55m75Ye6ZGQCCg8PFgYeC05hdmlnYXRlVXJsBSFodHRwOi8vcnB0LmhpbGw5OTkubmV0L2xvZ2luLmFzcHgfAAUM5p+l6Kmi57i95bizHgdWaXNpYmxlaGRkAgsPZBYMZg8WAh4LXyFJdGVtQ291bnQCDBYYZg9kFgJmDxUBBue+juajkmQCAQ9kFgJmDxUBBuWPsOajkmQCAg9kFgJmDxUBBuaXpeajkmQCAw9kFgJmDxUBDOWFtuWug+ajkueQg2QCBA9kFgJmDxUBBue+juexg2QCBQ9kFgJmDxUBBuWGsOeQg2QCBg9kFgJmDxUBBue+jui2s2QCBw9kFgJmDxUBBuWFtuS7lmQCCA9kFgJmDxUBBue2sueQg2QCCQ9kFgJmDxUBBuW9qeeQg2QCCg9kFgJmDxUBBuaMh+aVuGQCCw9kFgJmDxUBBui2s+eQg2QCAQ8WAh8DAgwWGGYPZBYCZg8VAQEwZAIBD2QWAmYPFQEBMGQCAg9kFgJmDxUBATBkAgMPZBYCZg8VAQEwZAIED2QWAmYPFQEBMGQCBQ9kFgJmDxUBATBkAgYPZBYCZg8VAQEwZAIHD2QWAmYPFQEBMGQCCA9kFgJmDxUBATBkAgkPZBYCZg8VAQEwZAIKD2QWAmYPFQEBMGQCCw9kFgJmDxUBATBkAgIPFgIfAwIMFhhmD2QWAmYPFQEBN2QCAQ9kFgJmDxUBATBkAgIPZBYCZg8VAQEwZAIDD2QWAmYPFQEBMGQCBA9kFgJmDxUBATBkAgUPZBYCZg8VAQIyMmQCBg9kFgJmDxUBATBkAgcPZBYCZg8VAQEwZAIID2QWAmYPFQEBMGQCCQ9kFgJmDxUBATBkAgoPZBYCZg8VAQEwZAILD2QWAmYPFQEBMGQCAw8WAh8DAggWEGYPZBYCZg8VAgEwBumBjumXnGQCAQ9kFgJmDxUCBzEwMSwxMDMG6K6T5YiGZAICD2QWAmYPFQIHMTAyLDEwNAblpKflsI9kAgMPZBYCZg8VAgcxMTAsMTExBueNqOi0j2QCBA9kFgJmDxUCBzEwNSwxMTMG5Zau6ZuZZAIFD2QWAmYPFQIDMTA2DOS4gOi8uOS6jOi0j2QCBg9kFgJmDxUCATIM6LWw5Zyw6K6T5YiGZAIHD2QWAmYPFQIBMwzotbDlnLDlpKflsI9kAgQPFgIfAwIMFhhmD2QWAmYPFQIBNAbnvo7mo5JkAgEPZBYCZg8VAgIxMQblj7Dmo5JkAgIPZBYCZg8VAgIxMgbml6Xmo5JkAgMPZBYCZg8VAgIxMwzlhbblroPmo5LnkINkAgQPZBYCZg8VAgEzBue+juexg2QCBQ9kFgJmDxUCAjgyBuWGsOeQg2QCBg9kFgJmDxUCATUG576O6LazZAIHD2QWAmYPFQICNzIG5YW25LuWZAIID2QWAmYPFQICNTUG57ay55CDZAIJD2QWAmYPFQICODMG5b2p55CDZAIKD2QWAmYPFQICODQG5oyH5pW4ZAILD2QWAmYPFQIBMQbotrPnkINkAgUPFgIfAwIMFhhmD2QWAmYPFQEG576O5qOSZAIBD2QWAmYPFQEG5Y+w5qOSZAICD2QWAmYPFQEG5pel5qOSZAIDD2QWAmYPFQEM5YW25a6D5qOS55CDZAIED2QWAmYPFQEG576O57GDZAIFD2QWAmYPFQEG5Yaw55CDZAIGD2QWAmYPFQEG576O6LazZAIHD2QWAmYPFQEG5YW25LuWZAIID2QWAmYPFQEG57ay55CDZAIJD2QWAmYPFQEG5b2p55CDZAIKD2QWAmYPFQEG5oyH5pW4ZAILD2QWAmYPFQEG6Laz55CDZGS5hts0YMkklREXuJ859QH4qDNZJA==" />
</div>

<script type="text/javascript">
//<![CDATA[


function unlink(){
    alert('尚無權限進入');
    return false ;
}



//]]>
</script>


<div class="aspNetHidden">

  <input type="hidden" name="__VIEWSTATEGENERATOR" id="__VIEWSTATEGENERATOR" value="9DA3C228" />
</div>
    <div class="maB">
        <div class="maA">
            <div class="container">
                <div class="wrapper ma">
                    <div class="lsd">
                    </div>
                    <div class="rsd">
                    </div>
                    <div class="wrapper_inner">
                        <div class="header">
                            <div>
                                <div class="fl">
                                    <a class="logo" href="#home"></a>
                                </div>
                                <div class="fr top-box">
                                    <span id="lblmember" class="fl" style="color: white; margin: 5px;
                                        font-size: 16px">曼哈頓 子帳號 - <?php echo $account ?></span>
                                <!--    <a href="#" onclick="window.open('http://104.237.53.162/');"
                                        class="fl btn-ys">
                                        <span id="Label8" class="fl">即時比分</span>
                                    </a>
<a href="#" onclick="window.open('http://tv1.hill8888.net:5588');"
                                        class="fl btn-ys">
                                        <span id="Label6" class="fl">希爾影城</span>

                                    </a>-->

                                    <a id="ButtonLogout" class="fl btn-ys" href="<?php echo base_url('welcome/logout'); ?>">登出</a>
                                    <div class="clearFix">
                                    </div>
                                </div>
                            </div>
                            <div class="acenter">
                                <div class="nav_main">
                                    <a href=""  onclick='unlink();' class="nav_main_item">
                                        帳號管理/修改密碼
                                    </a><a href="" class="nav_main_item active" onclick='unlink();'>
                                        即時投注
                                    </a><a href="" onclick='unlink();' class="nav_main_item active">
                                        已開賽
                                    </a><a href=""  onclick='unlink();' class="nav_main_item active">
                                        歷史比賽
                                    </a><a href="<?php echo base_url('welcome/report1/'.$num); ?>" class="nav_main_item active">
                                        查詢報表
                                    </a>
                                    <div class="clearFix">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="marquee">
                <div class="mqlf">
                    <span></span>
                </div>
                <div class="nav_sub" id="toMiddle">

                    

                    <a class="nav_main_item" href="<?php echo base_url('welcome/report1/'.$num); ?>"  >
                        體育當日報表
                    </a>
                    <a class="nav_main_item" href="<?php echo base_url('welcome/searchall/'.$num); ?>" >
                        體育歷史總帳
                    </a>

                    
                    <a class="nav_main_item" href="<?php echo base_url('welcome/searchnow/'.$num); ?>"  >
                        即時注單查找

                    </a>
                    
                </div>
                <div class="mqrf">
                    <span></span>
                </div>
            </div>
            <div class="mq-main">
                <i class="mq-icon"></i>
                <div class="mq-mask" style="cursor: pointer">
                    <marquee id="leftMarquee" onclick="openwindow('/Manager/marquee.aspx',1028,window.innerHeight,'');">★敬請注意★帳務日期03月15日美國冰球NHL <新澤西魔鬼vs溫尼伯噴射機>因賽事取消。,故依據本公司規則投注該場賽事所有注單一律取消，敬請會員留意，謝謝&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;★敬請注意★帳務日期03月15日MLB-熱身賽(芝加哥小熊ＶＳ密爾瓦基釀酒人)因賽事結果為7:7平手結束,故依據本公司規則投注該場賽事所有注單一律取消，敬請會員留意，謝謝&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;本公司棒球熱身賽規則如下：＜美棒熱身賽＞、結果為和局時，退回所有注單。＜日棒熱身賽、台棒熱身賽、韓棒熱身賽＞結果為和局時，所有注單均為有效注單。比賽打滿五局，上半場皆視為有效注單。敬請各階層注意，本公司祝您投注愉快！&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;★敬請注意★本公司<彩球賽事>暫不開放。造成不便 敬請見諒!&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;★敬請注意★本公司<其它籃球類>暫不開放。造成不便 敬請見諒!&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;★敬請注意★帳務日期03月06日MLB-熱身賽(太空人VS馬林魚)因賽事結果為7:7平手結束,故依據本公司規則投注該場賽事所有注單一律取消，敬請會員留意，謝謝&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;★敬請注意★帳務日期03月06日MLB-熱身賽(小熊VS遊騎兵)因賽事結果為9:9平手結束,故依據本公司規則投注該場賽事所有注單一律取消，敬請會員留意，謝謝&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;★敬請注意★帳務日期03月03日世界棒球經典賽-熱身賽(KOR-韓國 VS 尚武鳳凰隊)因賽事局數不正規,投注該場賽事所有注單一律取消 敬請會員留意，造成不便敬請見諒，謝謝&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;02月28日 04:10 MLB 美國職棒-熱身賽(堪薩斯皇家 vs 西雅圖水手)因賽事由原04:10提前至03:10,凡於03:11以後下注該場賽事所有注單一律取消(含過關、綜合過關),敬請各會員注意(其詳細規則請會員至線上投注協定與規則內查閱)***謝謝***&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;★敬請注意★美國職棒(MLB)熱身賽規則:1.比賽打滿5局(含)以上而未滿9局如遇突發狀況而比賽終止,但經聯盟裁定勝負(全場讓分,走地讓分)仍視為有效注單,(全場大小,走地大小)則不予計算 2.賽事結果如遇平手或保留.取消.延期比賽時,投注於該場賽事之(全場讓分.全場大小.全場走地讓分.全場走地大小)之注單以退組計算 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;★敬請注意★中華職棒.韓國職棒 熱身賽規則:1.比賽打滿5局(含)以上而未滿9局如遇突發狀況而比賽終止,但經聯盟裁定勝負(全場讓分,走地讓分)仍視為有效注單,(全場大小,走地大小)則不予計算 2.賽事結果如遇平手或保留.取消.延期比賽時,投注於該場賽事之(全場讓分.全場大小.全場走地讓分.全場走地大小)之注單以退組計算 3.先發投手僅供參考，如遇臨時換投手所有注單本公司均視為有效注單  ..謝謝&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;★敬請注意★美國職棒(MLB)熱身賽規則:1.比賽打滿5局(含)以上而未滿9局如遇突發狀況而比賽終止,但經聯盟裁定勝負(全場讓分,走地讓分)仍視為有效注單,(全場大小,走地大小)則不予計算 2.賽事結果如遇平手或保留.取消.延期比賽時,投注於該場賽事之(全場讓分.全場大小.全場走地讓分.全場走地大小)之注單以退組計算 3.先發投手僅供參考，如遇臨時換投手所有注單本公司均視為有效注單  ....謝謝&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;★春節重要訊息★農曆年春節期間‧盤口正常開放‧敬請會員踴躍下注.本公司祝各位財源廣進‧新春如意。&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;]敬請會員在保持網速流暢的狀態下進行遊戲，若因網路速度造成視訊延遲、黑屏，投注仍然視為有效。所有因網路因素引起爭議的狀況，一律以本網站記錄之數據為主，會員可於帳務報表查看結果，本網站將不受理任何因個人網速問題提出之投訴。&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ◆美國職棒正規賽上半場規則◆ 1.所有注單結果依1到5局比分為標準，若遇未滿5局則所有注單一率取消。 2.若遇平手被讓者贏全部（平手輸多少或平手贏多少之盤口例外）. 3.如第六局之後比賽取消則上半場注單依舊有效, 本公司均以退組計算~如遇與他家規則不同一律以本公司為準..敬請會員注意....謝謝&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;◆美國職棒MLB正規賽規則(不含走地)◆ 1.比分結果依MLB官方網站裁定為準。 2.比賽未滿九局除(全場讓分.全場獨贏注單.全場讓分過關.全場獨贏過關)有算，其他注單一律按退組論。 3.先發投手僅供參考，如遇臨時換投手所有注單依舊照算。 4.如遇補賽則隊名後面會加(補)以玆區別，補賽投手與正常賽投手如遇聯盟臨時更換所有注單依舊照算。&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;★敬請注意★本公司對於 ( 日棒.韓棒 足球.打分洞團體下注) 之行為者.不論比賽是否派彩.對於上述公告本公司將一律刪除注單.敬請會員留意.請會員不要以身試法,本公司取消注單皆會以跑馬燈訊息及於注單上備註，ㄧ切按公司規則判定輸贏。&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;★敬請注意★會員端所有遊戲項目【會員單場限額A隊+B隊，二隊押注額為相加總額度】，【例如:會員單場限額10萬A隊押注5萬，B隊押注5萬】同一場賽事將無法再進行投注，否則一律視為無效注單..敬請會員們留意.謝謝&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;★敬告各位階層代理與會員，故使得下注限額超過遊戲之單注、單場及單邊下注限額問題，發生此類問題本公司可以協助刪除注單，此類下注方式依本公司規定一律刪單權力無論開獎與否。&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;★敬請注意★如發現注單有錯誤，跑馬燈並未公告，對注單有效性存疑，請立即與公司連絡，私下協議之結果公司皆不予處理，ㄧ切按公司規則判定輸贏。&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;★敬請注意★本公司對於任何個人或團體以外掛軟件程式同時在同一項目,投注走地相同內容的注單走地進球後之異常注單.或人為疏失所產生的異常注單,不論比賽是否派彩.對於上述公告本公司將 一律取消注單 .敬請會員留意.本公司取消注單及於注單上備註，造成不便敬請見諒，謝謝&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</marquee>
                </div>
            </div>
        </div>
    </div>


            
    