<?php
declare(strict_types=1);

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {

    $app->get('/validate', function (Request $request, Response $response) {
        $pin = '5678';

        $split = explode("*",$_REQUEST['ussd_string']);

        foreach($split as $key=>$item)
        {
            if(empty($item))
            {
                unset($split[$key]);
            }
        }

        if(count($split)<2){
            $message = "CON Sample\n Please enter your PIN:";
        }else{
            if($split[1]!='5678'){
                $message = "END, Invalid PIN";
            }else{
                $message = "CON OK|2";
            }
        }

        $response->getBody()->write($message);

        return $response;
    });

    $app->get('/menu', function (Request $request, Response $response) {

        $menuid = 0;
        $parentid = 0;

        $menu[] = [        
            "menuid"=> $menuid++,
            "parentid"=> $parentid,
            "menuposition"=> 1,
            "ussd_path"=> null,
            "menu_selector"=> "200",
            "menu_icon"=> null,
            "menu_url"=> null,
            "menutitle"=> "Sample 1",
            "menurole"=> "SELECTION",
            "questionnaire"=> "Please enter ",
            "menuquestions"=> "Amount=,confirm=",
            "pre_request_url"=> null,
            "pre_request_method"=> null,
            "menu_request_url"=> "http://172.17.0.1:10999/action",
            "menu_request_method"=> "POST",
            "confirm_template"=> "Confirm. Get KSh {{amount}}?\n1. Yes\n2. No",
            "filtered"=> false,
            "service_pack_id"=> null,
            "service_pack_url"=> null,
            "menu_header"=> "Some Random ID:".number_format(rand(100,1000),2),
            "default_response"=> null,
            "menu_status"=> "ACTIVE"
        ];

        $option_id = $menuid++;

        $menu[] = [        
            "menuid"=> $option_id,
            "parentid"=> $parentid,
            "menuposition"=> 1,
            "ussd_path"=> null,
            "menu_selector"=> "200",
            "menu_icon"=> null,
            "menu_url"=> "http://172.17.0.1:10999/submenu",
            "menutitle"=> "Option 1",
            "menurole"=> "OPTION",
            "questionnaire"=> null,
            "menuquestions"=> null,
            "pre_request_url"=> null,
            "pre_request_method"=> null,
            "menu_request_url"=> null,
            "menu_request_method"=> null,
            "confirm_template"=> null,
            "filtered"=> false,
            "service_pack_id"=> null,
            "service_pack_url"=> null,
            "menu_header"=> "Some Random ID:".number_format(rand(100,1000),2),
            "default_response"=> null,
            "menu_status"=> "ACTIVE"
        ];

        $response->getBody()->write(json_encode($menu));
        return $response;
    });

    $app->get('/submenu', function (Request $request, Response $response) {

        $menuid = 0;
        $parentid = 0;

        $menu[] = [        
            "menuid"=> $menuid++,
            "parentid"=> $parentid,
            "menuposition"=> 1,
            "ussd_path"=> null,
            "menu_selector"=> "200",
            "menu_icon"=> null,
            "menu_url"=> null,
            "menutitle"=> "Sub Sample 1",
            "menurole"=> "SELECTION",
            "questionnaire"=> "Please enter ",
            "menuquestions"=> "Amount=,confirm=",
            "pre_request_url"=> null,
            "pre_request_method"=> null,
            "menu_request_url"=> "http://172.17.0.1:10999/action",
            "menu_request_method"=> "POST",
            "confirm_template"=> "Confirm. Get KSh {{amount}}?\n1. Yes\n2. No",
            "filtered"=> false,
            "service_pack_id"=> null,
            "service_pack_url"=> null,
            "menu_header"=> "Some Random ID:".number_format(rand(100,1000),2),
            "default_response"=> null,
            "menu_status"=> "ACTIVE"
        ];

        $menu[] = [        
            "menuid"=> $menuid++,
            "parentid"=> $parentid,
            "menuposition"=> 1,
            "ussd_path"=> null,
            "menu_selector"=> "200",
            "menu_icon"=> null,
            "menu_url"=> null,
            "menutitle"=> "Sub Sample 2",
            "menurole"=> "SELECTION",
            "questionnaire"=> "Please enter ",
            "menuquestions"=> "Amount=,confirm=",
            "pre_request_url"=> null,
            "pre_request_method"=> null,
            "menu_request_url"=> "http://172.17.0.1:10999/action",
            "menu_request_method"=> "POST",
            "confirm_template"=> "Confirm. Get KSh {{amount}}?\n1. Yes\n2. No",
            "filtered"=> false,
            "service_pack_id"=> null,
            "service_pack_url"=> null,
            "menu_header"=> "Some Random ID:".number_format(rand(100,1000),2),
            "default_response"=> null,
            "menu_status"=> "ACTIVE"
        ];


        $response->getBody()->write(json_encode($menu));
        return $response;
    });

    $app->post('/action', function (Request $request, Response $response) {
        $response->getBody()->write(json_encode($_REQUEST));
        return $response;
    });

};
