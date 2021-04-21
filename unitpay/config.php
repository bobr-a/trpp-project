<?php

class Config
{
    // Ваш секретный ключ (из настроек проекта в личном кабинете UnitPay )
    const SECRET_KEY = '--f8e-0a-24d133-56';
    const paymentType = 'card'; // Код платежной системы, через которую будет идти оплата.
    const projectId = 3-1; // ID вашего проекта в системе UnitPay
    const resultUrl = 'https://mtabobr.online/donate'; // Urlencoded адрес перехода пользователя после оплаты (например, http://вашсайт.ru)
    const desc = "Покупка привилегий на игровом сервере MTA Bobr RP"; // Описание заказа
    const publicKey = "3-7";
    // Стоимость товара в руб.
    const ITEM_PRICE = 1;

    // Таблица начисления товара, например `users`
    const TABLE_ACCOUNT = 'SummDonate';
    // Название поля из таблицы начисления товара по которому производится поиск аккаунта/счета, например `email`
    const TABLE_ACCOUNT_NAME = 'Account';
    // Название поля из таблицы начисления товара которое будет увеличено на колличево оплаченого товара, например `sum`, `donate`
    const TABLE_ACCOUNT_DONATE= 'Money';

    // Параметры соединения с бд
    // Хост
    const DB_HOST = 'localhost';
    // Имя пользователя
    const DB_USER = 'u-';
    // Пароль
    const DB_PASS = 'L-';
    // Назывние базы
    const DB_NAME = 'u--';
    // номер порта(необязательно)
    const DB_PORT = '';

}