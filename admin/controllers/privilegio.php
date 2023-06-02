<?php
    require_once(__DIR__.'/sistema.php');

    class Privilegio extends Sistema{
        public function get($idPrivilegio = null){
            $this->db();
            if (is_null($idPrivilegio)) {
                $sql = 'SELECT * FROM privilegio';
                $st = $this->db->prepare($sql);
                $st->execute();
                $data = $st->fetchAll(PDO::FETCH_ASSOC);
            } else {
                $sql = 'SELECT * FROM privilegio WHERE id_privilegio = :id_privilegio';
                $st = $this->db->prepare($sql);
                $st->bindParam(':id_privilegio', $idPrivilegio, PDO::PARAM_INT);
                $st->execute();
                $data = $st->fetchAll(PDO::FETCH_ASSOC);
            }
            return $data;
        }

        public function new($data){
            $this->db();
            try {
                $this->db->beginTransaction();

                $sql = 'INSERT INTO privilegio(privilegio) VALUES (:privilegio)';
                $st = $this->db->prepare($sql);
                $st->bindParam(':privilegio', $data['privilegio'], PDO::PARAM_STR);
                $st->execute();
                $rc = $st->rowCount();

                $this->db->commit();

                return $rc;
            } catch (PDOException $e) {
                $this->db->rollBack();
                throw $e;
            }
        }

        public function delete($idPrivilegio){
            $this->db();

            try {
                $this->db->beginTransaction();
                $sql = "DELETE FROM rol_privilegio WHERE id_privilegio = :id_privilegio";
                $st = $this->db->prepare($sql);
                $st->bindParam(':id_privilegio', $idPrivilegio, PDO::PARAM_INT);

                $sql2 = "DELETE FROM privilegio WHERE id_privilegio = :id_privilegio";
                $st2 = $this->db->prepare($sql2);
                $st2->bindParam(':id_privilegio', $idPrivilegio, PDO::PARAM_INT);
                $st->execute();
                $st2->execute();
                $rc = $st2->rowCount();

                $this->db->commit();

                return $rc;
            } catch (PDOException $e) {
                $this->db->rollBack();
                throw $e;
            }
        }

        public function edit($idPrivilegio, $data){
            $this->db();

            try {
                $this->db->beginTransaction();

                $sql = 'UPDATE privilegio SET privilegio = :privilegio WHERE id_privilegio = :id_privilegio';
                $st = $this->db->prepare($sql);
                $st->bindParam(':id_privilegio', $idPrivilegio, PDO::PARAM_INT);
                $st->bindParam(':privilegio', $data['privilegio'], PDO::PARAM_STR);
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

    $privilegio = new Privilegio;
?>