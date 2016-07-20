<?php
require_once 'adminskillperson.entidad.php';
require_once 'adminskillperson.model.php';
// Logica
$per = new Skillperson();
$model = new SkillpersonModel();

if(isset($_REQUEST['action']))
{
	switch($_REQUEST['action'])
	{
		case 'actualizar':
			$per->__SET('intidskillme',$_REQUEST['intidskillme']);
			$per->__SET('intidpersona',$_REQUEST['intidpersona']);
			$per->__SET('nvchskillname',$_REQUEST['nvchskillname']);
            $per->__SET('nvchporcentaje', $_REQUEST['nvchporcentaje']);
            //$alm->__SET('foto', $_REQUEST['foto']);
			$model->Actualizar($per);
			header('Location: adminskillperson.php');
			break;

		case 'registrar':
			$per->__SET('intidpersona',$_REQUEST['intidpersona']);
			$per->__SET('nvchskillname',$_REQUEST['nvchskillname']);
            $per->__SET('nvchporcentaje', $_REQUEST['nvchporcentaje']);

			$model->Registrar($per);
			echo "<script>alert('Registro exitoso..!!');</script>";
			header('Location: adminskillperson.php');
			break;

		case 'eliminar':
			$model->Eliminar($_REQUEST['intidskillme']);
			header('Location: adminskillperson.php');
			break;

		case 'editar':
			$per = $model->Obtener($_REQUEST['intidskillme']);
			break;
	}


}


include_once('connection.php');
	$servidor = 'localhost';
	$user = 'root';
	$pass = '';
	$name = 'db_portfoliogame';
	conectar($servidor, $user, $pass, $name);
//dame tareas para el combobox
	function dameusuario(){
	    $consulta_mysql="
	    SELECT
		  tb_persona.intidpersona,
		  tb_persona.nvchapellido,
		  tb_persona.nvchnombres
		FROM
		  tb_persona
	    ";
	    $resultado_consulta_mysql=mysql_query($consulta_mysql);
	    while($registro = mysql_fetch_array($resultado_consulta_mysql)){
	        echo "
	              <option value='".$registro['intidpersona']."'>".$registro['nvchnombres']." ".$registro['nvchapellido']."
	              </option>
	        ";
	    }
	}

	function damegame(){
	    $consulta_mysql="
	    SELECT
			tb_game.intidgame,
			tb_game.nvchnombre
		from 
		tb_game
	    ";
	    $resultado_consulta_mysql=mysql_query($consulta_mysql);
	    while($registro = mysql_fetch_array($resultado_consulta_mysql)){
	        echo "
	              <option value='".$registro['intidgame']."'>
	                ".$registro['nvchnombre']."
	              </option>
	        ";
	    }
	}

	function damelista(){
		$consulta_mysql="
	    SELECT 
			tb_skillme.intidskillme,
			tb_persona.nvchnombres,
			tb_persona.nvchapellido,
			tb_skillme.nvchskillname, 
			tb_skillme.nvchporcentaje
		FROM 
		tb_skillme inner join tb_persona
		on tb_persona.intidpersona =  tb_skillme.intidpersona
	    ";
	    $resultado_consulta_mysql=mysql_query($consulta_mysql);
	    while($registro = mysql_fetch_array($resultado_consulta_mysql)){
	        echo "
              	<tr style='text-transform: uppercase;'>
					<td>".$registro['nvchnombres']." ".$registro['nvchapellido']."</td>
					<td>".$registro['nvchskillname']."</td>
					<td>".$registro['nvchporcentaje']."%</td>
					<td>
						<a href='?action=editar&intidskillme=".$registro['intidskillme']."'>Editar</a>
		                <a href='?action=eliminar&intidskillme=".$registro['intidskillme']."'>Eliminar</a>
					</td>
				</tr>
	        ";
	    }
	}


include('panelheader.php');
?>
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
			<div class="row">
				<ol class="breadcrumb">
					<li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
					<li class="active">Tables</li>
				</ol>
			</div><!--/.row-->
			<br>

			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-default">
						<div class="panel-heading">Rol en videojuego</div>
						<div class="panel-body">
							<div class="col-md-6">
								<form action="?action=<?php echo $per->intidskillme > 0 ? 'actualizar' : 'registrar'; ?>" method="post" class="pure-form pure-form-stacked" style="margin-bottom:30px;" enctype="multipart/form-data">
				                    <input class="form-control" type="hidden" name="intidskillme" value="<?php echo $per->__GET('intidjuego_persona'); ?>" />
				                    <label for="">Persona</label>
				                    <!--select persona-->
				                    <select name="intidpersona" class="form-control" id="">
                                          <?php dameusuario(); ?>
                                    </select>
                                    <!--END select persona-->
				                    <label for="">Habilidad</label>
				                    <!--select persona-->
				                    <input class="form-control" type="text" name="nvchskillname" value="<?php echo $per->__GET('nvchskillname'); ?>" style="width:100%;" required/>
                                    <!--END select persona-->
				                    <label for="">Dominio (%)</label>
				                    <input class="form-control" type="number" min="1" max='100' name="nvchporcentaje" value="<?php echo $per->__GET('nvchporcentaje'); ?>" style="width:100%;" required/>
				                    <br>
				                    <button type="submit" class="btn btn-primary">Guardar</button>
									<button type="reset" class="btn btn-danger">Limpiar</button>
				                </form>
							</div>
						</div>
					</div>
				</div><!-- /.col-->
			</div><!-- /.row -->

			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-default">
						<div class="panel-heading">Personas</div>
						<div class="panel-body">
							<table data-toggle="table"  data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
							    <thead>
							    <tr>
							        <th >Persona</th>
							        <th >Juego</th>
							        <th >Funcion</th>
							        <th>Opciones</th>
							    </tr>
							    </thead>
								<?php damelista(); ?>
							</table>
						</div>
					</div>
				</div>
			</div><!--/.row-->	
	</div><!--/.main-->

<?php include_once('panelfooter.php'); ?>