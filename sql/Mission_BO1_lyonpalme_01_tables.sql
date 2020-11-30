CREATE DATABASE lyonpalme CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE lyonpalme;
CREATE TABLE adherent(
   id_adh CHAR(7),
   estactif_adh TINYINT(1),
   nom_adh VARCHAR(50),
   prenom_adh VARCHAR(50),
   datenaissance_adh DATE,
   dateinscription_adh DATE,
   datefincertifmed_adh DATE,
   fonctionbureau_adh VARCHAR(50) UNIQUE,
   estresponsablemateriel_adh TINYINT(1),
   estresponsableplanning_adh TINYINT(1),
   login_adh VARCHAR(50) UNIQUE,
   mdp_adh VARCHAR(50) UNIQUE,
   PRIMARY KEY(id_adh)
) ENGINE = InnoDB;

CREATE TABLE materiel(
   code_mat CHAR(7),
   libelle_mat VARCHAR(50),
   tailleoupointure_mat VARCHAR(50),
   marque_mat VARCHAR(50),
   PRIMARY KEY(code_mat)
) ENGINE = InnoDB;

CREATE TABLE competition(
   id_compet CHAR(7),
   libelle_compet VARCHAR(50),
   dateclotureinscription_compet DATE,
   PRIMARY KEY(id_compet)
) ENGINE = InnoDB;

CREATE TABLE entraineur(
   id_adh CHAR(7),
   PRIMARY KEY(id_adh),
   FOREIGN KEY(id_adh)
       REFERENCES adherent(id_adh)
       ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE = InnoDB;

CREATE TABLE distance(
   id_distance CHAR(7),
   metres_distance VARCHAR(10) NOT NULL,
   PRIMARY KEY(id_distance)
) ENGINE = InnoDB;

CREATE TABLE modalite(
   id_modalite CHAR(7),
   libelle_modalite VARCHAR(50),
   PRIMARY KEY(id_modalite)
) ENGINE = InnoDB;

CREATE TABLE coach(
   id_adh CHAR(7),
   PRIMARY KEY(id_adh),
   FOREIGN KEY(id_adh)
       REFERENCES entraineur(id_adh)
       ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE = InnoDB;

CREATE TABLE entrainement(
   id_entrainement CHAR(7),
   date_entrainement DATE,
   id_adh CHAR(7) NOT NULL,
   PRIMARY KEY(id_entrainement),
   FOREIGN KEY(id_adh)
       REFERENCES coach(id_adh)
       ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE = InnoDB;

CREATE TABLE sortie(
   id_sortie CHAR(7),
   jour_sortie DATE,
   lieurdv_sortie VARCHAR(50),
   heurerdv_sortie TIME,
   plage_sortie VARCHAR(50),
   heuremisealeau_sortie TIME,
   niveaupublic_sortie VARCHAR(50),
   mentionhiver_sortie VARCHAR(200),
   id_adh CHAR(7) NOT NULL,
   PRIMARY KEY(id_sortie),
   FOREIGN KEY(id_adh)
       REFERENCES entraineur(id_adh)
       ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE = InnoDB;

CREATE TABLE seance(
   id_seance CHAR(7),
   date_seance DATE,
   id_entrainement CHAR(7) NOT NULL,
   PRIMARY KEY(id_seance),
   FOREIGN KEY(id_entrainement)
       REFERENCES entrainement(id_entrainement)
       ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE = InnoDB;

CREATE TABLE sinscrirecompet(
   id_adh CHAR(7),
   id_compet CHAR(7),
   modalitechoisie_inscr CHAR(7),
   distancechoisie_inscr CHAR(7),
   besoincovoiturage_inscr TINYINT(1),
   proposecovoiturage_inscr TINYINT(1),
   nombreplacesvoiture_inscr TINYINT,
   besoinherbergement_inscr TINYINT(1),
   nbpersonneaccompagne_inscr TINYINT,
   PRIMARY KEY(id_adh, id_compet),
   FOREIGN KEY(id_adh)
       REFERENCES adherent(id_adh)
       ON UPDATE CASCADE ON DELETE RESTRICT,
   FOREIGN KEY(id_compet)
       REFERENCES competition(id_compet)
       ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE = InnoDB;

CREATE TABLE participersortie(
   id_adh CHAR(7),
   id_sortie CHAR(7),
   PRIMARY KEY(id_adh, id_sortie),
   FOREIGN KEY(id_adh)
       REFERENCES adherent(id_adh)
       ON UPDATE CASCADE ON DELETE RESTRICT,
   FOREIGN KEY(id_sortie)
       REFERENCES sortie(id_sortie)
       ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE = InnoDB;

CREATE TABLE animer(
   id_seance CHAR(7),
   id_adh CHAR(7),
   commentaireindispo_animer VARCHAR(50),
   propositionechange_animer VARCHAR(200),
   PRIMARY KEY(id_seance, id_adh),
   FOREIGN KEY(id_seance)
       REFERENCES seance(id_seance)
       ON UPDATE CASCADE ON DELETE RESTRICT,
   FOREIGN KEY(id_adh)
       REFERENCES entraineur(id_adh)
       ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE = InnoDB;

CREATE TABLE pret(
   code_mat CHAR(7),
   date_pret DATE,
   daterendu_pret VARCHAR(50),
   estrendu_pret TINYINT(1),
   commentaire_pret VARCHAR(50),
   id_adh CHAR(7) NOT NULL,
   PRIMARY KEY(code_mat, date_pret),
   FOREIGN KEY(code_mat)
       REFERENCES materiel(code_mat)
       ON UPDATE CASCADE ON DELETE RESTRICT,
   FOREIGN KEY(id_adh)
       REFERENCES adherent(id_adh)
       ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE = InnoDB;

CREATE TABLE proposer_dist(
   id_compet CHAR(7),
   id_distance CHAR(7),
   PRIMARY KEY(id_compet, id_distance),
   FOREIGN KEY(id_compet)
       REFERENCES competition(id_compet)
       ON UPDATE CASCADE ON DELETE RESTRICT,
   FOREIGN KEY(id_distance)
       REFERENCES distance(id_distance)
       ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE = InnoDB;

CREATE TABLE proposer_mod(
   id_compet CHAR(7),
   id_modalite CHAR(7),
   PRIMARY KEY(id_compet, id_modalite),
   FOREIGN KEY(id_compet)
       REFERENCES competition(id_compet)
       ON UPDATE CASCADE ON DELETE RESTRICT,
   FOREIGN KEY(id_modalite)
       REFERENCES modalite(id_modalite)
       ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE = InnoDB;
