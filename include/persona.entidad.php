<?php
class Persona
{
	private $intidpersona;
	private $nvchnombres;
	private $nvchapellido;
	private $nvchdireccion;
	private $nvchcorreo;
	private $nvchphone;

	public function __GET($k){ return $this->$k; }
	public function __SET($k, $v){ return $this->$k = $v; }
}
?>