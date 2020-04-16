<?php
	class Usuario{

		private $idusario;
		private $deslogin;
		private $desenha;
		private $dtcadastro;


		public function getIdusario(){
			return $this->idusario;
		}

		public function setIdusario($idusario){
			$this->idusario= $idusario;
		}

		public function getDeslogin(){
			return $this->deslogin;
		}

		public function setDeslogin($deslogin){
			$this->deslogin= $deslogin;
		}

		public function getDesenha(){
			return $this->desenha;
		}

		public function setDesenha($desenha){
			$this->desenha= $desenha;
		}

		public function getDtcadastro(){
			return $this->dtcadastro;
		}

		public function setDtcadastro($dtcadastro){
			$this->dtcadastro= $dtcadastro;
		}

		public function loadById($id){
			$sql= new Sql();
			$result= $sql->select("SELECT *FROM tb_usuarios WHERE idusario= :ID", array(":ID"=>$id));
			if(count($result)>0){
				$row= $result[0];
				$this->setData($result[0]);	
			}
		}

		public function getList(){
			$sql= new Sql();
			return $sql->select("SELECT *FROM tb_usuarios ORDER BY idusario");
		}

		public static function search($login){
			$sql= new Sql();
			return $sql->select("SELECT *FROM tb_usuarios
				WHERE deslogin LIKE :SEARCH ORDER BY idusario", array(':SEARCH'=>"%".$login."%"));
		}

		public function login($login,$password){
			$sql= new Sql();
			$result= $sql->select("SELECT *FROM tb_usuarios WHERE deslogin= :LOGIN AND desenha= :PASSWORD", array(":LOGIN"=>$login, ":PASSWORD"=>$password));
			if(count($result)>0){
				$row= $result[0];
				$this->setData($result[0]);		
			}else{
				throw new Exception("Usuario ou senha inválidos", 1);
				
			}
		}

		public function insert(){
			$sql= new Sql();
			$results= $sql->select("CALL sp_usuarios_insert(:LOGIN,:PASSOWORD)", array(":LOGIN"=> $this->getDeslogin(),
				":PASSOWORD"=> $this->getDesenha()));

			if (count($results)>0){
				$this->setData($results[0]);
			}
		}

		public function update($login,$password){
			$this->setDeslogin($login);
			$this->setDesenha($password);

			$sql= new Sql();
			$sql->query("UPDATE tb_usuarios SET deslogin= :LOGIN, desenha= :PASSWORD WHERE idusario= :ID", array(":LOGIN"=>$this->getDeslogin(),
				":PASSWORD"=> $this->getDesenha(),
				":ID"=>$this->getIdusario()));
		}

		public function setData($data){
				$this->setIdusario($data['idusario']);
				$this->setDeslogin($data['deslogin']);
				$this->setDesenha($data['desenha']);
				$this->setDtcadastro(new DateTime($data['dtcadastro']));
		}

		public function __construct($login="", $senha=""){
			$this->setDeslogin($login);
			$this->setDesenha($senha);
		}


		public function __toString(){
			return json_encode(array(
				"idusario"=>$this->getIdusario(),
				"deslogin"=>$this->getDeslogin(),
				"desenha"=>$this->getDesenha(),
				"dtcadastro"=>$this->getDtcadastro()->format("d/m/Y")));
		}





	}



?>