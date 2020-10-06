<?php
function sendMessage($chat_id,$text,$markup=null){
	$url=$GLOBALS['url'].'sendMessage?chat_id='.$chat_id.'&text='.urlencode($text).'&reply_markup='.$markup.'&parse_mode=Markdown';
	return get($url);
}
function editMessage($chat_id,$message_id,$text,$markup=null)
{
	$url=$GLOBALS['url'].'editMessageText?chat_id='.$chat_id.'&message_id='.$message_id.'&text='.urlencode($text).'&reply_markup='.$markup.'&parse_mode=Markdown';
return get($url);
}