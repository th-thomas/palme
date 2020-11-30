-- Se connecter en tant que 'secretaire'
-- et exécuter toutes ces requêtes :
use lyonpalme;

-- Test 1 --
-- L'erreur suivante doit se produire :
-- ERROR 1142 (420000): SELECT command denied to user 'secretaire'@'localhost' for table 'materiel'
select * from materiel;

-- Test 2 --
-- L'erreur suivante doit se produire :
-- SELECT command denied to user 'secretaire'@'localhost' for table 'sortie'
select * from sortie;

-- Test 3 --
-- L'erreur suivante doit se produire :
-- ERROR 1142 (42000): INSERT, CREATE commande denied [...]
create table sortiebis as select * from sortie;

-- Test 4 --
-- Les requêtes suivantes doivent aboutir.
insert into adherent (id_adh, estactif_adh, nom_adh, prenom_adh, datenaissance_adh, dateinscription_adh, datefincertifmed_adh, fonctionbureau_adh, estresponsablemateriel_adh, estresponsableplanning_adh, login_adh, mdp_adh) values
('ADH1234',1,'Smith','John','1900/01/01','1950/01/01','2050/01/01',NULL,0,0,'jsmith','jsmithpwd');

select prenom_adh as 'Prenom', nom_adh as 'Nom', dateinscription_adh as 'Date d\'inscription'
from adherent
where prenom_adh like 'j%h%'
or datefincertifmed_adh > '2049/12/31';

-- Test 5 --
-- Les requêtes doivent aboutir
update adherent
set fonctionbureau_adh = 'Assistant au vice-secrétaire en chef'
where nom_adh = 'smith';

select nom_adh as 'Nom', prenom_adh as 'Prenom', fonctionbureau_adh as 'Fonction'
from adherent
where year(datenaissance_adh) < 1901;

-- Test 6 --
-- Les requêtes doivent aboutir
insert into entraineur (id_adh)
select id_adh from adherent
where id_adh = 'ADH1234';

select * from entraineur;

-- Pour finir --
-- La requête doit aboutir
delete from adherent where id_adh = 'ADH1234';