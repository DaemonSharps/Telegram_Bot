<?php
function inline_keyboard_main_menu()
{
	$inline_keyboard=[
		array(array("text"=>"Посмотреть статистику","callback_data"=>'/showstat')),
		array(array("text"=>"Добавить рабочий день","callback_data"=>'/addworkday')),
		array(array("text"=>"Узнать зарплату","callback_data"=>'/cashmoney')),
	];
	$keyboard=json_encode(array("inline_keyboard"=>$inline_keyboard));
	return $keyboard;
}
function inline_keyboard_period()
{
	$inline_keyboard=[
		array(array("text"=>"За первую или вторую половину месяца","callback_data"=>'/showstathalfm')),
		array(array("text"=>"За месяц с первого числа","callback_data"=>'/showstatwholem')),
		array(array("text"=>"За предыдущий месяц","callback_data"=>'/showstatlastm')),
		array(array("text"=>"За год","callback_data"=>'/showstatyear')),
		array(array("text"=>"Назад","callback_data"=>'/backmain')),
	];
	$keyboard=json_encode(array("inline_keyboard"=>$inline_keyboard));
	return $keyboard;
}
function inline_keyboard_period_end()
{
	$inline_keyboard=[
		array(array("text"=>"Назад","callback_data"=>'/showstat')),
	array(array("text"=>"Вернутся в начало","callback_data"=>'/backmain')),
];
$keyboard=json_encode(array("inline_keyboard"=>$inline_keyboard));
return	$keyboard;
	
}
function inline_keyboard_to_main()
{
	$inline_keyboard=[
		array(array("text"=>"На главную","callback_data"=>'/backmain')),
	];
	$keyboard=json_encode(array("inline_keyboard"=>$inline_keyboard));
	return	$keyboard;
}

function inline_keyboard_add_day()
{
	$inline_keyboard=[
		array(array("text"=>"Да","callback_data"=>'/adddayYES')),
		array(array("text"=>"Нет (Добавить предыдущий день)","callback_data"=>'/adddayNO')),
	];
	$keyboard=json_encode(array("inline_keyboard"=>$inline_keyboard));
	return $keyboard;
}
function inline_keyboard_add_day_braks()
{
	$inline_keyboard=[
		array(array("text"=>"Два по 30","callback_data"=>'/break')),
		array(array("text"=>"Один 30","callback_data"=>'/break')),
		array(array("text"=>"Один 15","callback_data"=>'/break')),
		array(array("text"=>"Один 15 и один 30","callback_data"=>'/break')),
	];
	$keyboard=json_encode(array("inline_keyboard"=>$inline_keyboard));
	return $keyboard;
}
function inline_keyboard_add_day_eat()
{
	$inline_keyboard=[
		array(array("text"=>"Филе о Фиш","callback_data"=>'/break')),
		array(array("text"=>"Картошка","callback_data"=>'/break')),
		array(array("text"=>"Пирожок","callback_data"=>'/break')),
		array(array("text"=>"Чай","callback_data"=>'/break')),
		array(array("text"=>"Сырные палочки","callback_data"=>'/break')),
		array(array("text"=>"Больше ничего","callback_data"=>'/eatEND')),
	];
	$keyboard=json_encode(array("inline_keyboard"=>$inline_keyboard));
	return $keyboard;
}

function inline_keyboard_add_day_End()
{
	$inline_keyboard=[
		array(array("text"=>"Верно (добавить и вернуться на главную)","callback_data"=>'/backmain')),
		array(array("text"=>"Не верно (перейти в начало)","callback_data"=>'/addworkday')),
	
	];
	$keyboard=json_encode(array("inline_keyboard"=>$inline_keyboard));
	return $keyboard;
}

/*array(array("text"=>"","callback_data"=>'')),*/