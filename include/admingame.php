<?php
require_once 'game.entidad.php';
require_once 'game.model.php';
// Logica
$gam = new Game();
$model = new GameModel();

if(isset($_REQUEST['action']))
{
	switch($_REQUEST['action'])
	{
		case 'actualizar':
			$gam->__SET('intidgame',$_REQUEST['intidgame']);
			$gam->__SET('nvchnombre',$_REQUEST['nvchnombre']);
			$gam->__SET('nvchdescripcion',$_REQUEST['nvchdescripcion']);
			$gam->__SET('nvchlinkspot',$_REQUEST['nvchlinkspot']);
			$gam->__SET('nvchbanner', $_REQUEST['nvchbanner']);
            $gam->__SET('nvchlinkdownandr', $_REQUEST['nvchlinkdownandr']);
            $gam->__SET('nvchlinkdownpc', $_REQUEST['nvchlinkdownpc']);
            $gam->__SET('nvchlinkdownios', $_REQUEST['nvchlinkdownios']);
            //$alm->__SET('foto', $_REQUEST['foto']);
			$model->Actualizar($gam);
			header('Location: admingame.php');
			break;

		case 'registrar':
			$gam->__SET('nvchnombre',$_REQUEST['nvchnombre']);
			$gam->__SET('nvchdescripcion',$_REQUEST['nvchdescripcion']);
			$gam->__SET('nvchlinkspot',$_REQUEST['nvchlinkspot']);
			$gam->__SET('nvchbanner',$_REQUEST['nvchbanner']);
            $gam->__SET('nvchlinkdownandr', $_REQUEST['nvchlinkdownandr']);
            $gam->__SET('nvchlinkdownpc', $_REQUEST['nvchlinkdownpc']);
            $gam->__SET('nvchlinkdownios', $_REQUEST['nvchlinkdownios']);

			$model->Registrar($gam);
			header('Location: admingame.php');
			break;

		case 'eliminar':
			$model->Eliminar($_REQUEST['intidgame']);
			header('Location: admingame.php');
			break;

		case 'editar':
			$gam = $model->Obtener($_REQUEST['intidgame']);
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
						<div class="panel-heading">Registro Juegos</div>
						<div class="panel-body">
							<div class="col-md-6">
				                <form action="?action=<?php echo $gam->intidgame > 0 ? 'actualizar' : 'registrar'; ?>" method="post" class="pure-form pure-form-stacked" style="margin-bottom:30px;" enctype="multipart/form-data">
				                    <input type="hidden" name="intidgame" value="<?php echo $gam->__GET('intidgame'); ?>" />
				                    <label for="">Nombre game</label>
				                    <input class="form-control" type="text" name="nvchnombre" value="<?php echo $gam->__GET('nvchnombre'); ?>" style="width:100%;" required />
				                    <label for="">descripcion</label>
				                    <input class="form-control" type="text" name="nvchdescripcion" value="<?php echo $gam->__GET('nvchdescripcion'); ?>" style="width:100%;" />
				                    <label for="">pitch link</label>
				                    <input class="form-control" type="text" name="nvchlinkspot" value="<?php echo $gam->__GET('nvchlinkspot'); ?>" style="width:100%;" />
				                    <label for="">banner</label>
				                    <input class="form-control" type="text" name="nvchbanner" value="<?php echo $gam->__GET('nvchbanner'); ?>" style="width:100%;" />
									<label for="">link android</label>
				                    <input class="form-control" type="text" name="nvchlinkdownandr" value="<?php echo $gam->__GET('nvchlinkdownandr'); ?>" style="width:100%;" />
				                    <label for="">link ios</label>
				                    <input class="form-control" type="text" name="nvchlinkdownpc" value="<?php echo $gam->__GET('nvchlinkdownpc'); ?>" style="width:100%;" />
				                    <label for="">link pc</label>
				                    <input class="form-control" type="text" name="nvchlinkdownios" value="<?php echo $gam->__GET('nvchlinkdownios'); ?>" style="width:100%;" />
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
						<div class="panel-heading">Videojuegos</div>
						<div class="panel-body">
							<table data-toggle="table" data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
							    <thead>
							    <tr>
							        <th style="text-transform: uppercase">Videojuego</th>
							        <th style="text-transform: uppercase">Descripcion</th>
							        <th style="text-transform: uppercase">PITCH</th>
							        <th style="text-transform: uppercase">Descargas</th>
							        <th style="text-transform: uppercase">Opciones</th>
							    </tr>
							    </thead>
								<?php foreach($model->Listar() as $r): ?>
			                        <tr>
			                            <td>
			                                <?php echo $r->__GET('nvchnombre'); ?>
			                            </td>
			                            <td>
			                                <?php echo $r->__GET('nvchdescripcion'); ?>
			                            </td>
			                            <td>
			                                <a href="<?php echo $r->__GET('nvchlinkspot'); ?>"><?php echo $r->__GET('nvchlinkspot'); ?></a>
			                            </td>
			                            <td>
			                                <a href="<?php echo $r->__GET('nvchlinkdownandr'); ?>"><?php echo $r->__GET('nvchlinkdownandr'); ?></a>
			                                <br>
			                                <a href="<?php echo $r->__GET('nvchlinkdownpc'); ?>"><?php echo $r->__GET('nvchlinkdownpc'); ?></a>
			                                <br>
			                                <a href="<?php echo $r->__GET('nvchlinkdownios'); ?>"><?php echo $r->__GET('nvchlinkdownios'); ?></a>
			                            </td>
			                            <td>
			                                <a href="?action=editar&intidgame=<?php echo $r->intidgame; ?>">Editar</a>
			                                <a href="?action=eliminar&intidgame=<?php echo $r->intidgame; ?>">Eliminar</a>
			                            </td>
			                        </tr>
			                    <?php endforeach; ?>
							</table>
						</div>
					</div>
				</div>
			</div><!--/.row-->	

                <form action="?action=<?php echo $gam->intidgame > 0 ? 'actualizar' : 'registrar'; ?>" method="post" class="pure-form pure-form-stacked" style="margin-bottom:30px;" enctype="multipart/form-data">
                    <input type="hidden" name="intidgame" value="<?php echo $gam->__GET('intidgame'); ?>" />
                </form> 
              
		</form>
	</div><!--/.main-->

<?php include_once('panelfooter.php'); ?>