<?php
class PersonaModel
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

			$stm = $this->pdo->prepare("SELECT * FROM tb_persona");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$per = new Persona();

				$per->__SET('intidpersona', $r->intidpersona);
				$per->__SET('nvchnombres', $r->nvchnombres);
				$per->__SET('nvchapellido', $r->nvchapellido);
				$per->__SET('nvchdireccion', $r->nvchdireccion);
				$per->__SET('nvchcorreo', $r->nvchcorreo);
				$per->__SET('nvchphone', $r->nvchphone);

				$result[] = $per;
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
			          ->prepare("SELECT * FROM tb_persona WHERE intidpersona = ?");
			          

			$stm->execute(array($id));
			$r = $stm->fetch(PDO::FETCH_OBJ);

			$per = new Persona();

			$per->__SET('intidpersona', $r->intidpersona);
			$per->__SET('nvchnombres', $r->nvchnombres);
			$per->__SET('nvchapellido', $r->nvchapellido);
			$per->__SET('nvchdireccion', $r->nvchdireccion);
			$per->__SET('nvchcorreo', $r->nvchcorreo);
			$per->__SET('nvchphone', $r->nvchphone);

			return $per;
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
			          ->prepare("DELETE FROM tb_persona WHERE intidpersona = ?");			          

			$stm->execute(array($id));
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Actualizar(Persona $data)
	{
		try 
		{
			$sql = "UPDATE tb_persona SET 
						nvchnombres = ?, 
						nvchapellido = ?,
						nvchdireccion  = ?, 
						nvchcorreo = ?,
						nvchphone = ?
				    WHERE intidpersona = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				array(
					$data->__GET('nvchnombres'), 
					$data->__GET('nvchapellido'), 
					$data->__GET('nvchdireccion'),
					$data->__GET('nvchcorreo'),
					//agregado recien
					$data->__GET('nvchphone'),
					$data->__GET('intidpersona')
					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Registrar(Persona $data)
	{

		try 
		{
		$sql = "INSERT INTO tb_persona (nvchnombres,nvchapellido,nvchdireccion,nvchcorreo,nvchphone) 
		        VALUES (?, ?, ?, ?, ?)";

		$this->pdo->prepare($sql)
		     ->execute(
			array(
				$data->__GET('nvchnombres'), 
				$data->__GET('nvchapellido'), 
				$data->__GET('nvchdireccion'),
				$data->__GET('nvchcorreo'),
				$data->__GET('nvchphone')

				)
			);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}
