-- USE master;
GO

CREATE DATABASE Neuromodulation;
GO

USE Neuromodulation;
GO

-- Create Patients table
CREATE TABLE Patients (
    id INT PRIMARY KEY IDENTITY(1,1),
    first_name NVARCHAR(100),
    surname NVARCHAR(100),
    date_of_birth DATE,
    age AS DATEDIFF(YEAR, date_of_birth, GETDATE())
);
GO

-- Create PainInventory table
CREATE TABLE PainInventory (
    id INT PRIMARY KEY IDENTITY(1,1),
    patient_id INT FOREIGN KEY REFERENCES Patients(id),
    q1 INT,
    q2 INT,
    q3 INT,
    q4 INT,
    q5 INT,
    q6 INT,
    q7 INT,
    q8 INT,
    q9 INT,
    q10 INT,
    q11 INT,
    q12 INT,
    date_of_submission DATETIME DEFAULT GETDATE(),
    total_score INT
);
GO

-- Stored Procedure to Insert Patient
CREATE PROCEDURE InsertPatient
    @FirstName NVARCHAR(100),
    @Surname NVARCHAR(100),
    @DateOfBirth DATE,
    @PatientID INT OUTPUT
AS
BEGIN
    INSERT INTO Patients (first_name, surname, date_of_birth)
    VALUES (@FirstName, @Surname, @DateOfBirth);
    
    SET @PatientID = SCOPE_IDENTITY();
END;
GO

-- Stored Procedure to Insert Pain Inventory
CREATE PROCEDURE InsertPainInventory
    @PatientID INT,
    @Q1 INT,
    @Q2 INT,
    @Q3 INT,
    @Q4 INT,
    @Q5 INT,
    @Q6 INT,
    @Q7 INT,
    @Q8 INT,
    @Q9 INT,
    @Q10 INT,
    @Q11 INT,
    @Q12 INT,
    @TotalScore INT
AS
BEGIN
    INSERT INTO PainInventory (patient_id, q1, q2, q3, q4, q5, q6, q7, q8, q9, q10, q11, q12, total_score)
    VALUES (@PatientID, @Q1, @Q2, @Q3, @Q4, @Q5, @Q6, @Q7, @Q8, @Q9, @Q10, @Q11, @Q12, @TotalScore);
END;
GO

-- Stored Procedure to Get All Data
CREATE PROCEDURE GetAllData
AS
BEGIN
    SELECT 
        p.first_name,
        p.surname,
        p.date_of_birth,
        p.age,
        pi.q1,
        pi.q2,
        pi.q3,
        pi.q4,
        pi.q5,
        pi.q6,
        pi.q7,
        pi.q8,
        pi.q9,
        pi.q10,
        pi.q11,
        pi.q12,
        pi.total_score
    FROM PainInventory pi
    INNER JOIN Patients p ON pi.patient_id = p.id;
END;
GO

-- Stored Procedure to Delete Record
CREATE PROCEDURE DeleteRecord
    @ID INT
AS
BEGIN
    DELETE FROM PainInventory WHERE id = @ID;
END;
GO
