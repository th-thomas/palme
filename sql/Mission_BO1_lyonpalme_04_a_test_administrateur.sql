-- Se connecter en tant que 'administrateur'
-- et exécuter toutes ces requêtes (toutes doivent aboutir) :
use lyonpalme;

-- Test 1 --
create table palmes
    as select * from materiel
    where libelle_mat like '%palme%';

select * from palmes;

drop table palmes;

-- Test 2 --
create table test (
  champ1 char(2) primary key,
  champ2 varchar(20)
);

insert into test values
    ('AB', 'Valeur de test'),
    ('CD', 'Autre valeur');

select * from test;

drop table test;

-- Test 3 --
insert into materiel (code_mat, libelle_mat, tailleoupointure_mat, marque_mat)
values ('MAT1234','Tri-palme fictif','60','Lav-One');

select * from materiel where code_mat = 'MAT1234';

-- Pour finir --
delete from materiel where code_mat = 'MAT1234';
