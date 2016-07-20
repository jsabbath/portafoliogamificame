<?php
class Skillperson
{
	private $intidskillme;
	private $intidpersona;
	private $nvchskillname;
	private $nvchporcentaje;

	public function __GET($k){ return $this->$k; }
	public function __SET($k, $v){ return $this->$k = $v; }
}
?>