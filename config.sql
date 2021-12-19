/* tietokannan luominen */
CREATE DATABASE t8kohe02;

USE t8kohe02;
/*taulut*/
CREATE TABLE user(
id int primary key auto_increment,
username varchar(40) not null,
password varchar(40) not null,
)

CREATE TABLE info(
id int primary key auto_increment,
firstname varchar(40) not null,
lastname varchar(40) not null,
userid int not null,
index userid(userid),
foreign key (userid) references user(id)
on delete restrict
);
