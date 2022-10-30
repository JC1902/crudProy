<?php
class ProductoModelo {
    private $pdo;

    public function __CONSTRUCT () {
        try {

            $this->pdo = new PDO('mysql:host=localhost;dbname=videojuegos', 'root', '');
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch ( Exception $e ) {

            die($e->getMessage());

        }
    }

    public function Listar() {
		try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM catalogo");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$prod = new Producto();

				$prod->__SET('id', $r->id);
				$prod->__SET('Compania', $r->Compania);
                $prod->__SET('Nombre', $r->Nombre);
				$prod->__SET('Precio', $r->Precio);
				$prod->__SET('AnoLanzamiento', $r->AnoLanzamiento);
				$prod->__SET('Generos', $r->Generos);
                $prod->__SET('Plataformas', $r->Plataformas);
                $prod->__SET('Imagen', $r->Imagen);

				$result[] = $prod;
			}

			return $result;
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

    public function Obtener( $id ) {
        try {
            $stm = $this->pdo->prepare("SELECT * FROM catalogo WHERE id = ?");

            $stm->execute(array($id));
            $r = $stm->fetch(PDO::FETCH_OBJ);

            $prod = new Producto();

            $prod->__SET('id', $r->id);
			$prod->__SET('Compania', $r->Compania);
            $prod->__SET('Nombre', $r->Nombre);
			$prod->__SET('Precio', $r->Precio);
			$prod->__SET('AnoLanzamiento', $r->AnoLanzamiento);
			$prod->__SET('Generos', $r->Generos);
            $prod->__SET('Plataformas', $r->Plataformas);
            $prod->__SET('Imagen', $r->Imagen);

            return $prod;
        } catch (Exception $e) {
            die( $e->getMessage());
        }
    }

    public function Eliminar($id) {
        try {
            $stm = $this->pdo->prepare("DELETE FROM catalogo WHERE id = ?");

            $stm->execute(array($id));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Actualizar(Producto $datos) {
        try {
            $sql = "UPDATE catalogo SET
                        Compania        = ?,
                        Nombre          = ?,
                        Precio          = ?,
                        AnoLanzamiento  = ?,
                        Generos         = ?,
                        Plataformas     = ?,
                        Imagen          = ?
                    WHERE id = ?";

            $this->pdo->prepare($sql)->execute(
                                        array(
                                            $datos->__GET('Compania'),
                                            $datos->__GET('Nombre'),
                                            $datos->__GET('Precio'),
                                            $datos->__GET('AnoLanzamiento'),
                                            $datos->__GET('Generos'),
                                            $datos->__GET('Plataformas'),
                                            $datos->__GET('Imagen'),
                                            $datos->__GET('id')
                                            )
                                    );
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Registrar(Producto $datos)
	{
		try 
		{
		$sql = "INSERT INTO catalogo (Compania,Nombre,Precio,AnoLanzamiento,Generos,Plataformas,Imagen) 
		        VALUES (?, ?, ?, ?, ?, ?, ?)";

		$this->pdo->prepare($sql)
		     ->execute(
			array(
                $datos->__GET('Compania'),
                $datos->__GET('Nombre'),
                $datos->__GET('Precio'),
                $datos->__GET('AnoLanzamiento'),
                $datos->__GET('Generos'),
                $datos->__GET('Plataformas'),
                $datos->__GET('Imagen')
				)
			);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}