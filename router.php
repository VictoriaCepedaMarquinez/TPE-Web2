<?php
require_once './app/controllers/reserves.controller.php';
require_once './app/controllers/rooms.controller.php';
require_once './app/controllers/auth.controller.php';
require_once './app/views/home.view.php';
require_once './app/views/default.view.php';


define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

$action = 'home';
if (!empty( $_GET['action'])) {
    $action = $_GET['action'];
}


$params = explode('/', $action);

switch ($params[0]) {
    case 'home':
        $view = new HomeView();
        $view->showHome();
        break;
    case 'rooms':
        $controller = new RoomsController();
        $controller->showRooms();
         break;    
    case 'formAddReserve':
      $controller = new ReserveController();
      $controller->showAddReserve($params[1]);
      break;
    case 'listReserves':
        $controller = new ReserveController();
        $controller->showListReserves();
     break;
    case 'login':       
       $controller = new AuthController();
       $controller->showLogin();
       break;
     case 'logout':
        $controller = new AuthController();
        $controller->logout();
        break;
    case 'auth':
        $controller = new AuthController();
        $controller->auth();
       break;
    case 'addReserve':
        $controller = new ReserveController();
        $controller->addReserve();
        break;
    case 'deleteReserve':
        $controller = new ReserveController();
        $controller->removeReserve($params[1]);
        break;
    case 'modificReserve':
        $controller = new ReserveController();
        $controller->modificReserves($params[1]);
         break;  
    case 'formModificReserve':
        $controller = new ReserveController();
        $controller->showModificReserve($params[1]);
         break; 
   case 'formConfirmReserve':
        $controller = new ReserveController();
        $controller->confirmReserve($params[1]);
         break;  
    case 'confirmReserveList':
        $controller = new ReserveController();
        $controller->confirmReserveList($params[1]);
        break;  
    case 'yourReserve':
        $controller = new ReserveController();
        $controller->showLastReserve($params[1]);
         break;
    case 'detailreserve':
        $controller = new ReserveController();
        $controller->showDetailReserve($params[1]);
        break;  
    case 'showRooms':
        $controller = new RoomsController();
        $controller->showRoomsAdmin();
       break;
    case 'addRoom':
        $controller = new RoomsController();
        $controller->addRoom();
        break;
    case 'deleteRoom':
        $controller = new RoomsController();
        $controller->deleteRoom($params[1]);
        break;
    case 'updateRoom':
        $controller = new RoomsController();
        $controller->updateRoom();
        break;
    case'reserveByCategorie':
        $controller = new RoomsController();
        $controller->getReserveByIdRoom($params[1]);
        break;                  
    default: 
         $view = new DefaultView();
         $view->showDefault();
        break;
}
