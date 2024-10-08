<?php

Class Usuario{
    private $pdo;
    public function __construct($dbname,$host,$user,$senha)
    {
    
        try{
        $this->pdo =new PDO("mysql:dbname=".$dbname.";host".$host,$user,$senha);
        }
        catch(Exception $e) {
            echo "Erro de conexao:".$e->getMessage();
            exit();
        }
        catch(Exception $e){
            echo "Erro :".$e->getMessage();
            exit();
        }
    }

public function buscarDados(){
    $res = array();
    $cmd=$this->pdo->query("SELECT * FROM usuarios ORDER BY nome ");
    $res = $cmd->fetchAll(PDO::FETCH_ASSOC);
    return $res;
}

public function cadastrarUsuario($nome,$tel,$email,$senha){
$cmd =$this ->pdo->prepare("SELECT id FROM usuarios WHERE email =:e");
$cmd->bindValue(":e",$email);
$cmd->execute();
if($cmd->rowCount()>0){
    return false;
}else{
    $cmd =$this->pdo->prepare("INSERT INTO usuarios(nome,tel,email,senha) VALUES(:n,:m,:e,:s)");
    $cmd->bindValue(":n",$nome);   
    $cmd->bindValue(":e",$email);
    $cmd->bindValue(":m",$tel);    
    $cmd->bindValue(":s",$senha);
    $cmd->execute();
    return true;
}
}
public function excluirUsuario($id){
$cmd = $this->pdo->prepare("DELETE FROM usuarios WHERE id= :id");
$cmd->bindValue(":id",$id);
$cmd->execute();

}
public function buscarDadosUsuario($id)
{
    $res= array();
    $cmd=$this->pdo->prepare("SELECT * FROM usuarios WHERE id=:id");
    $cmd->bindValue(":id",$id);
    $cmd ->execute();
    $res =$cmd->fetch(PDO::FETCH_ASSOC);
    return $res;
}

public function atualizarDados($id,$nome,$tel,$email,$senha)
{
 
     $cmd=$this->pdo->prepare("UPDATE usuarios SET nome=:n,tel=:m,email=:e,senha=:s  WHERE id=:id");
    $cmd->bindValue(":n",$nome);
    $cmd->bindValue(":m",$tel);
    $cmd->bindValue(":e",$email);  
    $cmd->bindValue(":s",$senha);
    $cmd->bindValue(":id",$id);
    $cmd->execute();
    
   
}
public function logar($tel,$senha)
{
$cmd = $this-> pdo->prepare("SELECT id FROM usuarios WHERE tel =:m AND senha=:s");
$cmd->bindValue(":m",$tel);  
$cmd->bindValue(":s",$senha);
$cmd->execute();
if($cmd->rowCount()>0){
    $dado=$cmd->fetch(); 
    session_start();
    $_SESSION['id']= $dado['id'];
    return true;
}else{
    return false;
}
}


}




