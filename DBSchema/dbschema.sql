<?php
CREATE TABLE IF NOT EXISTS UserDetails
(
    Name VARCHAR (200) NOT NULL,
    EmailId VARCHAR (100) NOT NULL,
    Department VARCHAR (25) NOT NULL,
    Type VARCHAR(2) NOT NULL ,
    Password VARCHAR(200) NOT NULL,
    UserId INT AUTO_INCREMENT,
    ContactNumber VARCHAR(20) NOT NULL,
    PRIMARY KEY(UserId),
    UNIQUE (EmailId)

);

CREATE TABLE IF NOT EXISTS PracticeQuestions
 (

    questionId INT AUTO_INCREMENT,
    questionName TEXT NOT NULL,
    questionStatement LONGTEXT NOT NULL,
    difficulty INT NOT NULL,
    UserId INT NOT NULL,
    PRIMARY KEY (questionId),
    FOREIGN KEY (UserId) REFERENCES UserDetails(UserId)

 );

CREATE TABLE IF NOT EXISTS Scoreboard
 (
    submissionId INT NOT NULL,
    questionId INT NOT NULL ,
    Status VARCHAR(200) NOT NULL,
    SourceCode LONGTEXT NOT NULL,
    Time VARCHAR(200) NOT NULL,
    Memory VARCHAR(200) NOT NULL,
    UserId INT NOT NULL,
    startTime DATETIME NOT NULL,
    endTime DATETIME NOT NULL,
    PRIMARY KEY(submissionId),
    FOREIGN KEY (questionId) REFERENCES PracticeQuestions(questionId),
    FOREIGN KEY (UserId) REFERENCES UserDetails(UserId)
 );


 CREATE TABLE IF NOT EXISTS TestCases
 (
    questionId INT NOT NULL,
    tid INT NOT NULL AUTO_INCREMENT,
    inputCase LONGTEXT NOT NULL,
    outputCase LONGTEXT NOT NULL,
    isSample VARCHAR(1) NOT NULL,
    PRIMARY KEY (tid),
    FOREIGN KEY(questionId) REFERENCES PracticeQuestions(questionId)

 );

 CREATE TABLE IF NOT EXISTS Challenge
 (
    cId INT NOT NULL,
    cName INT NOT NULL,
    cStatement INT NOT NULL,
    startDate DATETIME NOT NULL,
    endDate DATETIME NOT NULL,
    cType VARCHAR(100) NOT NUll,
    PRIMARY KEY(cId)


 );

CREATE TABLE IF NOT EXISTS ChallengeQuestions
 (
        cId INT NOT NULL,
        questionId INT NOT NULL,
        FOREIGN KEY(cId) REFERENCES Challenge(cId),
        FOREIGN KEY(questionId) REFERENCES PracticeQuestions(questionId),
        PRIMARY KEY(questionId)
 );








?>