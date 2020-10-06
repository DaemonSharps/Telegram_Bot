<?php
ini_set('log_errors','On');
ini_set('error_log','MC_errors.log');

include('config.php');
include('main_func.php');
include('functions.php');
include('keyboards.php');
include('MySQL.php');
/*----------------------------Connect with telegram---------------------------------------*/
if(($json=valid())==false)
{
	echo get($url.'setWebhook?url='.$webhook);
	exit();
}

$usid=0;
/*-------------------------------------Get info from user message-----------------------------*/
if(isset($json['message']['from']['id'])){
	$usid=$json['message']['from']['id'];
	$mesid=$json['message']['message_id'];
	$mg_text=$json['message']['text'];
	$answer="Hellow, worker))";
}

/*--------------------------Check the presence of a user in DB and add if he is absent--------*/
if($usid!=0) user_DB_Check($usid);
$pos_array=get_Position($usid);
$Position=$pos_array['Position'];
/*-----------------get callback data info-----------*/
if($json['callback_query']){
	$callback_data=$json['callback_query']['data'];
	$usid=$json['callback_query']['message']['chat']['id'];
	$mesid=$json['callback_query']['message']['message_id'];

}
/*------------------answer on callback_querry-----------*/
if(isset($callback_data))
{
	switch ($callback_data) 
	{
		case '/showstat':
		$keyboard=inline_keyboard_period();
		$answer="За какой период?";
			editMessage($usid,$mesid,$answer,$keyboard);
			
			break;
		case '/cashmoney':
			$answer="Ближайшая зарплата  числа в размере 0000.00 рублей. Следующая зарплата  числа в размере 000.00 рублей.";
			$keyboard=inline_keyboard_to_main();
			editMessage($usid,$mesid,$answer,$keyboard);
			
			break;
		case '/showstathalfm':
		$answer="Твоя статистика за 
		00.00.0000-00.00.0000
		Отработано дней:**
		Отработано часов:**
		Перерывов:**
		Филе съел:**
		Картошки съел:**
		Чая выпил:**";
			$keyboard=inline_keyboard_period_end();
			editMessage($usid,$mesid,$answer,$keyboard);
			
			break;
		case '/backmain':
			$answer="Привет, что хочешь сделать?";
			$keyboard=inline_keyboard_main_menu();
			editMessage($usid,$mesid,$answer,$keyboard);
			
			break;
		case '/addworkday':
			$answer="Сегодня ".date("j.m.Y")." , этот день?";
			$keyboard=inline_keyboard_add_day();
			editMessage($usid,$mesid,$answer,$keyboard);

			break;
		case '/adddayYES':
			update_Columns($usid,"Set-Time-start");
			$answer="Во сколько пробился в (формате 00:00) ?";
			editMessage($usid,$mesid,$answer,$keyboard);
	
			break;
		case '/adddayNO':
		update_Columns($usid,"add-day-another");
			$answer="Напиши число в формате (00.00.0000)";
			editMessage($usid,$mesid,$answer,$keyboard);
			break;
		case '/break':
			$answer="Что ел? (Повторяется)";
			$keyboard=inline_keyboard_add_day_eat();
			editMessage($usid,$mesid,$answer,$keyboard);
			exit();
			break;
		case '/eatEND':
			$answer="За день 00.00.0000
			Съел:филе, пирожок...
			Отработал 99 часов 99 минут с 00:00 до 00:00
			Перерывы: 2";
			$keyboard=inline_keyboard_add_day_End();
			editMessage($usid,$mesid,$answer,$keyboard);
			exit();
			break;		
	}
exit();
}
/*case '':
	$answer="";
	$keyboard=
	editMessage($usid,$mesid,$answer,$keyboard);
	break;*/

/*-------------------------------if-switch, select anwer----------------------------*/
if(!empty($mg_text))
{
	switch ($mg_text) {
		case '/start':
			$answer="Привет, что хочешь сделать?";
			$keyboard=inline_keyboard_main_menu();

			break;
		case ($Position=="Set-Time-start"):
		update_Columns($usid,"Set-Time-end");
			$answer="Во сколько ущел? (В формате 00:00)";
			sendMessage($usid,$answer,$keyboard);
			exit();
			break;
		case($Position=="Set-Time-end"):
		update_Columns($usid,0);
		$answer="Сколько перерывов?";
		$keyboard=inline_keyboard_add_day_braks();
		sendMessage($usid,$answer,$keyboard);
		exit();
		break;
		case ($Position=="add-day-another"):
			update_Columns($usid,"Set-Time-start");
			$answer="Во сколько пробился в (формате 00:00) ?";
			editMessage($usid,$mesid,$answer,$keyboard);
			break;

	}
}
/*--------------------------finally send answer-------------------------------------*/

sendMessage($usid,$answer,$keyboard);
