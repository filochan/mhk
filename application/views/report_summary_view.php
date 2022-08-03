
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
        <span id="pageTitle">當日報表 </span></p>
    <div style="height: 780px; padding-bottom: 10px;background-color:#ffffff;" id="divCotent">
        <div class="ui-layout-north" style="background-color:#ffffff;padding:10px;min-height: 40px; overflow: hidden; width: 98%;" id="divNorth">
            <div style="margin-top: 0px; z-index: 200; position: relative; min-width: 98%;">
                <table cellspacing="0" cellpadding="0" style="margin-top: 5px;" class="table_common "
                    width="98%">
                    <tbody>
                        <tr class="dataBgs">
                            <td style="text-align: center;" width="10%">
                                <span></span>
                            </td>
                            
                               <td style="text-align: center;" width="7%">
                                   <span id="">美棒</span>
                               </td>
                            
                               <td style="text-align: center;" width="7%">
                                   <span id="">台棒</span>
                               </td>
                            
                               <td style="text-align: center;" width="7%">
                                   <span id="">日棒</span>
                               </td>
                            
                               <td style="text-align: center;" width="7%">
                                   <span id="">其它棒球</span>
                               </td>
                            
                               <td style="text-align: center;" width="7%">
                                   <span id="">美籃</span>
                               </td>
                            
                               <td style="text-align: center;" width="7%">
                                   <span id="">冰球</span>
                               </td>
                            
                               <td style="text-align: center;" width="7%">
                                   <span id="">美足</span>
                               </td>
                            
                               <td style="text-align: center;" width="7%">
                                   <span id="">其他</span>
                               </td>
                            
                               <td style="text-align: center;" width="7%">
                                   <span id="">網球</span>
                               </td>
                            
                               <td style="text-align: center;" width="7%">
                                   <span id="">彩球</span>
                               </td>
                            
                               <td style="text-align: center;" width="7%">
                                   <span id="">指數</span>
                               </td>
                            
                               <td style="text-align: center;" width="7%">
                                   <span id="">足球</span>
                               </td>
                            
                        </tr>
                        <tr class="dataBg">
                            <td style="text-align: center;">
                                <b><?php echo $sport[0]['note']; ?>


                                    (含)以後未結算注單</b>
                            </td>
                            
                               <td style="text-align: center;">
                                   <span id=""><?php echoresult($sport[0]['US_baseball']); ?></span>
                               </td>
                            
                               <td style="text-align: center;">
                                   <span id=""><?php echoresult($sport[0]['TW_baseball']);   ?></span>
                               </td>
                            
                               <td style="text-align: center;">
                                   <span id=""><?php echoresult($sport[0]['JP_baseball']);   ?></span>
                               </td>
                            
                               <td style="text-align: center;">
                                   <span id=""><?php echoresult($sport[0]['other_baseball']);   ?></span>
                               </td>
                            
                               <td style="text-align: center;">
                                   <span id=""><?php echoresult($sport[0]['US_basketball']);   ?></span>
                               </td>
                            
                               <td style="text-align: center;">
                                   <span id=""><?php echoresult($sport[0]['iceball']);   ?></span>
                               </td>
                            
                               <td style="text-align: center;">
                                   <span id=""><?php echoresult($sport[0]['US_football']);   ?></span>
                               </td>
                            
                               <td style="text-align: center;">
                                   <span id=""><?php echoresult($sport[0]['others']);   ?></span>
                               </td>
                            
                               <td style="text-align: center;">
                                   <span id=""><?php echoresult($sport[0]['tenners']);   ?></span>
                               </td>
                            
                               <td style="text-align: center;">
                                   <span id=""><?php echoresult($sport[0]['colorball']);   ?></span>
                               </td>
                            
                               <td style="text-align: center;">
                                   <span id=""><?php echoresult($sport[0]['indexs']);   ?></span>
                               </td>
                            
                               <td style="text-align: center;">
                                   <span id=""><?php echoresult($sport[0]['soccer']);   ?></span>
                               </td>
                            
                        </tr>
                        <tr class="dataBg">
                            <td style="text-align: center;">
                                <b><?php echo $sport[1]['note']; ?>
                                    (含)以前未結算注單</b>
                            </td>
                            
                               <td style="text-align: center;">
                                   <span id=""><?php echoresult($sport[1]['US_baseball']); ?></span>
                               </td>
                            
                               <td style="text-align: center;">
                                   <span id=""><?php echoresult($sport[1]['TW_baseball']);   ?></span>
                               </td>
                            
                               <td style="text-align: center;">
                                   <span id=""><?php echoresult($sport[1]['JP_baseball']);   ?></span>
                               </td>
                            
                               <td style="text-align: center;">
                                   <span id=""><?php echoresult($sport[1]['other_baseball']);   ?></span>
                               </td>
                            
                               <td style="text-align: center;">
                                   <span id=""><?php echoresult($sport[1]['US_basketball']);   ?></span>
                               </td>
                            
                               <td style="text-align: center;">
                                   <span id=""><?php echoresult($sport[1]['iceball']);   ?></span>
                               </td>
                            
                               <td style="text-align: center;">
                                   <span id=""><?php echoresult($sport[1]['US_football']);   ?></span>
                               </td>
                            
                               <td style="text-align: center;">
                                   <span id=""><?php echoresult($sport[1]['others']);   ?></span>
                               </td>
                            
                               <td style="text-align: center;">
                                   <span id=""><?php echoresult($sport[1]['tenners']);   ?></span>
                               </td>
                            
                               <td style="text-align: center;">
                                   <span id=""><?php echoresult($sport[1]['colorball']);   ?></span>
                               </td>
                            
                               <td style="text-align: center;">
                                   <span id=""><?php echoresult($sport[1]['indexs']);   ?></span>
                               </td>
                            
                               <td style="text-align: center;">
                                   <span id=""><?php echoresult($sport[1]['soccer']);   ?></span>
                               </td>
                        </tr>
                    </tbody>

                </table>
                <form action="<?php echo base_url('welcome/showsearch'); ?>" method='post'>
                 
                <table id="tblhead" cellpadding="0" cellspacing="0" border="0" style="width: 100%"
                    class="table_common">
                    <tbody>
                        <tr id="trLine1" class="" style="height: 38px;">
                            <td style="text-align: right;">
                                *帳務日期：  
                            </td>
                            <td colspan="4">
                                <input type="text" id="startDate" name="startDate" value="<?php echo $date; ?>"  style="width: 100px;" /><span
                                    class=""></span>
                                <span>
                                    <input type="button" value="今天" id="btnDay" name="btnDate" dtype="d" num="0" class="btnStyle" />
                                    <input type="button" value="後一日" id="btnDayT" name="btnDayT" dtype="d" num="+1" class="btnStyle" />


                                    
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

});
        </script>

