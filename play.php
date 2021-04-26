<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" charset="utf-8">
    <meta name="google" content="notranslate">
    <title>Bobr RP | Начать играть</title>
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/play.css?<?=time();?>">
    <link rel="stylesheet" href="css/adaptive_play.css?<?=time();?>">
</head>


<body>
    <div class="round_one"></div>
    <div class="round_two"></div>
    <div class="bg"></div>
    <header>
        <div class="container">
            <div class="heading">
                <a class="logo__text" href="index.php">
                    <div class="l__text clearfix">
                        <p class="BOBR">BOBR</p>
                        <p class="ROLEPLAY">ROLEPLAY</p>
                    </div>
                    <img src="img/logo.png" alt="">
                </a>
                <span class="lnr lnr-menu"></span>
                <div class="menu">
                    <a class="st_btn btn__main__page" href="index.php">Главная</a>
                    <a class="button_play" href="play.php">Начать играть</a>
                    <a class="st_btn donate_link" href="donate.php">Донат</a>
                    <a class="st_btn" href="https://forum.mtabobr.ru/">Форум</a>
                    <a class="st_btn" href="about.php">О проекте</a>
                </div>
            </div>
        </div>
    </header>
    <section style="height: 799px;">
        <div class="container clearfix">
            <div class="left_content video_container">
                <iframe src="https://www.youtube.com/embed/VH6fpmVQGs0" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                <div class="txt_right">
                    <h1>Начать игру - легко!</h1>
                    <p>Достаточно посмотреть видео</p>
                </div>
            </div>
            <div class="left_content download_container">
                <img src="/img/launcher.png" alt="Лаунчер">
                <div class="txt_right2">
                    <h1>Скачайте наш лаунчер</h1>
                    <div class="buttons_download">
                        <a class="google" href="#">Google Drive</a>
                        <a class="yandex" href="#">Яндекс Диск</a>
                        <a class="torrent" href="#">Torrent</a>
                    </div>
                </div>
            </div>
            <div class="left_content setup_container">
                <h1>Пройдите легкую установку</h1>
                <img src="/img/setup.png" alt="Установщик">
            </div>
            <div class="steps_container">
                <div class="number_step one">1</div>
                <div class="line_step line_one"></div>
                <div class="number_step two">2</div>
                <div class="line_step line_two"></div>
                <div class="number_step three">3</div>
            </div>
        </div>
    </section>
    <footer>
        <div class="container">
            <div class="footering clearfix">
                <div class="mouse_scroll">
                    <img src="img/mouse_scroll.png" alt="">
                    <p>Используйте колесико для прокрутки</p>
                </div>
                <div class="copyright">
                    <p>MTA BOBR 2020. Все права защищены.<br>Dev: Makeev</p>
                </div>
            </div>
        </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="js/jquery.mousewheel.js?<?=time();?>"></script>
    <script src="js/jquery.touchSwipe.min.js?<?=time();?>"></script>
    <script src="js/gam.js?<?=time();?>"></script>
    <script src="js/play.js?<?=time();?>"></script>
</body>

</html>