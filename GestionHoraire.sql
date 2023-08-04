CREATE DATABASE IF NOT EXISTS GESTIONHORAIRE;
USE GESTIONHORAIRE;
CREATE TABLE Enseignant(
    Matricule_Ens VARCHAR(10) PRIMARY KEY,
    Nom_Ens VARCHAR(20),
    PostNom_Ens VARCHAR(20),
    Prenom_Ens VARCHAR(20),
    Grade_Ens VARCHAR(20),
    Telephone_Ens VARCHAR(13)
);
CREATE TABLE DEPARTEMENT(
    Id_Depart INT(2) AUTO_INCREMENT PRIMARY KEY,
    Nom_Depart VARCHAR(30)
);
CREATE TABLE Promotion(
    Id_Promo VARCHAR(10) PRIMARY KEY,
    Nom_Promo VARCHAR(30),
    Id_Depart INT(2),

    CONSTRAINT fk0 FOREIGN KEY(Id_Depart) REFERENCES DEPARTEMENT(Id_Depart)
);
CREATE TABLE COURS(
    Id_Cours varchar(10) primary key,
    Nom_Cours varchar(30),
    Matricule_Ens varchar(10),
    Id_Promo varchar(10),
    Volume_Horaire VARCHAR(10),

    CONSTRAINT fk1 FOREIGN KEY(Matricule_Ens) REFERENCES Enseignant(Matricule_Ens),
    CONSTRAINT fk2 FOREIGN KEY(Id_Promo) REFERENCES Promotion(Id_Promo)
);
CREATE TABLE Jours(
    Jour VARCHAR(10) primary key
);
create table Heures(
    Heure varchar(15) primary key
);
create table AnneeAcad(
    AnneeA varchar(9) primary key
);
CREATE TABLE Salle(
    Id_Salle INT(3) AUTO_INCREMENT PRIMARY KEY,
    Numero_Salle INT(3)
);
CREATE TABLE Horaire(
    Id_Horaire INT(9) AUTO_INCREMENT PRIMARY KEY,
    Jour varchar(10),
    Heure varchar(15),
    Id_Cours varchar(10),
    AnneeA varchar(9),
    Id_Salle int(3),
    Date_Horaire DATETIME,

    CONSTRAINT fk3 FOREIGN KEY(Jour) REFERENCES Jours(Jour),
    CONSTRAINT fk4 FOREIGN KEY(Heure) REFERENCES Heures(Heure),
    CONSTRAINT fk5 FOREIGN KEY(Id_Cours) REFERENCES COURS(Id_Cours),
    CONSTRAINT fk6 FOREIGN KEY (AnneeA) REFERENCES AnneeAcad(AnneeA),
    CONSTRAINT fk7 FOREIGN KEY(Id_Salle) REFERENCES Salle(Id_Salle)
);
create table User(
    ID int(10) auto_increment Primary key,
    LoginUser Varchar(30),
    MdP varchar(255),
    Etat int(1),
    email Varchar(50)
);
-- Pour le rapport de Apparitorat
CREATE TABLE Horaire1(
    Id_Horaire INT(9) AUTO_INCREMENT PRIMARY KEY,
    Jour varchar(10),
    Heure varchar(15),
    Id_Cours varchar(10),
    AnneeA varchar(9),
    Id_Salle int(3),
    Date_Horaire DATETIME,

    CONSTRAINT fk8 FOREIGN KEY(Jour) REFERENCES Jours(Jour),
    CONSTRAINT fk9 FOREIGN KEY(Heure) REFERENCES Heures(Heure),
    CONSTRAINT fk10 FOREIGN KEY(Id_Cours) REFERENCES COURS(Id_Cours),
    CONSTRAINT fk11 FOREIGN KEY (AnneeA) REFERENCES AnneeAcad(AnneeA),
    CONSTRAINT fk12 FOREIGN KEY(Id_Salle) REFERENCES Salle(Id_Salle)
);