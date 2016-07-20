<?php
class JuegopersonaModel
{
	private $pdo;

	public function __CONSTRUCT()
	{
		try
		{
			$this->pdo = new PDO('mysql:host=localhost;dbname=db_portfoliogame', 'root', '');
			$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		        
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Listar()
	{
		try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM tb_juego_persona");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$gam = new Juegopersona();

				$gam->__SET('intidjuego_persona', $r->intidjuego_persona);
				$gam->__SET('intidpersona', $r->intidpersona);
				$gam->__SET('intidgame', $r->intidgame);
				$gam->__SET('nvchfuncion', $r->nvchfuncion);

				$result[] = $gam;
			}

			return $result;
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Obtener($id)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM tb_juego_persona WHERE intidjuego_persona = ?");
			          
			$stm->execute(array($id));
			$r = $stm->fetch(PDO::FETCH_OBJ);

			$gam = new Juegopersona();

			$gam->__SET('intidjuego_persona', $r->intidjuego_persona);
			$gam->__SET('intidpersona', $r->intidpersona);
			$gam->__SET('intidgame', $r->intidgame);
			$gam->__SET('nvchfuncion', $r->nvchfuncion);

			return $gam;
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}



/*
SELECT 
intidjuego_persona,
tb_persona.nvchnombres,
tb_persona.nvchapellido,
tb_game.nvchnombre,
tb_juego_persona.nvchfuncion
from 
tb_juego_persona 
inner join tb_persona
on tb_juego_persona.intidpersona = tb_persona.intidpersona
inner join tb_game
on tb_game.intidgame = tb_juego_persona.intidgame
*/
	public function Eliminar($id)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("DELETE FROM tb_juego_persona WHERE intidjuego_persona = ?");			          

			$stm->execute(array($id));
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Actualizar(Juegopersona $data)
	{
		try 
		{
			$sql = "UPDATE tb_juego_persona SET 
						intidpersona = ?,
						intidgame  = ?, 
						nvchfuncion = ?
				    WHERE intidjuego_persona = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				array(
					$data->__GET('intidpersona'), 
					$data->__GET('intidgame'), 
					$data->__GET('nvchfuncion'),
					$data->__GET('intidjuego_persona')
					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Registrar(Juegopersona $data)
	{

		try 
		{
		$sql = "INSERT INTO  tb_juego_persona (intidpersona,intidgame,nvchfuncion) 
		        VALUES (?, ?, ?)";

		$this->pdo->prepare($sql)
		     ->execute(
			array(
				$data->__GET('intidpersona'), 
				$data->__GET('intidgame'), 
				$data->__GET('nvchfuncion')
				)
			);



		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}

