# _{Hair Salon}_

#### _An application that holds a hair salon's stylists and their individual clients, {September 23, 2016}_

#### By _**Angela Smith**_

## Description

_{A mySQL database holds a salon's stylists and their individual clients.  The user can see a list of the stylists and the clients that belong to them. New stylists may be added and new clients to any stylist.}_

## Specifications

| Behavior      | Input       |Output|
| ------------- |-------------| -----|
| A name will be entered and returned for the stylist class | "Betty" | "Betty" |
| An ID will be entered and returned as a number for a new stylist | 1 | true |
| A name will be entered and saved for a new object in the class stylist | "Betty" | "Betty" |
| The application will return all stylists | "Betty", "Flo" | ["Betty", "Flo"] |
| All stylists will be deleted | "Betty", "Flo" | [] |
| The application will return a stylist that the the user searches for | "Betty", "Flo" | "Betty" |
| The user will be able to update a stylist's name | "Betty", "Elizabeth" | "Elizabeth" |
| The user will be able to delete a specific stylist and their clients | "Betty", "Lisa Smith" | [] |
| The details for the client will be entered and saved for a new object in the class client | "Lisa Smith", "555-555-5555", "2016/05/01" | "Lisa Smith", "555-555-5555", "2016/05/01" |
| The application will return all client objects | "Lisa Smith", "Veronica Mars" | ["Lisa Smith", "Veronica Mars"] |
| All clients will be deleted | "Lisa Smith", "Veronica Mars" | [] |
| An ID will be entered and returned as a number for a new client | 1 | true |
| The client's stylist ID will be saved into the client's object as a number | 1 | true |
| The application will return a client object that the the user searches for | "Lisa Smith", "Veronica Mars" | "Lisa Smith" |
| The user will be able to update a client's information | "Lisa Smith", "Lisa Jones" | "Lisa Jones" |
| The application will return all clients that belong to a stylist | 1 | true |
| The user will be able to delete all clients belonging to a specific stylist | "Lisa Smith", "Veronica Mars" | [] |

## Setup/Installation Requirements

* Clone the repository.
* Type in _"apachectl start"_ in the command line.
* Open a browser and navigate to _localhost:8080/phpmyadmin_, enter username: _"root"_ and password: _"root"_ if prompted.
* Go to the Import tab and under "File to import", browse computer to project, select the zip file and press "Go".
* Using the command line, navigate to the project's root directory.
* Install dependencies by running _$composer install_.
* Navigate to the /web directory and start a local server with _$php -S localhost:8000_.
* Open a browser and go to the address http://localhost:8000 to view the application.

* If there is no file to import, type in the command line _"mysql.server start"_ and then _"mysql -uroot -proot"_.
* Type in _"CREATE DATABASE hair_salon;"_.
* Type in _"USE hair_salon;"_.
* Create the tables by typing in _"CREATE TABLE stylists (id serial PRIMARY KEY, name VARCHAR(255));"_ and _"CREATE TABLE clients (id serial PRIMARY KEY, stylist_id INT, name VARCHAR(255), phone VARCHAR(255), last_visit DATE);"_.

## Known Bugs

_There are no known bugs at this time_

## Support and contact details

_Angela Smith: avksmit2@gmail.com_

## Technologies Used

_PHP,
mySQL,
Silex,
Twig,
PHPUnit,
Bootstrap,_

### License

*This webpage is licensed under the MIT license.*

Copyright (c) 2016 **_Angela Smith_**
