use lyonpalme;
insert into adherent (id_adh, estactif_adh, nom_adh, prenom_adh, datenaissance_adh, dateinscription_adh, datefincertifmed_adh, fonctionbureau_adh, estresponsablemateriel_adh, estresponsableplanning_adh, login_adh, mdp_adh)
values
       ('ADH0001',1,'Constant','Benjamin','1990/01/25','2005/02/01','2020/12/31','Secrétaire',0,1,'bconstant','bconstantpwd'),
       ('ADH0002',1,'Boam','Jérôme','1940/12/25','2006/04/02','2022/01/01','Président',0,0,'jboam','jboampwd'),
       ('ADH0003',1,'Bonnet','Mélanie','1993/02/20','2015/09/30','2021/04/26',NULL,0,0,'mbonnet','mbonnetpwd'),
       ('ADH0004',1,'Dumoulin','Stéphanie','1979/11/11','2005/07/06','2020/03/02','Président adjoint',0,0,'sdumoulin','sdumoulinpwd'),
       ('ADH0005',1,'Dumoulin','Patrick','1979/11/11','2004/02/02','2020/12/15','Secrétaire adjoint',1,0,'pdumoulin','pdumoulinpwd'),
       ('ADH0006',1,'Solo','Hans','1984/05/10','2007/08/18','2022/01/15','Trésorier',0,0,'hsolo','hsolopwd'),
       ('ADH0007',0,'Sekaï-Haulequeur','Luc','1999/06/06','2004/05/04','2009/12/14',NULL,0,0,'lsekaihaulequeur','lsekaihaulequeurpwd'),
       ('ADH0008',0,'Papadopoulos','Archibald','1973/08/27','2006/10/14','2009/10/10',NULL,0,0,'apapadopoulos','apapadopoulospwd'),
       ('ADH0009',1,'Papadopoulos','Hélène','1975/03/03','2006/10/14','2021/03/02',NULL,0,0,'hpapadopoulos','hpapadopoulospwd')
       ;
-- Ci-dessus les mots de passe ont été imaginés pour suivre un schéma simple à tester (login concaténé à 'pwd')
-- Les mots de passe ne sont donc pas les dates d'anniversaire.

insert into entraineur (id_adh)
values
       ('ADH0001'),
       ('ADH0004'),
       ('ADH0005'),
       ('ADH0006')
       ;

insert into coach (id_adh)
values
       ('ADH0001'),
       ('ADH0006')
       ;

insert into competition (id_compet, libelle_compet, dateclotureinscription_compet)
values
       ('COM0001','Demi-finale Rhône 2020','2020/06/30'),
       ('COM0002','Amicale inter-région 2020','2020/09/30')
       ;

insert into distance (id_distance, metres_distance)
values
       ('DIS0001','1000 m'),
       ('DIS0002','3000 m'),
       ('DIS0003','5000 m'),
       ('DIS0004','10 000 m');

insert into modalite (id_modalite, libelle_modalite)
values
       ('MOD0001','relais'),
       ('MOD0002','mono-palme'),
       ('MOD0003','bi-palme'),
       ('MOD0004','en support')
       ;

insert into proposer_mod (id_compet, id_modalite)
values
       ('COM0001','MOD0001'),
       ('COM0001','MOD0002'),
       ('COM0001','MOD0003'),
       ('COM0001','MOD0004'),
       ('COM0002','MOD0002'),
       ('COM0002','MOD0003'),
       ('COM0002','MOD0004')
       ;

insert into proposer_dist (id_compet, id_distance)
values
       ('COM0001','DIS0002'),
       ('COM0001','DIS0003'),
       ('COM0001','DIS0004'),
       ('COM0002','DIS0001'),
       ('COM0002','DIS0002')
       ;

insert into sinscrirecompet (id_adh, id_compet, modalitechoisie_inscr, distancechoisie_inscr, besoincovoiturage_inscr, proposecovoiturage_inscr, nombreplacesvoiture_inscr, besoinherbergement_inscr, nbpersonneaccompagne_inscr)
values
       ('ADH0003','COM0001','MOD0003','DIS0002',0,1,4,0,0),
       ('ADH0003','COM0002','MOD0002','DIS0001',0,1,4,1,0),
       ('ADH0009','COM0001','MOD0002','DIS0003',1,0,0,1,2),
       ('ADH0004','COM0001','MOD0004','DIS0002',1,0,0,1,0),
       ('ADH0004','COM0002','MOD0004','DIS0002',1,0,0,1,0)
       ;

insert into materiel (code_mat, libelle_mat, tailleoupointure_mat, marque_mat)
values
       ('MAT1001','Monopalme souple','43','Will DePalm'),
       ('MAT1002','Monopalme','44','Will DePalm'),
       ('MAT1003','Monopalme','42','Flipper2000'),
       ('MAT1004','Bipalme souple','42','Flipper2000'),
       ('MAT1005','Bipalme','43','Flipper2000'),
       ('MAT2001','Tuba frontal','Taille unique','Spido'),
       ('MAT2002','Tuba frontal','Taille unique','Spido'),
       ('MAT3001','Lunettes','Petite taille','Spido'),
       ('MAT3002','Lunettes','Moyenne taille','Spido'),
       ('MAT3003','Lunettes','Moyenne taille','Spido'),
       ('MAT3004','Lunettes','Moyenne taille','Rébanne'),
       ('MAT3005','Lunettes','Moyenne taille','Rébanne'),
       ('MAT3006','Lunettes','Grande taille','Rébanne'),
       ('MAT3007','Lunettes','Très grande taille','Rébanne'),
       ('MAT4001','Combinaison','S','Spido'),
       ('MAT4002','Combinaison','S','Flipper2000'),
       ('MAT4003','Combinaison','S','Will DePalm'),
       ('MAT4004','Combinaison','M','Spido'),
       ('MAT4005','Combinaison','M','Spido'),
       ('MAT4006','Combinaison','M','Flipper2000'),
       ('MAT4007','Combinaison','M','Will DePalm'),
       ('MAT4008','Combinaison','L','Spido'),
       ('MAT4009','Combinaison','L','Spido'),
       ('MAT4010','Combinaison','XL','Spido')
       ;

insert into sortie (id_sortie, jour_sortie, lieurdv_sortie, heurerdv_sortie, plage_sortie, heuremisealeau_sortie, niveaupublic_sortie, mentionhiver_sortie, id_adh)
values
       ('SOR0001','2020/07/28','Lac de Miribel','10:00','Plage ouest','11:00','Confirmé',NULL,'ADH0001')
       ;

insert into entrainement (id_entrainement, date_entrainement, id_adh)
values
       ('ENT0001','2020/06/08','ADH0001'),
       ('ENT0002','2020/06/10','ADH0001'),
       ('ENT0003','2020/06/11','ADH0006')
       ;

insert into seance (id_seance, date_seance, id_entrainement)
values
       ('SEA0001','2020/06/08','ENT0001'),
       ('SEA0002','2020/06/10','ENT0002'),
       ('SEA0003','2020/06/11','ENT0003')
       ;

insert into animer (id_seance, id_adh, commentaireindispo_animer, propositionechange_animer)
values
       ('SEA0001','ADH0001',NULL,NULL),
       ('SEA0001','ADH0004',NULL,NULL),
       ('SEA0002','ADH0006',NULL,NULL),
       ('SEA0002','ADH0001',NULL,NULL),
       ('SEA0003','ADH0005','Indisponible','Echange avec Hans Solo possible ?')
       ;

insert into participersortie (id_adh, id_sortie)
values
       ('ADH0003','SOR0001'),
       ('ADH0009','SOR0001')
       ;

insert into pret (code_mat, date_pret, daterendu_pret, estrendu_pret, commentaire_pret, id_adh)
values
       ('MAT1001','2020/03/02',NULL,0,NULL,'ADH0003'),
       ('MAT1002','2020/06/01','2020/06/04',1,'Abîmé','ADH0009')
       ;

