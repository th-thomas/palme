-- Se connecter en tant que 'materiel'
-- et exécuter toutes ces requêtes :
use lyonpalme;

-- Test 1 --
-- La requête doit aboutir.
select * from materiel;

-- Test 2 --
-- L'erreur suivante doit se produire :
-- SELECT command denied to user 'materiel'@'localhost' for table 'sortie'
select * from sortie;

-- Test 3 --
-- La requête n'est pas autorisée. On doit avoir l'erreur suivante :
-- INSERT command denied to user 'materiel'@'localhost' for table 'sortie'
insert into sortie (id_sortie, jour_sortie, lieurdv_sortie, heurerdv_sortie, plage_sortie, heuremisealeau_sortie, niveaupublic_sortie, mentionhiver_sortie, id_adh)
values ('SOR1234','1900/01/01','Paris-Plage','14:00','On verra suivant le monde qu\'il y a','16:00','Tous publics','Canne à pêche obligatoire','ADH0001');

-- Test 4 --
-- La requête doit aboutir.
insert into materiel (code_mat, libelle_mat, tailleoupointure_mat, marque_mat) values
('MAT1234','Monocle de compétition','Pour les grosses têtes','Rébanne');

-- Test 5 --
-- La requête doit aboutir.
update materiel
set marque_mat = 'Spido'
where libelle_mat like '%monocle%';

-- Test 6 --
-- La requête doit aboutir.
insert into pret (code_mat, date_pret, daterendu_pret, estrendu_pret, commentaire_pret, id_adh) values
('MAT1234','2100/01/01',NULL,0,NULL,'ADH0001');

-- Test 7 --
-- La requête doit aboutir.
select * from pret;

-- Test 8 --
-- La requête doit aboutir.
update pret
set daterendu_pret = '2100/12/31',
    commentaire_pret = 'RAS'
where code_mat = 'MAT1234'
and date_pret = '2100/01/01';

-- Test 9 ---
-- Les requêtes doivent aboutir.
delete from pret
where code_mat = (select pret.code_mat from pret, materiel where pret.code_mat = materiel.code_mat and libelle_mat like '%monocle%');

delete from materiel
where libelle_mat like '%monocle%';
