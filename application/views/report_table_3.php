 <?php 

//                    echo '<pre>';
//var_dump($this->_ci_cached_vars);
//                    echo '</pre>';


                ?>
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
                                    <img id="imgListLoading" alt="Loading" src="<?php echo base_url('assets/images/loading1.gif');?>" style="height: 25px; display: none;" />
                                    <img id="imgReturn"  title="Return" alt="Return" src="<?php echo base_url("assets/images/undo.png"); ?>" style="height: 25px; cursor:pointer; " />
                                    </span>
                            </td>
                            <td height="28" colspan="16" style="text-align: left;">
                                <div id="divMenu">
                                    <div class="nvareport" > <a path="L5MemID:m612">
                                    <?php 
                                        //echo $GLOBALS['CI']->load->get_var(11);
                                        echo $agents['accnum'];
                                        //echo $$this->_ci_cached_vars[0]['name'];
                                    ?>
     
 </a> </div>
                                </div>

                            </td>
                        </tr>
                    </thead>
                </table>
               


                   <table id="ticketTable" style="" class="table_common " width="100%"
                    border="0" cellpadding="0" cellspacing="0">
                    <thead>
                        <tr>
                            <th height="30" style="text-align: center;">
                                <span>時間</span>
                            </th>
                            <th style="text-align: center;">
                                <span>單號</span>
                            </th>
                            <th style="text-align: center;">
                                <span>交易內容</span>
                            </th>
                            <th style="text-align: center;">
                                <span>交易金額</span>
                            </th>
                            <th style="text-align: center;">
                                <span>有效投注</span>
                            </th>
                            
                            <th style="text-align: center;">
                                <span>返水</span>
                            </th>
                            <th style="text-align: center;">
                                <span>結果</span>
                            </th>
                            <th style="text-align: center;">
                                <span>洗碼量</span>
                            </th>
                            <th class="" style="text-align: center;" pname="L5">
                                <span>代理</span>
                            </th>
                            <th class="" style="text-align: center;" pname="L4">
                                <span>成數</span>
                            </th>
                            <th style="text-align: center;">
                                <span>投注方式</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody id="ticketBody">
                    <?php 

                        $a1 = 0 ;
                        $a2 = 0 ;
                        $a3 = 0 ;
                        $a4 = 0 ;
                        $a5 = 0 ;
                        $a6 = 0 ;



                        foreach ($bids as $row){

                            $a1 = $a1 + $row['SysAmount'];
                            $a2 = $a2 + $row['EffectiveAmount'];
                            $a3 = $a3 + $row['RetAmtTotal'];
                            $a4 = $a4 + $row['Results'];
                            $a5 = $a5 + $row['XFL'];
                            $a6 = $a6 + $row['L5Amt'];

                    ?>


                        <tr class="dataBgHistory total" style="background-color:#C4F6CC">
                            <td class="" pname="TicketTime" style="line-height: 10px;"><?php echo str_replace(' ','<br>',$row['TicketTime']); ?>
                            </td>
                            <td class="" pname="TicketID" style="line-height:18px;text-align:center;font-size:14px;"><?php echo substr($row['DescnList'],15)."<br>" .nl2br($row['TicketID']).'<br>'.$row['BetIP']; ?>
                            </td>
                            <td class="" pname="Descn" style="text-align: left; width: 300px; letter-spacing: -1px"><?php echo str_replace('(主)','<span style="color:#B07420">(主)</span>',nl2br($row['Line1'])."<br>".$row['Line2']."<br>".'<span style="color:#880000">'.$row['Line3'].'</span>'); ?>
                            </td>
                            <td pname="SysAmount"><?php echoresult2($row['SysAmount']); ?>
                            </td>
                            <td class="" pname="EffectiveAmount"><?php echoresult2($row['EffectiveAmount']); ?>
                            </td>
                            <td class="" pname="RetAmtTotal">0
                            </td>

                            <td class="" pname="Results"><?php echoresult2($row['Results']); ?>
                            </td>
                            <td class="" pname="XFL">0
                                
                            </td>
                            <td class="" pname="L5Amt"><?php echoresult2($row['L5Amt']); ?>
                            </td>
                            <td class="" pname="L4Amt">0/-/-/-/-/-  
                            </td>
                            <td class="" pname="L3Amt"><?php echo $row['device']; ?>
                            </td>
                            </td>
                        </tr>
                    <?php 
                        }
                        if ($a4>0){
                            $a4 = floor($a4 * 1.2) ; 
                        }else{
                            $a4 = floor($a4 * 0.8) ; 
                        }
                        if ($a6>0){
                            $a6 = floor($a6 * 1.15) ; 
                        }else{
                            $a6 = floor($a6 * 0.85) ; 
                        }
                        ?>
                        <tr class="dataBgHistory" style="background-color:#C4F6CC">
                            <td class="" pname="TicketTime">
                            </td>
                            <td class="" pname="TicketID">
                            </td>
                            <td class="" pname="Descn" style="text-align: left; width: 300px; letter-spacing: -1px">合計
                            </td>
                            <td pname="SysAmount"><?php echoresult2($a1);?>
                            </td>
                            <td class="" pname="EffectiveAmount"><?php echoresult2($a2);?>
                            </td>
                            <td class="" pname="RetAmtTotal">0
                            </td>
                            <td class="" pname="Results"><?php echoresult2($a4);?>
                            </td>
                            <td class="" pname="XFL">0
                                0
                            </td>
                            <td class="" pname="L5Amt"><?php echoresult2($a6);?>
                            </td>
                            <td class="" pname="L4Amt">
                            </td>
                            <td class="" pname="L3Amt">
                            </td>
                        </tr>
                    </tbody>

                </table>
    </div>


            </div>
        </div>
    </div>