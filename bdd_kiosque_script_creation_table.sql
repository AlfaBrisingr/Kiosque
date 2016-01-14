DROP SCHEMA IF EXISTS db576425814;

CREATE SCHEMA db576425814;

USE db576425814;

CREATE TABLE ecole (
	idEcole INT NOT NULL AUTO_INCREMENT,
	typeEcole int not null,
	nomEcole VARCHAR(50) NOT NULL,
	adresseEcole VARCHAR(50) NOT NULL,
	adresse2Ecole VARCHAR(20),
	cpEcole INT NOT NULL,
	villeEcole VARCHAR(50) NOT NULL,
	mail_dir VARCHAR(50) NOT NULL,
	idDirecteur INT,
	PRIMARY KEY (idEcole)
);
CREATE TABLE enseignant (
	idEns INT NOT NULL AUTO_INCREMENT,
	civEns VARCHAR(50) NOT NULL,
	nomEns VARCHAR(50) NOT NULL,
	prenomEns VARCHAR(50) NOT NULL,
	mailEns VARCHAR(50) NOT NULL,
	telEns text NOT NULL,
	idEcole INT NOT NULL,
	PRIMARY KEY (idEns)
);

CREATE TABLE inscription (
	idInscription INT NOT NULL AUTO_INCREMENT,
	validationInscription boolean NOT NULL,
	idEns INT NOT NULL,
	dateInscription datetime not null,
	diversInscription text,
	impoInscription text,
	nbEnfantsInscription int not null,
	nbAdultesInscription int not null,
	PRIMARY KEY(idInscription)
);

CREATE TABLE choix (
	idInscription INT NOT NULL,
	idSpectacle INT NOT NULL,
	prioriteChoix INT NOT NULL,
	PRIMARY KEY(idInscription,idSpectacle)
);

CREATE TABLE spectacle (
	idSpectacle INT NOT NULL AUTO_INCREMENT,
	nomSpectacle VARCHAR(80) NOT NULL,
	nbPlaceSpectacle INT NOT NULL,
	typeClasse varchar(40) not null,
	PRIMARY KEY(idSpectacle)
);

CREATE TABLE genre (
	idGenre INT NOT NULL AUTO_INCREMENT,
	nomGenre VARCHAR(40) NOT NULL,
	PRIMARY KEY (idGenre)
);

CREATE TABLE genre_spectacle (
	idGenre INT NOT NULL,
	idSpectacle INT NOT NULL,
	PRIMARY KEY (idGenre,idSpectacle)
);

CREATE TABLE seance (
	idSeance INT NOT NULL AUTO_INCREMENT,
	idSpectacle INT NOT NULL,
	date_heure DATETIME NOT NULL,
	idLieu INT NOT NULL,
	PRIMARY KEY(idSeance)
);

CREATE TABLE planning (
	idSeance INT NOT NULL,
	idInscription INT NOT NULL,
	PRIMARY KEY (idSeance, idInscription)
);

CREATE TABLE lieu (
	idLieu INT NOT NULL AUTO_INCREMENT,
	nomLieu VARCHAR(50) NOT NULL,
	adrLieu VARCHAR(50) NOT NULL,
	cpLieu INT(5) NOT NULL,
	villeLieu VARCHAR(50) NOT NULL,
	PRIMARY KEY (idLieu)
);

CREATE TABLE admin (
	code_user INT NOT NULL AUTO_INCREMENT,
	login VARCHAR(40) NOT NULL,
	password VARCHAR(50) NOT NULL,
	PRIMARY KEY (code_user)
);

CREATE TABLE saison (
	idSaison int not null AUTO_INCREMENT,
	nomSaison varchar(40) not null,
	courante tinyint(1) not null,
	primary key (idSaison)
);

CREATE TABLE saison_spectacle (
	idSaison int not null,
	idSpectacle int not null,
	primary key (idSaison,idSpectacle)
);

ALTER TABLE ecole
ADD CONSTRAINT fkEcoleEnseignant
FOREIGN KEY (idDirecteur) REFERENCES enseignant(idEns);

ALTER TABLE enseignant
ADD CONSTRAINT fkEnseignantEcole
FOREIGN KEY (idEcole) REFERENCES ecole(idEcole);

ALTER TABLE inscription
ADD CONSTRAINT fk_inscriptionEnseignant
FOREIGN KEY (idEns) REFERENCES enseignant(idEns);

ALTER TABLE choix
ADD CONSTRAINT fk_choix_inscription
FOREIGN KEY (idInscription) REFERENCES inscription(idInscription),
ADD CONSTRAINT fk_choix_spectacle
FOREIGN KEY (idSpectacle) REFERENCES spectacle(idSpectacle);

ALTER TABLE seance
ADD CONSTRAINT fk_seance_spectacle
FOREIGN KEY (idSpectacle) REFERENCES spectacle(idSpectacle),
ADD CONSTRAINT fk_seance_lieu
FOREIGN KEY (idLieu) REFERENCES lieu(idLieu);

ALTER TABLE planning
ADD CONSTRAINT fk_planning_seance
FOREIGN KEY (idSeance) REFERENCES seance(idSeance),
ADD CONSTRAINT fk_planning_inscription
FOREIGN KEY (idInscription) REFERENCES inscription(idInscription);

alter table genre_spectacle
ADD CONSTRAINT fk_spectacle_genre
FOREIGN KEY (idSpectacle) REFERENCES spectacle(idSpectacle),
ADD CONSTRAINT fk_genre_spectacle_genre
FOREIGN key (idGenre) REFERENCES genre(idGenre);

ALTER TABLE saison_spectacle
ADD CONSTRAINT fk_saison_saison_spectacle
FOREIGN KEY (idSaison) REFERENCES saison(idSaison),
ADD CONSTRAINT fk_spectacle_saison_spectacle
FOREIGN KEY (idSpectacle) REFERENCES spectacle(idSpectacle);

/* Insertion des données par défaut */

/* Table Ecole */

INSERT INTO ecole VALUES (1,1,"Charles Perrault","18 Bd Général Leclerc",null,53100,"MAYENNE","ce.0530320k@ac-nantes.fr",null),
(2,1,"Jacques Prévert","Rue Ambroise de Loré",null,53100,"MAYENNE","ce.0530323n@ac-nantes.fr",null),
(3,1,"Paul Eluard Prim","125 Rue d'Oisseau",null,53100,"MAYENNE","ce.0530325r@ac-nantes.fr",null),
(4,1,"L'angellerie","117 rue Estienne",null,53100,"MAYENNE","ce.0530900r@ac-nantes.fr",null),
(5,1,"Jules Ferry","5 rue Réaumur",null,53100,"MAYENNE","ce.0530509r@ac-nantes.fr",null),
(6,1,"Louise Michel","145 rue de la Visistation",null,53100,"MAYENNE","ce.0530510s@ac-nantes.fr",null),
(7,1,"Pierre & Marie Curie","53 rue Lamartine",null,53100,"MAYENNE","ce.0530511t@ac-nantes.fr",null),
(8,2,"Don Bosco","387 rue des Vallées",null,53100,"MAYENNE","ecole.lavellee@donbosco.fr",null),
(9,2,"St Joseph - Ste Anne","8 rue des Capucins",null,53100,"MAYENNE","ecole.saintjoseph@donbosco.fr",null),
(10,2,"St Martin","7 rue de la Davière",null,53100,"MAYENNE","ecole.saintmartin@donbosco.fr",null),
(11,1,"Alexain","10 rue de la mairie",null,53240,"ALEXAIN","ce.0530087g@ac-nantes.fr",null),
(12,1,"Le Petit Bois","10 rue de Baladé",null,53440,"ARON","ce.0530095r@ac-nantes.fr",null),
(13,2,"St Martin","3 rue de Normandie",null,53440,"ARON","ecole.privee.aron@wanadoo.fr",null),
(14,2,"Sacré Coeur","6 route de Jublains",null,53440,"GRAZAY","ecole.grazay@orange.fr",null),
(15,1,"Jublains","18 rue du Temple",null,53160,"JUBLAINS","ecole.jub@wanadoo.fr",null),
(16,1,"La Bazoge Montpinçon","16 rue de la Mairie",null,53440,"LA BAZOGE MONTPINCON","ce.0530112j@ac-nantes.fr",null),
(17,1,"Moulay","1 rue du Val de l'Aron",null,53100,"MOULAY","ecolepub.moulay@wanadoo.fr",null),
(18,2,"St Louis de Gonzague","12 allée des Chênes",null,53240,"PLACE","place.ecole.stlouis@ddec53.fr",null),
(19,1,"Emile Zola","Rue des Camélias",null,53470,"SACE","ce.0530379z@ac-nantes.fr",null),
(20,1,"La Haie Traversaine","2 rue du Breil",null,53300,"LA HAIE TRAVERSAINE","ce.0530232p@ac-nantes.fr",null),
(21,1,"Henri Matisse","35 bis rue de Normandie",null,53440,"MARCILLE LA VILLE","ce.0530743v@ac-nantes.fr",null),
(22,2,"St Anne","8 rue de l'Oseraie",null,53440,"MARCILLE LA VILLE","ecole.st-anne@wanadoo.fr",null),
(23,1,"Galilée","5 rue Véga",null,53470,"MARTIGNE SUR MAYENNE","ecole.galilee.martigne@wanadoo.fr",null),
(24,1,"Paul Cezanne","Route de Contest",null,53100,"ST BAUDELLE","ecolepublique-st-baudelle@wanadoo.fr",null),
(25,1,"Henri des","2 rue des Fresnots",null,53300,"ST FRAIMBAULT DE PRIERES","ce.0530401y@ac-nantes.fr",null),
(26,2,"St Marthe","6 rue de la Grange",null,53240,"ST GERMAIN D'ANXURE","ecole.ste.marthe53@orange.fr",null),
(27,1,"Paul Eluard Mat","125 Rue d'Oisseau",null,53100,"MAYENNE","ce.0530324p@ac-nantes.fr",null),
(28,1,"Belgeard","27 rue du Muguet",null,53440,"BELGEARD","belgeard.ecole@wanadoo.fr",null),
(29,1,"Jules Verne","16 rue des Tisserands",null,53470,"COMMER","ce.0530759m@ac-nantes.fr",null),
(30,1,"Louis Chedid","1 rue Hollenbach",null,53100,"CONTEST","ce.0530178f@ac-nantes.fr",null),
(31,2,"St Martin","6 rue Hollenbach",null,53100,"CONTEST","contest.ecole.stmartin@ddec53.fr",null);

/* Table Enseignant */

INSERT INTO enseignant VALUES (1,"Monsieur","MOQUET","Jean-Pierre","","0243042083",1),
(2,"Madame","COLOMBEL","Liliane","","0243042015",2),
(3,"Madame","HOUDOU","Isabelle","","0243043868",3),
(4,"Monsieur","POISSON","Olivier","","0243000754",4),
(5,"Monsieur","DONNIO","Pierre Alain","","0243042340",5),
(6,"Madame","DESTOOP","Catherine","","0243041941",6),
(7,"Madame","VENTOSA","Claire","","0243042305",7),
(8,"Madame","RENAULT","Angelique","","0243304748",8),
(9,"Monsieur","CALLONNEC","Yves","","0243042362",9),
(10,"Monsieur","CALLONNEC","Yves","","0243000558",10),
(11,"Madame","BURLET","Lucie","","0243007715",11),
(12,"Madame","DIRECTRICE","","","0243048384",12),
(13,"Madame","PEYRIEUX","Laure","","0243045696",13),
(14,"Madame","DIRECTRICE","","","0243007715",14),
(15,"Madame","KIRYLUK","Helène","","0243321240",15),
(16,"Madame","DEGUARA","Nathalie","","0243000137",16),
(17,"Madame","DIRECTRICE","","","0243004833",17),
(18,"Madame","CAILLEAU","Aurélie","","0243098123",18),
(19,"Monsieur","REBOURS","Samuel","","0243580739",19),
(20,"Madame","DIVEL","Nathalie","","0243040391",20),
(21,"Madame","GAUDIN","Jeanne","","0243007043",21),
(22,"Madame","SAUDRAIS","Bénédicte","","0243000620",22),
(23,"Madame","LESAGE","Christelle","","0243025706",23),
(24,"Monsieur","VALLEE","Laurent","","0243043481",24),
(25,"Monsieur","LEPERT","Gilles","","0243008818",25),
(26,"Madame","CORBET","Florence","","0243686077",26),
(27,"Madame","LE COCQ","Audrey","","0243044102",27),
(28,"Madame","MAUGET","Isabelle","","0243085904",28),
(29,"Madame","MANCEAU","Emmanuelle","","0243004478",29),
(30,"Madame","COURTIN","Audrey","","0243004644",30),
(31,"Madame","LESAGE","Maud","","0243321619",31),
(32,"Madame","LETERME","Marie-Odile","mt.leterme@orange.fr","0606901533",8);

/* Table MInscription Pour Test */

/*INSERT INTO inscription
VALUES (1,0,2,"2015-02-27 13:54:12",null,null,12,3),
(2,0,1,"2015-06-10 17:54:32",null,' - - ',13,1),
(3,0,4,"2015-05-23 03:32:21",'bonjoue',"non je peux pas j'ai piscine - et oui encore",40,2),
(4,0,3,"2015-06-04 20:32:40",'bonjour','1 : Vssde <br> 2 : <strong><em>Vide</em></strong> <br> 3 : <strong><em>Vide</em></strong>',100,20);

/* Table Spectacle */

INSERT INTO spectacle VALUES (1,"Lettre pour Elena",200,'CE/CM'),
(2,"Gretel et Hansel",100,'PS/MS'),
(3,"Enchantés",400,'CP/CE1'),
(4,"Abeille et Bourdon",300,'CE/CM'),
(5,"Jongle",200,'PS/MS'),
(6,"Le monde sous les flaques",80,"CE2/CM"),
(7,"L'hiver, 4 chiens mordent mes et mes mains",35,"CM2"),
(8,"Le roi des rats",250,"CM");

/* Table Genre */

INSERT INTO genre VALUES (1,'Danse'),
(2,'Théâtre');

/* Table Genre_spectacle */

INSERT INTO genre_spectacle VALUES (1,1),
(2,2),
(1,3),
(2,4),
(1,5);

/* Table Choix */

/*INSERT INTO choix VALUES (1,2,1),
(1,1,2),
(2,3,1),
(2,1,2),
(3,2,1),
(3,3,2),
(4,1,2),
(4,3,1);

/* Table Lieu */

INSERT INTO lieu VALUES (1,"Salle Polyvalente","rue Volney",53100,"MAYENNE"),
(2,"Théâtre municipal","Place Juhel",53100,"MAYENNE"),
(3,"Hall des expositions","Rue Volney",53100,"MAYENNE"),
(4,"Musée du Château de Mayenne","Place Juhel",53100,"MAYENNE"),
(5,"ARON - Salle des fêtes","Rue des loisirs",53440,"ARON"),
(6,"BELGEARD - Salle des fêtes","Rue du Muguet",53440,"BELGEARD");

/* Table Séance Pour Test */

INSERT INTO seance VALUES (1,1,"2015-11-26 10:00:00",1),
(2,5,"2016-05-17 10:00:00",1),
(3,5,"2016-05-17 14:00:00",1),
(4,5,"2016-05-18 10:00:00",1),
(5,5,"2016-05-18 14:00:00",1),
(6,5,"2016-05-19 10:00:00",1),
(7,5,"2016-05-19 14:00:00",1);

/* Table Planning */

/* INSERT INTO planning VALUES (5,5),
(6,5);

/* Table Saison */

INSERT INTO saison VALUES
(1,'2015/2016',1),
(2,'2016/2017',0),
(3,'2017/2018',0),
(4,'2018/2019',0),
(5,'2019/2020',0),
(6,'2020/2021',0),
(7,'2021/2022',0),
(8,'2022/2023',0),
(9,'2023/2024',0),
(10,'2024/2025',0),
(11,'2025/2026',0),
(12,'2026/2027',0),
(13,'2027/2028',0);

/* Table saison_spectacle */

INSERT INTO saison_spectacle VALUES
(1,1),
(1,2),
(1,3),
(1,4),
(1,5),
(1,6),
(1,7),
(1,8);

/* Table Admin */

INSERT INTO admin VALUES (1,"valerie","04fe694a19f79586abf93d86faee3146e841311a"), /* Mot de passe : 7placejuhel */
(2,"anne","04fe694a19f79586abf93d86faee3146e841311a"), /* Mot de passe : 7placejuhel */
(3,"jeunePublic","120525d1a28d39f78ef479b07011de199c5c2e92"); /* Mot de passe : kiosque */

/* Modifier les champs vides de la table Ecole */

UPDATE ecole SET idDirecteur = 1 WHERE idEcole = 1;
UPDATE ecole SET idDirecteur = 2 WHERE idEcole = 2;
UPDATE ecole SET idDirecteur = 3 WHERE idEcole = 3;
UPDATE ecole SET idDirecteur = 4 WHERE idEcole = 4;
UPDATE ecole SET idDirecteur = 5 WHERE idEcole = 5;
UPDATE ecole SET idDirecteur = 6 WHERE idEcole = 6;
UPDATE ecole SET idDirecteur = 7 WHERE idEcole = 7;
UPDATE ecole SET idDirecteur = 8 WHERE idEcole = 8;
UPDATE ecole SET idDirecteur = 9 WHERE idEcole = 9;
UPDATE ecole SET idDirecteur = 10 WHERE idEcole = 10;
UPDATE ecole SET idDirecteur = 11 WHERE idEcole = 11;
UPDATE ecole SET idDirecteur = 12 WHERE idEcole = 12;
UPDATE ecole SET idDirecteur = 13 WHERE idEcole = 13;
UPDATE ecole SET idDirecteur = 14 WHERE idEcole = 14;
UPDATE ecole SET idDirecteur = 15 WHERE idEcole = 15;
UPDATE ecole SET idDirecteur = 16 WHERE idEcole = 16;
UPDATE ecole SET idDirecteur = 17 WHERE idEcole = 17;
UPDATE ecole SET idDirecteur = 18 WHERE idEcole = 18;
UPDATE ecole SET idDirecteur = 19 WHERE idEcole = 19;
UPDATE ecole SET idDirecteur = 20 WHERE idEcole = 20;
UPDATE ecole SET idDirecteur = 21 WHERE idEcole = 21;
UPDATE ecole SET idDirecteur = 22 WHERE idEcole = 22;
UPDATE ecole SET idDirecteur = 23 WHERE idEcole = 23;
UPDATE ecole SET idDirecteur = 24 WHERE idEcole = 24;
UPDATE ecole SET idDirecteur = 25 WHERE idEcole = 25;
UPDATE ecole SET idDirecteur = 26 WHERE idEcole = 26;
UPDATE ecole SET idDirecteur = 27 WHERE idEcole = 27;
UPDATE ecole SET idDirecteur = 28 WHERE idEcole = 28;
UPDATE ecole SET idDirecteur = 29 WHERE idEcole = 29;
UPDATE ecole SET idDirecteur = 30 WHERE idEcole = 30;
UPDATE ecole SET idDirecteur = 31 WHERE idEcole = 31;
