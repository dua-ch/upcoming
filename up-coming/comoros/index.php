    <?php
    require('../system/config.php');
    $page_info = array(
        'page' => 'home',
        'page_nohome' => 1,
    );
    $usersCount = 0;
    $delay = time() - 30;
    $vp = '?time='.time();
    $mSql = $mysqli->query("SELECT * FROM boom_users WHERE last_action > '$delay'");
    if ($mSql->num_rows > 0) {
        while ($s = $mSql->fetch_assoc()) {
            $usersCount++;
        }
    }
    if (boomLogged()) {
        header('location: ../');
        exit;
    }
    ?>
    <!doctype html>
    <html lang="en">

    <head>
        <link rel="shortcut icon" type="image/png" href="/default_images/icon.png<?php echo $vp ?>" />
        <link rel="apple-touch-icon" href="/default_images/icon.png<?php echo $vp ?>" />
        <link rel="canonical" href="https://dandna.chat/" />
        <base href="https://dandna.chat/">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta property="og:title" content="شات جزر القمر | دردشة مصرية, شات مصر بدون تسجيل مجانًا">
        <meta property="og:description" content="غرفة دردشة مصرية دردش وتعرف على أصدقاء من القاهرة والإسكندرية وغيرها في مدينة مصر محدثات جماعية كتابية بدون تحميل جافا أو برامج من الجوال">
        <title>شات جزر القمر | دردشة مصرية, شات مصر بدون تسجيل مجانًا</title>
        <meta name="description" content="غرفة دردشة مصرية دردش وتعرف على أصدقاء من القاهرة والإسكندرية وغيرها في مدينة مصر محدثات جماعية كتابية بدون تحميل جافا أو برامج من الجوال">
        <meta content="شات جزر القمر , دردشة جزر القمر , شات جزر القمريين , شات بنات جزر القمر , comoros chat" name="keywords">
    </head>
    <style>
        * {
            margin: 0;
            padding: 0
        }

        a {
            text-decoration: none
        }

        body {
            background: #fff
        }

        .header {
            background-color: #1895d2;
            direction: rtl;
            padding: 5px 0
        }

        .header>a {
            color: #fff;
            text-decoration: none;
            font: 30px 'Segoe UI', Tahoma;
            padding: 5px 10px
        }

        .header a:hover {
            background: #2a6082
        }

        .header b {
            color: lavender;
            font: 16px 'Segoe UI'
        }

        .nav {
            background: rgba(55, 124, 168, 0.13);
            text-align: center
        }

        .nav a {
            padding: 10px 0;
            width: 140px;
            color: steelblue;
            font: 16px 'Segoe UI', Tahoma;
            border-left: 1px solid rgba(55, 124, 168, 0.2);
            display: inline-block
        }

        .nav a:hover {
            background: #f1f1f1
        }

        .nav a:first-child {
            border-left: none
        }

        .main {
            margin: 15px auto;
            text-align: center
        }

        .left {
            display: inline-table;
            vertical-align: top;
            width: 160px;
        }

        .midd {
            display: inline-table;
            vertical-align: top;
            width: 728px
        }

        .right {
            display: inline-table;
            vertical-align: top;
            width: 160px;
        }

        .room {
            margin: 0 auto 15px;
            text-align: center;
            border: 1px solid lavender;
            background: #f9f9f9
        }

        .room h3 {
            background: #E3F0F7;
            color: steelblue;
            padding: 5px 0;
            font: bold 18px 'Segoe UI', Tahoma
        }

        .room p {
            font: 16px 'Segoe UI', Tahoma;
            margin: 5px;
            color: #0069b4;
            line-height: 1.8
        }

        .right ul {
            background: #f9f9f9;
            padding: 0 5px;
            direction: rtl;
            list-style: none;
            font-family: 'Segoe UI', tahoma;
            margin-bottom: 10px;
            text-align: right;
            border: 1px solid #1895d2
        }

        .right li {
            font-size: 18px;
            line-height: 33px;
            border-bottom: 1px solid lightsteelblue;
            color: #0069b4;
            padding: 0 5px
        }

        .right .li {
            font-size: 14px;
            margin-right: 5px;
        }

        .li:last-child {
            border: none
        }

        .rads {
            margin: 5px auto 0;
            text-align: center
        }

        .foot {
            margin: auto;
            border-bottom: 1px solid #EEE;
            text-align: center
        }

        .foot nav {
            display: inline-block;
            margin: 5px 30px;
            text-align: right;
            vertical-align: top
        }

        .foot nav a {
            display: block;
            text-decoration: none;
            font: 14px 'Segoe UI', Tahoma;
            padding: 2px 0
        }

        .copy {
            margin: 15px auto;
            text-align: center;
            font: 14px 'Segoe UI', Tahoma
        }

        h1 {
            background: #1895d2;
            font: normal 24px 'Segoe UI', Tahoma;
            text-align: center;
            color: #FFF;
            padding-bottom: 5px
        }

        h2 {
            text-align: center;
            background: #f9f9f9;
            color: #06F;
            font: 16px 'Segoe UI';
            padding: 10px;
            margin: 20px 5px 15px
        }

        @media screen and (max-width: 480px) {

            .right,
            .left {
                display: none
            }

            .room {
                width: auto
            }

            .foot nav a {
                display: none
            }

            .midd {
                margin: auto;
                text-align: center;
                float: none;
                width: auto
            }
        }

        .error {
            display: block;
            margin-bottom: 15px;
            padding: 5px 10px;
            font: 16px 'Segoe UI';
            direction: rtl;
            background: darksalmon;
            color: maroon;
            border-radius: 5px;
            display: none;
        }

        .login {
            display: block;
            background: #f9f9f9;
            width: 336px;
            border: 1px solid lavender;
            vertical-align: top;
            margin-bottom: 15px
        }

        .login .top {
            display: table;
            margin: 15px auto
        }

        #guest_username,
        #member_username,
        #member_password {
            width: 240px;
            padding: 5px;
            text-align: center;
            font: 24px 'Segoe UI';
            border: 1px solid #ddd;
            margin-right: 3px
        }

        .gendiv {
            display: table;
            margin: 0 auto 20px
        }

        .malediv {
            float: left;
            margin-right: 10px
        }

        .femalediv {
            float: right;
            margin-left: 10px
        }

        label:hover {
            cursor: pointer;
            height: 80px;
            background: #EEE
        }

        .male {
            color: #0066FF
        }

        .female {
            color: #EE1133
        }

        .gendiv b {
            font: bold 30px Tahoma
        }

        .gendiv span {
            font: 30px 'Segoe UI', Tahoma
        }

        input[type=submit] {
            display: block;
            margin: 10px auto;
            font: 26px 'Segoe UI';
            background: #377ca8;
            color: #fff;
            padding: 5px 25px;
            border: 1px solid #2a6082;
            border-radius: 10px;
        }

        input[type=submit]:hover {
            background: #195B86;
            cursor: pointer
        }

        .btn {
            display: table;
            margin: 10px auto 5px;
            color: #fff;
            background: #377ca8;
            padding: 3px 8px;
            border-radius: 5px;
            font: 18px 'Segoe UI';
            border: 0;
            cursor: pointer;
        }

        #guest_box,
        #member_box {
            display: none;
        }

        #guest_btn,
        #guest_submit_btn {
            background: #f97360;
        }

        .room b {
            background: #18d418;
            border-radius: 50%;
            color: #18d418
        }

        .room u {
            text-decoration: none
        }

        .room span {
            display: inline-block;
            color: green;
            padding-left: 25px;
        }
    </style>

    <body>
        <div class="header">
            <a href="https://dandna.chat">شات دندنة</a>
            <b>دردشة عربية مجانية بدون تسجيل</b>
        </div>
        <nav class="nav">
            <a href="https://dandna.chat">الرئيسية</a>
            <a href="https://dandna.chat/privacy.php">سياسة الخصوصية</a>
            <a href="https://dandna.chat/terms.php">شروط الاستخدام</a>
        </nav>
        <div class="main">
            <div class="midd">
                <div class="error" id="error"></div>
                <div class="login" id="guest_box">
                    <form method="post" id="guest_form" action="">
                        <div class="top">
                            <input type="text" id="guest_username" maxlength="50" placeholder="الإسم المستعار" value="" autocomplete="off">
                        </div>
                        <div class="gendiv">
                            <div class="malediv">
                                <input id="male" type="radio" name="gender" value="1" checked>
                                <label for="male" class="male"><span class="male">ذكر</span><b>♂</b></label>
                            </div>
                            <div class="femalediv">
                                <input id="female" type="radio" name="gender" value="2">
                                <label for="female" class="female"><span class="female">أنثى</span><b>♀</b></label>
                            </div>
                        </div>
                        <input type="submit" name="sub" value="دخول" id="guest_submit_btn">
                    </form>
                </div>
                <div class="login" id="member_box">
                    <form method="post" id="member_form" action="">
                        <div class="top">
                            <input type="text" id="member_username" maxlength="50" placeholder="الإسم المستعار" value="" autocomplete="off">
                        </div>
                        <div class="top">
                            <input type="password" id="member_password" maxlength="30" placeholder="كلمة المرور" value="" autocomplete="off">
                        </div>
                        <input type="submit" name="sub" value="دخول" id="member_submit_btn">
                    </form>
                </div>
                <div class="room">
                    <h3>شات جزر القمر</h3>
                    <p>قابل اصدقاء جدد من شات جزر القمر ، مجانا وبدون تسجيل</p>
                    <span><u>(<?php echo $usersCount; ?>)</u><i> المتواجدون </i><b>(.)</b></span>
                    <button class="btn" id="guest_btn">دخول الزوار</button>
                    <button class="btn" id="member_btn">دخول الأعضاء</button>
                </div>
            </div>
        </div>
        <h2>غرفة دردشة مصرية دردش وتعرف على أصدقاء من القاهرة والإسكندرية وغيرها في مدينة مصر محدثات جماعية كتابية بدون
            تحميل جافا أو برامج من الجوال</h2>
        <div class="foot">
            <nav>
                <a href="https://dandna.chat/chat-algeria/">شات الجزائر</a>
<a href="https://dandna.chat/chat-bahrain/">شات البحرين</a>
<a href="https://dandna.chat/chat-emirates/">شات الامارات</a>
<a href="https://dandna.chat/chat-jordan/">شات الاردن</a>
<a href="https://dandna.chat/chat-kuwait/">شات الكويت</a>
</nav>
<nav>
<a href="https://dandna.chat/chat-libya/">شات ليبيا</a>
<a href="https://dandna.chat/chat-tunisia/">شات تونس</a>
<a href="https://dandna.chat/maroc/">شات المغرب</a>
<a href="https://dandna.chat/oman/">شات عمان</a>
<a href="https://dandna.chat/sudan/">شات السودان</a>
</nav>
<nav>
<a href="https://dandna.chat/palestine/">شات فلسطين</a>
<a href="https://dandna.chat/qatar/">شات قطر</a>
<a href="https://dandna.chat/comoros/">شات جزر القمر</a>
<a href="https://dandna.chat/yemen/">شات اليمن</a>
<a href="https://dandna.chat/jibouti/">شات جيبوتي</a>
</nav>
<nav>
<a href="https://dandna.chat/egypt/">شات مصري</a>
<a href="https://dandna.chat/saudi/">شات السعودية</a>
<a href="https://dandna.chat/chat-lebanon/">شات لبنان</a>
<a href="https://dandna.chat/syria/">شات سوريا</a>
<a href="https://dandna.chat/chat-iraq/">شات العراق</a>
            </nav>
        </div>
        <p class="copy"><span>&copy; شات دندنة | dandna.chat</span></p>
        <script>
            var system = {
                error: "حدث خطأ ما",
                badLogin: "اسم المستخدم أو كلمة مرور خاطئة",
                invalidUsername: "المرجو إدخال [ أسم صالح ] لدخول الدردشة.",
                usernameExist: "اسم المستخدم محجوز مسبقا",
                maxReg: "لقد وصلت للحد المسموح للتسجيل لهذا اليوم",
                missingRecaptcha: "يرجى ملء نموذج reCAPTCHA أدناه",
            };

            function xhr(url, params, callback) {
                var http = new XMLHttpRequest();
                http.open('POST', url, true);
                http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                http.onreadystatechange = function() {
                    if (http.readyState == 4 && http.status == 200) {
                        callback.call(null, http.responseText);
                    }
                }
                http.send(params);
            }

            function e(id) {
                return document.getElementById(id);
            }

            function err(text) {
                e('error').style.display = 'block';
                e('error').innerText = text;
            }

            function clearerr() {
                e('error').style.display = '';
                e('error').innerText = '';
            }
            document.addEventListener('DOMContentLoaded', function() {
                e('member_btn').addEventListener('click', function() {
                    clearerr();
                    e('guest_box').style.display = 'none';
                    e('member_box').style.display = 'inline-block';
                    document.getElementsByClassName('header')[0].scrollIntoView();
                });
                e('guest_btn').addEventListener('click', function() {
                    clearerr();
                    e('guest_box').style.display = 'inline-block';
                    e('member_box').style.display = 'none';
                    document.getElementsByClassName('header')[0].scrollIntoView();
                });
                e('guest_form').addEventListener('submit', function() {
                    event.preventDefault();
                    var guest_name = e('guest_username').value;
                    var guest_gender = e('male').checked ? 1 : 2;
					var guest_age = '0';
                    clearerr();
                    xhr('system/guest_login.php', 'guest_name=' + encodeURIComponent(guest_name) +
                        '&guest_gender=' + guest_gender + '&guest_age='+guest_age,
                        function(r) {
                            if (r == 4) {
                                err(system.invalidUsername);
                                e('guest_username').value = '';
                            } else if (r == 5) {
                                err(system.usernameExist);
                                e('guest_username').value = '';
                            } else if (r == 6) {
                                err(system.missingRecaptcha);
                            } else if (r == 16) {
                                err(system.maxReg);
                            } else if (r == 14) {
                                err(system.error);
                            } else if (r == 666) {
                                err('Banned IP!');
                            } else if (r == 1) {
                                window.location.replace("https://dandna.chat/");
                            } else {
                                err(system.error);
                            }
                        });
                });
                e('member_form').addEventListener('submit', function() {
                    event.preventDefault();
                    var username = e('member_username').value;
                    var password = e('member_password').value;
                    clearerr();
                    xhr('system/guest_login.php', 'username=' + encodeURIComponent(username) + '&password=' +
                        encodeURIComponent(password),
                        function(r) {
                            if (r == 1) {
                                err(system.badLogin);
                                e('member_username').value = '';
                                e('member_username').value = '';
                            } else if (r == 2) {
                                err(system.badLogin);
                                e('guest_username').value = '';
                                e('member_password').value = '';
                            } else if (r == 3) {
                                window.location.replace("https://dandna.chat/");
                            } else {
                                err(system.error);
                            }
                        });
                });
            });
        </script>

    </body>

    </html>