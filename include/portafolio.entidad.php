<?php
class tb_portfolio
{
	private $intid;
	private $nvchname;
	private $nvchdescription;
	private $Fecharegistro;
	private $btestado;

	public function __GET($k){ return $this->$k; }
	public function __SET($k, $v){ return $this->$k = $v; }
}