<?php
class Game
{
	private $intidgame;
	private $nvchnombre;
	private $nvchdescripcion;
	private $nvchlinkspot;
	private $nvchbanner;
	private $nvchlinkdownandr;
	private $nvchlinkdownpc;
	private $nvchlinkdownios;

	public function __GET($k){ return $this->$k; }
	public function __SET($k, $v){ return $this->$k = $v; }
}
?>