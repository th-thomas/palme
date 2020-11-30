--
-- Script SQL permettant la création des utilisateurs de la base de données lyonpalme
-- et l'attribution de droits à ces utilisateurs selon les règles de gestion.
--

--
-- DEFINITION D'UN MOT DE PASSE POUR L'UTILISATEUR 'ROOT'
-- Utile dans le cas d'une nouvelle installation XAMPP (par défaut l'utilisateur 'root' n'a pas de mot de passe).
--
alter user root@localhost identified by 'toor';

--
-- CREATION DES UTILISATEURS
--

-- On ne permet les connexions que depuis localhost pour plus de sécurité.
drop user if exists administrateur@localhost;
create user if not exists administrateur@localhost;

drop user if exists secretaire@localhost;
create user if not exists secretaire@localhost;

drop user if exists entraineur@localhost;
create user if not exists entraineur@localhost;

drop user if exists coach@localhost;
create user if not exists coach@localhost;

drop user if exists materiel@localhost;
create user if not exists materiel@localhost;

drop user if exists adherent@localhost;
create user if not exists adherent@localhost;


--
-- ATTRIBUTION DES PRIVILEGES
--

-- L'utilisateur 'administrateur'
-- - a tous les privilèges sur la base de données lyonpalme.
grant all privileges
    on lyonpalme.*
    to administrateur@localhost
    with grant option;

-- L'utilisateur 'secretaire' peut :
-- - Visualiser les adhérents inscrits
-- - Inscrire les nouveaux adhérents
-- - Archiver les anciens adhérents
grant select, insert, update, delete
    on lyonpalme.adherent
    to secretaire@localhost;

grant select, insert, update, delete
    on lyonpalme.entraineur
    to secretaire@localhost;

grant select, insert, update, delete
    on lyonpalme.coach
    to secretaire@localhost;

-- L'utilisateur 'entraineur' peut :
-- - Visualiser un entraînement
-- - Construire et modifier le planning des séances s'il est responsable planning
-- - Visualiser le planning des séances d'entraînement
-- - Signaler une indisponibilité sur une séance du planning et proposer un échange
-- - Créer une sortie
-- - Dupliquer une sortie
-- - Créer une compétition
grant select
    on lyonpalme.entrainement
    to entraineur@localhost;

grant select, insert, update, delete
    on lyonpalme.seance
    to entraineur@localhost;

grant select, insert, update, delete
    on lyonpalme.animer
    to entraineur@localhost;

grant select, insert, update, delete
    on lyonpalme.sortie
    to entraineur@localhost;

grant select, insert, update, delete
    on lyonpalme.competition
    to entraineur@localhost;

grant select, insert, update, delete
    on lyonpalme.proposer_mod
    to entraineur@localhost;

grant select, insert, update, delete
    on lyonpalme.proposer_dist
    to entraineur@localhost;

grant select
    on lyonpalme.adherent
    to entraineur@localhost;

grant select
    on lyonpalme.coach
    to entraineur@localhost;

-- L'utilisateur 'coach' peut :
-- - Déposer un entraînement
-- - Dupliquer un entraînement
grant select, insert, update, delete
    on lyonpalme.entrainement
    to coach@localhost;

-- (Le coach dépose un entraînement pour une séance spécifique :
-- id_entrainement est clé étrangère dans la table 'seance'.
-- Il faut donc que le coach puisse mettre à jour id_entrainement.)
grant select
    on lyonpalme.seance
    to coach@localhost;

grant update
    (id_entrainement)
    on lyonpalme.seance
    to coach@localhost;

grant select
    on lyonpalme.adherent
    to coach@localhost;

grant select
    on lyonpalme.entraineur
    to coach@localhost;

grant select
    on lyonpalme.coach
    to coach@localhost;

-- L'utilisateur 'materiel' peut :
-- - Visualiser le stock
-- - Rentrer / supprimer du matériel en stock
-- - Prêter du matériel
-- - Récupérer du matériel en fin de saison
grant select, insert, update, delete
    on lyonpalme.materiel
    to materiel@localhost;

grant select, insert, update, delete
    on lyonpalme.pret
    to materiel@localhost;

-- L'utilisateur 'adherent' peut :
-- - Modifier son compte (mot de passe)
-- - Visualiser le trombinoscope
-- - Visualiser l'annuaire (voir les fonctions des autres adhérents)
grant select
    on lyonpalme.adherent
    to adherent@localhost;

grant update
    (mdp_adh)
    on lyonpalme.adherent
    to adherent@localhost;

grant select
    on lyonpalme.entraineur
    to adherent@localhost;

grant select
    on lyonpalme.coach
    to adherent@localhost;

-- - Afficher les compétitions prévues
-- - S'inscrire à une compétition
grant select
    on lyonpalme.competition
    to adherent@localhost;

grant select
    on lyonpalme.proposer_dist
    to adherent@localhost;

grant select
    on lyonpalme.proposer_mod
    to adherent@localhost;

grant select
    on lyonpalme.modalite
    to adherent@localhost;

grant select
    on lyonpalme.distance
    to adherent@localhost;

grant select, insert, update
    on lyonpalme.sinscrirecompet
    to adherent@localhost;

-- - Afficher les sorties prévues
-- - S'inscrire à une sortie
grant select
    on lyonpalme.sortie
    to adherent@localhost;

grant select, insert, update
    on lyonpalme.participersortie
    to adherent@localhost;

--
-- FIN DE L'ATTRIBUTION DES PRIVILEGES
--

-- Commande parfois utile pour éviter des soucis avec les utilisateurs nouvellement créés
flush privileges;