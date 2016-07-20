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
			header('Location: game.php');
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
			header('Location: game.php');
			break;

		case 'eliminar':
			$model->Eliminar($_REQUEST['intidgame']);
			header('Location: game.php');
			break;

		case 'editar':
			$gam = $model->Obtener($_REQUEST['intidgame']);
			break;
	}
}

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Anexsoft</title>
        <meta charset="utf-8">
	</head>
    <body style="padding:15px;">

        <div class="pure-g">
            <div class="pure-u-1-12">

                
                <form action="?action=<?php echo $gam->intidgame > 0 ? 'actualizar' : 'registrar'; ?>" method="post" class="pure-form pure-form-stacked" style="margin-bottom:30px;" enctype="multipart/form-data">
                    <input type="hidden" name="intidgame" value="<?php echo $gam->__GET('intidgame'); ?>" />
                    
                    <table style="width:500px;">
                        <tr>
                            <th style="text-align:left;">Nombre game</th>
                            <td><input type="text" name="nvchnombre" value="<?php echo $gam->__GET('nvchnombre'); ?>" style="width:100%;" required /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">descripcion</th>
                            <td><input type="text" name="nvchdescripcion" value="<?php echo $gam->__GET('nvchdescripcion'); ?>" style="width:100%;" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">pitch link</th>
                                <td><input type="text" name="nvchlinkspot" value="<?php echo $gam->__GET('nvchlinkspot'); ?>" style="width:100%;" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">banner</th>
                            <td><input type="text" name="nvchbanner" value="<?php echo $gam->__GET('nvchbanner'); ?>" style="width:100%;" /></td>
                        </tr>
                        <!--agregado recientemente-->
                        <tr>
                            <th style="text-align:left;">link android</th>
                            <td><input type="text" name="nvchlinkdownandr" value="<?php echo $gam->__GET('nvchlinkdownandr'); ?>" style="width:100%;" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">link ios</th>
                            <td><input type="text" name="nvchlinkdownpc" value="<?php echo $gam->__GET('nvchlinkdownpc'); ?>" style="width:100%;" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">link pc</th>
                            <td><input type="text" name="nvchlinkdownios" value="<?php echo $gam->__GET('nvchlinkdownios'); ?>" style="width:100%;" /></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <button type="submit" class="pure-button pure-button-primary">Guardar</button>
                            </td>
                        </tr>
                    </table>
                </form>

                <table class="pure-table pure-table-horizontal">
                    <thead>
                        <tr>
                            <th style="text-align:left;">Nombre</th>
                            <th style="text-align:left;">descripcion</th>
                            <th style="text-align:left;">pitch</th>
                            <th style="text-align:left;">banner</th>
                            <th style="text-align:left;">downandroid</th>
                            <th style="text-align:left;">down pc</th>
                            <th style="text-align:left;">down ios</th>

                            <th>opciones</th>
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
                                <?php echo $r->__GET('nvchlinkspot'); ?>
                            </td>
                            <td>
                                <?php echo $r->__GET('nvchbanner'); ?></td>
                            <td>
                                <?php echo $r->__GET('nvchlinkdownandr'); ?>
                            </td>
                            <td>
                                <?php echo $r->__GET('nvchlinkdownpc'); ?>
                            </td>
                            <td>
                                <?php echo $r->__GET('nvchlinkdownios'); ?>
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

    </body>
</html>