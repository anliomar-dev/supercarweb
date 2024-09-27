CREATE TABLE accueil(
   ID INT AUTO_INCREMENT,
   TitreVideo VARCHAR(50),
   Video VARCHAR(255),
   Lien VARCHAR(255),
   CadreModele VARCHAR(50),
   CadrePrix DECIMAL(15,2),
   CadreImg VARCHAR(255),
   CadrePollution VARCHAR(255),
   CadreLien VARCHAR(255),
   ActualiteImg VARCHAR(255),
   ActualiteDescription VARCHAR(255),
   ActualiteLink TEXT,
   PRIMARY KEY(ID)
);

CREATE TABLE admin(
   IdAdmin INT AUTO_INCREMENT,
   Nom VARCHAR(50) NOT NULL,
   Prenom VARCHAR(20) NOT NULL,
   email VARCHAR(100) NOT NULL,
   Telephone VARCHAR(15) NOT NULL,
   Identifiant VARCHAR(50) NOT NULL,
   MotDePasse VARCHAR(100) NOT NULL,
   PRIMARY KEY(IdAdmin)
);

CREATE TABLE contacts(
   IdContact INT AUTO_INCREMENT,
   Nom VARCHAR(50) NOT NULL,
   Prenom VARCHAR(20) NOT NULL,
   email VARCHAR(80) NOT NULL,
   NumTel VARCHAR(15) NOT NULL,
   PRIMARY KEY(IdContact)
);

CREATE TABLE evenement(
   IdEvenement INT AUTO_INCREMENT,
   théme VARCHAR(50) NOT NULL,
   DateDebut DATE NOT NULL,
   DateFin DATE NOT NULL,
   Description TEXT NOT NULL,
   image VARCHAR(255),
   Prix DECIMAL(10,2),
   location VARCHAR(50) NOT NULL,
   PRIMARY KEY(IdEvenement)
);

CREATE TABLE inscription(
   IdInscription INT AUTO_INCREMENT,
   Nom VARCHAR(50) NOT NULL,
   Prenom VARCHAR(20) NOT NULL,
   Adresse VARCHAR(150) NOT NULL,
   NumTel VARCHAR(15) NOT NULL,
   email VARCHAR(80) NOT NULL,
   Identifiant VARCHAR(50) NOT NULL,
   MotDePasse VARCHAR(100) NOT NULL,
   PRIMARY KEY(IdInscription)
);

CREATE TABLE marque(
   IdMarque INT AUTO_INCREMENT,
   NomMarque VARCHAR(50) NOT NULL,
   PRIMARY KEY(IdMarque)
);

CREATE TABLE voitures(
   IdVoiture INT AUTO_INCREMENT,
   Couleur VARCHAR(50) NOT NULL,
   TypeMoteur VARCHAR(50) NOT NULL,
   Km INT,
   Moteur VARCHAR(50) NOT NULL,
   Image VARCHAR(255) NOT NULL,
   BoiteVitesse VARCHAR(50) NOT NULL,
   Caburant VARCHAR(50),
   PRIMARY KEY(IdVoiture)
);

CREATE TABLE Connexion(
   IdConnexion INT,
   Identifiant VARCHAR(50),
   MotDePasse VARCHAR(50),
   IdInscription INT NOT NULL,
   PRIMARY KEY(IdConnexion),
   UNIQUE(IdInscription),
   FOREIGN KEY(IdInscription) REFERENCES inscription(IdInscription)
);

CREATE TABLE demandeessaie(
   Ref_Essaie INT AUTO_INCREMENT,
   DateEssaie DATE NOT NULL,
   HeureEssaie TIME NOT NULL,
   Marque VARCHAR(50) NOT NULL,
   Modele VARCHAR(50) NOT NULL,
   Moteur VARCHAR(50) NOT NULL,
   IdVoiture INT NOT NULL,
   IdInscription INT NOT NULL,
   PRIMARY KEY(Ref_Essaie),
   FOREIGN KEY(IdVoiture) REFERENCES voitures(IdVoiture),
   FOREIGN KEY(IdInscription) REFERENCES inscription(IdInscription)
);

CREATE TABLE modele(
   IdModele INT AUTO_INCREMENT,
   NomModele VARCHAR(50) NOT NULL,
   Prix DECIMAL(15,2) NOT NULL,
   Annee BYTE NOT NULL,
   IdVoiture INT NOT NULL,
   IdMarque INT NOT NULL,
   PRIMARY KEY(IdModele),
   FOREIGN KEY(IdVoiture) REFERENCES voitures(IdVoiture),
   FOREIGN KEY(IdMarque) REFERENCES marque(IdMarque)
);

CREATE TABLE Concerne(
   IdEvenement INT,
   IdVoiture INT,
   PRIMARY KEY(IdEvenement, IdVoiture),
   FOREIGN KEY(IdEvenement) REFERENCES evenement(IdEvenement),
   FOREIGN KEY(IdVoiture) REFERENCES voitures(IdVoiture)
);
