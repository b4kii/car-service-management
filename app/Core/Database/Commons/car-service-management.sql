USE `car_service_management`;

CREATE TABLE `Service`(
    `Id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `CarId` BIGINT UNSIGNED NOT NULL,
    `Name` VARCHAR(255) NOT NULL,
    `Cost` DECIMAL(8, 2) NOT NULL,
    `Comment` VARCHAR(255) NULL
);
CREATE TABLE `Address`(
    `Id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `City` VARCHAR(20) NOT NULL,
    `Street` VARCHAR(20) NOT NULL,
    `PostCode` VARCHAR(10) NOT NULL,
    `HouseNumber` VARCHAR(10) NOT NULL,
    `Phone` VARCHAR(15) NOT NULL,
    `Email` VARCHAR(15) NOT NULL
);
-- TODO: add first name, last name
CREATE TABLE `User`(
    `Id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `Login` VARCHAR(50) NOT NULL,
    `Password` VARCHAR(100) NOT NULL,
    `Email` VARCHAR(50) NOT NULL,
    `Phone` VARCHAR(15) NOT NULL,
    `Role` ENUM('Admin', 'Manager', 'Worker') NOT NULL
);
CREATE TABLE `Client`(
    `Id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `AddressId` BIGINT UNSIGNED NOT NULL,
    `Firstname` VARCHAR(50) NOT NULL,
    `Lastname` VARCHAR(50) NOT NULL,
    `NIP` VARCHAR(15) NULL,
    `Code` VARCHAR(50) NOT NULL,
    `Type` ENUM('Individual', 'Company') NOT NULL
);
CREATE TABLE `Car`(
    `Id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `ClientId` BIGINT UNSIGNED NOT NULL,
    `WorkerId` BIGINT UNSIGNED NOT NULL,
    `Brand` VARCHAR(20) NOT NULL,
    `Model` VARCHAR(20) NOT NULL,
    `IdentificationNumber` VARCHAR(20) NOT NULL,
    `Color` VARCHAR(20) NOT NULL,
    `Mileage` DECIMAL(8, 2) NOT NULL,
    `EngineCapacity` DECIMAL(8, 2) NOT NULL,
    `Type` ENUM('Combi', 'Coupe', 'Cabrio', 'Sedan', 'Suv', 'Hatchback', 'Truck') NOT NULL,
    `Status` ENUM('New', 'InProgress', 'Cancelled', 'Finished') NOT NULL,
    `AdmissionDate` DATETIME NOT NULL,
    `SubmissionDate` DATETIME NULL
);
ALTER TABLE
    `Service` ADD CONSTRAINT `service_carid_fk` FOREIGN KEY(`CarId`) REFERENCES `Car`(`Id`);
ALTER TABLE
    `Client` ADD CONSTRAINT `client_addressid_fk` FOREIGN KEY (`AddressId`) REFERENCES `Address`(`Id`);
ALTER TABLE
    `Car` ADD CONSTRAINT `car_workerid_fk` FOREIGN KEY(`WorkerId`) REFERENCES `User`(`Id`);
ALTER TABLE
    `Car` ADD CONSTRAINT `car_clientid_fk` FOREIGN KEY(`ClientId`) REFERENCES `Client`(`Id`);
