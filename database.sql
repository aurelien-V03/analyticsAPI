-- Script de creation de la base de donnee pour stocker les 
-- donnees relatives aux API

CREATE DATABASE IF NOT EXISTS analytics_api;
USE analytics_api;

DROP TABLE IF EXISTS pageana;
DROP TABLE IF EXISTS code_ecran;
DROP TABLE IF EXISTS code_action;


-- Table code_ecran 
CREATE TABLE code_ecran(
    id_code_ecran INT PRIMARY KEY AUTO_INCREMENT,
    libelle VARCHAR(30)
);

INSERT INTO code_ecran VALUES(1,"Accueil");
INSERT INTO code_ecran VALUES(2,"About");
INSERT INTO code_ecran VALUES(3,"Memo");
INSERT INTO code_ecran VALUES(4,"Categorie");
INSERT INTO code_ecran VALUES(5,"Contact");
INSERT INTO code_ecran VALUES(6,"Formules");
INSERT INTO code_ecran VALUES(7,"Landing");
INSERT INTO code_ecran VALUES(8,"Login");
INSERT INTO code_ecran VALUES(9,"Paiement");
INSERT INTO code_ecran VALUES(10,"Presentation");
INSERT INTO code_ecran VALUES(11,"Profile");
INSERT INTO code_ecran VALUES(12,"QCM");
INSERT INTO code_ecran VALUES(13,"Anxiete");
INSERT INTO code_ecran VALUES(14,"Dependance");
INSERT INTO code_ecran VALUES(15,"Sommeil");
INSERT INTO code_ecran VALUES(16,"Stress");
INSERT INTO code_ecran VALUES(17,"Questionnaire");
INSERT INTO code_ecran VALUES(18,"Seance");
INSERT INTO code_ecran VALUES(19,"Seances");
INSERT INTO code_ecran VALUES(20,"Posture");
INSERT INTO code_ecran VALUES(21,"Signup");
INSERT INTO code_ecran VALUES(22,"Sophrologue");
INSERT INTO code_ecran VALUES(23,"Stat");
INSERT INTO code_ecran VALUES(24,"AgendaSeance");

-- table code_action
CREATE TABLE code_action(
    id_code_action INT PRIMARY KEY AUTO_INCREMENT,
    libelle VARCHAR(30)
);

INSERT INTO code_action VALUES(1,"Affiche");
INSERT INTO code_action VALUES(2,"Ajout");
INSERT INTO code_action VALUES(3,"Suppression");
INSERT INTO code_action VALUES(4,"Modification");
INSERT INTO code_action VALUES(5,"click");
INSERT INTO code_action VALUES(6,"Consultation");
INSERT INTO code_action VALUES(7,"QuitterEcran");
INSERT INTO code_action VALUES(8,"QuitterSeance");
INSERT INTO code_action VALUES(9,"ArretSeance");
INSERT INTO code_action VALUES(10,"RetourEcran");
INSERT INTO code_action VALUES(11,"QuitterAppli");
INSERT INTO code_action VALUES(12,"MenuOuvre");
INSERT INTO code_action VALUES(13,"MenuFerme");
INSERT INTO code_action VALUES(14,"DemandeInfo");

-- Table pageana 
CREATE TABLE pageana(
    id_pageana INT PRIMARY KEY AUTO_INCREMENT,
    ip VARCHAR(55) NOT NULL,
    id_utilisateur INT NOT NULL,
    url VARCHAR(255) NOT NULL,
    code_ecran INT NOT NULL,
    code_action INT NOT NULL,
    libelle_action VARCHAR(255),
    date_enreg TIMESTAMP NOT NULL           -- Attention, timestamp ou datetime ?
);

ALTER TABLE pageana ADD FOREIGN KEY (code_ecran) REFERENCES code_ecran(id_code_ecran);
ALTER TABLE pageana ADD FOREIGN KEY (code_action) REFERENCES code_action(id_code_action);


