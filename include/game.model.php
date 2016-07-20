<?php
class GameModel
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

			$stm = $this->pdo->prepare("SELECT * FROM tb_game");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$gam = new Game();

				$gam->__SET('intidgame', $r->intidgame);
				$gam->__SET('nvchnombre', $r->nvchnombre);
				$gam->__SET('nvchdescripcion', $r->nvchdescripcion);
				$gam->__SET('nvchlinkspot', $r->nvchlinkspot);
				$gam->__SET('nvchbanner', $r->nvchbanner);
				$gam->__SET('nvchlinkdownandr', $r->nvchlinkdownandr);
				$gam->__SET('nvchlinkdownpc', $r->nvchlinkdownpc);
				$gam->__SET('nvchlinkdownios', $r->nvchlinkdownios);

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
			          ->prepare("SELECT * FROM tb_game WHERE intidgame = ?");
			          

			$stm->execute(array($id));
			$r = $stm->fetch(PDO::FETCH_OBJ);

			$gam = new Game();

			$gam->__SET('intidgame', $r->intidgame);
			$gam->__SET('nvchnombre', $r->nvchnombre);
			$gam->__SET('nvchdescripcion', $r->nvchdescripcion);
			$gam->__SET('nvchlinkspot', $r->nvchlinkspot);
			$gam->__SET('nvchbanner', $r->nvchbanner);
			$gam->__SET('nvchlinkdownandr', $r->nvchlinkdownandr);
			$gam->__SET('nvchlinkdownpc', $r->nvchlinkdownpc);
			$gam->__SET('nvchlinkdownios', $r->nvchlinkdownios);

			return $gam;
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Eliminar($id)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("DELETE FROM tb_game WHERE intidgame = ?");			          

			$stm->execute(array($id));
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Actualizar(Game $data)
	{
		try 
		{
			$sql = "UPDATE tb_game SET 
						nvchnombre = ?,
						nvchdescripcion  = ?, 
						nvchlinkspot = ?,
						nvchbanner = ?,
						nvchlinkdownandr = ?,
						nvchlinkdownpc = ?,
						nvchlinkdownios = ?
				    WHERE intidgame = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				array(
					$data->__GET('nvchnombre'), 
					$data->__GET('nvchdescripcion'), 
					$data->__GET('nvchlinkspot'),
					$data->__GET('nvchbanner'),
					$data->__GET('nvchlinkdownandr'),
					$data->__GET('nvchlinkdownpc'),
					$data->__GET('nvchlinkdownios'),
					$data->__GET('intidgame')
					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Registrar(Game $data)
	{

		try 
		{
		$sql = "INSERT INTO tb_game (nvchnombre,nvchdescripcion,nvchlinkspot,nvchbanner,nvchlinkdownandr,nvchlinkdownpc,nvchlinkdownios) 
		        VALUES (?, ?, ?, ?, ?, ?, ?)";

		$this->pdo->prepare($sql)
		     ->execute(
			array(
				$data->__GET('nvchnombre'), 
				$data->__GET('nvchdescripcion'), 
				$data->__GET('nvchlinkspot'),
				$data->__GET('nvchbanner'),
				$data->__GET('nvchlinkdownandr'),
				$data->__GET('nvchlinkdownpc'),
				$data->__GET('nvchlinkdownios')
				)
			);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}

