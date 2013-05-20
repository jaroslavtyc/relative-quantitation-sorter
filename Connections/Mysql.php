<?php
namespace \RqData\Connections;

final class Mysql extends \PripojeniMysql {

	public function __construct(){
		if (empty($_SERVER['WINDIR'])) {
			parent::__construct(self::LOCALHOST,'rqdata-kostrivec','QRmFKTUKt5WGADw2','rqdata-kostrivec');
			$this->checkVersion();
		} else {
			parent::__construct(self::LOCALHOST,'root','','test');
		}
	}

	private function checkVersion(){
		$verze = $this->dejVerzi();
		if(str_replace('.','',$verze) < 5100){
			trigger_error("Verze MySQL je příliš zastaralá ($verze), vyžadujeme alespoň 5.1.0)",E_USER_ERROR);
		}
	}
}