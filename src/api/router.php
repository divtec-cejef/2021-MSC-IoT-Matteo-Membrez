<?php
/**
 * Created by PhpStorm.
 * User: lmo
 * Date: 19.11.18
 * Time: 18:37
 *
 *
 *
 * https://stackoverflow.com/questions/778385/rails-post-put-get
Action   HTTP Method  Purpose
-------------------------------------------------------------------------
index    GET          Displays a collection of resources
show     GET          Displays a single resource
new      GET          Displays a form for creating a new resource
create   POST         Creates a new resource (new submits to this)
edit     GET          Displays a form for editing an existing resource
update   PUT          Updates an existing resource (edit submits to this)
destroy  DELETE       Destroys a single resource


https://developer.mozilla.org/fr/docs/Web/HTTP/M%C3%A9thode
https://lornajane.net/posts/2008/accessing-incoming-put-data-from-php
https://technologyconversations.com/2014/08/12/rest-api-with-json/

 *
 * https://blog.octo.com/designer-une-api-rest/
 */


/***
 * @param $method : méthode nécessaire pour la route
 * @param $regex: modèle de la route à évaluer
 * @param $cb:  fonction de rappel invoqué si la route est bonne
 * @return int
 *
 * l'envoi doit être x-www-form-urlencode
 */
function route ($method, $regex, $cb) {

    if( strtoupper($method) !== $_SERVER['REQUEST_METHOD'])
        return 0;

    $recieved_datas = [];

    switch ($_SERVER['REQUEST_METHOD']){

        //pour GET et DELETE on récupère un id dans l'url

        case 'PUT':
            parse_str(file_get_contents("php://input"),$recieved_datas);


            //$recieved_datas['titre'] = 'plume';
            break;


        case 'POST':
            $recieved_datas = $_POST;
            break;
    }





    $regex = str_replace('/', '\/', $regex);

    $is_match = preg_match('/^' . ($regex) . '$/', $_SERVER['REQUEST_URI'], $matches, PREG_OFFSET_CAPTURE);

    // appel la fonction passée en paramètre si il y a correspondence
    if ($is_match) {
        $cb($matches, $recieved_datas);
    }
}

