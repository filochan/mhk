 
        <div class="ui-layout-west" style="background-color: #dddddd;height:6px;">
            <div id="container">
                <ul class="treeview" id="navigation" style="margin-right: 30px;">
                    <li class="expandable lastExpandable">
                        <div class="item" id="treeRoot" oid="5" mid="m612"
                            path="L5MemID:m612">
                            <div class="hitarea expandable-hitarea lastExpandable-hitarea">
                            </div>&nbsp;</div>
                        <ul>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <div class="ui-layout-center" style="background-color: #dddddd;padding-left:6px;height:533px;">
            <div id="divList" style="background-color:#ffffff;padding:10px;min-width: 1000px; min-height: 400px;height:521px;overflow-y: scroll;">

                <table id="table1" cellpadding="2" cellspacing="0" border="0" class="m-tableB" style="border: 1px solid #aeaba3;
                    padding: 5px;" width="100%">
                    <thead>
                        <tr>
                            <td style="min-width: 40px; width: 40px; border-right: 0px">
                                <span style="min-width: 30px; width: 30px;">
                                    <img id="imgListLoading" alt="Loading" src="<?php echo base_url('assets/images/loading1.gif'); ?>" style="height: 25px; display: none;" />
                                    <img id="imgReturn"  title="Return" alt="Return" src="<?php echo base_url("assets/images/undo.png"); ?>" style="height: 25px; cursor:pointer; " />
                                    </span>
                            </td>
                            <td height="28" colspan="16" style="text-align: left;">
                                <div id="divMenu">
                                    <div class="nvareport" > <a path="L5MemID:m612">
                                   <a href="<?php echo base_url('welcome/report3').'/'.$this->session->userdata('num') ; ?>"> <?php  echo $agents['accnum']; ?></a>
     
 </a> </div>
                                </div>

                            </td>
                        </tr>
                    </thead>
                </table>
                <table id="tableList" cellpadding="2" cellspacing="0" border="0" class="m-tableB"
                    style="border: 1px solid #aeaba3; padding: 5px;" width="100%">
                    <thead>
                        <tr style="height: 35px;">
                            <th style="width: 50px">
                                <span id="LevelName">會員</span>   
                            </th>
                            <th style="width: 110px;min-width:90px;">
                                 暱稱
                            </th>
                            <th style="width: 70px">
                                筆數  
                            </th>
                            <th style="width: 80px">
                                下注金額  
                            </th>
                            <th style="width: 80px">
                                有效投注  
                            </th>
                            
                            <th style="width: 70px">
                                會員  
                            </th>
                            <th style="width: 70px">
                                會員全退  
                            </th>
                            <th class="L5" style="text-align: center; width: 70px" pname="L5">
                                代理  
                            </th>
                            <th style="width: 50px">
                                實貨量  
                            </th>
                            <th style="width: 50px">
                                實貨量(%)  
                            </th>
                            <th style="width: 50px">
                                貢獻度  
                            </th>
                            <th style="width: 50px">
                                貢獻度(%)
                            </th>

                            
                                    <th style="width: 40px" class="share">
                                        美棒
                                    </th>
                                
                                    <th style="width: 40px" class="share">
                                        台棒
                                    </th>
                                
                                    <th style="width: 40px" class="share">
                                        日棒
                                    </th>
                                
                                    <th style="width: 40px" class="share">
                                        其它棒球
                                    </th>
                                
                                    <th style="width: 40px" class="share">
                                        美籃
                                    </th>
                                
                                    <th style="width: 40px" class="share">
                                        冰球
                                    </th>
                                
                                    <th style="width: 40px" class="share">
                                        美足
                                    </th>
                                
                                    <th style="width: 40px" class="share">
                                        其他
                                    </th>
                                
                                    <th style="width: 40px" class="share">
                                        網球
                                    </th>
                                
                                    <th style="width: 40px" class="share">
                                        彩球
                                    </th>
                                
                                    <th style="width: 40px" class="share">
                                        指數
                                    </th>
                                
                                    <th style="width: 40px" class="share">
                                        足球
                                    </th>
                                

                        </tr>
                    </thead>
                    <style>
                     a:link {
                            color: #0083FC;
                        }

                        /* visited link */
                        a:visited {
                            color: #0083FC;
                        }

                        /* mouse over link */
                        a:hover {
                            color: #0083FC;
                        }
                    </style>

                        <?php
                        if ($results>0){
                            $results = floor($results * 1.20) ; 
                        }else{
                            $results = floor($results * 0.8) ; 
                        }

                        if ($agentamount>0){
                            $agentamount = floor($agentamount * 1.15) ; 
                        }else{
                            $agentamount = floor($agentamount * 0.85) ; 
                        }
                        ?>




                    <tbody style="background: rgb(255, 255, 255);" id="tbodyList">
                        <tr class="dataBgHistory " style="height: 25px;">
                            <td class="MemID table_font" >
                                <a href="<?php echo base_url('welcome/report3').'/'.$this->session->userdata('num') ; ?>"> <?php  echo $agents['accnum']; ?></a>
                            </td>
                            <td class="right BetCount " ><?php  echo $agents['name']; ?>
                            </td>
                            <td class="right SysAmount "  ><?php  echo $total; ?>

                            </td>
                            <td class="right EffectiveAmount blue"  ><a href='<?php echo base_url('welcome/report3').'/'.$this->session->userdata('num') ; ?>'><?php  echo $amount; ?></a>
                            </td>
                            <td class="right "  ><?php  echo $eff_amount; ?>
                            </td>
                            <td class="right Results color" ><?php  echoresult2( $results); ?>
                            </td>
                            <td class="right Hyqt color" ><?php  echoresult2($results); ?>
                            </td>
                            <td class="right L5Gxd color" pname="L5Gxd" ><?php echoresult2($agentamount) ; ?>
                            </td>
                            <td class="" pname="L5Gxd_2" ><?php echo '0' ; ?>
                            </td>
                            <td class="right  L4Gxd_2 color" pname="" ><?php echo '0%' ; ?>
                            </td>
                            <td class="right  L3Gxd_2 color" pname="L3Gxd_2" >0
                            </td>
                            <td class="right  L3Gxd_2  color" pname="L3Gxd_2" >0%
                            </td>
                            <td class="right  L1Gxd_2 color" pname="L1Gxd_2" >0
                            </td>
                            <td class="right  L0Gxd_2 color" pname="L0Gxd_2" >0
                            </td>
                            <td class="right Shl " >0
                            </td>
                            <td class="right ShlPer " >0
                            </td>
                            <td class="right Gxd " >0
                            </td>
                            <td class="right GxdPer " >0
                            </td>
                            <td class="right  L1Gxd_2 color" pname="L1Gxd_2" >0
                            </td>
                            <td class="right  L0Gxd_2 color" pname="L0Gxd_2" >0
                            </td>
                            <td class="right Shl " >0
                            </td>
                            <td class="right Shl " >0
                            </td>
                            <td class="right Gxd " >0
                            </td>
                            <td class="right GxdPer " >0
                            </td>
                            <td class="right Shl " >0
                            </td>
                            <td class="right Gxd " >0
                            </td>
                            <td class="right GxdPer " >0
                            </td>
                            <td class="right Shl " >0
                            </td>
                            <td class="right Gxd " >0
                            </td>
                            <td class="right GxdPer " >0
                            </td>
                        </tr>




                        <tr class="dataBgHistory total" style="height: 25px;">
                            <td class="MemID table_font" >合計
                            </td>
                            <td class="right BetCount ">&nbsp;
                            </td>
                            <td class="right SysAmount "  ><?php  echo $total; ?>

                            </td>
                            <td class="right EffectiveAmount"  ><?php  echo $amount; ?>
                            </td>
                            <td class="right "  ><?php  echo $eff_amount; ?>
                            </td>
                            <td class="right Results color" ><?php  echoresult2( $results); ?>
                            </td>
                            <td class="right Hyqt color" ><?php  echoresult2($results); ?>
                            </td>
                            <td class="right L5Gxd color" pname="L5Gxd" ><?php echoresult2($agentamount) ; ?>
                            </td>
                            <td class="" pname="L5Gxd_2" ><?php echo '0' ; ?>
                            </td>
                            <td class="right  L4Gxd_2 color" pname="" ><?php echo '0%' ; ?>
                            </td>
                            <td class="right  L3Gxd_2 color" pname="L3Gxd_2" >0
                            </td>
                            <td class="right  L3Gxd_2 color" pname="L3Gxd_2" ><?php echo '<font style="color:red;">0%</font>' ; ?>
                            </td>
                            <td class="right  L1Gxd_2 color" pname="L1Gxd_2" >0
                            </td>
                            <td class="right  L0Gxd_2 color" pname="L0Gxd_2" >0%
                            </td>
                            <td class="right Shl " >0
                            </td>
                            <td class="right ShlPer " >0%
                            </td>
                            <td class="right Gxd " >0
                            </td>
                            <td class="right GxdPer " >0
                            </td>
                            <td class="right  L1Gxd_2 color" pname="L1Gxd_2" >0
                            </td>
                            <td class="right  L0Gxd_2 color" pname="L0Gxd_2" >0
                            </td>
                            <td class="right Shl " >0
                            </td>
                            <td class="right ShlPer " >0
                            </td>
                            <td class="right Gxd " >0
                            </td>
                            <td class="right GxdPer " >0
                            </td>
                            <td class="right ShlPer " >0
                            </td>
                            <td class="right Gxd " >0
                            </td>
                            <td class="right GxdPer " >0
                            </td>
                            <td class="right ShlPer " >0
                            </td>
                            <td class="right Gxd " >0
                            </td>
                            <td class="right GxdPer " >0
                            </td>



                        </tr>

                    </tbody>
                </table>

            </div>
        </div>
    </div>