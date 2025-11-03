<?php

require_once 'Conexao.php';
require_once 'UtilDAO.php';

class MovimentoDAO  extends Conexao
{
    public function RealizarMovimento($tipo, $data, $valor, $obs, $categoria, $empresa, $conta)
    {
        if ($tipo == '' || trim($data) == '' || trim($valor) == '' || $categoria == '' || $empresa == '' || $conta == '') {
            return 0;
        } else {
            $conexao = parent::retornarConexao();

            $comando_sql = 'INSERT INTO tb_movimento
                                        (tipo_movimento, data_movimento, valor_movimento,
                                        obs_movimento, id_categoria, id_empresa,
                                         id_conta, id_usuario)
                                          values(?,?,?,?,?,?,?,?)';

            $sql = new  PDOStatement();

            $sql = $conexao->prepare($comando_sql);

            $sql->bindValue(1, $tipo);
            $sql->bindValue(2, $data);
            $sql->bindValue(3, $valor);
            $sql->bindValue(4, $obs);
            $sql->bindValue(5, $categoria);
            $sql->bindValue(6, $empresa);
            $sql->bindValue(7, $conta);
            $sql->bindValue(8, UtilDAO::UsuarioLogado());

            $conexao->beginTransaction();

            try {
                $sql->execute();

                if ($tipo == 1) {
                    $comando_sql = 'UPDATE tb_conta SET saldo_conta = saldo_conta + ? WHERE id_conta = ? ';
                } else if ($tipo == 2) {
                    $comando_sql = 'UPDATE tb_conta SET saldo_conta = saldo_conta - ? WHERE id_conta = ? ';
                }

                $sql = $conexao->prepare($comando_sql);

                $sql->bindValue(1, $valor);
                $sql->bindValue(2, $conta);

                $sql->execute();

                $conexao->commit();

                return 1;
            } catch (Exception $ex) {
                echo  $ex->getMessage();
                $conexao->rollBack();
                return -1;
            }
        }
    }

    public function ExcluirMovimento($idMovimento, $idConta, $valor, $tipo)
    {

        if ($idMovimento == '' || $idConta == '' || $valor == '' || $tipo == '') {
            return 0;
        }

        $conexao = parent::retornarConexao();
        $comando_sql = 'delete from tb_movimento where id_movimento = ?';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, $idMovimento);

        $conexao->beginTransaction();

        try {

            $sql->execute();

            if ($tipo == 1) {
                $comando_sql =  'update tb_conta
                                   set saldo_conta = saldo_conta - ?
                                   where id_conta = ?';
            } else if ($tipo == 2) {
                $comando_sql = 'update tb_conta 
                                 set saldo_conta = saldo_conta + ?
                                 where id_conta = ?';
            }

            $sql = $conexao->prepare($comando_sql);

            $sql->bindValue(1, $valor);
            $sql->bindValue(2, $idConta);

            $sql->execute();

            $conexao->commit();

            return 1;
        } catch (Exception $ex) {
            $conexao->rollBack();
            echo $ex->getMessage();
            return -1;
        }
    }


    public function FiltrarMovimento($tipoMov, $data_inicial, $data_final)
    {
        if (trim($tipoMov) == '' || trim($data_inicial) == '' || trim($data_final) == '') {
            return 0;
        } else {
            $conexao = parent::retornarConexao();

            $comando_sql = 'SELECT id_movimento,
                                    tipo_movimento,
                                    tb_movimento.id_conta,
                                DATE_FORMAT(data_movimento, "%d/%m/%Y") AS data_movimento,
                                    valor_movimento, 
                                    nome_categoria,
                                    nome_empresa,
                                    banco_conta,
                                    numero_conta,
                                    agencia_conta,
                                    obs_movimento 
                                from tb_movimento
                                    inner join tb_categoria
                                on tb_categoria.id_categoria = tb_movimento.id_categoria
                                    inner join tb_empresa
                                on tb_empresa.id_empresa = tb_movimento.id_empresa
                                    inner join tb_conta 
                                on tb_conta.id_conta = tb_movimento.id_conta
                                    where tb_movimento.id_usuario = ? and tb_movimento.data_movimento between ? and ? ';

            if ($tipoMov != 0) {
                $comando_sql = $comando_sql . ' and tipo_movimento = ?';
            }

            $sql = new PDOStatement();

            $sql = $conexao->prepare($comando_sql);

            $sql->bindValue(1, UtilDAO::UsuarioLogado());
            $sql->bindValue(2, $data_inicial);
            $sql->bindValue(3, $data_final);

            if ($tipoMov != 0) {
                $sql->bindValue(4, $tipoMov);
            }

            $sql->setFetchMode(PDO::FETCH_ASSOC);

            $sql->execute();

            return $sql->fetchAll();
        }
    }

    public function TotalEntrada()
    {
        $conexao = parent::retornarConexao();
        $comando_sql = 'select sum(valor_movimento) as total
                                from tb_movimento
                                where tipo_movimento = 1
                                and id_usuario = ?';
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, UtilDAO::UsuarioLogado());
        $sql->setfetchMode(PDO::FETCH_ASSOC);

        $sql->execute();

        return $sql->fetchAll();
    }

    public function TotalSaida()
    {
        $conexao = parent::retornarConexao();
        $comando_sql = 'select sum(valor_movimento) as total
                                from tb_movimento
                                where tipo_movimento = 2
                                and id_usuario = ?';
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, UtilDAO::UsuarioLogado());
        $sql->setfetchMode(PDO::FETCH_ASSOC);

        $sql->execute();

        return $sql->fetchAll();
    }

    public function MostrarUltimosLancamentos()
    {

        $conexao = parent::retornarConexao();
        $comando_sql = 'select id_movimento,
             tipo_movimento.id_conta,
          DATE_FORMAT(data_movimento, "%d/%m/%Y") AS data_movimento,
              valor_movimento, 
              nome_categoria,
              nome_empresa,
              banco_conta,
              numero_conta,
              agencia_conta,
              obs_movimento 
              from tb_movimento
              inner join tb_categoria
              on tb_categoria.id_categoria = tb_movimento.id_categoria
              inner join tb_empresa
              on tb_empresa.id_empresa = tb_movimento.id_empresa
              inner join tb_conta 
              on tb_conta.id_conta = tb_movimento.id_conta
               where tb_movimento.id_usuario = ?    
               order by tb_movimento.id_movimento  DESC limit 10';


        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, UtilDAO::UsuarioLogado());

        $sql->setFetchMode(PDO::FETCH_ASSOC);



        return $sql->fetchAll();
    }
}
