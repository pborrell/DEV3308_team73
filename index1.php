<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
<title></title>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
</head>
    <body>
       
    <table id="tbl-layout" cellpadding="0" cellspacing="0">
    <tr>
        <!--
        left side menu bottons
        -->
    <td valign="top" id="tbl-left" width="30%">
    <div id="left-side-wrapper">
    <div id="left-menu" style='max-width:130px !important;'>
    </div></div>
    </td>
    <!--
    pushes the pages to the middle
        --><?php 
        $num = rand(1, 4);
        switch($num){
            case 1:
                include("Partner_Patch_Front_End.html");
                break;
            case 2:
                include("Fem_front_end.html");
                break;
            case 3:
                include("redwood.html");
                break;
            case 4:
                include("puppies_home.html");
                break;
        }
        ?>
    </body>
</html>
