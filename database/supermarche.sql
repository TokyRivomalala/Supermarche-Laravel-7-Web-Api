DROP VIEW ARTICLECOMPLET;
DROP VIEW REMISECOMPLET;
DROP VIEW REMISEGRATUIT;
DROP VIEW REMISEPOURCENTAGE;
DROP VIEW ARTICLEETSTOCK;

DROP SEQUENCE admin_seq;
DROP SEQUENCE article_seq;
DROP SEQUENCE stockarticle_seq;
DROP SEQUENCE pourcentage_seq;
DROP SEQUENCE gratuit_seq;
DROP SEQUENCE gratuitpourcentage_seq;
DROP SEQUENCE remise_seq;
DROP SEQUENCE achat_seq;
DROP SEQUENCE ticket_seq;

CREATE SEQUENCE admin_seq;
CREATE SEQUENCE utilisateur_seq;
CREATE SEQUENCE article_seq;
CREATE SEQUENCE stockarticle_seq;
CREATE SEQUENCE pourcentage_seq;
CREATE SEQUENCE gratuit_seq;
CREATE SEQUENCE gratuitpourcentage_seq;
CREATE SEQUENCE remise_seq;
CREATE SEQUENCE achat_seq;
CREATE SEQUENCE ticket_seq;



/*==============================================================*/
/* Vue : ARTICLEETSTOCK                                         */
/*==============================================================*/
create or replace view ARTICLEETSTOCK as
select
Articles.idArticle,
Articles.designation,
Articles.code,
StockArticles.quantiteStock,
StockArticles.prixUnitaire
FROM StockArticles JOIN Articles ON Articles.idArticle = StockArticles.idArticle;

/*==============================================================*/
/* Vue : REMISEPOURCENTAGE                                      */
/*==============================================================*/
create or replace view REMISEPOURCENTAGE as
select
Pourcentages.idPourcentage,
Pourcentages.pourcentage,
Remises.idArticle,
Remises.idGratuit,
Remises.IDGRATUITPOURCENTAGE
FROM Pourcentages JOIN Remises ON Pourcentages.idPourcentage = Remises.idPourcentage;

/*==============================================================*/
/* Vue : REMISEGRATUIT                                         */
/*==============================================================*/
create or replace view REMISEGRATUIT as
select
RemisePourcentage.idPourcentage,
RemisePourcentage.pourcentage,
RemisePourcentage.idArticle,
RemisePourcentage.idGratuit,
RemisePourcentage.IDGRATUITPOURCENTAGE,
Gratuits.nbMin,
Gratuits.nbGratuit
FROM Gratuits JOIN RemisePourcentage ON Gratuits.idGratuit = RemisePourcentage.idGratuit;


/*==============================================================*/
/* Vue : REMISECOMPLET                                          */
/*==============================================================*/
create or replace view REMISECOMPLET as
select
REMISEGRATUIT.idPourcentage,
REMISEGRATUIT.pourcentage,
REMISEGRATUIT.idArticle,
REMISEGRATUIT.idGratuit,
REMISEGRATUIT.nbMin,
REMISEGRATUIT.nbGratuit,
REMISEGRATUIT.IDGRATUITPOURCENTAGE,
GRATUITPOURCENTAGES.NBMINPRC,
GRATUITPOURCENTAGES.prc
FROM GRATUITPOURCENTAGES JOIN REMISEGRATUIT ON GRATUITPOURCENTAGES.IDGRATUITPOURCENTAGE = REMISEGRATUIT.IDGRATUITPOURCENTAGE;

/*==============================================================*/
/* Vue : ARTICLECOMPLET                                         */
/*==============================================================*/
create or replace view ARTICLECOMPLET as
select
RemiseComplet.idPourcentage,
RemiseComplet.pourcentage,
RemiseComplet.idArticle,
RemiseComplet.idGratuit,
RemiseComplet.nbMin,
RemiseComplet.nbGratuit,
RemiseComplet.IDGRATUITPOURCENTAGE,
RemiseComplet.NBMINPRC,
RemiseComplet.prc,
ArticleEtStock.designation,
ArticleEtStock.code,
ArticleEtStock.quantiteStock,
ArticleEtStock.prixUnitaire
FROM RemiseComplet JOIN ArticleEtStock ON RemiseComplet.idArticle = ArticleEtStock.idArticle;


INSERT INTO admins (idadmin,email,mdp) VALUES (CONCAT('AD',lpad(nextval('admin_seq')::text,2,'0')),'toky@gmail.com','toky');

INSERT INTO pourcentages (idpourcentage,pourcentage) VALUES (CONCAT('PRC',lpad(nextval('pourcentage_seq')::text,2,'0')),0);
INSERT INTO gratuits (idgratuit,nbmin,nbgratuit) VALUES (CONCAT('GRT',lpad(nextval('gratuit_seq')::text,2,'0')),1,0);
INSERT INTO gratuitpourcentages (idgratuitpourcentage,nbminprc,prc) VALUES (CONCAT('GRP',lpad(nextval('gratuitpourcentage_seq')::text,2,'0')),1,0);

INSERT INTO articles (idarticle,designation,code) VALUES (CONCAT('ART',lpad(nextval('article_seq')::text,2,'0')),'Petit Sablé Citron Gouty','PSG');
INSERT INTO articles (idarticle,designation,code) VALUES (CONCAT('ART',lpad(nextval('article_seq')::text,2,'0')),'Biscuit Gouty Beurre','BGB');
INSERT INTO articles (idarticle,designation,code) VALUES (CONCAT('ART',lpad(nextval('article_seq')::text,2,'0')),'Biscuit Tuc','TUC');
INSERT INTO articles (idarticle,designation,code) VALUES (CONCAT('ART',lpad(nextval('article_seq')::text,2,'0')),'Croquette poulet KIPKOP','CPK');
INSERT INTO articles (idarticle,designation,code) VALUES (CONCAT('ART',lpad(nextval('article_seq')::text,2,'0')),'Mini madeleine au Beurre Gouty','MMG');
INSERT INTO articles (idarticle,designation,code) VALUES (CONCAT('ART',lpad(nextval('article_seq')::text,2,'0')),'Bolo Duo Choco','BDC');
INSERT INTO articles (idarticle,designation,code) VALUES (CONCAT('ART',lpad(nextval('article_seq')::text,2,'0')),'Bolo Duo Vanille','BDV');


INSERT INTO STOCKARTICLES (IDARTICLE,QUANTITESTOCK,PRIXUNITAIRE) VALUES ('ART01',200,1100);
INSERT INTO STOCKARTICLES (IDARTICLE,QUANTITESTOCK,PRIXUNITAIRE) VALUES ('ART02',108,1000);
INSERT INTO STOCKARTICLES (IDARTICLE,QUANTITESTOCK,PRIXUNITAIRE) VALUES ('ART03',124,2300);
INSERT INTO STOCKARTICLES (IDARTICLE,QUANTITESTOCK,PRIXUNITAIRE) VALUES ('ART04',232,600);
INSERT INTO STOCKARTICLES (IDARTICLE,QUANTITESTOCK,PRIXUNITAIRE) VALUES ('ART05',275,1600);
INSERT INTO STOCKARTICLES (IDARTICLE,QUANTITESTOCK,PRIXUNITAIRE) VALUES ('ART06',103,300);
INSERT INTO STOCKARTICLES (IDARTICLE,QUANTITESTOCK,PRIXUNITAIRE) VALUES ('ART07',111,300);

INSERT INTO POURCENTAGES (IDPOURCENTAGE,POURCENTAGE) VALUES (CONCAT('PRC',lpad(nextval('pourcentage_seq')::text,2,'0')),21.27);
INSERT INTO POURCENTAGES (IDPOURCENTAGE,POURCENTAGE) VALUES (CONCAT('PRC',lpad(nextval('pourcentage_seq')::text,2,'0')),15);
INSERT INTO POURCENTAGES (IDPOURCENTAGE,POURCENTAGE) VALUES (CONCAT('PRC',lpad(nextval('pourcentage_seq')::text,2,'0')),0.02);

INSERT INTO GRATUITS (IDGRATUIT,NBMIN,NBGRATUIT) VALUES (CONCAT('GRT',lpad(nextval('gratuit_seq')::text,2,'0')),3,1);
INSERT INTO GRATUITS (IDGRATUIT,NBMIN,NBGRATUIT) VALUES (CONCAT('GRT',lpad(nextval('gratuit_seq')::text,2,'0')),2,4);
INSERT INTO GRATUITS (IDGRATUIT,NBMIN,NBGRATUIT) VALUES (CONCAT('GRT',lpad(nextval('gratuit_seq')::text,2,'0')),2,2);

INSERT INTO GRATUITPOURCENTAGES (IDGRATUITPOURCENTAGE,NBMINPRC,prc) VALUES (CONCAT('GRP',lpad(nextval('gratuitpourcentage_seq')::text,2,'0')),2,50);


INSERT INTO REMISES (IDARTICLE,IDGRATUIT,IDPOURCENTAGE,IDGRATUITPOURCENTAGE) VALUES ('ART01','GRT01','PRC01','GRP02');
INSERT INTO REMISES (IDARTICLE,IDGRATUIT,IDPOURCENTAGE,IDGRATUITPOURCENTAGE) VALUES ('ART02','GRT02','PRC04','GRP01');
INSERT INTO REMISES (IDARTICLE,IDGRATUIT,IDPOURCENTAGE,IDGRATUITPOURCENTAGE) VALUES ('ART03','GRT03','PRC02','GRP01');
INSERT INTO REMISES (IDARTICLE,IDGRATUIT,IDPOURCENTAGE,IDGRATUITPOURCENTAGE) VALUES ('ART04','GRT04','PRC03','GRP01');
INSERT INTO REMISES (IDARTICLE,IDGRATUIT,IDPOURCENTAGE,IDGRATUITPOURCENTAGE) VALUES ('ART05','GRT03','PRC03','GRP01');
INSERT INTO REMISES (IDARTICLE,IDGRATUIT,IDPOURCENTAGE,IDGRATUITPOURCENTAGE) VALUES ('ART06','GRT02','PRC02','GRP01');
INSERT INTO REMISES (IDARTICLE,IDGRATUIT,IDPOURCENTAGE,IDGRATUITPOURCENTAGE) VALUES ('ART07','GRT01','PRC01','GRP01');





