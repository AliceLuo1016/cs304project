drop database if exists zoo;
create database zoo;
use zoo;

drop table if exists Member;
CREATE TABLE Member(
	MemberID MEDIUMINT NOT NULL AUTO_INCREMENT,
	PhoneNo CHAR(10) NOT NULL,
	Address CHAR(50) NOT NULL, 
	Name CHAR(20) NOT NULL,
	PRIMARY KEY (MemberID),
	UNIQUE (Name, PhoneNo, Address)
);
INSERT INTO Member (PhoneNo, Address, Name) VALUES ('778888000','Las Vegas Blvd S Las Vegas NV','Emma Watson');
INSERT INTO Member (PhoneNo, Address, Name) VALUES ('778834092','2329 West Mall Vancouver BC','Harry Potter');
INSERT INTO Member (PhoneNo, Address, Name) VALUES ('778892934','163 Marsh Wall London England','Taylor Swift');
INSERT INTO Member (PhoneNo, Address, Name) VALUES ('839480234','Western Gateway Royal Victoria Dock London England','Jennifer Lawrence');
INSERT INTO Member (PhoneNo, Address, Name) VALUES ('768491283','4-18 Harrington Gardens London England','Johnny Depp');

drop table if exists TicketPurchase;
CREATE TABLE TicketPurchase(
	ReceiptID MEDIUMINT NOT NULL AUTO_INCREMENT,
	Quantity INT, 
	Price INT,
	PRIMARY KEY (ReceiptID)
);
INSERT INTO TicketPurchase (Quantity, Price) VALUES ('5','50');
INSERT INTO TicketPurchase (Quantity, Price) VALUES ('80','800');
INSERT INTO TicketPurchase (Quantity, Price) VALUES ('24','240');
INSERT INTO TicketPurchase (Quantity, Price) VALUES ('17','170');
INSERT INTO TicketPurchase (Quantity, Price) VALUES ('1','10');

drop table if exists Habitat;
CREATE TABLE Habitat(
	hName CHAR(20),
	Climate CHAR(10),
	Size INT, 
	Type CHAR(20),
	PRIMARY KEY (hName)
);
INSERT INTO Habitat(hName, Climate, Size, Type) VALUES ('Owl Heaven','Temperate','500','Sky');
INSERT INTO Habitat(hName, Climate, Size, Type) VALUES ('Under Water','Cold','600','Sea water');
INSERT INTO Habitat(hName, Climate, Size, Type) VALUES ('Panda Paradise','Temperate','782','Lawn');
INSERT INTO Habitat(hName, Climate, Size, Type) VALUES ('Jungle Adventure','Warm','897','Jungle');
INSERT INTO Habitat(hName, Climate, Size, Type) VALUES ('Dolphin Plaza','Cold','166','Pool');

drop table if exists Animal_Supplier;
CREATE TABLE Animal_Supplier(
	aSuppID	MEDIUMINT NOT NULL AUTO_INCREMENT, 
	Name CHAR(20), 
	PhoneNo CHAR(10),
	PRIMARY KEY (aSuppID)
);
INSERT INTO Animal_Supplier(Name, PhoneNo) VALUES ("Birdie", '2829670778');
INSERT INTO Animal_Supplier(Name, PhoneNo) VALUES ("Exotic Animals", '3378293719');
INSERT INTO Animal_Supplier(Name, PhoneNo) VALUES ("Mammal Home", '236217836');
INSERT INTO Animal_Supplier(Name, PhoneNo) VALUES ("Sea Animals", '283947364');
INSERT INTO Animal_Supplier(Name, PhoneNo) VALUES ("Dangerous Species", '2237189247');

drop table if exists Food_Stand;
CREATE TABLE Food_Stand(
	StandID	MEDIUMINT NOT NULL AUTO_INCREMENT, 
	Name CHAR(20), 
	PhoneNo CHAR(10), 
	Balance	CHAR(7), 
	Hotdog_Stock CHAR(4),
	PRIMARY KEY (StandID)
);
INSERT INTO Food_Stand(Name, PhoneNo, Balance, Hotdog_Stock) VALUES ('Hungry?','899579368','100','8');
INSERT INTO Food_Stand(Name, PhoneNo, Balance, Hotdog_Stock) VALUES ('Snow Cone','896926793','780','0');
INSERT INTO Food_Stand(Name, PhoneNo, Balance, Hotdog_Stock) VALUES ('Hot Dog','896368293','214','100');
INSERT INTO Food_Stand(Name, PhoneNo, Balance, Hotdog_Stock) VALUES ('Pizza','734028803','387','920');
INSERT INTO Food_Stand(Name, PhoneNo, Balance, Hotdog_Stock) VALUES ('Noodle Shop','892369096','234','0');

drop table if exists Food_Supplier;
CREATE TABLE Food_Supplier(
	fSuppID	MEDIUMINT NOT NULL AUTO_INCREMENT, 
	Name CHAR(20), 
	PhoneNo CHAR(10),
	PRIMARY KEY (fSuppID)
);
INSERT INTO Food_Supplier(Name, PhoneNo) VALUES ('Save on Foods','7847923482');
INSERT INTO Food_Supplier(Name, PhoneNo) VALUES ('Saveways','248927492');
INSERT INTO Food_Supplier(Name, PhoneNo) VALUES ('Best Food Ever','2389182434');
INSERT INTO Food_Supplier(Name, PhoneNo) VALUES ('Great Food','2371847934');
INSERT INTO Food_Supplier(Name, PhoneNo) VALUES ('Food Supplier','3128491284');

drop table if exists Trainer;
CREATE TABLE Trainer(
	Empl_ID MEDIUMINT NOT NULL AUTO_INCREMENT, 
	Name CHAR(20), 
	PhoneNo CHAR(10), 
	Salary CHAR(6),
	PRIMARY KEY (Empl_ID)
);
INSERT INTO Trainer(Name, PhoneNo, Salary) VALUES ('David Beckham','79348967','4000');
INSERT INTO Trainer(Name, PhoneNo, Salary) VALUES ('Angelina Jolie','789073582','5000');
INSERT INTO Trainer(Name, PhoneNo, Salary) VALUES ('Avril Lavigne','892792037','3000');
INSERT INTO Trainer(Name, PhoneNo, Salary) VALUES ('Lionel Messi','892367687','9000');
INSERT INTO Trainer(Name, PhoneNo, Salary) VALUES ('Michael Jordan','894672904','100000');

/* The table with the foreign keys */
drop table if exists Animal;
CREATE TABLE Animal(
	aName CHAR(10), 
	Species	CHAR(10), 
	Gender CHAR(1), 
	Weight INT, 
	Diet CHAR(20), 
	Birthday CHAR(20), 
	hName CHAR(20)  NOT NULL,
	aSuppID	MEDIUMINT NOT NULL,
	Cost INT,
	PRIMARY KEY (hName, Species, aName, aSuppID),
    UNIQUE KEY (aName, Species),
	FOREIGN KEY (hName) REFERENCES Habitat(hName),
	FOREIGN KEY (aSuppID) REFERENCES Animal_Supplier(aSuppID)
) ENGINE=InnoDB;
INSERT INTO Animal(aName, Species, Gender, Weight, Diet, Birthday, hName, aSuppID, Cost) 
	VALUES ('Emily','Panda','F','48','Bamboo','13/02/00','Panda Paradise','2','500');
INSERT INTO Animal(aName, Species, Gender, Weight, Diet, Birthday, hName, aSuppID, Cost) 
	VALUES ('Linda','Parrot','F','3','Pumpkin seeds','13/02/01','Owl Heaven','1','100');
INSERT INTO Animal(aName, Species, Gender, Weight, Diet, Birthday, hName, aSuppID, Cost) 
	VALUES ('Tommy','Lion','M','67','Meat','06/06/99','Jungle Adventure','3','1500');
INSERT INTO Animal(aName, Species, Gender, Weight, Diet, Birthday, hName, aSuppID, Cost) 
	VALUES ('Lucy','Dolphin','F','23','Fish','14/02/00','Dolphin Plaza','4','300');
INSERT INTO Animal(aName, Species, Gender, Weight, Diet, Birthday, hName, aSuppID, Cost) 
	VALUES ('Jack','Shark','M','40','Fish','15/08/00','Under Water','5','900');

drop table if exists Supplies_food;
CREATE TABLE Supplies_food(
	fSuppID MEDIUMINT, 
	StandID MEDIUMINT,
	PRIMARY KEY (fSuppID, StandID),
	FOREIGN KEY (fSuppID) REFERENCES Food_Supplier(fSuppID),
	FOREIGN KEY (StandID) REFERENCES Food_Stand(StandID)
);
INSERT INTO Supplies_food(fSuppID, StandID) VALUES ('1','5');
INSERT INTO Supplies_food(fSuppID, StandID) VALUES ('2','4');
INSERT INTO Supplies_food(fSuppID, StandID) VALUES ('3','3');
INSERT INTO Supplies_food(fSuppID, StandID) VALUES ('4','2');
INSERT INTO Supplies_food(fSuppID, StandID) VALUES ('5','1');

drop table if exists Required_for;
CREATE TABLE Required_for(
	ReceiptID MEDIUMINT, 
	hName CHAR(20),
	PRIMARY KEY (ReceiptID, hName),
	FOREIGN KEY (ReceiptID) REFERENCES TicketPurchase(ReceiptID),
	FOREIGN KEY (hName) REFERENCES Habitat(hName)
);
INSERT INTO Required_for(ReceiptID, hName) VALUES ('1','Owl Heaven');
INSERT INTO Required_for(ReceiptID, hName) VALUES ('2','Panda Paradise');
INSERT INTO Required_for(ReceiptID, hName) VALUES ('3','Jungle Adventure');
INSERT INTO Required_for(ReceiptID, hName) VALUES ('4','Dolphin Plaza');
INSERT INTO Required_for(ReceiptID, hName) VALUES ('5','Under Water');

drop table if exists Purchase_with_Discount;
CREATE TABLE Purchase_with_Discount(
	MemberID MEDIUMINT, 
	ReceiptID MEDIUMINT,
	PRIMARY KEY (MemberID, ReceiptID),
	FOREIGN KEY (MemberID) REFERENCES Member(MemberID),
	FOREIGN KEY (ReceiptID) REFERENCES TicketPurchase(ReceiptID)
);
INSERT INTO Purchase_with_Discount(MemberID, ReceiptID) VALUES ('3','5');
INSERT INTO Purchase_with_Discount(MemberID, ReceiptID) VALUES ('2','4');
INSERT INTO Purchase_with_Discount(MemberID, ReceiptID) VALUES ('4','3');
INSERT INTO Purchase_with_Discount(MemberID, ReceiptID) VALUES ('1','2');
INSERT INTO Purchase_with_Discount(MemberID, ReceiptID) VALUES ('5','1');

/* some how the table with foreign keys alredy cannot be referenced back, 
need time to fix that */
drop table if exists Direct_Performance;
CREATE TABLE Direct_Performance(
	EmpID MEDIUMINT,
	Start_Time CHAR(6),
	End_Time CHAR(6), 
	Date CHAR(10), 
	pName CHAR(20), 
	hName CHAR(20), 
	aName CHAR(10), 
	Species	CHAR(10), 
	PRIMARY KEY (EmpID, Start_Time, End_Time, pName, aName, Species),
	FOREIGN KEY (EmpID) REFERENCES Trainer(Empl_ID),
	FOREIGN KEY (hName) REFERENCES Habitat(hName),
	FOREIGN KEY (aName, Species) REFERENCES Animal(aName, Species)
)ENGINE = InnoDB;
INSERT INTO Direct_Performance(EmpID, Start_Time, End_Time, Date, pName, hName, aName, Species) VALUES ('1', '11:00','12:00','13/02/15','Flying Lesson','Owl Heaven','Linda','Parrot');
INSERT INTO Direct_Performance(EmpID, Start_Time, End_Time, Date, pName, hName, aName, Species) VALUES ('3','13:00','14:00','13/02/15','Meal Time','Panda Paradise','Emily','Panda');
INSERT INTO Direct_Performance(EmpID, Start_Time, End_Time, Date, pName, hName, aName, Species) VALUES ('5','9:00','10:30','13/02/15','Under Sea','Under Water','Jack','Shark');
INSERT INTO Direct_Performance(EmpID, Start_Time, End_Time, Date, pName, hName, aName, Species) VALUES ('4','14:30','15:00','13/02/15','Jungle Rules','Jungle Adventure','Tommy','Lion');
INSERT INTO Direct_Performance(EmpID, Start_Time, End_Time, Date, pName, hName, aName, Species) VALUES ('2','15:00','16:30','13/02/15','Water Dancing','Dolphin Plaza','Lucy','Dolphin');

CREATE TABLE Supplies_Animal(
	aSuppID MEDIUMINT, 
	aName CHAR(10), 
	Species CHAR(10),
	PRIMARY KEY (aSuppID, aName, Species),
	FOREIGN KEY (aSuppID) REFERENCES Animal_Supplier(aSuppID),
	FOREIGN KEY (aName, Species) REFERENCES Animal(aName,Species)
);
INSERT INTO Supplies_Animal(aSuppID, aName, Species) VALUES ('1','Linda','Parrot');
INSERT INTO Supplies_Animal(aSuppID, aName, Species) VALUES ('2','Emily','Panda');
INSERT INTO Supplies_Animal(aSuppID, aName, Species) VALUES ('3','Lucy','Dolphin');
INSERT INTO Supplies_Animal(aSuppID, aName, Species) VALUES ('4','Jack','Shark');
INSERT INTO Supplies_Animal(aSuppID, aName, Species) VALUES ('5','Tommy','Lion');

drop table if exists Care_for;
CREATE TABLE Care_for(
	EmpID MEDIUMINT, 
	aName CHAR(10), 
	Species CHAR(10),
	PRIMARY KEY (EmpID, aName, Species),
	FOREIGN KEY (EmpID) REFERENCES Trainer(Empl_ID),
    FOREIGN KEY (aName, Species) REFERENCES Animal(aName, Species)
);
INSERT INTO Care_for(EmpID, aName, Species) VALUES ('1','Linda','Parrot');
INSERT INTO Care_for(EmpID, aName, Species) VALUES ('2','Lucy','Dolphin');
INSERT INTO Care_for(EmpID, aName, Species) VALUES ('3','Emily','Panda');
INSERT INTO Care_for(EmpID, aName, Species) VALUES ('4','Tommy','Lion');
INSERT INTO Care_for(EmpID, aName, Species) VALUES ('5','Jack','Shark');


