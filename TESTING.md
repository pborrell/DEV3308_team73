1. Peter Borrell 
	Sean Patterson 
	Victoria Manchester 
	Ziheng Zhu 
	Serena Buxton
2.  Gone Phishin'

3. We wanted to find a way to play with multiple CSS profiles and a lot of database interaction onto of doing a little social engineering. Motivation: We want to do this so we can write a web application that has multiple database interactions and using multiple CSS on one website page, a "theme'. The security leak of Equifax's information might result in more phishing attacks to collect dots that are not included in a credit reporting company's databases

4.  Automated Tests:

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