<?php
class Juegopersona
{
	private $intidjuego_persona;
	private $intidpersona;
	private $intidgame;
	private $nvchfuncion;

	public function __GET($k){ return $this->$k; }
	public function __SET($k, $v){ return $this->$k = $v; }
}
?>