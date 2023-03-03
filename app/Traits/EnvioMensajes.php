<?php 

namespace App\Traits;

use Telegram;

trait EnvioMensajes{

	public function telegramMensajeGrupo($text)
	{
        $chat_id = config('app.telegram_id_grup');	
		
        Telegram::sendMessage([
            "chat_id" => $chat_id,
            "parse_mode" => 'HTML',
            "text" => $text,
        ]);
        
        return true;
	} 
}