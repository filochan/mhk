<body id="loginPage">
    <form method="post" action="<?php echo base_url('welcome/logincheck'); ?>" >
        <div class=""  style="background-image('<?php echo base_url('assets/images/login_bg.jpg'); ?>');">
        </div>


        <div class="" >
            <input type="hidden" name="" id="" value="" />
        </div>
        <div id="content">
            <table id="loginTable">
                <thead>
                    <tr>
                        <td colspan="2">
                        </td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td width="35px">
                        </td>
                        <td>
                            <div class="fl lang">
                                <select name="" id="">
                                    <option selected="selected" value="zh-TW">繁體中文</option>
                                    <option value="zh-CN">简体中文</option>
                                    <option value="en">English</option>
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td width="35px">
                            <span id="lblUserName">帳號</span>
                        </td>
                        <td>
                            <input name="txtUserName" type="text" id="txtUserName" />
                            <span id="" style="visibility:hidden;">請輸入賬號</span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span id="lblPwd">密碼</span>
                        </td>
                        <td>
                            <input name="txtPwd" type="password" id="txtPwd" />
                            <span id="" style="visibility:hidden;">密碼不可為空白</span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        </td>
                        <td class="ButtonCell">
                            <div style="vertical-align: middle">
                                <button id="ButtonLogin" class="login_button" style="display:inline-block;background-color:Transparent;text-decoration:none;height:22px;width:62px;margin:0 0 0 57px;padding-top:0px;" >登入</button>
                            </div>
                            <br />
                            <span id="ErrMsg" style="color:Red;font-size:10pt;"></span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <span id="lbltt3"></span>
                            <br />
                            <a href="https://www.google.com.tw/chrome/browser/desktop/index.html" target="_blank" style="color:#999; text-decoration:none;">
                            <span id="lbltt4">＊此系統推薦使用Google瀏覽器 下載請按此</span></a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

