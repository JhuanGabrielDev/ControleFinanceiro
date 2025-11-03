insert into  tb_usuario
(nome_usuario, email_usuario, senha_usuario, data_cadastro)
values
('Ana Maria' , 'ana@gmail.com' , 'senha123' , '2021-02-21');

insert into tb_usuario
(nome_usuario, email_usuario, senha_usuario, data_cadastro)
values
('Carlos Junior' , 'carlos@gmail.com' , '44510' , '21-02-25');

insert into tb_usuario
(nome_usuario, email_usuario, senha_usuario, data_cadastro)
values
('Alexandre Junior' , 'ale@gmail.com' , '3323' , '21-02-25');

insert into tb_usuario
(nome_usuario, email_usuario, senha_usuario, data_cadastro)
values
('Alice Maria' , 'maria@gmail.com' , '3323' , '21-02-25');


/*======================================================================================*/

insert into tb_categoria
(nome_categoria , id_usuario)
values
('Alimentação' , 1);

insert into tb_categoria
(nome_categoria , id_usuario)
values
('Viagens' , 2);

insert into tb_categoria
(nome_categoria , id_usuario)
values
('Farmacia' , 3);

insert into tb_categoria
(nome_categoria , id_usuario)
values
('Combustivel' , 4);

insert into tb_categoria
(nome_categoria , id_usuario)
values
('Roupa' , 5);

insert into tb_categoria
(nome_categoria , id_usuario)
values
('Roupa' , 6);

insert into tb_categoria
(nome_categoria , id_usuario)
values
('Lojas' , 7);

/*===================================================================================*/

insert into tb_empresa
(nome_empresa, endereco_empresa, telefone_empresa , id_usuario)
values
('Empresa colçhão' , 'Rua dos colçhões' , '439992889' , 1);

insert into tb_empresa
(nome_empresa, endereco_empresa, telefone_empresa , id_usuario)
values
('Empresa comer bem' , 'Rua dos restaurantes' '435555366' , 2);

insert into tb_empresa
(nome_empresa, endereco_empresa, telefone_empresa , id_usuario)
values
('Petrobras' ,  'Rua Brasil' , '4626662666' , 3);

insert into tb_empresa
(nome_empresa, endereco_empresa, telefone_empresa, id_usuario)
values
('Nike' , 'Rua dos sapatos' , '435555266' , 4);

insert into tb_empresa 
(nome_empresa, endereco_empresa, telefone_empresa, id_usuario)
values
('Adidas' , 'Rua das Americas' , '23331665' , 5);

insert into tb_empresa
(nome_empresa, endereco_empresa, telefone_empresa, id_usuario)
values
('Fiat' , 'Rua dos carros' , '24416567' , 6);

insert into tb_empresa 
(nome_empresa, endereco_empresa, telefone_empresa, id_usuario)
values
('zé Lanches' , 'Rua dos Restaurantes' , '92892988' , 7);

/*=======================================================================================*/

insert into tb_conta
(banco_conta, agencia_conta, numero_conta, saldo_conta, id_usuario)
values
('Itau' , '2322' , '23333' , 71782.23 ,3);

insert into tb_conta 
(banco_conta, agencia_conta, numero_conta, saldo_conta, id_usuario)
values
('Santander' , '1221' , '12445' , 4500.20 , 1);

insert into tb_conta 
(banco_conta, agencia_conta, numero_conta, saldo_conta, id_usuario)
values
('Bradesco' , '6272' , '99983' , 50500.20 , 2);

insert into tb_conta 
(banco_conta, agencia_conta, numero_conta, saldo_conta, id_usuario)
values
('Nubank' , '1313' , '90200' , 499.20 , 4);

insert into tb_conta 
(banco_conta, agencia_conta, numero_conta, saldo_conta, id_usuario)
values
('PicPay' , '0001' , '10000' , 8936.73 , 5);

insert into tb_conta 
(banco_conta, agencia_conta, numero_conta, saldo_conta, id_usuario)
values
('Banco inter ' , '2000' , '14255' , 567.73 , 6);

insert into tb_conta 
(banco_conta, agencia_conta, numero_conta, saldo_conta, id_usuario)
values
('Caixa ' , '1267' , '09826' , 15272.94 , 7);

/*===============================================================================================*/

insert into tb_movimento
(tipo_movimento, data_movimento, valor_movimento, obs_movimento, id_empresa, id_conta, id_categoria, id_usuario)
values
(1 , '2021-01-10', 45, null, 1, 1, 4, 1  );

insert into tb_movimento
(tipo_movimento, data_movimento, valor_movimento, obs_movimento, id_empresa, id_conta, id_categoria, id_usuario)
values
(2 , '2021-01-10', 4578.43, null, 2, 2, 3, 2  );

insert into tb_movimento
(tipo_movimento, data_movimento, valor_movimento, obs_movimento, id_empresa, id_conta, id_categoria, id_usuario)
values
(3 , '2021-01-10', 8.43, null, 9, 3, 11, 3 );

insert into tb_movimento
(tipo_movimento, data_movimento, valor_movimento, obs_movimento, id_empresa, id_conta, id_categoria, id_usuario)
values
(4 , '2021-01-10', 123.43, null, 3, 4, 4, 4 );

insert into tb_movimento
(tipo_movimento, data_movimento, valor_movimento, obs_movimento, id_empresa, id_conta, id_categoria, id_usuario)
values
(5 , '2021-01-10', 99838.65, null, 2, 5, 5, 5 );


insert into tb_movimento
(tipo_movimento, data_movimento, valor_movimento, obs_movimento, id_empresa, id_conta, id_categoria, id_usuario)
values
(6 , '2021-01-10', 9030.32, null, 5, 6, 6, 6 );

insert into tb_movimento
(tipo_movimento, data_movimento, valor_movimento, obs_movimento, id_empresa, id_conta, id_categoria, id_usuario)
values
(7 , '2021-01-10', 8888.43, null, 6, 7, 7, 7);