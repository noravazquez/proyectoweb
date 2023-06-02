<?php
    session_start();
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;

    require_once(__DIR__.'/../config.php');

    class Sistema
    {
        var $db = null;
        public function db(){
            $dsn = DBDRIVER . ':host=' . DBHOST . ';dbname=' . DBNAME . ';port=' . DBPORT;
            $this->db = new PDO($dsn, DBUSER, DBPASS);
        }

        public function alert($tipo, $icono, $titulo, $mensaje){
            include('views/alert.php');
        }

        public function uploadfile($tipo, $ruta, $archivo)
        {
            $name = false;
            $uploads['archivo'] = array("application/gzip", "application/zip", "application/x-zip-compressed","image/jpeg", "image/jpg", "image/gif", "image/png");
            if ($_FILES[$tipo]['error'] == 4) {
                return $name;
            }
            if ($_FILES[$tipo]['error'] == 0) {
                if (in_array($_FILES[$tipo]['type'], $uploads['archivo'])) {
                    if ($_FILES[$tipo]['size'] <= 2 * 1048 * 1048) {
                        $origen = $_FILES[$tipo]['tmp_name'];
                        $ext = explode(".", $_FILES[$tipo]['name']);
                        $ext = $ext[sizeof($ext) - 1];
                        $destino = $ruta . $archivo . "." . $ext;
                        if (move_uploaded_file($origen, $destino)) {
                            $name = $destino;
                        }
                    }
                }
            }
            return $name;
        }

        public function validateEmail($correo){
            if (filter_var($correo, FILTER_VALIDATE_EMAIL)) {
                return true;
            }
            return false;
        }

        public function login($correo, $contrasena)
        {
            if (!is_null($contrasena)) {
                if (strlen($contrasena)>0) {
                    if ($this->validateEmail($correo)) {
                        $contrasena = md5($contrasena);
                        $this->db();
                        $sql = 'SELECT id_usuario, correo FROM usuario WHERE correo = :correo AND contrasena = :contrasena';
                        $st = $this->db->prepare($sql);
                        $st->bindParam(":correo", $correo, PDO::PARAM_STR);
                        $st->bindParam(":contrasena", $contrasena, PDO::PARAM_STR);
                        $st->execute();
                        $data = $st->fetchAll(PDO::FETCH_ASSOC);
                        if (isset($data[0])) {
                            $data = $data[0];
                            $_SESSION=$data;
                            $_SESSION['roles'] = $this->getRoles($correo);
                            $_SESSION['privilegios'] = $this->getPrivilegios($correo);
                            $_SESSION['validado']=true;
                            return true;
                        } else{
                            $this->alert('danger', 'bi bi-exclamation-circle-fill', 'Error', 'Usuario o contraseña incorrectos');
                        }
                    }   
                }
            }
            return false;
        }

        public function getRoles($correo){
            $roles = array();
            if ($this->validateEmail($correo)) {
                $this->db();
                $sql = 'SELECT r.rol FROM usuario u JOIN usuario_rol ur ON u.id_usuario = ur.id_usuario JOIN rol r ON ur.id_rol = r.id_rol WHERE u.correo = :correo';
                $st = $this->db->prepare($sql);
                $st->bindParam(":correo", $correo, PDO::PARAM_STR);
                $st->execute();
                $data = $st->fetchAll(PDO::FETCH_ASSOC);
                foreach ($data as $key => $rol) {
                    array_push($roles, $rol['rol']);
                }
            } 
            return $roles;
        }

        public function getPrivilegios($correo){
            $privilegios = array();
            if ($this->validateEmail($correo)) {
                $this->db();
                $sql = 'SELECT p.privilegio FROM usuario u JOIN usuario_rol ur ON u.id_usuario = ur.id_usuario JOIN rol r ON ur.id_rol = r.id_rol JOIN rol_privilegio rp ON r.id_rol = rp.id_rol JOIN privilegio p ON rp.id_privilegio = p.id_privilegio WHERE u.correo = :correo';
                $st = $this->db->prepare($sql);
                $st->bindParam(":correo", $correo, PDO::PARAM_STR);
                $st->execute();
                $data = $st->fetchAll(PDO::FETCH_ASSOC);
                foreach ($data as $key => $privilegio) {
                    array_push($privilegios, $privilegio['privilegio']);
                }
            } 
            return $privilegios;
        }

        public function validateRol($rol)
        {
            if (isset($_SESSION['validado'])) {
                if ($_SESSION['validado']) {
                    if (isset($_SESSION['roles'])) {
                        // Verificar si el usuario tiene alguno de los roles permitidos
                        $rolesPermitidos = ['Administrador', 'Gerente', 'Dependiente'];
                        $rolesUsuario = $_SESSION['roles'];

                        $rolesIntersectados = array_intersect($rolesPermitidos, $rolesUsuario);

                        if (empty($rolesIntersectados)) {
                            $this->killApp('No tienes el rol adecuado');
                        }
                    } else {
                        $this->killApp('No tienes roles asignados');
                    }
                } else {
                    $this->killApp('No estás validado');
                }
            } else {
                $this->killApp('No te has logueado');
            }
        }

        public function killApp($mensaje)
        {
            ob_end_clean();
            include('views/header_error.php');
            $this->alert('danger', 'bi bi-exclamation-circle-fill', 'Error', $mensaje);
            include('views/footer_error.php');
            die();
        }

        public function loginSend($correo){
            $rc=0;
            if($this->validateEmail($correo)){
                $this->db();
                $sql = 'SELECT correo FROM usuario WHERE correo = :correo';
                $st = $this->db->prepare($sql);
                $st->bindParam(":correo", $correo, PDO::PARAM_STR);
                $st->execute();
                $data = $st->fetchAll(PDO::FETCH_ASSOC);
                if (isset($data[0])) {
                    $token = $this->generarToken($correo);
                    $sql2 = 'UPDATE usuario SET token = :token WHERE correo = :correo';
                    $st2 = $this->db->prepare($sql2);
                    $st2->bindParam(":token", $token, PDO::PARAM_STR);
                    $st2->bindParam(":correo", $correo, PDO::PARAM_STR);
                    $st2->execute();
                    $rc = $st2->rowCount();
                    $this->forgot($correo, $token);
                }
            }
            return $rc;
        }

        public function forgot($destinatario, $token)
        {
            if ($this->validateEmail($destinatario)) {
                require '../vendor/autoload.php';
                $mail = new PHPMailer();
                $mail->isSMTP();
                $mail->SMTPDebug = SMTP::DEBUG_OFF;
                $mail->Host = 'smtp.gmail.com';
                $mail->Port = 465;
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                $mail->SMTPAuth = true;
                $mail->Username = '19030547@itcelaya.edu.mx';
                $mail->Password = 'fldfafvqktftruuc';
                $mail->setFrom('19030547@itcelaya.edu.mx', 'Nora Vazquez');
                $mail->addAddress($destinatario, 'Piccoliglam & Piccolinos');
                $mail->Subject = 'Recuperacion de contraseña';
                $mensaje = "Estimado usuario <br> <a href=\"http://localhost/picco/admin/login.php?action=recovery&token=$token&correo=$destinatario\">Presiona aqui para recuperar la contaseña.</a> <br>
                Atentamente. PiccoliGlam & Piccolinos";
                $mensaje = utf8_decode($mensaje);
                $mail->msgHTML($mensaje);
                if (!$mail->send()) {
                    //echo 'Mailer Error: ' . $mail->ErrorInfo;
                } else {
                    //echo 'Message sent!';
                }
                function save_email($mail){
                    $path = '{imap.gmail.com:993/imap/ssl}[Gmail]/Sent Mail';
                    $imapStream = imap_open($path, $mail->Username, $mail->Password);
                    $result = imap_append($imapStream, $path, $mail->getSentMIMEMessage());
                    imap_close($imapStream);

                    return $result;
                }
            }
        }

        public function generarToken($correo){
            $token = "memorias";
            $n=rand(1,1000000);
            $x = md5(md5($token));
            $y = md5($x . $n);
            $token = md5($y);
            $token= md5($token . 'piccoliglam');
            $token = md5('piccolinos'). md5($token . $correo);
            return $token;
        }

        function validateToken($correo, $token){
            if(strlen($token)==64){
                if($this->validateEmail($correo)){
                    $this->db();
                    $sql = "SELECT correo FROM usuario where correo=:correo and token=:token";
                    $st = $this->db->prepare($sql);
                    $st->bindParam(':correo', $correo, PDO::PARAM_STR);
                    $st->bindParam(':token', $token, PDO::PARAM_STR);
                    $st->execute();
                    $data = $st->fetchAll(PDO::FETCH_ASSOC);
                    if(isset($data[0])){
                        return true;
                    }
                }
            }
            return false;
        }

        public function resetPassword($correo, $token, $contrasena){
            $cantidad=0;
            if(strlen($token)==64 and strlen($contrasena)>0){
                if($this->validateEmail($correo)){
                    $contrasena=md5($contrasena);
                    $this->db();
                    $sql = "UPDATE usuario SET contrasena = :contrasena,token = null 
                            WHERE correo = :correo AND token=:token";
                    $st = $this->db->prepare($sql);
                    $st->bindParam(':correo', $correo, PDO::PARAM_STR);
                    $st->bindParam(':token', $token, PDO::PARAM_STR);
                    $st->bindParam(':contrasena', $contrasena, PDO::PARAM_STR);
                    $st->execute();
                    $cantidad = $st->rowCount();
                }
            }
            return $cantidad;
        }

        public function validatePrivilegio($privilegio)
        {
            if (isset($_SESSION['validado'])) {
                if ($_SESSION['validado']) {
                    if (isset($_SESSION['privilegios'])) {
                        if (!in_array($privilegio, $_SESSION['privilegios'])) {
                            $this->killApp('No tienes el privilegio adecuado');
                        }
                    } else {
                        $this->killApp('No tienes privilegios asignados');
                    }
                } else {
                    $this->killApp('No estas validado');
                }
            } else {
                $this->killApp('No te has logueado');
            }
        }
    }
    $sistema = new Sistema;
?>