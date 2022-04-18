<?php
switch (@parse_url($_SERVER['REQUEST_URI'])['path']) {
   case '/':                  
      require 'login.php';
      break; 
   case '/login.php':                  
      require 'login.php';
      break; 
   case '/sampleImdb.php':    
      require 'sampleImdb.php';
      break;              
   case '/movieView.php':
      require 'movieView.php';
      break;
    case '/logout.php':
        require 'logout.php';
        break;  
    case '/commentView.php':
         require 'commentView.php';
         break;
    case '/register.php':
        require 'register.php';
        break;
    default:
      http_response_code(404);
      exit('Not Found');
}  
?>