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
                      usutipo int REFERENCES tipoUsuario (id)
);

INSERT INTO tipoUsuario (perfil) VALUES ('Admin');
INSERT INTO tipoUsuario (perfil) VALUES ('Cliente');
INSERT INTO tipoUsuario (perfil) VALUES ('Profissional');
select * from usuarios;
select * from tipoUsuario;