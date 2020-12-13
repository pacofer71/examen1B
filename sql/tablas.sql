create database examen_1;

create user usuexamen@'localhost' identified by "secret0";

grant all on examen_1.* to usuexamen@'localhost';

use examen_1;

create table usuarios(
    id int PRIMARY KEY AUTO_INCREMENT ,
    nombre varchar(20) unique not null,
    pass varchar(64) not null,
    perfil enum("Admin", "Normal") default "Normal",
    foto varchar(100) default "./img/default.jpg"
);
insert into usuarios(nombre, pass, perfil) values("admin", sha2("passadmin", 256), 1);
insert into usuarios(nombre, pass) values("usu2020", sha2("passusu", 256));
-- --------------------------------------------
create table usuarios3(
    id int PRIMARY KEY AUTO_INCREMENT ,
    nombre varchar(20) unique not null,
    pass varchar(64) not null,
    perfil enum("Admin", "Normal") default "Normal",
    foto varchar(100) default "./img/default.jpg"
);
insert into usuarios3(nombre, pass, perfil) values("admin", sha2("passadmin", 256), 1);
insert into usuarios3(nombre, pass) values("usu2020", sha2("passusu", 256));
-- ---------------------
create table usuarios11(
    id int PRIMARY KEY AUTO_INCREMENT ,
    nombre varchar(20) unique not null,
    pass varchar(64) not null,
    perfil enum("Admin", "Normal") default "Normal",
    foto varchar(100) default "./img/default.jpg"
);
insert into usuarios11(nombre, pass, perfil) values("admin", sha2("passadmin", 256), 1);
insert into usuarios11(nombre, pass) values("usu2020", sha2("passusu", 256));
-- ------------------------
create table usuarios12(
    id int PRIMARY KEY AUTO_INCREMENT ,
    nombre varchar(20) unique not null,
    pass varchar(64) not null,
    perfil enum("Admin", "Normal") default "Normal",
    foto varchar(100) default "./img/default.jpg"
);
insert into usuarios12(nombre, pass, perfil) values("admin", sha2("passadmin", 256), 1);
insert into usuarios12(nombre, pass) values("usu2020", sha2("passusu", 256));
-- ------------------------------
create table usuarios14(
    id int PRIMARY KEY AUTO_INCREMENT ,
    nombre varchar(20) unique not null,
    pass varchar(64) not null,
    perfil enum("Admin", "Normal") default "Normal",
    foto varchar(100) default "./img/default.jpg"
);
insert into usuarios14(nombre, pass, perfil) values("admin", sha2("passadmin", 256), 1);
insert into usuarios14(nombre, pass) values("usu2020", sha2("passusu", 256));
-- --------------------------------
create table usuarios16(
    id int PRIMARY KEY AUTO_INCREMENT ,
    nombre varchar(20) unique not null,
    pass varchar(64) not null,
    perfil enum("Admin", "Normal") default "Normal",
    foto varchar(100) default "./img/default.jpg"

);
insert into usuarios16(nombre, pass, perfil) values("admin", sha2("passadmin", 256), 1);
insert into usuarios16(nombre, pass) values("usu2020", sha2("passusu", 256));
-- --------------------------------------
create table usuarios17(
    id int PRIMARY KEY AUTO_INCREMENT ,
    nombre varchar(20) unique not null,
    pass varchar(64) not null,
    perfil enum("Admin", "Normal") default "Normal",
    foto varchar(100) default "./img/default.jpg"
);
insert into usuarios17(nombre, pass, perfil) values("admin", sha2("passadmin", 256), 1);
insert into usuarios17(nombre, pass) values("usu2020", sha2("passusu", 256));
-- --------------------------------
create table usuarios18(
    id int PRIMARY KEY AUTO_INCREMENT ,
    nombre varchar(20) unique not null,
    pass varchar(64) not null,
    perfil enum("Admin", "Normal") default "Normal",
    foto varchar(100) default "./img/default.jpg"
);
insert into usuarios18(nombre, pass, perfil) values("admin", sha2("passadmin", 256), 1);
insert into usuarios18(nombre, pass) values("usu2020", sha2("passusu", 256));
-- ---------------------------------
create table usuarios19(
    id int PRIMARY KEY AUTO_INCREMENT ,
    nombre varchar(20) unique not null,
    pass varchar(64) not null,
    perfil enum("Admin", "Normal") default "Normal",
    foto varchar(100) default "./img/default.jpg"
);
insert into usuarios19(nombre, pass, perfil) values("admin", sha2("passadmin", 256), 1);
insert into usuarios19(nombre, pass) values("usu2020", sha2("passusu", 256)); 
   
-- ---------------------------------------
create table usuarios20(
    id int PRIMARY KEY AUTO_INCREMENT ,
    nombre varchar(20) unique not null,
    pass varchar(64) not null,
    perfil enum("Admin", "Normal") default "Normal",
    foto varchar(100) default "./img/default.jpg"
);
insert into usuarios20(nombre, pass, perfil) values("admin", sha2("passadmin", 256), 1);
insert into usuarios20(nombre, pass) values("usu2020", sha2("passusu", 256));
-- -------------------------------------
create table usuarios21(
    id int PRIMARY KEY AUTO_INCREMENT ,
    nombre varchar(20) unique not null,
    pass varchar(64) not null,
    perfil enum("Admin", "Normal") default "Normal",
    foto varchar(100) default "./img/default.jpg"
);
insert into usuarios21(nombre, pass, perfil) values("admin", sha2("passadmin", 256), 1);
insert into usuarios21(nombre, pass) values("usu2020", sha2("passusu", 256));
-- ----------------------------------
create table usuarios22(
    id int PRIMARY KEY AUTO_INCREMENT ,
    nombre varchar(20) unique not null,
    pass varchar(64) not null,
    perfil enum("Admin", "Normal") default "Normal",
    foto varchar(100) default "./img/default.jpg"
);
insert into usuarios22(nombre, pass, perfil) values("admin", sha2("passadmin", 256), 1);
insert into usuarios22(nombre, pass) values("usu2020", sha2("passusu", 256));
-- -----------------------------
create table usuarios23(
    id int PRIMARY KEY AUTO_INCREMENT ,
    nombre varchar(20) unique not null,
    pass varchar(64) not null,
    perfil enum("Admin", "Normal") default "Normal",
    foto varchar(100) default "./img/default.jpg"
);
insert into usuarios23(nombre, pass, perfil) values("admin", sha2("passadmin", 256), 1);
insert into usuarios23(nombre, pass) values("usu2020", sha2("passusu", 256));