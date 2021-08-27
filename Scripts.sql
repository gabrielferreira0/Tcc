drop table tipoUsuario;
drop table usuarios;
drop table categorias;
drop table servicos;


create table tipoUsuario(
                            id serial primary key not null ,
                            perfil varchar (50)
);

create table usuarios(
                         id serial primary key not null,
                         usunome varchar (50),
                         ususenha varchar (50),
                         usuemail varchar (100),
                         usucpf varchar (50),
                         usutelefone varchar (50),
                         usufoto varchar (100),
                         usustatus varchar (20),
                         usutipo integer REFERENCES tipoUsuario (id),
                         usublock boolean default false,
                         usudatacadastro date
);

create table categorias (
                            id serial primary key not null,
                            catnome varchar (50),
                            catfoto varchar (100),
                            catstatus varchar (50)
);

create table servicos (
                          id serial primary key not null,
                          catid integer REFERENCES categorias(id),
                          sernome varchar (50),
                          serstatus bool
);


create table endereco_profissional(
                                      id serial primary key not null,
                                      usuid integer REFERENCES usuarios(id),
                                      CEP varchar (50),
                                      cidade varchar (100),
                                      UF varchar (2),
                                      logradouro varchar (100),
                                      complemento varchar (100),
                                      bairro varchar (100)

);

create table conta_profissional (
                                    id serial primary key not null,
                                    usuid integer REFERENCES usuarios(id),
                                    banco int,
                                    agencia varchar (100),
                                    conta varchar (100)
);

create table servico_profissional (
                                      id serial primary key not null,
                                      usuid integer REFERENCES usuarios(id),
                                      serid integer REFERENCES servicos(id),
                                      status boolean
);
alter table  servico_profissional add column preco double precision;


INSERT INTO tipoUsuario (perfil) VALUES ('Admin');
INSERT INTO tipoUsuario (perfil) VALUES ('Cliente');
INSERT INTO tipoUsuario (perfil) VALUES ('Profissional');




