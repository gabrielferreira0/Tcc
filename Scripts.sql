drop table Users;

create table Users(
                      id serial primary key not null,
                      username varchar (50),
                      senha varchar (50),
                      email varchar (50),
                      cpf varchar (50),
                      nascimento date,
                      cidade varchar (50),
                      telefone varchar (50),
                      UF varchar (50)
);

select * from users;