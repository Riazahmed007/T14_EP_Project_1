CREATE TABLE Users (
    UserID INT AUTO_INCREMENT PRIMARY KEY,
    Username VARCHAR(50) UNIQUE NOT NULL,
    Password VARCHAR(255) NOT NULL,
    UserType ENUM('admin', 'supervisor', 'staff') NOT NULL,
    StaffNumber INT, -- For supervisors and staff
    Email VARCHAR(100) UNIQUE -- For sending task assignment emails
);

CREATE TABLE Tasks (
    TaskID INT AUTO_INCREMENT PRIMARY KEY,
    Title VARCHAR(100) NOT NULL,
    Description TEXT,
    Status ENUM('Not Started', 'Working on', 'Done') NOT NULL,
    AssignedTo INT, -- UserID of staff member assigned to the task
    DueDate DATE,
    ReviewDate DATE,
    Log TEXT, -- Rolling log of progress updates
    SupervisorOnly BOOLEAN -- Whether task visible to all or only supervisor
);