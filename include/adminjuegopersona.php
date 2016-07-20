<?php
require_once 'juegopersona.entidad.php';
require_once 'juegopersona.model.php';
// Logica
$per = new Juegopersona();
$model = new JuegopersonaModel();

if(isset($_REQUEST['action']))
{
	switch($_REQUEST['action'])
	{
		case 'actualizar':
			$per->__SET('intidjuego_persona',$_REQUEST['intidjuego_persona']);
			$per->__SET('intidpersona',$_REQUEST['intidpersona']);
			$per->__SET('intidgame',$_REQUEST['intidgame']);
            $per->__SET('nvchfuncion', $_REQUEST['nvchfuncion']);
            //$alm->__SET('foto', $_REQUEST['foto']);
			$model->Actualizar($per);
			header('Location: adminjuegopersona.php');
			break;

		case 'registrar':
			$per->__SET('intidpersona',$_REQUEST['intidpersona']);
			$per->__SET('intidgame',$_REQUEST['intidgame']);
            $per->__SET('nvchfuncion', $_REQUEST['nvchfuncion']);

			$model->Registrar($per);
			echo "<script>alert('Registro exitoso..!!');</script>";
			header('Location: adminjuegopersona.php');
			break;

		case 'eliminar':
			$model->Eliminar($_REQUEST['intidjuego_persona']);
			header('Location: adminjuegopersona.php');
			break;

		case 'editar':
			$per = $model->Obtener($_REQUEST['intidjuego_persona']);
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
			tb_juego_persona.intidjuego_persona,
			tb_persona.nvchnombres,
			tb_persona.nvchapellido,
			tb_game.nvchnombre as namegame,
			tb_juego_persona.nvchfuncion
		from 
		tb_juego_persona 
		inner join tb_persona
			on tb_juego_persona.intidpersona = tb_persona.intidpersona
		inner join tb_game
			on tb_game.intidgame = tb_juego_persona.intidgame
	    ";
	    $resultado_consulta_mysql=mysql_query($consulta_mysql);
	    while($registro = mysql_fetch_array($resultado_consulta_mysql)){
	        echo "
              	<tr>
					<td>".$registro['nvchnombres']." ".$registro['nvchapellido']."</td>
					<td>".$registro['namegame']."</td>
					<td>".$registro['nvchfuncion']."</td>
					<td>
						<a href='?action=editar&intidjuego_persona=".$registro['intidjuego_persona']."'>Editar</a>
		                <a href='?action=eliminar&intidjuego_persona=".$registro['intidjuego_persona']."'>Eliminar</a>
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
								<form action="?action=<?php echo $per->intidjuego_persona > 0 ? 'actualizar' : 'registrar'; ?>" method="post" class="pure-form pure-form-stacked" style="margin-bottom:30px;" enctype="multipart/form-data">
				                    <input class="form-control" type="hidden" name="intidjuego_persona" value="<?php echo $per->__GET('intidjuego_persona'); ?>" />
				                    <label for="">Persona</label>
				                    <!--select persona-->
				                    <select name="intidpersona" class="form-control" id="">
                                          <?php dameusuario(); ?>
                                    </select>
                                    <!--END select persona-->

				                    <label for="">Juego</label>
				                    <!--select persona-->
				                    <select name="intidgame" class="form-control" id="">
                                          <?php damegame(); ?>
                                    </select>
                                    <!--END select persona-->
				                    <label for="">Funcion</label>
				                    <input class="form-control" type="text" name="nvchfuncion" value="<?php echo $per->__GET('nvchfuncion'); ?>" style="width:100%;" required/>
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