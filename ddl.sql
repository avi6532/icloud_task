
-- CREATE THE TABLE IN SQL
create table exams(id int primary key auto_increment,course_id varchar(20) unique not null,branch_id varchar(20) not null
,branch_name varchar(20) not null,faculty_name varchar(30) not null,exam_date Date not null,start_time time not null , end_time time not null,
q1 varchar(100) not null,q2 varchar(100) not null,q3 varchar(100) not null,q4 varchar(100) not null,
q5 varchar(100) not null,q6 varchar(100) not null,q7 varchar(100) not null,q8 varchar(100) not null,
q9 varchar(100) not null,q10 varchar(100) not null,
q11 varchar(100) not null,q12 varchar(100) not null,q13 varchar(100) not null,q14 varchar(100) not null,
q15 varchar(100) not null,q16 varchar(100) not null,q17 varchar(100) not null,q18 varchar(100) not null,
q19 varchar(100) not null,q20 varchar(100) not null,
q21 varchar(100) not null,q22 varchar(100) not null,q23 varchar(100) not null,q24 varchar(100) not null,
q25 varchar(100) not null,q26 varchar(100) not null,q27 varchar(100) not null,q28 varchar(100) not null,
q29 varchar(100) not null,q30 varchar(100) not null,
q31 varchar(100) not null,q32 varchar(100) not null,q33 varchar(100) not null,q34 varchar(100) not null,
q35 varchar(100) not null,q36 varchar(100) not null,q37 varchar(100) not null,q38 varchar(100) not null,
q39 varchar(100) not null,q40 varchar(100) not null,
q41 varchar(100) not null,q42 varchar(100) not null,q43 varchar(100) not null,q44 varchar(100) not null,
q45 varchar(100) not null,q46 varchar(100) not null,q47 varchar(100) not null,q48 varchar(100) not null,
q49 varchar(100) not null,q50 varchar(100) not null,
m1 int not null,m2 int not null,m3 int not null,m4 int not null,
m5 int not null,m6 int not null,m7 int not null,m8 int not null,
m9 int not null,m10 int not null,
m11 int not null,m12 int not null,m13 int not null,m14 int not null,
m15 int not null,m16 int not null,m17 int not null,m18 int not null,
m19 int not null,m20 int not null,
m21 int not null,m22 int not null,m23 int not null,m24 int not null,
m25 int not null,m26 int not null,m27 int not null,m28 int not null,
m29 int not null,m30 int not null,
m31 int not null,m32 int not null,m33 int not null,m34 int not null,
m35 int not null,m36 int not null,m37 int not null,m38 int not null,
m39 int not null,m40 int not null,
m41 int not null,m42 int not null,m43 int not null,m44 int not null,
m45 int not null,m46 int not null,m47 int not null,m48 int not null,
m49 int not null,m50 int not null,noq int not null
);




create table student(id int primary key auto_increment,roll varchar(20) not null unique, name varchar(30) not null, branch_id varchar(30) not null);

insert into student(roll,name,branch_id)
values("C101","John","CSE"),("I101","Smith","IT"),("C102","Richard","CSE"),("C103","Dwayne","CSE");

create table marks(student_roll varchar(20) not null ,
student_name varchar(30), course_id varchar(20) not null,branch_id varchar(30) not null, 
m1 int not null,m2 int not null,m3 int not null,m4 int not null,
m5 int not null,m6 int not null,m7 int not null,m8 int not null,
m9 int not null,m10 int not null,
m11 int not null,m12 int not null,m13 int not null,m14 int not null,
m15 int not null,m16 int not null,m17 int not null,m18 int not null,
m19 int not null,m20 int not null,
m21 int not null,m22 int not null,m23 int not null,m24 int not null,
m25 int not null,m26 int not null,m27 int not null,m28 int not null,
m29 int not null,m30 int not null,
m31 int not null,m32 int not null,m33 int not null,m34 int not null,
m35 int not null,m36 int not null,m37 int not null,m38 int not null,
m39 int not null,m40 int not null,
m41 int not null,m42 int not null,m43 int not null,m44 int not null,
m45 int not null,m46 int not null,m47 int not null,m48 int not null,
m49 int not null,m50 int not null,

constraint pk_stuexam primary key (student_roll , course_id)

);



-- -- 
-- INSERT INTO customer_data (customer_id, customer_name, customer_place)
-- SELECT * FROM (SELECT 6, "Rasmus","TestPlace") AS tmp_name
-- WHERE NOT EXISTS (
--     SELECT customer_name FROM customer_data WHERE customer_name = "Rasmus"
-- ) LIMIT 1;