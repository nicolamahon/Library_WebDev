# Library_WebDev
Model for a Dynamic Public Library Website using PHP, HTML, CSS, MariaDB, MySQL

This library model has been designed using MariaDB to create a background database to retain all library 
details i.e. users, books, reservations, categories, etc. 

The database is accessed using MySQL and PHP. 
The layout and stylingof the website are provided using HTML and CSS. 

This project is the result of my successful completion of the Year 2 Web Development module, as part of my 
BSc Computer Science (Hons) degree. 

<h4>Functionality:</h4>

<b>Login</b><br>
Users can login / register. 
Login is secured using session identifications. 
Login details are checked against details already saved in the database for registered user, to ensure secure access. 

<b>Registration</b><br>
Registration utilises a number of validation checks. 
- usernames must be unique, no duplicate usernames can exist in the database
- passwords must be minimum 6 characters long
- passwords must be entered twice to confirm that masked password is correct in both entries
- mobile phone numbers must be 10 characters long and numeric only

<b>Searching Books</b><br>
Users can search for a book using a number of methods.
- search by the author (full or partial search)
- search by the title (full or partial search)
- search by author and title (full or partial search)
- search for all books in a particular category eg. Health, Business, Technology

<b>Reserving Books</b><br>
Users can see a list of all the books they have reserved. 
From this interface they can also unreserve books they no longer want to reserve. 
Users can reserve a book oncee located it in the search options. 
A user cannot reserve a book that is reserved aby another user.
The reservation status of each book is displayed in the search results from any search. 

<b>Logout</b><br>
Users can choose to logout of the system at any time as a logout button is included on all pages, after successful login. 
Logging out terminates the user's session so that no other user's can access their account details. 
Once logged out, a user must login again to access the system. 