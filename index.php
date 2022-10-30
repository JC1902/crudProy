<?php
require_once 'producto.entidad.php';
require_once 'producto.modelo.php';

// Logica
$prod = new Producto();
$model = new ProductoModelo();

if(isset($_REQUEST['action']))
{
	switch($_REQUEST['action'])
	{
		case 'actualizar':
            $prod->__SET('id',              $_REQUEST['id']);
			$prod->__SET('Compania',        $_REQUEST['Compania']);
            $prod->__SET('Nombre',          $_REQUEST['Nombre']);
			$prod->__SET('Precio',          $_REQUEST['Precio']);
			$prod->__SET('AnoLanzamiento',  $_REQUEST['AnoLanzamiento']);
			$prod->__SET('Generos',         $_REQUEST['Generos']);
            $prod->__SET('Plataformas',     $_REQUEST['Plataformas']);
            $prod->__SET('Imagen',          $_REQUEST['Imagen']);

			$model->Actualizar($prod);
			header('Location: index.php');
			break;

		case 'registrar':
			$prod->__SET('Compania',        $_REQUEST['Compania']);
            $prod->__SET('Nombre',          $_REQUEST['Nombre']);
			$prod->__SET('Precio',          $_REQUEST['Precio']);
			$prod->__SET('AnoLanzamiento',  $_REQUEST['AnoLanzamiento']);
			$prod->__SET('Generos',         $_REQUEST['Generos']);
            $prod->__SET('Plataformas',     $_REQUEST['Plataformas']);
            $prod->__SET('Imagen',          $_REQUEST['Imagen']);

			$model->Registrar($prod);
			header('Location: index.php');
			break;

		case 'eliminar':
			$model->Eliminar($_REQUEST['id']);
			header('Location: index.php');
			break;

		case 'editar':
			$prod = $model->Obtener($_REQUEST['id']);
			break;
	}
}

?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<title>Anexsoft</title>
        <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/pure-min.css">
	</head>
    <body style="padding:15px;">

        <div class="pure-g">
            <div class="pure-u-1-12">
                
                <form action="?action=<?php echo $prod->id > 0 ? 'actualizar' : 'registrar'; ?>" method="post" class="pure-form pure-form-stacked" style="margin-bottom:30px;">
                    <input type="hidden" name="id" value="<?php echo $prod->__GET('id'); ?>" />
                    
                    <table style="width:500px;">
                        <tr>
                            <th style="text-align:left;">Compania</th>
                            <td><input type="text" name="Compania" value="<?php echo $prod->__GET('Compania'); ?>" style="width:100%;" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Nombre</th>
                            <td><input type="text" name="Nombre" value="<?php echo $prod->__GET('Nombre'); ?>" style="width:100%;" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Precio</th>
                            <td><input type="text" name="Precio" value="<?php echo $prod->__GET('Precio'); ?>" style="width:100%;" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Año de Lanzamiento</th>
                            <td><input type="text" name="AnoLanzamiento" value="<?php echo $prod->__GET('AnoLanzamiento'); ?>" style="width:100%;" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Generos</th>
                            <td><input type="text" name="Generos" value="<?php echo $prod->__GET('Generos'); ?>" style="width:100%;" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Plataformas</th>
                            <td><input type="text" name="Plataformas" value="<?php echo $prod->__GET('Plataformas'); ?>" style="width:100%;" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Imagen</th>
                            <td><input type="text" name="Imagen" value="<?php echo $prod->__GET('Imagen'); ?>" style="width:100%;" /></td>
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
                            <th style="text-align:left;">Compania</th>
                            <th style="text-align:left;">Nombre</th>
                            <th style="text-align:left;">Precio</th>
                            <th style="text-align:left;">Año de Lanzamiento</th>
                            <th style="text-align:left;">Generos</th>
                            <th style="text-align:left;">Plataformas</th>
                            <th style="text-align:left;">Imagen</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <?php foreach($model->Listar() as $r): ?>
                        <tr>
                            <td><?php echo $r->__GET('Compania'); ?></td>
                            <td><?php echo $r->__GET('Nombre'); ?></td>
                            <td><?php echo $r->__GET('Precio'); ?></td>
                            <td><?php echo $r->__GET('AnoLanzamiento'); ?></td>
                            <td><?php echo $r->__GET('Generos'); ?></td>
                            <td><?php echo $r->__GET('Plataformas'); ?></td>
                            <td><?php echo $r->__GET('Imagen'); ?></td>
                            <td>
                                <a href="?action=editar&id=<?php echo $r->id; ?>">Editar</a>
                            </td>
                            <td>
                                <a href="?action=eliminar&id=<?php echo $r->id; ?>">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>     
              
            </div>
        </div>

    </body>
</html>