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

				$this->setIdusario($row['idusario']);
				$this->setDeslogin($row['deslogin']);
				$this->setDesenha($row['desenha']);
				$this->setDtcadastro(new DateTime($row['dtcadastro']));
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

				$this->setIdusario($row['idusario']);
				$this->setDeslogin($row['deslogin']);
				$this->setDesenha($row['desenha']);
				$this->setDtcadastro(new DateTime($row['dtcadastro']));
			}else{
				throw new Exception("Usuario ou senha inválidos", 1);
				
			}
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