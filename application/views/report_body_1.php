


    <script type="text/javascript">

        var finished = $.getUrlParam('finished');

        var UserOrderId = parseInt('5');

        var POrderId = UserOrderId;

        var OrderId = UserOrderId;

        var UserId = $('#treeRoot').attr('mid');

        var UserPath = $('#treeRoot').attr('path');

        var winColor = 'green';
        var loseColor = 'red';

        var calTotal = '合計';

        var DefaultCurrency = 'TWD';

        var selme = "1";

        jQuery(document).ready(function () {
            var myLayout = $('#divCotent').layout({
                applyDemoStyles: true,
                resizerClass: 'ui-state-defaults',
                north__size: 104,
                west__size: 182,

                west__onresize: function (pane, $Pane) {
                }
            });

            myLayout.close('west');
            //            var winWidth = $(window).width();
            //            if (winWidth < 1024) {
            //                myLayout.close('west');
            //            }

            //设置默认 币种
            $('#selMoney').val(DefaultCurrency);

            rptype = $.getUrlParam('t');

            if (rptype == "1") {
                $('#pageTitle').text('當日報表');
                $('*.hide1').hide();
                myLayout.sizePane("north", 'auto');
                //                var dates = getDates('d', 0);
                //                $('#startDate').val(dates.d1);
                //                $('#endDate').val(dates.d2);
            }
            else if (rptype == '2') {
                $('#pageTitle').text('歷史總帳');
                $('*.hide2').hide();
                //                var dates = getDates('w', 0);
                //                $('#startDate').val(dates.d1);
                //                $('#endDate').val(dates.d2);
            }
            else {
                $('#pageTitle').text('即時注單查找');
                $('*.hide3').hide();
                //                $('#startDate').val('');
                //                $('#endDate').val('');

                <?php if ($searchheight == '110') {
                    echo 'myLayout.sizePane("north", 110);';
                }else{
                    echo 'myLayout.sizePane("north", 230);';

                }
                ?>

            }
            $('div.ui-layout-north').css('overflow', 'hidden');

            $("#startDate").datepicker({
                defaultDate: new Date(),
                changeMonth: true
            });
            $("#endDate").datepicker({
                defaultDate: "+0d",
                changeMonth: true
            });

            $("#navigation").on('click', 'div.hitarea', function () {
                changeTreeNode($(this).parent('div'));
            });

            $("#navigation").on('click', 'a', function () {
                var div = $(this).parent('div');
                var mid = div.attr('mid');
                var path = div.attr('path');
                loadReportList(mid, path);
            });

            loadTree(UserId, UserPath, function () {
                loadReportList(UserId, UserPath);
            });

            $('#btnFind').click(function () {
                var mid = $('#txtMemId').val();
                if (mid) {
                    loadTree(UserId, UserPath, function () {
                        loadReportList(mid, '');
                    });
                }
                else {
                    loadTree(UserId, UserPath, function () {
                        loadReportList(UserId, UserPath);
                    });
                }
            });

            $('#txtMemId').keydown(function (event) {
                if (event.keyCode == 13) {
                    $('#btnFind').click();
                    event.preventDefault();
                    return false;
                }
            });

            $('#btnReset').click(function () {
                $('#txtMemId').val('');
                $('#selMoney').val(DefaultCurrency);
                $('#selWtids').val('');
                $('#selStatus').val('Y');

                var mid = $('#hdMemId').val();
                var path = $('#hdPath').val();
                loadReportList(mid, path);
            });

            $('#divMenu').on('click', 'a[path]', function (event) {
                var mid = $(this).text();
                var path = $(this).attr('path');
                loadReportList(mid, path);

                event.preventDefault();
                return false;
            });


            $('#table1').on('click', 'img#imgReturn', function () {
                var pid = $(this).attr('pid');
                var mid = $(this).attr('mid');

                if (pid == mid) {
                    selme = '1';
                }

                var path = $(this).attr('path');
                loadReportList(pid, path);
            });


            $('#tableList').on('click', 'a[mid]', function () {
                var mid = $(this).attr('mid');
                var path = $(this).attr('path');
                loadReportList(mid, path);
            });

            $('#selMoney,#selWtids,#selStatus,#selCatID').change(function () {
                var mid = $('#hdMemId').val();
                var path = $('#hdPath').val();
                loadReportList(mid, path);
            })

            ///個人
            $('#chkGxd_2').change(function () {
                var checked = $(this).prop('checked');
                if (checked) {
                    $('#tableList').find('td[pname*="Gxd_1"]').hide();
                    for (var oid = 0; oid < 6; oid++) {
                        if ($('#chk_L' + oid).prop('checked')) {
                            $('#tableList').find('th[pname*="L' + oid + '"],td[pname*="L' + oid + 'Gxd_2"]').hide();
                        }
                        else {
                            $('#tableList').find('th[pname*="L' + oid + '"],td[pname*="L' + oid + 'Gxd_2"]').show();
                        }
                    }
                }
                else {
                    $('#tableList').find('td[pname*="Gxd_2"]').hide();
                    for (var oid = 0; oid < 6; oid++) {
                        if ($('#chk_L' + oid).prop('checked')) {
                            $('#tableList').find('th[pname*="L' + oid + '"],td[pname*="L' + oid + 'Gxd_1"]').hide();
                        }
                        else {
                            $('#tableList').find('th[pname*="L' + oid + '"],td[pname*="L' + oid + 'Gxd_1"]').show();
                        }
                    }
                }
                for (var oid = 0; oid < UserOrderId; oid++) {
                    $('#tableList').find('th[pname*="L' + oid + '"],td[pname*="L' + oid + '"]').hide();
                }
            });

            $('#phide input[type="checkbox"]').change(function () {
                if (POrderId < 6) {
                    $('#chkGxd_2').change();
                }
                else {
                    hideTickCols();
                }
            });

            for (var i = 0; i < UserOrderId; i++) {
                $('#span_L' + i).hide();
                $('#tableList').find('th[pname*="L' + i + '"],td[pname*="L' + i + '"]').hide();
            }
        });

        function changeTreeNode(div) {

            var li = div.parent('li');
            var ul = li.find('ul:first');
            var span = li.find('div.hitarea:first');
            var collap = li.hasClass("collapsable"); //展开状态,
            if (collap) {
                ul.hide();
                li.attr('class', li.attr('class').replace('collapsable', 'expandable').replace('Collapsable', 'Expandable'));
                span.attr('class', span.attr('class').replace('collapsable', 'expandable').replace('Collapsable', 'Expandable'));
                return;
            }
            var mid = div.attr('mid');
            var path = div.attr('path');
            loadTree(mid, path);
        }

        function loadTree(mid, path, succFun) {
            var div = $('#navigation li div[path="' + path + '"]:first');
            var li = div.parent('li');
            var ul = li.find('ul:first');
            var span = div.find('div.hitarea:first');
            var orderId = parseInt(div.attr('oid'));
            if (orderId == 6) {
                li.attr('class', li.attr('class').replace('expandable', 'collapsable').replace('Expandable', 'Collapsable'));
                span.attr('class', span.attr('class').replace('expandable', 'collapsable').replace('Expandable', 'Collapsable'));
                //loadTicketList(mid,path);
                return;
            }
            var load = div.attr('load'); //避免重複加載
            if (load) {
                return;
            }
            div.attr('load', '1');
            span.addClass('placeholder');
            ul = ul.empty();
            var option = getOption(mid, path, 'tree');
            $.ajax({
                url: 'List.ashx?r=' + Math.random(),
                type: 'POST',
                data: option,
                dataType: 'json',
                timeout: 10000,
                cache: false,
                async: true,
                beforeSend: function () {
                    //                span.addClass('placeholder');
                    //                ul = ul.empty();
                },
                success: function (redata) {
                    span.removeClass('placeholder');
                    div.removeAttr('load');

                    if (redata.Success != 1) {
                        alert(redata.Msg);
                        return;
                    }
                    var oid = redata.Data.OrderId;

                    POrderId = oid - 1;
                    var list = redata.Data.List;
                    var length = list.length;

                    //alert('1111111');

                    var liClass = '';
                    var divClass = '';
                    if (length > 0) {
                        var itemhtml = null;
                        for (var i = 0; i < length; i++) {
                            liClass = '';
                            divClass = '';
                            if (i == length - 1) {
                                liClass = 'lastExpandable';
                                divClass = 'lastExpandable-hitarea';
                            }
                            itemhtml = '<li class="expandable ' + liClass + '"><div class="item" oid = "' + oid + '" mid="' + list[i].MemID + '" path="' + list[i].Path
                            + '"><div class="hitarea expandable-hitarea ' + divClass + '"></div><a>' + list[i].MemID + '</a></div><ul></ul></li>';
                            if (oid == 6) {
                                itemhtml = itemhtml.replace(/expandable/g, 'collapsable').replace(/Expandable/g, 'Collapsable');
                            }
                            ul.append($(itemhtml));
                        }
                        ul.show();
                    }
                    else {
                        ul.hide();
                    }

                    li.attr('class', li.attr('class').replace('expandable', 'collapsable').replace('Expandable', 'Collapsable'));
                    span.attr('class', span.attr('class').replace('expandable', 'collapsable').replace('Expandable', 'Collapsable'));

                    if (succFun) {
                        succFun();
                    }
                },
                complete: function () {
                    span.removeClass('placeholder');
                    div.removeAttr('load');
                },
                error: function () {
                    //                    setTimeout(function () {
                    //                        loadTree(mid, path);
                    //                    }, 1000);
                }
            });
        }

        function showLoading(show) {
            if (show) {
                $('#imgListLoading').show();
                $('#imgReturn').hide();
            } else {
                $('#imgListLoading').hide();
                $('#imgReturn').show();
            }
        }

        ///加載報表
        function loadReportList(mid, path) {
            
            var load = $('#tbodyList').attr('load'); //避免重複加載
            if (load) {
                return;
            }
            var option = getOption(mid, path, 'list');

            $('#navigation a').css({ 'color': '' });
            $('#navigation li div[mid="' + mid + '"] a:first').css({ 'color': 'red' });

            $('#tbodyList').attr('load', '1');

            $.ajax({
                url: 'List.ashx?r=' + Math.random(),
                type: 'POST',
                data: option,
                dataType: 'json',
                timeout: 30000,
                cache: false,
                async: true,
                beforeSend: function () {
                    $('#tbodyList').empty();
                    //$('#imgListLoading').show();

                    showLoading(true);
                },
                success: function (redata) {
                    $('#tbodyList').removeAttr('load');
                    showLoading(false);

                    if (redata.Success != 1) {
                        alert(redata.Msg);
                        return;
                    }
                    //alert('loadReportList 2');
                    var orderId = redata.Data.OrderId;
                    if (orderId > 6) {
                        createTicketList(redata);
                        return;
                    }

                    var jsonList = redata.Data.List;
                    var jsonLength = jsonList.length;
                    createMuen(redata.Data.PathList);

                    if (jsonLength <= 0) {  //顯示沒有數據
                        var size = $('#tableList>thead>tr th').size();
                        var tr = $('<tr class="dataBgHistory"><td>沒有數據</td></tr>');
                        tr.find('td').attr('colspan', size);
                        $('#tbodyList').append(tr);
                        return;
                    }

                    $('#ticketTable').hide();
                    $('#tableList').show();
                    $('#LevelName').html(redata.Data.LevelName);
                    POrderId = orderId - 1;

                    var trTemp = '<tr class="dataBgHistory">'
                    + '<td class="MemID" pname="MemID"><a></a></td>'
                    + '<td pname="MemName" class="right MemName"></td>'
                    + '<td class="right BetCount"></td>'
                    + '<td class="right SysAmount money"><a></a></td>'
                    + '<td class="right EffectiveAmount money"></td>'
                    + '<td class="right Results color money" ></td>'
                    + '<td class="right Hyqt color money"></td>'
                    + '<td class="right L5Gxd color money" pname="L5Gxd_1"></td>'
                    + '<td class="right L4Gxd color money" pname="L4Gxd_1"></td>'
                    + '<td class="right L3Gxd color money" pname="L3Gxd_1"></td>'
                    + '<td class="right L2Gxd color money" pname="L2Gxd_1"></td>'
                    + '<td class="right L1Gxd color money" pname="L1Gxd_1"></td>'
                    + '<td class="right L0Gxd color money" pname="L0Gxd_1"></td>'
                    + '<td class="right hide L5Gxd_2 color money" pname="L5Gxd_2"></td>'
                    + '<td class="right hide L4Gxd_2 color money" pname="L4Gxd_2"></td>'
                    + '<td class="right hide L3Gxd_2 color money" pname="L3Gxd_2"></td>'
                    + '<td class="right hide L2Gxd_2 color money" pname="L2Gxd_2"></td>'
                    + '<td class="right hide L1Gxd_2 color money" pname="L1Gxd_2"></td>'
                    + '<td class="right hide L0Gxd_2 color money" pname="L0Gxd_2"></td>'
                    + '<td class="right Shl blue money"></td>'
                    + '<td class="right ShlPer blue"></td>'
                    + '<td class="right Gxd red money" ></td>'
                    + '<td class="right GxdPer red"></td>'
                    + '<td class="right share S1Share"></td><td class="right share S3Share"></td><td class="right share S2Share"></td><td class="right share S10Share"></td><td class="right share S5Share"></td><td class="right share S4Share"></td><td class="right share S7Share"></td><td class="right share S8Share"></td><td class="right share S9Share"></td><td class="right share S11Share"></td><td class="right share S12Share"></td><td class="right share S6Share"></td>'
                    + '</tr>';
                    for (var i = 0; i < jsonLength; i++) {
                        var tr = $(trTemp);
                        $('#tbodyList').append(tr);
                        var data = jsonList[i];

                        if (data['S10Share'] && data['S10Share'] >= 95) {   //韓棒 佔成大於等於95 底色淡綠
                            tr.find('td').css({ 'background-color': '#C4F6CC' });
                        }
                        if (data['A1MemID'] == '000') {   //特帳00底色淡黃
                            tr.find('td').css({ 'background-color': '#ffe1bb' });
                        }

                        for (var p in data) {
                            var td = tr.find('td.' + p);
                            if (td.size() == 0) {
                                continue;
                            }
                            var pval = data[p];
                            if (p == 'MemID' || p == 'SysAmount') {
                                td.find('a').text(pval).attr('oid', orderId).attr('mid', data['MemID']).attr('path', data["Path"]);
                            }
                            else if (p == 'ShlPer' || p == 'GxdPer') {
                                td.text(pval + '%');
                            }
                            else {
                                if (td.hasClass('color')) {
                                    if (pval < 0) {
                                        td.css('color', loseColor);
                                    }
                                    else if (pval > 0) {
                                        td.css('color', winColor);
                                    }
                                }
                                td.html(pval);
                            }
                        }
                        if (i == jsonLength - 1) {
                            tr.addClass('total').find('td.MemID').html(calTotal);
                            tr.find('td.SysAmount').html(data['SysAmount']);
                            tr.find('td.share').html('');
                        }
                    }
                    selme = '';

                    $('#spanGxd_2').show();
                    $('#chkGxd_2').change();
                },
                complete: function (xhr) {
                    //$('#imgListLoading').hide();

                    showLoading(false);

                    $('#tbodyList').removeAttr('load');
                    $('#hdMemId').val(option.mid);
                    $('#hdPath').val(option.path);
                    //$('#txtMemId').val('');
                },
                error: function () {
                    //                    setTimeout(function () {
                    //                        loadReportList(mid, path);
                    //                    }, 1000);
                }
            });
        }

        function createMuen(pathList) {
            var length = pathList.length;
            //alert('createMuen');
       
            $('#divMenu').empty();
            for (var i = 0; i < length; i++) {
                var list = pathList[i];
                var div = $('<div class="nvareport" ></div>');
                $('#divMenu').append(div);
                for (var j = 0; j < list.length; j++) {
                    if (list[j].MemID) {
                        if (j > 0) {
                            div.append('→');
                        }
                        div.append('<a path="' + list[j].Path + '">' + list[j].MemID + '</a>');
                    }
                }
            }

            if (length > 0) {
                //移桶可能有问题？
                var pathLength = pathList[0].length;
                if (pathLength > 1) {
                    $('#imgReturn').attr('path', pathList[0][pathLength - 2].Path);
                    $('#imgReturn').attr('pid', pathList[0][pathLength - 2].MemID);
                    $('#imgReturn').attr('mid', pathList[0][pathLength - 1].MemID);
                }
                else {
                    $('#imgReturn').attr('path', pathList[0][pathLength - 1].Path);
                    $('#imgReturn').attr('pid', pathList[0][pathLength - 1].MemID);
                    $('#imgReturn').attr('mid', pathList[0][pathLength - 1].MemID);
                }
            }
            //alert('createMuen 2');
        }

        function getOption(mid, path, type) {
            var d1 = $('#startDate').val();
            var d2 = $('#endDate').val();
            if (rptype == 1) {
                d2 = d1;
            }
            var wtids = $('#selWtids').val();
            var statusType = $('#selStatus').val();
            var myType = $('#selMoney').val();
            if (!mid) {
                mid = $('#hdMemId').val();
                if (!mid) {
                    mid = UserId;
                }
            }
            var catId = $('#selCatID').val();

            var option = { uid: UserId, mid: mid, type: type, d1: d1, d2: d2, wtids: wtids, statusType: statusType, 
            myType: myType,catId: catId, finished: finished, path: path, self: selme };
            return option;
        }

        ///加載 ticket 
        function loadTicketList(mid, path) {
            var load = $('#ticketBody').attr('load'); //避免重複加載
            if (load) {
                return;
            }
            $('#ticketBody').attr('load', '1');
            //$('#imgListLoading').show();

            showLoading(true);
            var option = getOption(mid, path, 'ticket');

            $.ajax({
                url: 'List.ashx?r=' + Math.random(),
                type: 'POST',
                data: option,
                dataType: 'json',
                timeout: 30000,
                cache: false,
                async: true,
                beforeSend: function () {
                    $('#ticketBody').empty();
                },
                success: function (redata) {
                    //$('#imgListLoading').hide();
                    showLoading(false);
                    if (redata.Success != 1) {
                        alert(redata.Msg);
                        return;
                    }
                    createTicketList(redata);
                },
                complete: function (xhr) {
                    // alert('complete');
                    //$('#imgListLoading').hide();
                    showLoading(false);
                    $('#ticketBody').removeAttr('load');
                    $('#hdMemId').val(option.mid);
                    $('#hdPath').val(option.path);
                },
                error: function () {
//                    setTimeout(function () {
//                        $('#ticketBody').removeAttr('load');
//                        loadTicketList(mid, path);
//                    }, 1000);
                }
            });
        }

        function createTicketList(redata) {
            $('#ticketBody').empty();
            $('#ticketTable').show();
            $('#tableList').hide();
            createMuen(redata.Data.PathList);
            var jsonList = redata.Data.List;
            var jsonLength = jsonList.length;
            POrderId = redata.Data.OrderId - 1;
            var trTemp = '<tr class="dataBgHistory"><td class="" pname="TicketTime" ></td>'
                    + '<td class="" pname="TicketID"></td><td class=""  pname="Descn"  style="text-align: left;letter-spacing: -1px"></td>'
                    + '<td pname="SysAmount" class="money"></td><td class="money" pname="EffectiveAmount"></td><td class="money" pname="RetAmtTotal"></td><td class="money" pname="Results"></td>'
                    + '<td class="" pname="XFL">0</td><td class="money" pname="L5Amt"></td><td class="money" pname="L4Amt"></td><td class="money" pname="L3Amt"></td>'
                    + '<td class="money" pname="L2Amt"></td><td class="money" pname="L1Amt"></td><td class="money" pname="L0Amt"></td><td class="" pname="ShrPer"></td><td class="" pname="device"></td></tr>';
            var html;
            var grpTypeName = '過關';
            for (var i = 0; i < jsonLength; i++) {
                var tr = $(trTemp);
                $('#ticketBody').append(tr);
                var tds = tr.find('td');
                var data = jsonList[i];
                var descnList = data.DescnList;
                $.each(tds, function (index, t) {
                    var td = $(this);
                    var pname = td.attr('pname');
                    if (pname == 'TicketID' && i < jsonLength - 1) {
                        var wtdesc = descnList[0]["WagerTypeDesc"];
                        if (data['WagerGrpID'] == 1) {    //如果是过关
                            wtdesc = grpTypeName;
                        }
                        var descn = wtdesc + '<br/>' + data['TicketID'] + '<br/>[' + data['BetIP'] + ']';
                        if (data['tkType'] > 0 && data['tkTypeDesc'])
                        {
                            descn += '<br/><span style="color:red;"> ' + data['tkTypeDesc'] + '</span>';
                            tr.find('td').css({ 'background-color': '#ffd5d5' });
                        }
                        td.html(descn);
                    }
                    else if (pname == 'Descn' && i < jsonLength - 1) {
                        html = '';
                        for (var d = 0; d < descnList.length; d++) {
                            var descn = descnList[d];
                            html += descn["Line1"] + descn["Line2"] + descn["Line3"] + descn["Line4"];
                            if (d < descnList.length - 1) {
                                html += "<hr />";
                            }
                        }
                        td.html(html);
                    }
                    else if (pname == 'ShrPer' && i < jsonLength - 1) {
                        html = '';
                        for (var oid = 5; oid >= 0; oid--) {
                            if (oid >= UserOrderId) {
                                html += data['L' + oid + pname] + '/';
                            }
                            else {
                                html += '-/';
                            }
                        }
                        if (html.length > 0) {
                            html = html.substring(0, html.length - 1);
                        }
                        td.html(html);
                    }
                    else {
                        if (data[pname] < 0) {
                            td.css('color', loseColor);
                        }
                        else if (data[pname] > 0) {
                            td.css('color',  winColor);
                        }
                        td.html(data[pname]);
                    }
                });
                if (i == jsonLength - 1) {
                    tr.addClass('total').find('td[pname="Descn"]').text(calTotal).height(30); 
                    tr.find('td[pname="TicketID"]').html('');
                }
            }
            $('#spanGxd_2').hide();
            hideTickCols();
        }

        function hideTickCols() {
            //是否隱藏域
            for (var oid = 0; oid < 6; oid++) {
                if ($('#chk_L' + oid).prop('checked')) {
                    $('#ticketTable').find('th[pname*="L' + oid + '"],td[pname*="L' + oid + '"]').hide();
                }
                else {
                    $('#ticketTable').find('th[pname*="L' + oid + '"],td[pname*="L' + oid + '"]').show();
                }
            }
            //根據賬號隱藏
            for (var oid = 0; oid < UserOrderId; oid++) {
                $('#ticketTable').find('th[pname*="L' + oid + '"],td[pname*="L' + oid + '"]').hide();
            }
        }


        Date.prototype.format = function (format) {
            var date = {
                "M+": this.getMonth() + 1,
                "d+": this.getDate(),
                "h+": this.getHours(),
                "m+": this.getMinutes(),
                "s+": this.getSeconds(),
                "q+": Math.floor((this.getMonth() + 3) / 3),
                "S+": this.getMilliseconds()
            };
            if (/(y+)/i.test(format)) {
                format = format.replace(RegExp.$1, (this.getFullYear() + '').substr(4 - RegExp.$1.length));
            }
            for (var k in date) {
                if (new RegExp("(" + k + ")").test(format)) {
                    format = format.replace(RegExp.$1, RegExp.$1.length == 1
                            ? date[k] : ("00" + date[k]).substr(("" + date[k]).length));
                }
            }
           
            return format;
        }

        Date.prototype.addDays = function (d) {
            this.setDate(this.getDate() + d);
        };

        //    var addNDays = function (date, n) {
        //        var time = date.getTime();
        //        var newTime = time + n * 24 * 60 * 60 * 1000;
        //        return new Date(newTime);
        //    };


   
    </script>

        </div>
    </div>
    </form>
</body>
</html>
