<?php

class Router {

    public static function analyse($request){
        $result = array(
            'controller'    => 'Error',
            'action'        => 'error404',
            'params'        => array()
        );

        if($request === '' || $request === '/'){ // Route vers la page d'accueil
            $result['controller']   = 'Page'; //PageController
            $result['action']       = 'index'; //function index()
            $result['params']['limit'] = 5;
        } else {
            $parts = explode('/', $request);
            
            if (count($parts) == 2) {
            if($parts[0] == 'download' && (count($parts) == 1 || $parts[1] !== '')) {
                $result['controller']       = 'Load';
                $result['action']           = 'load';
                $result["params"]["filename"] = $parts[1];
             }



            } elseif($parts[0] == 'login' && (count($parts) == 1 || $parts[1] == '')){ // Route vers la page de connexion
                $result['controller']       = 'User';
                $result['action']           = 'login';
            } elseif($parts[0] == 'signup' && (count($parts) == 1 || $parts[1] == '')){ // Route vers la page d'inscription
                $result['controller']       = 'User';
                $result['action']           = 'signup';
            } elseif($parts[0] == 'logout' && (count($parts) == 1 || $parts[1] == '')){ // Deconnexion de l'utilisateur
                $result['controller']       = 'User';
                $result['action']           = 'logout';
            } 
        }

        return $result;
    }
    
}