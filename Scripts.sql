drop table usuarios;
drop table tipoUsuario;

create table tipoUsuario(
    id serial primary key not null ,
    perfil varchar (50)
);

create table usuarios(
                      id serial primary key not null,
                      usunome varchar (50),
                      ususenha varchar (50),
                      usuemail varchar (50),
                      usucpf varchar (50),
                      usutelefone varchar (50),
                      usufoto varchar (100),
                      usustatus varchar (20),
                      usutipo integer REFERENCES tipoUsuario (id)
);

create table categorias (
                           id serial primary key not null,
                           catnome varchar (50),
                           catfoto varchar (100),
                           catstatus varchar (50)
);


create table servicos (
                          id serial primary key not null,
                          usucat integer REFERENCES categorias(id),
                          sernome varchar (50),
                          serstatus bool
);


INSERT INTO tipoUsuario (perfil) VALUES ('Admin');
INSERT INTO tipoUsuario (perfil) VALUES ('Cliente');
INSERT INTO tipoUsuario (perfil) VALUES ('Profissional');

INSERT INTO categorias (catnome, catfoto, catstatus) VALUES ('Pintor','557323cec98f20f214aec07fd68dfae8.jpg','True');
INSERT INTO categorias (catnome, catfoto, catstatus) VALUES ('Eletricista','eb2ea093fcf09f20e90936235ab2189a.jpg','True');
INSERT INTO categorias (catnome, catfoto, catstatus) VALUES ('Construção','d54b6c93135fce1fc04fa71831c34c15.jpg','True');
INSERT INTO categorias (catnome, catfoto, catstatus) VALUES ('Soldador','f44981a97028f8ab44f60ae1b7c64bec.jpg','True');
INSERT INTO categorias (catnome, catfoto, catstatus) VALUES ('Encanador','99938dfb1d709d80fe93830afc7c44a4.jpg','True');


select * from usuarios;
select * from tipoUsuario;
select * from categorias order by id;

UPDATE usuarios SET usutipo = 1 WHERE usucpf = '';

alter table usuarios add column usublock boolean default false;
alter table usuarios add column usudatacadastro date;
alter table usuarios alter column usuemail  type varchar(100);

UPDATE usuarios SET usudatacadastro = '20210820'  where 1=1;