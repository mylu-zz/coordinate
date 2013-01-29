<!--
  - header.php                                                               
  -                                                                          
  - Rendered at the top of each page                                         
  - Modified from CS50 problem set 7 distibution code                        
  -                                                                          
  - Max Lu                                                
  -->

<!DOCTYPE html>

<html>
    <head>
        <!-- jQuery from Google -->
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.0/jquery.min.js"></script>
        <!-- The main JavaScript/CSS Files -->
        <link href="css/bootstrap.css" rel="stylesheet"/>
        <link href="css/bootstrap-responsive.css" rel="stylesheet"/>
        <link href="css/styles.css" rel="stylesheet"/>
        <script src="foundation/javascripts/modernizr.foundation.js"></script>  
        <script src="js/jquery-1.8.2.js"></script>
        <script src="js/bootstrap.js"></script>
        <script src="js/scripts.js"></script>
        <script src="js/main.js"></script>   
        <!-- google maps api -->
        <script type="text/javascript"
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCStxW5louT_lGclLGyBvwzOcaEEWrYe4o&amp;sensor=true">    
        </script>
        
        <style type="text/css">
            html {height: 100% }
            body {height: 100%; margin: 0; padding: 0 }
        </style>  
        
        <?php if (isset($title)): ?>
            <title>Coordinate: <?= htmlspecialchars($title) ?></title>
        <?php else: ?>
            <title>Coordinate</title>
        <?php endif ?>
    </head>
    
    <body>      
