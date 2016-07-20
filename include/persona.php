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
			header('Location: persona.php');
			break;

		case 'registrar':
			$per->__SET('nvchnombres',$_REQUEST['nvchnombres']);
			$per->__SET('nvchapellido',$_REQUEST['nvchapellido']);
			$per->__SET('nvchdireccion',$_REQUEST['nvchdireccion']);
			$per->__SET('nvchcorreo',$_REQUEST['nvchcorreo']);
            $per->__SET('nvchphone', $_REQUEST['nvchphone']);

			$model->Registrar($per);
			header('Location: persona.php');
			break;

		case 'eliminar':
			$model->Eliminar($_REQUEST['intidpersona']);
			header('Location: persona.php');
			break;

		case 'editar':
			$per = $model->Obtener($_REQUEST['intidpersona']);
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

                
                <form action="?action=<?php echo $per->intidpersona > 0 ? 'actualizar' : 'registrar'; ?>" method="post" class="pure-form pure-form-stacked" style="margin-bottom:30px;" enctype="multipart/form-data">
                    <input type="hidden" name="intidpersona" value="<?php echo $per->__GET('intidpersona'); ?>" />
                    
                    <table style="width:500px;">
                        <tr>
                            <th style="text-align:left;">Nombre</th>
                            <td><input type="text" name="nvchnombres" value="<?php echo $per->__GET('nvchnombres'); ?>" style="width:100%;" required /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Apellido</th>
                            <td><input type="text" name="nvchapellido" value="<?php echo $per->__GET('nvchapellido'); ?>" style="width:100%;" required/></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Direccion</th>
                                <td><input type="text" name="nvchdireccion" value="<?php echo $per->__GET('nvchdireccion'); ?>" style="width:100%;" required/></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Correo</th>
                            <td><input type="mail" name="nvchcorreo" value="<?php echo $per->__GET('nvchcorreo'); ?>" style="width:100%;" required/></td>
                        </tr>
                        <!--agregado recientemente-->
                        <tr>
                            <th style="text-align:left;">Telefono</th>
                            <td><input type="text" name="nvchphone" value="<?php echo $per->__GET('nvchphone'); ?>" style="width:100%;" required/></td>
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
                            <th style="text-align:left;">Apellido</th>
                            <th style="text-align:left;">Sexo</th>
                            <th style="text-align:left;">Nacimiento</th>
                            <th style="text-align:left;">Fecha registro</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <?php foreach($model->Listar() as $r): ?>
                        <tr>
                            <td><?php echo $r->__GET('nvchnombres'); ?></td>
                            <td><?php echo $r->__GET('nvchapellido'); ?></td>
                            <td><?php echo $r->__GET('nvchdireccion'); ?></td>
                            <!--td><?php //echo $r->__GET('Sexo') == 1 ? 'H' : 'F'; ?></td-->
                            <td><?php echo $r->__GET('nvchcorreo'); ?></td>
                            <td><?php echo $r->__GET('nvchphone'); ?></td>
                            <td>
                                <a href="?action=editar&intidpersona=<?php echo $r->intidpersona; ?>">Editar</a>
                            </td>
                            <td>
                                <a href="?action=eliminar&intidpersona=<?php echo $r->intidpersona; ?>">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>     
              
            </div>
        </div>

    </body>
</html>