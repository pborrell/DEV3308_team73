1. Peter Borrell 
	Sean Patterson 
	Victoria Manchester 
	Ziheng Zhu 
	Serena Buxton
2.  Gone Phishin'

3. We wanted to find a way to play with multiple CSS profiles and a lot of database interaction onto of doing a little social engineering. Motivation: We want to do this so we can write a web application that has multiple database interactions and using multiple CSS on one website page, a "theme'. The security leak of Equifax's information might result in more phishing attacks to collect dots that are not included in a credit reporting company's databases

4.  Automated Tests: 
Automated testing can be useful for running automated tests of all app components after any changes are made to make sure that the changes didn't break anything in the rest of the code. PHPUnit is a common testing tool for PHP. It works to test Unit Cases on functions within classes in the code. The PHP code for our project is a web application that does not contain any laces where a unit case occurs that should be tested. Thus, for our project automated testing is not applicable. Instead we will put additional effort into manual testing and user acceptance tests. 

To manually test our application we are going to step through the application trying every link and inputting various inputs, both inputs that work and don’t work. For each of the front ends we will test to make sure the initial link goes to the first page of the webpage (if there are multiple). We will then click every link to ensure it goes to the appropriate place. When the form is reached the form will be filled out with various inputs that work and don't work and we will test to make sure the corresponding result aligns with the desired result. If one of the fields is invalid it will take the user to an error page and if all fields are valid then it will take the user to a success page. More specific information how the tests are set up for the form is described below. Finally, we will test that an email properly sends to the user informing them that they have fallen for a phishing attack. To test this we will check the email for the corresponding email that should have been sent.
 

5.  User Acceptance Tests:

UAT 1:
For the "credit" text field, the user is required to enter a 16 digit number without spaces or special characters. The number is also categorized into one of the 4 major card types based on the number's composition. Both of these actions are completed through regex in our processing.php file. This is to ensure that all credit card numbers entered in the database are valid. If the card isn't valid when the donate button is pressed, the user is redirected to a page saying that the card they entered is invalid.

function validatecard($number)
 {
    global $type;
    $cardtype = array(
        "visa"       => "/^4[0-9]{12}(?:[0-9]{3})?$/",
        "mastercard" => "/^5[1-5][0-9]{14}$/",
        "amex"       => "/^3[47][0-9]{13}$/",
        "discover"   => "/^6(?:011|5[0-9]{2})[0-9]{12}$/",
    );
    if (preg_match($cardtype['visa'],$number))
    {
  $type= "visa";
        return TRUE;
  
    }
    else if (preg_match($cardtype['mastercard'],$number))
    {
  $type= "mastercard";
        return TRUE;
    }
    else if (preg_match($cardtype['amex'],$number))
    {
  $type= "amex";
        return TRUE;
  
    }
    else if (preg_match($cardtype['discover'],$number))
    {
  $type= "discover";
        return TRUE;
    }
    else
    {
        return false;
    } 
 }

I.E. if 4782002049069240 is entered, the card type will be read as visa and will be accepted with no issue. If I were to enter 2348 0845 7632 0020, the card would not be accepted and the user would be taken to the "invalid card" page.


UAT 2: 
In the "email" field, the user is required to entire a valid email address format. We use regex in php to check whether the customer has entered an accurate email address including ...@...(.org, .net, etc.). 

if (preg_match("/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/", $email) === TRUE)

I.E. If I were to enter sepa2099@colorado.edu the donation would go through (assuming all other fields are filled in correctly), but if I were to enter jack+35, the user would be taken to a webpage saying that the email they entered was invalid.

UAT 3: 
The first name and last name field should only take valid names. This means that the name field can not take numbers or symbols such as question marks, etc. It is also important the this considers names from other languages that might have additonal characters not in the latin alphebet. 
if(preg_match("/^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]+$/u", $last_name) == TRUE) 
the same statement is used for first name but $last_name is replaced with $first_name

I.E. If I were to enter John for the first name and Doe for the last name the donation would go through and take the user to a success page. On the other hand if I were to enter 1234 the user would be taken to an error page. 