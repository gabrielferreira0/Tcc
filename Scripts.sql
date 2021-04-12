drop table usuarios;

create table usuarios(
                      id serial primary key not null,
                      usunome varchar (50),
                      ususenha varchar (50),
                      usuemail varchar (50),
                      usucpf varchar (50),
                      usutelefone varchar (50),
                      usufoto varchar (100)
);

select * from usuarios;