<?php

include 'UnitPayLib.php';

header('Content-Type: text/html; charset=utf-8');

class UnitPay
{
    private $event;

    public function __construct(UnitPayEvent $event)
    {
        $this->event = $event;
    }

    private function checkInputs($request)
    {
        if (!isset($request["polit"])) {
            return 2;//"Вы не согласились с пользовательским соглашением.";
        }
        $isLogin = false;
        try {
            $unitPayModel = UnitPayModel::getInstance();
            if ($unitPayModel->getAccountByName($request["account"])) {
                $isLogin = true;
            }
        }catch(Exception $e){
            return 3;//"Сервис временно не работает, попробуйте позже.";
        }

        $isEmail = preg_match('/^[A-Z0-9._%+-]+@[A-Z0-9-]+.+.[A-Z]{2,4}$/i', $request["email"]);

        $containsLetter  = preg_match('/[a-zA-Z]/',    $request["sum"]);
        $containsDigit   = preg_match('/\d/',          $request["sum"]);
        $containsSpecial = preg_match('/[^a-zA-Z\d]/', $request["sum"]);
        $isSum = !$containsLetter && $containsDigit && !$containsSpecial;

        if ($isLogin) {
            if ($isEmail) {
                if ($isSum) {
                    return 0;
                }
                else {
                    return 6;//"Введите корректную сумму.";
                }
            }
            else {
                return 5;//"Введите корректный Email.";
            }
        }
        else {
            return 4;//"Логин не найден. Введите корректный логин.";
        }	
    }

    public function getResult()
    {
        $request = $_REQUEST;
        
        if (empty($request['method'])
            || empty($request['params'])
            || !is_array($request['params'])
        )
        {
            $isValidInputs = $this->checkInputs($request);

            if($isValidInputs == 0){
                return $this->GoToUnitPay($request);
            }
            else {
                $text = "";
                switch ($isValidInputs) {
                    case 1:
                        $text = "Заполните все поля.";
                        break;
                    case 2:
                        $text = "Вы не согласились с пользовательским соглашением.";
                        break;
                    case 3:
                        $text = "Сервис временно не работает, попробуйте позже.";
                        break;
                    case 4:
                        $text = "Логин не найден. Введите корректный логин.";
                        break;
                    case 5:
                        $text = "Введите корректный Email.";
                        break;
                    case 6:
                        $text = "Введите корректную сумму.";
                        break;
                    default:
                        break;
                }
                if ($text != "") {
                    return $this->getResponseError($text);
                }
                else {
                    return $this->getResponseError("Неизвестная ошибка.");
                }
                
            }
        }

        $method = $request['method'];
        $params = $request['params'];

        if ($params['signature'] != $this->getSha256SignatureByMethodAndParams($method, $params, Config::SECRET_KEY))
        {
            return $this->getResponseError('Incorrect digital signature');
        }

        $unitPayModel = UnitPayModel::getInstance();

        if ($method == 'check')
        {
            if ($unitPayModel->getPaymentByUnitpayId($params['unitpayId']))
            {
                // Платеж уже существует
                return $this->getResponseSuccess('Payment already exists');
            }

            $itemsCount = floor($params['sum'] / Config::ITEM_PRICE);

            if ($itemsCount <= 0)
            {
                return $this->getResponseError('Суммы ' . $params['sum'] . ' руб. не достаточно для оплаты товара ' .
                    'стоимостью ' . Config::ITEM_PRICE . ' руб.');
            }

            if (!$unitPayModel->createPayment(
                $params['unitpayId'],
                $params['account'],
                $params['sum'],
                $itemsCount
            ))
            {
                return $this->getResponseError('Unable to create payment database');
            }

            $checkResult = $this->event->check($params);
            if ($checkResult !== true)
            {
                return $this->getResponseError($checkResult);
            }

            return $this->getResponseSuccess('CHECK is successful');
        }

        if ($method == 'pay')
        {
            $payment = $unitPayModel->getPaymentByUnitpayId(
                $params['unitpayId']
            );

            if ($payment && $payment->status == 1)
            {
                return $this->getResponseSuccess('Payment has already been paid');
            }

            if (!$unitPayModel->confirmPaymentByUnitpayId($params['unitpayId']))
            {
                return $this->getResponseError('Unable to confirm payment database');
            }

            $this->event
                ->pay($params);

            return $this->getResponseSuccess('PAY is successful');
        }

	return $this->getResponseError($method.' not supported');
    }

    private function getResponseSuccess($message)
    {
        return json_encode(
            array(
                'result' => array(
                    'message' => $message
                )
            )
        );
    }

    private function getResponseError($message)
    {
        return json_encode(
            array(
                'error' => array(
                    'message' => $message
                )
            )
        );
    }

    /**
     * @param       $method
     * @param array $params
     * @param       $secretKey
     *
     * @return string
     */
    private function getSha256SignatureByMethodAndParams($method, array $params, $secretKey)
    {
        ksort($params);
        unset($params['sign']);
        unset($params['signature']);
        array_push($params, $secretKey);
        array_unshift($params, $method);

        return hash('sha256', join('{up}', $params));
    }

    private function GoToUnitPay($request)
    {
        $unitPay = new UnitPayLib("unitpay.money", Config::SECRET_KEY);
        $unitPay
            ->setBackUrl(Config::resultUrl)
            ->setCustomerEmail($request["email"]);

        $redirectUrl = $unitPay->form(
            Config::publicKey,
            $request["sum"],
            $request["account"],
            Config::desc." [".$request["account"]."]"
        );

        header("Location: " . $redirectUrl);

        return;
    }
}
