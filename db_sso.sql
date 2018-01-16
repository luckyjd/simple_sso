CREATE TABLE simple_sso_db.user (
   id int UNSIGNED AUTO_INCREMENT NOT NULL,
   username varchar(20)  NOT NULL,
   password varchar(50)  NOT NULL,
   created_date datetime  NOT NULL,
   token varchar(500)  NULL,
   expire_date time  NULL,
   CONSTRAINT user_pk PRIMARY KEY (id)
);