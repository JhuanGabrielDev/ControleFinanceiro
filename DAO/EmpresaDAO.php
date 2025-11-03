<?php

require_once 'Conexao.php';
require_once 'UtilDAO.php';

class EmpresaDAO extends Conexao
{
    public function CadastrarEmpresa($nome_Emp, $telefone, $endereco)
    {
        if ($nome_Emp == '' || $telefone == '') {
            return 0;
        } else {
            //return 1;
            //1° Passo: criar uma variável que receberá o obj de conexão
            $conexao = parent::retornarConexao();

            //2° Passo: criar uma variável que receberá o texto do comando SQL que deverá ser executado no BD(Banco de dados)
            $comando_sql = 'INSERT INTO tb_empresa(nome_empresa, telefone_empresa, endereco_empresa, id_usuario) VALUE (?, ?, ?, ?)';

            //3° Passo: Criar um obj que será configurado e levado no BD para ser executado
            $sql = new PDOStatement();

            //4° Passo: Colocar dentro do obj $sql a conexão preparada para executar o comando_sql
            $sql = $conexao->prepare($comando_sql);

            //5° Passo: Verificar se no comando_sql eu tenho ? para ser configurado. Se tiver, configurar bindValues
            $sql->bindValue(1, $nome_Emp);
            $sql->bindValue(2, $telefone);
            $sql->bindValue(3, $endereco);
            $sql->bindValue(4, UtilDAO::UsuarioLogado());
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


    public function ConsultarEmpresa()
    {
        $conexao = parent::retornarConexao();

        $comando_sql = 'select id_empresa, nome_empresa, telefone_empresa, endereco_empresa from tb_empresa where id_usuario = ? order by nome_empresa ASC';

        $sql = new PDOStatement();

        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, utilDAO::UsuarioLogado());

        $sql->setFetchMode(PDO::FETCH_ASSOC);

        $sql->execute();

        return $sql->fetchAll();
    }

    public function DetalharEmpresa($idEmpresa){
        if ($idEmpresa == '') {
            return 0;
        } else {
            $conexao = parent::retornarConexao();

            $comando_sql = 'SELECT id_empresa, nome_empresa, telefone_empresa, endereco_empresa FROM tb_empresa WHERE id_empresa=  ? AND id_usuario = ?;';

            $sql = new PDOStatement();


            $sql = $conexao->prepare($comando_sql);

            $sql->bindValue(1, $idEmpresa);
            $sql->bindValue(2, UtilDAO::UsuarioLogado());

            $sql->setFetchMode(PDO::FETCH_ASSOC);

            $sql->execute();

            return $sql->fetchAll();
        }
    }
    public function AlterarEmpresa($nome_Emp, $telefone, $endereco, $idEmpresa)
    {
        if ($nome_Emp == '' || $telefone == ''|| $idEmpresa == '') {
            return 0;
        } else {
            $conexao = parent::retornarConexao();

            $comando_sql = 'UPDATE tb_empresa SET nome_empresa = ?, telefone_empresa = ?, endereco_empresa = ? WHERE id_empresa = ? AND id_usuario = ?;';

            $sql = new PDOStatement();

            $sql = $conexao->prepare($comando_sql);

            $sql->bindValue(1, $nome_Emp);
            $sql->bindValue(2, $telefone);
            $sql->bindValue(3, $endereco);
            $sql->bindValue(4, $idEmpresa);
            $sql->bindValue(5, UtilDAO::UsuarioLogado());

            try {
                $sql->execute();
                return 1;
            } catch (Exception $ex) {
                echo $ex->getMessage();
                return -1;
            }
        }
    }

    public function ExcluirEmpresa($idEmpresa)
    {
        if ($idEmpresa == '') {
            return 0;
        }
        $conexao = parent::retornarConexao();

        $comando_sql = 'DELETE FROM tb_empresa WHERE id_empresa = ? AND id_usuario = ?';

        $sql = new PDOStatement();

        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, $idEmpresa);
        $sql->bindValue(2, UtilDAO::UsuarioLogado());

        try {
            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            return -4;
        }
    }
}
