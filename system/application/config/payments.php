<?
//Общее: адреса скриптов
define('TESTMODE', 0); //В большинстве случаев при 1 будут проходить тестовые платежи
//Для работы нужно установить в 0

define('SUCCESS_URL',	"http://countrypost.ru/syspay/showSuccess");
define('FAIL_URL',		"http://countrypost.ru/syspay/showFail");
define('RESULT_URL',	"http://countrypost.ru/syspay/showResult");
define('ADMIN_EMAIL',	"info@countrypost.ru");

define('MAX_O2I_RU', 15000);

//WebMoney
define('WM_PURSE',			"R335456041886");
define('WMZ_PURSE',			"Z735510829657");
define('WM_SUCCESS_URL',	"http://countrypost.ru/syspay/showSuccess");
define('WM_FAIL_URL',		"http://countrypost.ru/syspay/showFail");
define('WM_RESULT_URL',		"http://countrypost.ru/syspay/showResult");
define('WMZ_RESULT_URL',	"http://countrypost.ru/syspay/showResultWMZ");
define('WM_SECRET_KEY',		"XFgw");
define('WM_IN_TAX', 1.8);
define('WM_IN_EXTRA', 0);
define('WMZ_IN_TAX', 2.4);
define('WMZ_IN_EXTRA', 2);
define('WM_OUT_TAX', 0.8);

//RoboKassa
define('RK_LOGIN', 'Craftsman1');
define('RK_PASS1', 'robokassa1');
define('RK_PASS2', 'robokassa2');
define('RK_IN_TAX', 1.8);
define('RK_IN_EXTRA', 0);

//W1
define('W1_WALLET', '103853778255');
define('W1_PASS', 'AyDcbD');
define('W1_KEY', 'VGtcWHpuTmIydVJGT3F1OWZ3T2NWWXxnQXhe');
define('W1_FAIL_URL',		"http://countrypost.ru/syspay/showFail");
define('W1_SUCCESS_URL',	"http://countrypost.ru/syspay/showSuccess");
define('W1_RESULT_URL',		"http://countrypost.ru/syspay/showResult");

//Лучше не использовать кнопку "Сгенерировать" в админке, т.к. слишком длинный код иногда вызывает проблемы с ЭЦП
define('W1_IN_TAX', 3);

//LiqPay
define('LP_MERCHANT_ID', 'i2498933264');
define('LP_MERCHANT_SIG1', 'x1XA6xyodERIWefQAR3sSbpdOo1Af0bmoY5Um');
define('LP_MERCHANT_SIG2', 'OPy4OGrEhcbUa1uaiWNlzh970lUfBv93seO8wVLj');
define('LP_RESULT_URL', 'http://countrypost.ru/syspay/showResultLP');
define('LP_SERVER_URL', 'http://countrypost.ru/syspay/showServerLP');

#$lp_merchant_id="i0327037845";
#$lp_merchant_password="YB1zi3hLHCJeXEo9ZeIfcLMT56Ydw";
#$lp_result_url="http://countrypost.ru/lp_result.php"; // success/fail
#$lp_server_url="http://countrypost.ru/lp.php";
define('LP_IN_TAX', 3);
define('LP_OUT_TAX', 0);

//Sberbank
define('CC_IN_TAX', 2);
define('SO_IN_TAX', 2);
define('OP_IN_TAX', 2);
define('BM_IN_TAX', 1);
define('BM_OUT_TAX', 1);
define('BM_IN_ACCOUNT', '4276838059339327');

// QIWI
define('QW_IN_TAX', 2.5);
define('QIWI_IN_TAX', 3.5);
define('QIWI_IN_EXTRA', 0);
define('QW_IN_ACCOUNT', '9161279091');
define('QW_LOGIN', '16801');
define('QIWI_PASS', 'WfRx15NPWfAL3LNORWtn');
define('QW_OUT_TAX', 0);
define('QIWI_SUCCESS_URL', "http://countrypost.ru/syspay/showResultQW");

// RBK Money
define('RBK_IN_TAX', 2.5);
define('RBK_IN_ACCOUNT', 'RU606456384');

// PayPal
define('PP_TEST', 0);
define('PP_IN_TAX', 4);
define('PP_IN_EXTRA', 5);
define('PP_ACCOUNT', 'stuff82@gmail.com');
define('PP_TEST_ACCOUNT', 'stuff82@gmail.com');
define('PP_URL', 'https://www.paypal.com/cgi-bin/webscr');
define('PP_TEST_URL', 'https://www.sandbox.paypal.com/cgi-bin/webscr');
define('PP_RETURN_URL', 'http://countrypost.ru/syspay/showResultPP');
define('PP_NOTIFY_URL', 'http://countrypost.ru/syspay/callbackPP');
define('PP_CALLBACK_URL', 'http://countrypost.ru/syspay/callbackPP');
define('PP_IMAGE_URL', 'http://countrypost.ru/static/images/logo.png');
define('PP_CANCEL_URL', 'http://countrypost.ru/client');

// UAH
define('PB_IN_TAX', 1.5);
define('PB_IN_ACCOUNT', '4627085825024728');

// BTA
define('BTA_IN_TAX', 2.4);
define('BTA_IN_ACCOUNT', '4256801510176849');
define('BTA_SERVICE_NAME', 'БТА Банк');

// CCR
define('CCR_IN_TAX', 2.4);
define('CCR_IN_ACCOUNT', '4667209610401898');
define('CCR_SERVICE_NAME', 'ЦентрКредит Банк');

// KKB
define('KKB_IN_TAX', 2.4);
define('KKB_IN_ACCOUNT', '6762045559163472');
define('KKB_SERVICE_NAME', 'Казкоммерцбанк');

// NB
define('NB_IN_TAX', 2.4);
define('NB_IN_ACCOUNT', '6762003509188602');
define('NB_SERVICE_NAME', 'Народный Банк');

// TB
define('TB_IN_TAX', 2.4);
define('TB_IN_ACCOUNT', '4392232500449829');
define('TB_SERVICE_NAME', 'Темирбанк');

// ATF
define('ATF_IN_TAX', 2.4);
define('ATF_IN_ACCOUNT', '4052587100780654');
define('ATF_SERVICE_NAME', 'АТФ Банк');

// AB
define('AB_IN_TAX', 2.4);
define('AB_IN_ACCOUNT', '4042428902488290');
define('AB_SERVICE_NAME', 'Альянсбанк');

// SV
define('SV_IN_TAX', 1);
define('SV_IN_ACCOUNT', '5163310501426881');
define('SV_SERVICE_NAME', 'Связной Банк');

// VTB
define('VTB_IN_TAX', 1);
define('VTB_IN_ACCOUNT', 'УНК 10180317 (Тонконогов Юрий Андреевич');
define('VTB_SERVICE_NAME', 'ВТБ Банк');