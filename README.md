# Chronic-Disease-Indicator
## Project
- Contains multiple PHP/HTML files that can be run on a local web browser.
1. Launch XAMMP and Start Apache and MySQL.
2. Launch any webpage/php file, although Login.php is recommended.
3. Replace file:///C:/xampp/htdocs/ with localhost/, this will create a connection with both 
PHPMyAdmin and XAMMP.
4. Launch PHPMyAdmin via entering http://localhost/phpmyadmin/ in the webpage, this allows
access to the database for both the webpages and the admin.
5. Follow demo slides to understand how the website works, or read instructions below.
- Contains a CSS file to style the webpage.
- Contains a SQL database file for PHPMyAdmin.
- For first time usage, please insure that the database file is uploaded to PHPMyAdmin.
- To upload a database file, create a new database and in the Import tab, upload the database file.
- In this website, users can create new accounts using the New User button that asks for the user's First and Last name and a password. 
- Upon registering, the website provides users with a unique username that can be used to log back in.
- For returning users, they can just enter their username and password to gain access to the website.
- Upon landing on the homepage, users are provided with a form that asks for personal information such as age and height. Existing users 
	can update their information in the database, whilst new users can enter their information for the first time. 
- There is a delete account button provided in case a user wants to delete their information in the database.
- After submitting the form, or by clicking on the Results tab, users can check their results for potential diseases based on their symptoms.
- Users can also obtain information regarding specialists in those diseases based on their diseases and proximity of location. This information
	can be accessed either via the Doctor tab up above or the doctor info column in the results page.
- Users can also logout of the website using the Logout tab up above in the navigation bar.
