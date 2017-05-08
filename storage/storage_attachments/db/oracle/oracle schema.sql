

CREATE TABLE "SELF_NATIONALITIES"
  (
    "ID"      NUMBER NOT NULL ENABLE,
    "EN_NAME" VARCHAR2(45 BYTE),
    "AR_NAME" VARCHAR2(45 BYTE),
    "CREATED" DATE,
    "MODIFIED" DATE,
    CONSTRAINT "NATIONALITIES_PK" PRIMARY KEY ("ID") ENABLE
  );
  
/*------------------------------------------*/

CREATE TABLE "SELF_CUSTOMERS"
  (
    "ID"             NUMBER NOT NULL ENABLE,
    "CUSTOMER_NO"    NUMBER,
    "EN_NAME"        VARCHAR2(150 BYTE),
    "AR_NAME"        VARCHAR2(150 BYTE),
    "CIVIL_ID"       VARCHAR2(45 BYTE),
    "MOBILE"         VARCHAR2(45 BYTE),
    "PHONE"          VARCHAR2(45 BYTE),
    "FAX"            VARCHAR2(45 BYTE),
    "EMAIL"          VARCHAR2(45 BYTE),
    "NATIONALITY_ID" NUMBER,
    "GENDER"         VARCHAR2(45 BYTE),
    "CONTACT_PERSON" VARCHAR2(45 BYTE),
    "CONTACT_MOBILE" VARCHAR2(45 BYTE),
    "CONTACT_PHONE"  VARCHAR2(45 BYTE),
    "ADDRESS"        VARCHAR2(45 BYTE),
    "REGION"         VARCHAR2(45 BYTE),
    "PART"           VARCHAR2(45 BYTE),
    "GADA"           VARCHAR2(45 BYTE),
    "STREET"         VARCHAR2(45 BYTE),
    "HOUSE"          VARCHAR2(45 BYTE),
    "FLOOR"          VARCHAR2(45 BYTE),
    "FLAT"           VARCHAR2(45 BYTE),
    "NOTES"          VARCHAR2(45 BYTE),
    "CREATED" DATE,
    "MODIFIED" DATE,
    CONSTRAINT "SELF_CUSTOMERS_PK" PRIMARY KEY ("ID") ENABLE,
    CONSTRAINT "SELF_NATIONALITY_FK" FOREIGN KEY ("NATIONALITY_ID") REFERENCES "SELF_NATIONALITIES" ("ID") ENABLE
  );

/*------------------------------------------*/

CREATE TABLE "SELF_SERVICES"
  (
    "ID"      NUMBER NOT NULL ENABLE,
    "EN_NAME" VARCHAR2(45 BYTE),
    "AR_NAME" VARCHAR2(45 BYTE),
    "CREATED" DATE,
    "MODIFIED" DATE,
    CONSTRAINT "SERVICES_PK" PRIMARY KEY ("ID") ENABLE
  );

/*------------------------------------------*/

CREATE TABLE "SELFCUSTOMERS_SELFSERVICES"
  (
    "ID"               NUMBER NOT NULL ENABLE,
    "SELFSERVICES_ID"  NUMBER,
    "SELFCUSTOMERS_ID" NUMBER,
    "MODIFIED" DATE,
    "CREATED" DATE,
    CONSTRAINT "CUSTOMERS_SERVICES_PK" PRIMARY KEY ("ID") ENABLE,
    CONSTRAINT "FK_SERVICE" FOREIGN KEY ("SELFSERVICES_ID") REFERENCES "SELF_SERVICES" ("ID") ENABLE,
    CONSTRAINT "FK_CUSTOMER" FOREIGN KEY ("SELFCUSTOMERS_ID") REFERENCES "SELF_CUSTOMERS" ("ID") ENABLE
  );

/*------------------------------------------*/

CREATE TABLE "SELF_RENTAL_PERIODS"
  (
    "ID"              NUMBER(*,0),
    "EN_NAME"         VARCHAR2(255 BYTE),
    "AR_NAME"         VARCHAR2(255 BYTE),
    "UNIT"            VARCHAR2(20 BYTE),
    "NUMBER_OF_UNITS" NUMBER(*,0),
    "CREATED" DATE,
    "MODIFIED" DATE,
    CONSTRAINT "RENTAL_PERIODS_PK" PRIMARY KEY ("ID") ENABLE
  );

/*------------------------------------------*/

CREATE TABLE "SELF_STORES"
  (
    "ID"        NUMBER NOT NULL ENABLE,
    "NAME"      VARCHAR2(45 BYTE),
    "HIEGHT"    VARCHAR2(45 BYTE),
    "WIDTH"     VARCHAR2(45 BYTE),
    "LENGTH"    VARCHAR2(45 BYTE),
    "ROOM_SIZE" VARCHAR2(45 BYTE),
    "STATUS"    VARCHAR2(45 BYTE),
    "CREATED" DATE,
    "MODIFIED" DATE,
    CONSTRAINT "STORES_PK" PRIMARY KEY ("ID") ENABLE
  );

/*------------------------------------------*/

CREATE TABLE "SELF_STORES_RENTALPERIODS"
  (
    "ID"               NUMBER NOT NULL ENABLE,
    "STORES_ID"        NUMBER,
    "RENTALPERIODS_ID" NUMBER,
    "PRICE" FLOAT(126),
    CONSTRAINT "STORES_RENTALPERIODS_PK" PRIMARY KEY ("ID") ENABLE,
    CONSTRAINT "FK_STORES" FOREIGN KEY ("STORES_ID") REFERENCES "SELF_STORES" ("ID") ENABLE,
    CONSTRAINT "FK_RENTAL" FOREIGN KEY ("RENTALPERIODS_ID") REFERENCES "SELF_RENTAL_PERIODS" ("ID") ON DELETE CASCADE ENABLE
  );

/*------------------------------------------*/
/*------------------------------------------*/

CREATE SEQUENCE "SELFCUSTOMERS_ID_SEQ" 
INCREMENT BY 1 
START WITH 1 
NOCACHE
NOCYCLE ;

/*------------------------------------------*/

CREATE SEQUENCE "SELFCUSTOMERS_SERVICES_ID_SEQ" 
INCREMENT BY 1 
START WITH 1 
NOCACHE
NOCYCLE ;

/*------------------------------------------*/

CREATE SEQUENCE "SELFCUSTS_SERVICES_ID_SEQ" 
INCREMENT BY 1 
START WITH 1 
NOCACHE
NOCYCLE ;

/*------------------------------------------*/

CREATE SEQUENCE "SELFNATIONALITIES_ID_SEQ" 
INCREMENT BY 1 
START WITH 1 
NOCACHE
NOCYCLE ;

/*------------------------------------------*/

CREATE SEQUENCE "SELFRENTAL_PERIODS_ID_SEQ" 
INCREMENT BY 1 
START WITH 1 
NOCACHE
NOCYCLE ;

/*------------------------------------------*/

CREATE SEQUENCE "SELFSERVICES_ID_SEQ" 
INCREMENT BY 1 
START WITH 1 
NOCACHE
NOCYCLE ;

/*------------------------------------------*/

CREATE SEQUENCE "SELFSTORES_ID_SEQ" 
INCREMENT BY 1 
START WITH 1 
NOCACHE
NOCYCLE ;

/*------------------------------------------*/

CREATE SEQUENCE "SELFSTORES_RENTAL_ID_SEQ" 
INCREMENT BY 1 
START WITH 1 
NOCACHE
NOCYCLE ;

/*------------------------------------------*/