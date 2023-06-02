<?php
    require_once(__DIR__.'/sistema.php');

    class Sucursal extends Sistema{
        public function get($idSucursal = null){
            $this->db();
            if (is_null($idSucursal)) {
                $sql = 'SELECT * FROM sucursal';
                $st = $this->db->prepare($sql);
                $st->execute();
                $data = $st->fetchAll(PDO::FETCH_ASSOC);
            } else {
                $sql = 'SELECT * FROM sucursal WHERE id_sucursal = :id_sucursal';
                $st = $this->db->prepare($sql);
                $st->bindParam(':id_sucursal', $idSucursal, PDO::PARAM_INT);
                $st->execute();
                $data = $st->fetchAll(PDO::FETCH_ASSOC);
            }
            return $data;
        }

        public function new($data){
            $this->db();
            try {
                $this->db->beginTransaction();

                $sql = 'INSERT INTO sucursal(sucursal, direccion) VALUES (:sucursal, :direccion)';
                $st = $this->db->prepare($sql);
                $st->bindParam(':sucursal', $data['sucursal'], PDO::PARAM_STR);
                $st->bindParam(':direccion', $data['direccion'], PDO::PARAM_STR);
                $st->execute();
                $rc = $st->rowCount();

                $this->db->commit();

                return $rc;
            } catch (PDOException $e) {
                $this->db->rollBack();
                throw $e;
            }
        }

        public function delete($idSucursal){
            $this->db();

            try {
                $this->db->beginTransaction();

                $sql = "DELETE FROM juguete WHERE id_sucursal = :id_sucursal";
                $st = $this->db->prepare($sql);
                $st->bindParam(':id_sucursal', $idSucursal, PDO::PARAM_INT);

                $sql2 = "DELETE FROM ropa WHERE id_sucursal = :id_sucursal";
                $st2 = $this->db->prepare($sql2);
                $st2->bindParam(':id_sucursal', $idSucursal, PDO::PARAM_INT);

                $sql3 = "DELETE FROM calzado WHERE id_sucursal = :id_sucursal";
                $st3 = $this->db->prepare($sql3);
                $st3->bindParam(':id_sucursal', $idSucursal, PDO::PARAM_INT);

                $sql4 = "DELETE FROM sucursal WHERE id_sucursal = :id_sucursal";
                $st4 = $this->db->prepare($sql4);
                $st4->bindParam(':id_sucursal', $idSucursal, PDO::PARAM_INT);
                $st->execute();
                $st2->execute();
                $st3->execute();
                $st4->execute();
                $rc = $st4->rowCount();

                $this->db->commit();

                return $rc;
            } catch (PDOException $e) {
                $this->db->rollBack();
                throw $e;
            }
        }

        public function edit($idSucursal, $data){
            $this->db();

            try {
                $this->db->beginTransaction();

                $sql = 'UPDATE sucursal SET sucursal = :sucursal, direccion = :direccion WHERE id_sucursal = :id_sucursal';
                $st = $this->db->prepare($sql);
                $st->bindParam(':id_sucursal', $idSucursal, PDO::PARAM_INT);
                $st->bindParam(':sucursal', $data['sucursal'], PDO::PARAM_STR);
                $st->bindParam(':direccion', $data['direccion'], PDO::PARAM_STR);
                $st->execute();
                $rc = $st->rowCount();

                $this->db->commit();

                return $rc;
            } catch (PDOException $e) {
                $this->db->rollBack();
                throw $e;
            }
        }
    }

    $sucursal = new Sucursal;
?>