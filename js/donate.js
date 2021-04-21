$(function () {
    $(".oplata").click(function () {
        if (!$(".check").hasClass("span__active")) {
            $(".check").css({ "border": "2px solid #f00" });
            $(this).attr('disabled', 'disabled');
        }
    });

    $(".buy_nick").click(function () {
        if (!$(".buy_nick").hasClass("active")) {
            sure("увеличить", ".buy_nick", false);
        }
        else {
            sure("уменьшить", ".buy_nick", false);
        }
    });
    $(".buy_tel").click(function () {
        if (!$(".buy_tel").hasClass("active")) {
            sure("увеличить", ".buy_tel", false);
        }
        else {
            sure("уменьшить", ".buy_tel", false);
        }
    });
    $(".buy_auto").click(function () {
        sure("увеличить", ".buy_auto", true);
    });
    $(".buy_vb").click(function () {
        if (!$(".buy_vb").hasClass("active")) {
            sure("увеличить", ".buy_vb", false);
        }
        else {
            sure("уменьшить", ".buy_vb", false);
        }
    });
    $(".buy_license").click(function () {
        if (!$(".buy_license").hasClass("active")) {
            sure("увеличить", ".buy_license", false);
        }
        else {
            sure("уменьшить", ".buy_license", false);
        }
    });
    $(".buy_slot").click(function () {
        sure("увеличить", ".buy_slot", true);
    });

});

function onSubmit(token) {
        var inputCash = document.getElementById('login');
        var inputEmail = document.getElementById('email');
        var inputSumm = document.getElementById('summ');
        if (!(inputCash.value == "" || inputEmail.value == "" || inputSumm.value == "")) {
            document.getElementById("signup-form").submit();
        }
        else {
            Swal.fire({
                title: 'Ошибка',
                text: 'Заполните все поля',
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
}

function sure(text, classcss, repeat) {
    var btnText = "Увеличить", success = 'Добавлено!', color = "#191919";
    if (text == "уменьшить") {
        btnText = "Уменьшить";
        success = "Уменьшено!";
    }
    Swal.fire({
        title: 'Вы уверены?',
        text: "Действительно ли Вы хотите " + text + " сумму?",
        icon: 'warning',
        iconColor: "#FFF",
        showCancelButton: true,
        confirmButtonColor: "#3947A2",
        cancelButtonColor: '#d33',
        confirmButtonText: btnText,
        cancelButtonText: 'Отмена',
    }).then((result) => {
        if (result.isConfirmed) {
            var type = classcss.split('_')[1];
            var money = Number.parseInt($(".money_" + type).text());
            if (repeat == false) {
                if (!$(classcss).hasClass("active")) {
                    var inputCash = document.getElementById('summ');
                    var money_input = Number.parseInt(inputCash.value);
                    if (isNaN(money_input)) {
                        inputCash.value = money;
                    }
                    else {
                        inputCash.value = money_input + money;
                    }
                    $(classcss).hover(function () {
                        $(classcss).css({ "background": "#3947A2", "color": "#fff" });
                    }, function () {
                        $(classcss).css({ "background": "#fff", "color": "#3947A2" });
                    });
                    $(classcss).text("Добавлено");
                    $(classcss).css({ "background": "#fff", "color": "#3947A2" });
                }
                else {
                    var inputCash = document.getElementById('summ');
                    var money_input = Number.parseInt(inputCash.value);
                    if (!isNaN(money_input)) {
                        if (money_input - money < 0) {
                            inputCash.value = "";
                        }
                        else {
                            inputCash.value = money_input - money;
                        }
                    }
                    $(classcss).hover(function () {
                        $(classcss).css({ "background": "#fff", "color": "#3947A2" });
                    }, function () {
                        $(classcss).css({ "background": "#3947A2", "color": "#fff" });
                    });
                    $(classcss).text("Приобрести");
                    $(classcss).css({ "background": "#3947A2", "color": "#fff" });
                }
            }
            else {
                var inputCash = document.getElementById('summ');
                var money_input = Number.parseInt(inputCash.value);
                if (isNaN(money_input)) {
                    inputCash.value = money;
                }
                else {
                    inputCash.value = money_input + money;
                }
            }
            Swal.fire(
                success,
                'Сумма была обновлена.',
                'success'
            )
            $(classcss).toggleClass("active");


            $(".swal2-confirm").css('background-color', "#3947A2");
            $(".swal2-title").css('color', "#FFF");
            $(".swal2-content").css('color', "#AAA");
            $(".swal2-success-circular-line-right").css('background-color', color);
            $(".swal2-success-circular-line-left").css('background-color', color);
            $(".swal2-success-fix").css('background-color', color);
            $(".swal2-modal").css('background-color', color);
            change();
        }
    });
    $(".swal2-title").css('color', "#FFF");
    $(".swal2-content").css('color', "#AAA");
    $(".swal2-modal").css('background-color', color);
}


$(document.getElementById('summ')).ready(function () {
    $('#summ').on('keyup', function () {
        change();
    });

    $('#summ').change(function () {
        checkElement(".buy_nick");
        checkElement(".buy_tel");
        checkElement(".buy_auto");
        checkElement(".buy_vb");
        checkElement(".buy_license");
        checkElement(".buy_slot");
    });
});

function checkElement(classcss) {
    var str_money = document.getElementById('summ');
    var cash = Number.parseInt(str_money.value);
    var type = classcss.split('_')[1];
    var money = Number.parseInt($(".money_" + type).text());
    if ($(classcss).hasClass("active")) {
        if (cash < money || isNaN(cash)) {
            $(classcss).toggleClass("active");
            $(classcss).hover(function () {
                $(classcss).css({ "background": "#fff", "color": "#3947A2" });
            }, function () {
                $(classcss).css({ "background": "#3947A2", "color": "#fff" });
            });
            $(classcss).text("Приобрести");
            $(classcss).css({ "background": "#3947A2", "color": "#fff" });
        }
    }
}

function change() {
    var donateRate = 1000;
    var cash = 0;
    var money = document.getElementById('summ'), rubles = document.getElementById('rubles'), valute = document.getElementById('valute');

    cash = Number.parseInt(money.value);
    if (Number.isInteger(cash) && cash > 0) {
        if (Number.isInteger(cash) && cash >= 1000 && cash <= 99999) {
            var donateValue = document.getElementById('donate_value');
            donateValue.style.marginLeft = "10px";
        }
        else if (Number.isInteger(cash) && cash > 99999) {
            var inputCash = document.getElementById('summ');
            var donateValue = document.getElementById('donate_value');
            donateValue.style.marginLeft = "10px";
            inputCash.value = "99999";
            cash = 99999;
        }
        else {
            var donateValue = document.getElementById('donate_value');
            donateValue.style.marginLeft = "60px";
        }
        rubles.innerText = cash;
        valute.innerText = money.value * donateRate;
    }
    else {
        var inputCash = document.getElementById('summ');
        inputCash.value = "";
        rubles.innerText = 1;
        valute.innerText = 1 * donateRate;
    }
}

function submit() {
    change();
    return window.location = url + cash;
}