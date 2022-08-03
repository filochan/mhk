
    <?php 
      function echoresult($sport){
        if ($sport>0){
          echo $sport;
        }else{
          echo '0' ;
        }

      }

      function echoresult2($data){
        if ($data >=0 ){
          echo '<font style="color:green;">'.$data.'</font>';
        }else{
          echo '<font style="color:red;">'.$data.'</font>';

        }


      }

    ?>

    <div id="xsly" class="tanchuan">
        <div class="tan_tt">
            <img src="<?php echo base_url('assets/images/tan_x.gif'); ?>" style="cursor: hand" onclick="Guan();" />
        </div>
        <div class="tan_scro" id="dddd">
        </div>
        <div class="tan_box">
            <dl>
                <dt>
                    <textarea id="txt" rows="5" cols="52"></textarea>
                </dt>
                <dd>
                    <input type="button" id="mss" onclick="submitmsg()" title="確定"
                        value="確定" />
                </dd>
            </dl>
        </div>
    </div>
    <div class="aheight">
    </div>
    <div id="account-management" class="mainA" >
        <div class="formStarong">
            
    <p class="redTitle" style="padding-top: 0px;padding-left:10px;">
        <span class="ui-icon ui-icon-circle-triangle-e" style="float: left; display: block;">
        </span>
        <span id="pageTitles">當日報表 </span></p>
    <div style="height: 780px; padding-bottom: 10px;background-color:#ffffff;" id="divCotent">
        <div class="ui-layout-north" style="background-color:#ffffff;padding:10px;min-height: 40px; overflow: hidden; width: 98%;" id="divNorth">
            <div style="margin-top: 0px; z-index: 200; position: relative; min-width: 98%;">
               
                <form action="<?php echo base_url('welcome/searchall'); ?>" method='post'>
                 
                <table id="tblhead" cellpadding="0" cellspacing="0" border="0" style="width: 100%"
                    class="table_common">
                    <tbody>
                        <tr id="trLine1" class="" style="height: 38px;">
                            <td style="text-align: right;">
                                *帳務日期：  
                            </td>
                            <td colspan="4">
                                <input type="text" id="startDate" name="startDate" value="<?php echo $startDate; ?>"  style="width: 100px;" /><span
                                    class="">--</span><input type="text" id="endDate" name="endDate" value="<?php echo $nextDate ?>" class=""  style="width: 100px;" />
                                </span>
                                <span>

                                    <input type="button" value="前一日" id="btnDayY" name="btnDate" dtype="d" num="-1" class="btnStyle hide1" />
                                    <input type="button" value="今天" id="btnDay" name="btnDate" dtype="d" num="0" class="btnStyle" />
                                    <input type="button" value="後一日" id="btnDayT" name="btnDate" dtype="d" num="+1" class="btnStyle" />
                                    <input type="button" value="上周" id="btnWeekUp" name="btnDate" dtype="w" num="-1"  class="btnStyle hide1" />
                                    <input type="button" value="本周" id="btnWeek" name="btnDate" dtype="w" num="0" class="btnStyle hide1" />
                                    <input type="button" value="上月" id="btnMonthUp" name="btnDate" dtype="m" num="-1" class="btnStyle hide1" />
                                    <input type="button" value="本月" id="btnMonth" name="btnDate" dtype="m" num="0" class="btnStyle hide1" />
                                </span>

                                
                            </td>
                            <td>
                                <span id="spanGxd_2">個人輸贏:
                                    <input type="checkbox" id="chkGxd_2" style="cursor: pointer;" />
                                </span>
                            </td>
                        </tr>
                        <tr style="height: 30px;">
                            <td style="text-align: right;">
                               帳號:
                            </td>
                            <td>
                                <input name="txtMemId" type="text" id="txtMemId" class="text" style="width: 120px;" />
                                <input name="hdMemId" type="hidden" id="hdMemId" />
                                <input name="hdPath" type="hidden" id="hdPath" />
                                <input type="submit" name="btnFind" value="  查 詢  " id="btnFind"  style="width:70px; padding:0px 3px; font-size:15px; background-color:#0081ff;color:#ffffff; " class="btnStyle"   /> 
                                <input type="button" name="btnReset" value="  重 置  " id="btnReset"  style="width:70px; padding:0px 3px; font-size:15px;" class="btnStyle" /> 
                            
                            </td>
                            
                            <td>
                                下注方式:
                                <select name="selWtids" id="selWtids">
                                    <option value="">全部</option>
                                    
                                            <option value="0">
                                                過關</option>
                                        
                                            <option value="101,103">
                                                讓分</option>
                                        
                                            <option value="102,104">
                                                大小</option>
                                        
                                            <option value="110,111">
                                                獨贏</option>
                                        
                                            <option value="105,113">
                                                單雙</option>
                                        
                                            <option value="106">
                                                一輸二贏</option>
                                        
                                            <option value="2">
                                                走地讓分</option>
                                        
                                            <option value="3">
                                                走地大小</option>
                                        
                                  
                                </select>
                            </td>


                            <td>
                                比賽類型: 
                                <select name="CatID" id="selCatID">
                                    <option value="">全部</option>
                                    
                                            <option value="4">
                                                美棒</option>
                                        
                                            <option value="11">
                                                台棒</option>
                                        
                                            <option value="12">
                                                日棒</option>
                                        
                                            <option value="13">
                                                其它棒球</option>
                                        
                                            <option value="3">
                                                美籃</option>
                                        
                                            <option value="82">
                                                冰球</option>
                                        
                                            <option value="5">
                                                美足</option>
                                        
                                            <option value="72">
                                                其他</option>
                                        
                                            <option value="55">
                                                網球</option>
                                        
                                            <option value="83">
                                                彩球</option>
                                        
                                            <option value="84">
                                                指數</option>
                                        
                                            <option value="1">
                                                足球</option>
                                        

                                </select>
                            </td>
                    
                            

                            <td>
                                幣種: 
                                <select name="Money" id="selMoney">
                                    <option value="TWD">新台幣</option>
                                    <option value="RMB">人民幣</option>
                                    <option value="USD">美元</option>
                                    <option value="THB">泰銖</option>
                                    <option value="PHP">菲幣</option>
                                </select>
                            </td>


                            <td>
                                異常選項:
                                <select name="selStatus" id="selStatus">   
                                    <option value="Y">正常注單</option> 
                                    <option value="1">刪除注單</option>
                                    <option value="0">不接受注單/取消注單</option>
                                    <option value="B">與打水套利同步注單</option>
                                </select>
                            </td>

                            
                        </tr>
                    </tbody>
                </table>
                </form>
            </div>
        </div>

<?php 
function getlastMonthDays($date){
     $timestamp=strtotime($date);
     $firstday=date('Y-m-01',strtotime(date('Y',$timestamp).'-'.(date('m',$timestamp)-1).'-01'));
     $lastday=date('Y-m-d',strtotime("$firstday +1 month -1 day"));
     return array($firstday,$lastday);
 }
$lastmon = getlastMonthDays(date('Y/m/d'));
 function getMonth($date){
     $firstday = date("Y-m-01",strtotime($date));
     $lastday = date("Y-m-d",strtotime("$firstday +1 month -1 day"));
     return array($firstday,$lastday);
 }

$thismon = getMonth(date('Y/m/d'));


function thisweek($getdate = "", $first_day = 0){
$getdate = date("Y-m-d");

//取得一周的第幾天,星期天開始0-6
$weekday = date("w", strtotime($getdate));

//要減去的天數

$del_day = $weekday - $first_day;
//本週開始日期
$week_start_day = date("Y-m-d", strtotime("$getdate -".$del_day." days"));


//本週結束日期
$week_end_day = date("Y-m-d", strtotime("$week_start_day +6 days"));


//上週開始日期
$lastweek_start_day = date('Ym-d',strtotime("$week_start_day - 7 days"));


//上週結束日期
$lastweek_end_day = date('Ym-d',strtotime("$week_start_day - 1 days"));

//返回開始和結束日期
return array($week_start_day, $week_end_day,$lastweek_start_day,$lastweek_end_day);
}
$thisweek=thisweek();
//print_r(thisweek()); //可觀看結果

/* 各別取出來使用的方式如下

$week_array = thisweek();
echo $week_array[0]; //本週開始日期
echo $week_array[1]; //本週結束日期
echo $week_array[2]; //上週開始日期
echo $week_array[3]; //上週結束日期
*/

?>



        <script>


$( document ).ready(function() {


$("#startDate").datepicker({
                defaultDate: new Date(),
                changeMonth: true
            });
$("#btnDay").click(function(){
  debugger;

  $('#startDate').val('<?php echo date("Y/m/d"); ?>');

})
$("#btnDayT").click(function(){
    $('#startDate').val('<?php echo date("Y/m/d",strtotime(date("Y/m/d").'+1 day')); ?>');
})
$('#btnDayY').click(function(){ //昨天
    //alert('昨天');
    $('#startDate').val('<?php echo date("Y/m/d",strtotime(date("Y/m/d").'-1 day')); ?>');
    $('#endDate').val('<?php echo date("Y/m/d",strtotime(date("Y/m/d").'-1 day')); ?>');
})

$('#btnWeekUp').click(function(){//上週

    //alert('上週');
    $('#startDate').val('<?php echo $thisweek[2]; ?>');
    $('#endDate').val('<?php echo $thisweek[3]; ?>');
})

$('#btnWeek').click(function(){//本週

    //alert('本週');
    $('#startDate').val('<?php echo $thisweek[0]; ?>');
    $('#endDate').val('<?php echo $thisweek[1]; ?>');
})

$('#btnMonthUp').click(function(){ //上月

   // alert('上月');
    $('#startDate').val('<?php echo $lastmon[0]; ?>');
    $('#endDate').val('<?php echo $lastmon[1]; ?>');
})

$('#btnMonth').click(function(){ // 本月

   // alert('本月');
    $('#startDate').val('<?php echo $thismon[0]; ?>');
    $('#endDate').val('<?php echo $thismon[1]; ?>');
})




});




        </script>

