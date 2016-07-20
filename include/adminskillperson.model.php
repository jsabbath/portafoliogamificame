<?php
class SkillpersonModel
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

			$stm = $this->pdo->prepare("SELECT * FROM tb_skillme");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$gam = new Juegopersona();

				$gam->__SET('intidskillme', $r->intidskillme);
				$gam->__SET('intidpersona', $r->intidpersona);
				$gam->__SET('nvchskillname', $r->nvchskillname);
				$gam->__SET('nvchporcentaje', $r->nvchporcentaje);

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
			          ->prepare("SELECT * FROM tb_skillme WHERE intidskillme = ?");
			          
			$stm->execute(array($id));
			$r = $stm->fetch(PDO::FETCH_OBJ);

			$gam = new Skillperson();

			$gam->__SET('intidskillme', $r->intidskillme);
			$gam->__SET('intidpersona', $r->intidpersona);
			$gam->__SET('nvchskillname', $r->nvchskillname);
			$gam->__SET('nvchporcentaje', $r->nvchporcentaje);

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
			          ->prepare("DELETE FROM tb_skillme WHERE intidskillme = ?");			          

			$stm->execute(array($id));
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Actualizar(Skillperson $data)
	{
		try 
		{
			$sql = "UPDATE tb_skillme SET 
						intidpersona = ?,
						nvchskillname  = ?, 
						nvchporcentaje = ?
				    WHERE intidskillme = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				array(
					$data->__GET('intidpersona'), 
					$data->__GET('nvchskillname'), 
					$data->__GET('nvchporcentaje'),
					$data->__GET('intidpersona')
					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Registrar(Skillperson $data)
	{

		try 
		{
		$sql = "INSERT INTO  tb_skillme (intidpersona,nvchskillname,nvchporcentaje) 
		        VALUES (?, ?, ?)";

		$this->pdo->prepare($sql)
		     ->execute(
			array(
				$data->__GET('intidpersona'), 
				$data->__GET('nvchskillname'), 
				$data->__GET('nvchporcentaje')
				)
			);



		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}

