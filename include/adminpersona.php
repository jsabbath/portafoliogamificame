<?php
require_once 'persona.entidad.php';
require_once 'persona.model.php';
// Logica
$per = new Persona();
$model = new PersonaModel();

if(isset($_REQUEST['action']))
{
	switch($_REQUEST['action'])
	{
		case 'actualizar':
			$per->__SET('intidpersona',$_REQUEST['intidpersona']);
			$per->__SET('nvchnombres',$_REQUEST['nvchnombres']);
			$per->__SET('nvchapellido',$_REQUEST['nvchapellido']);
			$per->__SET('nvchdireccion',$_REQUEST['nvchdireccion']);
			$per->__SET('nvchcorreo', $_REQUEST['nvchcorreo']);
            $per->__SET('nvchphone', $_REQUEST['nvchphone']);
            //$alm->__SET('foto', $_REQUEST['foto']);
			$model->Actualizar($per);
			header('Location: adminpersona.php');
			break;

		case 'registrar':
			$per->__SET('nvchnombres',$_REQUEST['nvchnombres']);
			$per->__SET('nvchapellido',$_REQUEST['nvchapellido']);
			$per->__SET('nvchdireccion',$_REQUEST['nvchdireccion']);
			$per->__SET('nvchcorreo',$_REQUEST['nvchcorreo']);
            $per->__SET('nvchphone', $_REQUEST['nvchphone']);

			$model->Registrar($per);
			header('Location: adminpersona.php');
			break;

		case 'eliminar':
			$model->Eliminar($_REQUEST['intidpersona']);
			header('Location: adminpersona.php');
			break;

		case 'editar':
			$per = $model->Obtener($_REQUEST['intidpersona']);
			break;
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
						<div class="panel-heading">Registro Personas</div>
						<div class="panel-body">
							<div class="col-md-6">
								<form action="?action=<?php echo $per->intidpersona > 0 ? 'actualizar' : 'registrar'; ?>" method="post" class="pure-form pure-form-stacked" style="margin-bottom:30px;" enctype="multipart/form-data">
				                    <input class="form-control" type="hidden" name="intidpersona" value="<?php echo $per->__GET('intidpersona'); ?>" />
				                    <label for="">Nombre</label>
				                    <input style='text-transform: uppercase;' class="form-control" type="text" name="nvchnombres" value="<?php echo $per->__GET('nvchnombres'); ?>" style="width:100%;" required />
				                    <label for="">Apellido</label>
				                    <input style='text-transform: uppercase;' class="form-control" type="text" name="nvchapellido" value="<?php echo $per->__GET('nvchapellido'); ?>" style="width:100%;" required/>
				                    <label for="">Direccion</label>
				                    <input class="form-control" type="text" name="nvchdireccion" value="<?php echo $per->__GET('nvchdireccion'); ?>" style="width:100%;" required/>
				                    <label for="">Correo</label>
				                    <input class="form-control" type="mail" name="nvchcorreo" value="<?php echo $per->__GET('nvchcorreo'); ?>" style="width:100%;" required/>
				                    <label for="">Telefono</label>
				                    <input class="form-control" type="text" name="nvchphone" value="<?php echo $per->__GET('nvchphone'); ?>" style="width:100%;" required/>
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
							        <th >Nombres y apellidos</th>
							        <th >Direccion</th>
							        <th >e-mail</th>
							        <th >Telefono</th>
							        <th >Opciones</th>
							    </tr>
							    </thead>
                                <?php foreach($model->Listar() as $r): ?>
			                        <tr>
			                            <td><?php echo $r->__GET('nvchnombres'); ?>
			                            <?php echo $r->__GET('nvchapellido'); ?></td>
			                            <td><?php echo $r->__GET('nvchdireccion'); ?></td>
			                            <!--td><?php //echo $r->__GET('Sexo') == 1 ? 'H' : 'F'; ?></td-->
			                            <td><?php echo $r->__GET('nvchcorreo'); ?></td>
			                            <td><?php echo $r->__GET('nvchphone'); ?></td>
			                            <td>
			                                <a href="?action=editar&intidpersona=<?php echo $r->intidpersona; ?>">Editar</a>
			                                <a href="?action=eliminar&intidpersona=<?php echo $r->intidpersona; ?>">Eliminar</a>
			                            </td>
			                        </tr>
			                    <?php endforeach; ?>
							</table>
						</div>
					</div>
				</div>
			</div><!--/.row-->	
	</div><!--/.main-->

<?php include_once('panelfooter.php'); ?>