Team Name:				Gone Phishin'
Members:				Peter Borrell
					Sean Patterson
					Victoria Manchester
					Ziheng Zhu
					Serena Buxton
Description:	
	The main idea is to create a general purpose platform for IT or HR department to test end user's susceptibility to phishing attacks. The purpose of this is to see if people need training to avoid them. It is invaluable to have the ability to test and train people from this type of social engineering attack.

	Beyond that we believe end users would enjoy being part of the blue-team after being tested. A company's security is as strong as the weakest link in the security chain. Since phising is a social engineering attack, it is ideal train end-users to avoid the attacks.

	We will be adding some configuration options to the PHP that will have documentation for how to change the functions. This will allow for us to set it so we can email an IT department, the user, not write anything, or anything else we can think of.

	The current application conisits of 4 front ends: A dating website that requires a $5 starter fee, a feminist donation site, an animal abuse donation site, and a redwoods donation site. If the user submits the form then their name, email, and a boolean for if they entered a credit card number is stored is stored in a database. The user then recieves an email telling them they fell for a phishing attack and provides a link for more information on how to be more careful. Currently, the application is only hosted locally for legal reasons. 

Vision Statement:
	We wanted to find a way to play with multiple CSS profiles and a lot of database interaction onto of doing a little social engineering.					
Motivation:	
	We want to do this so we can write a web application that has multiple database interactions and using multiple CSS on one website page, a "theme'. The security leak of Equifax's information might result in more phishing attacks to collect dots that are not included in a credit reporting company's databases.

Risks:
	1)It would be very easy to get personal information to be writes to databases. 
	2)Also setting up the database correctly. 
	3)Also the front-end not being persuasive enough.

Risk Migration Plan:
	1)Minimize the information written to the database.
	2)Proper database table names to make the structure logical. 
	3)We will also be doing research on the themes. 
	In general: Using the branch statndards.txt document.

Version Control:
	GIThub, the repository is DEV3308_team73.

Development Method:
	Agile, we will work on multiple features at a time with people doing different things concurrently. We are going to test features on a branch outside of master and when ever we get something working we will merge it back into master. Afterward we will down stream working features so we have an idea how the end project will work when we get later in the project. 

Collaboration Tool:
	Waffle.io integrated with GIThub. Google Hangouts for communication and remote collaboration and adding GroupMe to talk amongst.

Proposed Architecture:	
	The back end will be running off a MySQL database that will be read every time the page loads and written to every time a form is submitted. The form will write a first name, last name, and the email address to the database to minimize the amount of collected personal information for this project.
					
	The front end will be a HTML page with forms to fill in, CSS will be used to change the theme and the forms that appear on the page. Upon hitting submit a page using the same theme will come up and acknowledge they were either a victim of a phising scam and thanking them for signing up to a newsletter or something applicable.

	The middle will be using PHP to determine the theme write the information to the database and change the page. The features will deployed using a combination of PHP and MySQL. We may add some other pages like an about us for the profile to make the people using the application feel it is more legitimate. 
