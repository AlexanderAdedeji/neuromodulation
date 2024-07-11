-- Create Patients table
CREATE TABLE Patients (
    id INT PRIMARY KEY IDENTITY(1,1),
    first_name NVARCHAR(100) NOT NULL,
    surname NVARCHAR(100) NOT NULL,
    date_of_birth DATE NOT NULL,
    age INT NOT NULL
);

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
    total_score INT,
    submission_date DATETIME DEFAULT GETDATE()
);
