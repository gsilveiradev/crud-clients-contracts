--
-- Criando db
--
CREATE DATABASE simple_crud_clients_contracts
  DEFAULT CHARACTER SET utf8
  DEFAULT COLLATE utf8_general_ci;

 USE simple_crud_clients_contracts;

--
-- Estrutura da tabela clientes
--
CREATE TABLE  cliente (
  id integer unsigned NOT NULL AUTO_INCREMENT,
  nome varchar(255) NOT NULL,
  cpf varchar(255) NOT NULL,
  cidade varchar(255) NOT NULL,
  estado varchar(255) NOT NULL,
  telefone varchar(255) NOT NULL,
  data_nascimento timestamp NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Estrutura da tabela contratos
--
CREATE TABLE  contrato (
  id integer unsigned NOT NULL AUTO_INCREMENT,
  codigo varchar(255) NOT NULL,
  cliente_id integer unsigned NOT NULL,
  valor decimal(15,2) NOT NULL,
  data_cadastro timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  CONSTRAINT cliente_id_fk FOREIGN KEY (cliente_id) REFERENCES cliente (id) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;