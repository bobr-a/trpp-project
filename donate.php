<?php

error_reporting(E_ALL);

include 'unitpay/config.php';
include 'unitpay/lib/UnitPayModel.php';
include 'unitpay/lib/UnitPay.php';

header('Content-Type: text/html; charset=utf-8');

class UnitPayEvent
{
    public function check($params)
    {
        try {
            $unitPayModel = UnitPayModel::getInstance();

            if ($unitPayModel->getAccountByName($params['account'])) {
                return true;
            }
            return 'Character not found';
        }catch(Exception $e){
            return $e->getMessage();
        }
    }

    public function pay($params)
    {
         $unitPayModel = UnitPayModel::getInstance();
         $countItems = floor($params['sum'] / Config::ITEM_PRICE);
         $unitPayModel->donateForAccount($params['account'], $countItems);
    }
}


function setupPage($login, $email, $sum, $result)
{
	$time = time();
	echo <<<HTML
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
		<meta http-equiv="Pragma" content="no-cache" />
		<meta http-equiv="Expires" content="0" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" charset="utf-8">
		<title>Bobr RP | Донат</title>
		<link rel="icon" href="img/favicon.ico" type="image/x-icon">
		<link rel="stylesheet" href="css/donate.css?{$time}">
		<link rel="stylesheet" href="css/adaptive_donate.css?{$time}">
		<script src="https://www.google.com/recaptcha/api.js"></script>
	</head>


	<body>
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
						<a class="btn__main__page" href="index.php">Главная</a>
						<a class="button_play" href="play.php">Начать играть</a>
						<a class="donate_link" href="donate.php">Донат</a>
						<a href="https://forum.mtabobr.ru/">Форум</a>
						<a href="about.php">О проекте</a>
					</div>
				</div>
			</div>
		</header>
		<section id="center">
			<div class="container clearfix">
				<div class="center__boody">
					<div class="text__donate">
						<p class="refill">Пополнение счета</p>
					</div>
					<div class="panel__oplata">
						<p>Курс обмена
							<span id="donate_value" style="margin-left:60px;">
								<span id="rubles">
									1
								</span>
								₽ =
								<span id="valute">
									1000
								</span>
							</span>
						</p>
					</div>
					<form id="signup-form" class='signup-form' action='https://mtabobr.online/donate' method="post" accept-charset="UTF-8">
						<div class="block_gray">
							<p class="bl_gray"></p>
							<div class="input_donate">
								<input id="login" name="account" placeholder="Введите логин" value="{$login}" type="text"
									required="Заполните это поле.">
								<input id="email" name="email" placeholder="Введите email" value="{$email}" type="email"
									required="Заполните это поле.">
								<input id="summ" name="sum" placeholder="Введите сумму" value="{$sum}" type="number" min="1" max="99999"
									required="Заполните это поле.">
							</div>
							<div class="checkbox">
								<p class="agreement">
									<input name="polit" id="polit" type="checkbox">
									<label for="polit"></label>
								<p class="sure"><span>Я согласен и принимаю<br></span><a href="agreement.php"
										;>пользовательское соглашение</a></p>
								</p>
							</div>
							<button data-sitekey="6LcUvC0aAAAAAIFMdIiYySNbcynoef4ngz4i5-Cp" data-callback='onSubmit' 
								data-action='submit' class="oplata g-recaptcha" 
								id="send-money-form" type="submit">Перейти к оплате
							</button>
							<a class="qiwi" href="/qiwi">Как оплатить через <span class="txtqiwi">QIWI</span>?</a>
						</div>
					</form>
				</div>
				<div class="right_body clearfix">
					<p class="services" style="font-size: 32px;">Доступные услуги</p>
					<div class="containers">
						<div class="container_up">
							<div class="change_nick">
								<p class="text_nick" style="margin-top: 45px;">Смена игрового<br>имени</p>
								<p class="money_nick" style="margin-top: -10px;font-size: 45px;">50₽</p>
								<a class="buy_nick">Приобрести</a>
							</div>
							<div class="change_tel">
								<p class="text_tel" style="margin-top: 45px;">Уникальный номер<br>телефона</p>
								<p class="money_tel" style="margin-top: -10px;font-size: 45px;">350₽</p>
								<a class="buy_tel">Приобрести</a>
							</div>
						</div>
						<div class="container_down">
							<div class="change_auto">
								<p class="text_auto" style="margin-top: 45px;">Уникальный номер<br>автомобиля</p>
								<p class="money_auto" style="margin-top: -10px;font-size: 45px;">500₽</p>
								<a class="buy_auto">Приобрести</a>
							</div>
							<div class="change_vb">
								<p class="text_vb" style="margin-top: 45px;">Военный<br>билет</p>
								<p class="money_vb" style="margin-top: -10px;font-size: 45px;">350₽</p>
								<a class="buy_vb">Приобрести</a>
							</div>
						</div>
						<div class="container_right">
							<div class="change_license">
								<p class="text_license" style="margin-top: 45px;">Получить<br>все лицензии</p>
								<p class="money_license" style="margin-top: -10px;font-size: 45px;">600₽</p>
								<a class="buy_license">Приобрести</a>
							</div>
							<div class="change_slot">
								<p class="text_slot" style="margin-top: 45px;">Дополнительный<br>слот авто</p>
								<p class="money_slot" style="margin-top: -10px;font-size: 45px;">600₽</p>
								<a class="buy_slot">Приобрести</a>
							</div>
						</div>
					</div>
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
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
		<script src="js/gam.js?{$time}"></script>
		<script src="js/donate.js?{$time}"></script>
		<script>
			if ("{$result}" !== "1") {
				Swal.fire({
					title: 'Ошибка',
					text: "{$result}",
					icon: 'error',
					confirmButtonColor: "#3947A2",
					confirmButtonText: "Ок."
				});
				$(".swal2-title").css('color', "#FFF");
				$(".swal2-content").css('color', "#AAA");
				$(".swal2-success-circular-line-right").css('background-color', "#191919");
				$(".swal2-success-circular-line-left").css('background-color', "#191919");
				$(".swal2-success-fix").css('background-color', "#191919");
				$(".swal2-modal").css('background-color', "#191919");
			}
		</script>
	</body>

	</html>
	HTML;
}

$request = $_POST;
if($request){
	$payment = new UnitPay(
		new UnitPayEvent()
	);
	$result = json_decode($payment->getResult(), true);
	if (!isset($result["error"])) {
		return;
	}
	setupPage($request['account'],$request['email'],$request['sum'], $result["error"]["message"]);
}
else {
	setupPage("","","", 1);
}