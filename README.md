
## $\Large \mathcal{\color{green}{\fbox{CAR SERVICE MANAGEMENT} \}}$

## Informacje ogólne
Aplikacja CAR SERVICE MANAGEMENT to aplikacja służąca do obsługi serwisu motoryzacyjnego. </br>
Dla klientów, pracowników oraz właściciela.</b>
Wykonana w architekturze MVC. </b>

## Wykorzystane technologie:
Projekt został stworzony przy pomocy technologii: <br /><br />
<img src="https://img.shields.io/badge/GitHub-100000?style=for-the-badge&logo=github&logoColor=white" height="50">
<img src="https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white" height="50">
<img src="https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white" height="50">
<img src="https://img.shields.io/badge/Bootstrap-563D7C?style=for-the-badge&logo=bootstrap&logoColor=white" height="50">
<img src="http://img.shields.io/badge/-PHPStorm-181717?style=for-the-badge&logo=phpstorm&logoColor=white" height="50">
<img src="https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white" height="50">

## Szczegółowy opis aplikacji
Aplikacja jest podzielona na 3 osobne gałęzie. </br></br>

|UŻYTKOWNIK                           | PRACOWNIK                                               | WŁAŚCICIEL                                              |
|:-----------------------------------:|:-------------------------------------------------------:|:-------------------------------------------------------:|
|Sprawdzanie statusu oddanych pojazdów|Dodawanie nowej osoby                                    |Dodawanie nowej osoby                                    |  
|Zapoznanie się z regulaminem         |Dodawanie nowego pojazdu                                 |Dodawanie nowego pracownika                              |
|Zapoznanie się z oferowanymi usługami|Dodawanie wykonywanych usług względem konkretnego pojazdu|Dodawanie wykonywanych usług względem konkretnego pojazdu|      
|                                     |Edycja isniejącej osoby                                  |Edycja isniejącej osoby                                  | 
|                                     |Edycja istniejącego serwisu pojazdu                      |Edycja isniejącego pracownika                            | 
|                                     |Edycja wykonywanych usług względem pojazdu               |Edycja wykonywanych usług względem pojazdu               | 
|                                     |Edycja własnego profilu                                  |Edycja profilu użytkownik                                | 
|                                     |Edycja istniejącego pojazdu                              |Edycja własnego profilu                                  |
|                                     |Logowanie do aplikacji                                   |Rejestracja nowych pracowników                           |
|                                     |                                                         |Logowanie do aplikacji                                   | 

## Struktura aplikacji (baza danych)
|SERVICE            |ADDRESS              |USER                                   |CLIENT                              |CAR                                                                          |
|:-----------------:|:-------------------:|:-------------------------------------:|:----------------------------------:|:---------------------------------------------------------------------------:|
|Id (bigint)        |Id (bigint)          |Id (bigint)                            |Id (bigint)                         |Id (bigint)                                                                  |
|CarId (bigint)     |City (varchar)       |Firstname (varchar)                    |AddressId (bigint)                  |ClientId (bigint)                                                            |
|Name (varchar)     |Street (varchar)     |Lastname (varchar)                     |Firstname (varchar)                 |WorkerId (bigint)                                                            |
|Cost (decimal)     |PostCode (varchar)   |Login (varchar)                        |Lastname (varchar)                  |Brand (varchar)                                                              |
|Comment (varchar)  |HouseNumber (varchar)|Password (varchar) #hash               |NIP (varchar)                       |Model (varchar)                                                              |
|                   |Phone (varchar)      |Email (varchar)                        |Code (varchar)                      |IdentificationNumber (varchar)                                               |
|                   |Email (varchar)      |Phone (varchar)                        |Type (enum('individual', 'company'))|Color (varchar)                                                              |
|                   |                     |Role (enum('admin', 'manager' worker'))|                                    |Mileage (decimal)                                                            |
|                   |                     |                                       |                                    |EngineCapacity (decimal)                                                     |
|                   |                     |                                       |                                    |Type (enum('combi', 'coupe', 'cabrio', 'sedan', 'suv', 'hatchback', 'truck'))|
|                   |                     |                                       |                                    |Status (enum('new', 'inProgress', 'Cancelled', 'Finished'))                  |
|                   |                     |                                       |                                    |AdmissionDate (datetime)                                                     |
|                   |                     |                                       |                                    |SubmissionDate (datetime)                                                    |

![image](https://github.com/b4kii/car-service-management/assets/114850500/51ca5707-51a0-40e7-8f24-734bc3f13eb9)

## Dane testowe
|KONTA PRACOWNIKA                     |KONTO WŁAŚCICIELA/ADMINISTRATORA                         |
|:-----------------------------------:|:-------------------------------------------------------:|
|LOGIN: worker HASŁO: worker123       |LOGIN: admin HASŁO: admin123                             |  
|LOGIN: manager HASŁO: manager123     |                                                         |

## Instalacja i uruchomienie

1. Pobranie i zainstalowanie programu xampp.
2. Edycja plików konfiguracyjnych serwera apache  
     ```C:\xampp\apache\conf\httpd.conf```  
    ```Listen 8080```  
    oraz  
    ```C:\xampp\apache\conf\extra\httpd-vhosts.conf``` 
    
    ```
    <VirtualHost *:8080>
	    ServerName localhost
    	DocumentRoot "C:/xampp/htdocs/car-service-management/public"
    	<Directory "C:/xampp/htdocs/car-service-management/public/">
	    	Options +Indexes -FollowSymLinks
	    	AllowOverride All
	    	Require all granted
    	</Directory>
    </VirtualHost> 
3. Sklonowanie repozytorium  
    ```git clone https://github.com/b4kii/car-service-management.git C:\xampp\htdocs```
4. Stworzenie bazy danych w mysql xampp  
   ```CREATE DATABASE car_service_management```
5. Pobranie menadżera pakietów ```composer```  
   ```https://getcomposer.org/Composer-Setup.exe```
6. Uruchomienie projektu w IDE oraz zainstalowanie potrzebnych bibliotek  
   ```composer install```

