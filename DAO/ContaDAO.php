<?php

require_once 'Conexao.php';
require_once 'UtilDAO.php';

class ContaDAO extends Conexao
{
    public function CadastrarConta($banco, $agencia, $numero, $saldo)
    {
        if ($banco == '' || $agencia == '' || $numero == '' || $saldo == '') {
            return 0;
        } else {
            //return 1;
            //1° Passo: criar uma variável que receberá o obj de conexão
            $conexao = parent::retornarConexao();

            //2° Passo: criar uma variável que receberá o texto do comando SQL que deverá ser executado no BD(Banco de dados)
            $comando_sql = 'INSERT INTO tb_conta(banco_conta, agencia_conta, numero_conta, saldo_conta, id_usuario) VALUE (?, ?, ?, ?, ?)';

            //3° Passo: Criar um obj que será configurado e levado no BD para ser executado
            $sql = new PDOStatement();

            //4° Passo: Colocar dentro do obj $sql a conexão preparada para executar o comando_sql
            $sql = $conexao->prepare($comando_sql);

            //5° Passo: Verificar se no comando_sql eu tenho ? para ser configurado. Se tiver, configurar bindValues
            $sql->bindValue(1, $banco);
            $sql->bindValue(2, $agencia);
            $sql->bindValue(3, $numero);
            $sql->bindValue(4, $saldo);
            $sql->bindValue(5, UtilDAO::UsuarioLogado());

            try {
                //6° Passo: Executar o BD
                $sql->execute();
                return 1;
            } catch (Exception $ex) {
                echo $ex->getMessage();
                return -1;
            }
        }
    }
    public function ConsultarConta()
    {
        $conexao = parent::retornarConexao();
        $comando_sql = 'SELECT id_conta, banco_conta, agencia_conta, numero_conta, saldo_conta FROM tb_conta WHERE id_usuario = ?;';
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, UtilDAO::UsuarioLogado());
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();
        return $sql->fetchAll();
    }

    public function DetalharConta($idConta){
   if($idConta == ''){
    return 0;
   }else{

    $conexao = parent::retornarConexao();

    $comando_sql = 'SELECT id_conta, banco_conta, agencia_conta, numero_conta, saldo_conta FROM tb_conta WHERE id_conta = ? AND id_usuario = ?';

    $sql = new PDOStatement();

    $sql = $conexao->prepare($comando_sql);


    $sql->bindValue(1, $idConta);
    $sql->bindValue(2, UtilDAO::UsuarioLogado());

    $sql->setFetchMode(PDO::FETCH_ASSOC);

    $sql->execute();

    return $sql->fetchAll();
   

   }

    }

    public function AlterarConta($idConta, $banco, $agencia, $numero, $saldo){
        if ($idConta == '' ||  $banco ==  '' || $agencia == '' || $numero == '' || $saldo ==  '') {
            return 0;
        }
         $conexao = parent::retornarConexao();

         $comando_sql = 'UPDATE tb_conta 
                        SET banco_conta =?, 
                        agencia_conta =?, 
                        numero_conta =?, 
                        saldo_conta =? 
                        WHERE id_conta =? 
                        AND id_usuario =?';

        $sql = new PDOStatement();

        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, $banco);
        $sql->bindValue(2, $agencia);
        $sql->bindValue(3, $numero);
        $sql->bindValue(4, $saldo);
        $sql->bindValue(5, $idConta);
        $sql->bindValue(6, UtilDAO::UsuarioLogado());

        try {

             $sql->execute();

             return 1;
        }catch (Exception $ex) {
            echo $ex->getMessage();
            return -1;
        }
        

 
    }

    public function ExcluirConta($idConta){

        if($idConta == ''){
            return 0;
        }

           $conexao = parent::retornarConexao();

           $comando_sql = 'DELETE
                           FROM tb_conta
                           WHERE id_conta = ?
                           AND id_usuario = ?';

            $sql = new PDOStatement();
            $sql = $conexao->prepare($comando_sql);

            $sql->bindValue(1, $idConta);
            $sql->bindValue(2, UtilDAO::UsuarioLogado());
            
            try{

                $sql->execute();

                return 1;
            }catch(Exception $ex){
                return -4;
            }







    }

}
