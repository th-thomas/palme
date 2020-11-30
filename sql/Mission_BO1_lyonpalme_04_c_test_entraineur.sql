-- Se connecter en tant que 'entraineur'
-- et exécuter toutes ces requêtes :
use lyonpalme;

-- Test 1 --
-- L'erreur suivante doit se produire :
-- ERROR 1142 (420000): SELECT command denied to user 'entraineur'@'localhost' for table 'materiel'
select * from materiel;

-- Test 2 --
-- La requête doit aboutir.
select * from sortie;

-- Test 3 --
-- Les requêtes doivent aboutir.
insert into sortie (id_sortie, jour_sortie, lieurdv_sortie, heurerdv_sortie, plage_sortie, heuremisealeau_sortie, niveaupublic_sortie, mentionhiver_sortie, id_adh)
values ('SOR1234','1900/01/01','Paris-Plage','14:00','On verra suivant le monde qu\'il y a','16:00','Tous publics','Canne à pêche obligatoire','ADH0001');

select * from sortie
where id_adh = 'ADH0001';

delete from sortie
where id_sortie = 'SOR1234';

-- Test 4 --
-- Les requêtes doivent aboutir.
insert into competition (id_compet, libelle_compet, dateclotureinscription_compet) values
('COM1234','Championnat olympique','2100/01/01');

select * from competition;

delete from competition
where libelle_compet like '%olymp%';

-- Test 5 --
-- La requête doit aboutir.
select entrainement.id_entrainement as 'Numero entrainement', adherent.prenom_adh as 'Prenom redacteur', adherent.nom_adh as 'Nom redacteur', entrainement.date_entrainement from animer, seance, entrainement, adherent
where animer.id_adh = 'ADH0001'
and animer.id_seance = seance.id_seance
and seance.id_entrainement = entrainement.id_entrainement
and entrainement.id_adh = adherent.id_adh;

-- Test 6 --
-- La requête doit aboutir (elle doit renvoyer une ligne : SEA0003, ADH0005 est indisponible).
select * from animer
where commentaireindispo_animer like '%indisponible%';

-- Test 7 --
-- La requête doit aboutir.
update animer
set id_adh = 'ADH0006',
    commentaireindispo_animer = NULL,
    propositionechange_animer = NULL
where id_seance = 'SEA0003'
and id_adh = 'ADH0005';

-- Test 8 --
-- La requête doit aboutir.
update animer
set commentaireindispo_animer = 'Je suis malade...',
    propositionechange_animer = 'Echange possible avec Hans Solo ?'
where id_seance = 'SEA0001'
and id_adh = 'ADH0004';