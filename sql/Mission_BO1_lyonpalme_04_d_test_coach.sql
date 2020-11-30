-- Se connecter en tant que 'coach'
-- et exécuter toutes ces requêtes :
use lyonpalme;

-- Test 1 --
-- L'erreur suivante doit se produire :
-- ERROR 1142 (420000): SELECT command denied to user 'coach'@'localhost' for table 'materiel'
select * from materiel;

-- Test 2 --
-- L'erreur suivante doit se produire :
-- SELECT command denied to user 'coach'@'localhost' for table 'sortie'
select * from sortie;

-- Test 3 --
-- La requête n'est pas autorisée. On doit avoir l'erreur suivante :
-- INSERT command denied to user 'coach'@'localhost' for table 'sortie'
insert into sortie (id_sortie, jour_sortie, lieurdv_sortie, heurerdv_sortie, plage_sortie, heuremisealeau_sortie, niveaupublic_sortie, mentionhiver_sortie, id_adh)
values ('SOR1234','1900/01/01','Paris-Plage','14:00','On verra suivant le monde qu\'il y a','16:00','Tous publics','Canne à pêche obligatoire','ADH0001');

-- Test 4 --
-- La requête doit échouer : l'utilisateur coach n'a pas les droits de lecture (SELECT) sur la table 'animer'.
select entrainement.id_entrainement as 'Numero entrainement', adherent.prenom_adh as 'Prenom redacteur', adherent.nom_adh as 'Nom redacteur', entrainement.date_entrainement from animer, seance, entrainement, adherent
where animer.id_adh = 'ADH0001'
and animer.id_seance = seance.id_seance
and seance.id_entrainement = entrainement.id_entrainement
and entrainement.id_adh = adherent.id_adh;

-- Test 5 --
-- La requête doit échouer : l'utilisateur coach n'a pas les droits de modification (UPDATE) sur la table 'animer'.
update animer
set id_adh = 'ADH0006',
    commentaireindispo_animer = NULL,
    propositionechange_animer = NULL
where id_seance = 'SEA0003'
and id_adh = 'ADH0005';

-- Test 6 --
-- Les requêtes doivent aboutir.
insert into entrainement (id_entrainement, date_entrainement, id_adh) values
('ENT1234','2100/01/01','ADH0006');

-- Test 7 --
-- Les requêtes doivent aboutir.
select * from seance;
select * from entrainement;

-- Test 8 --
-- L'erreur suivante doit se produire :
-- INSERT command denied to user 'coach'@'localhost' for table 'seance'
insert into seance (id_seance, date_seance, id_entrainement) values
('SEA1234','2100/01/01','ENT1234');

-- Test 9 --
-- La requête doit aboutir
update seance
    set id_entrainement = 'ENT0001'
    where id_seance = 'SEA0002';

-- Test 9 --
-- La requête doit aboutir.
delete from entrainement
    where id_entrainement = 'ENT1234';