<?php
header('Content-Type: application/json');

require_once '../../includes/db.php';
require_once '../../model/budget.php';
require_once '../../model/networth.php';
require_once '../../model/grocery.php';
require_once '../../model/blddd.php';
require_once '../../model/pay.php';
require_once '../../model/peloton.php';
require_once '../../model/home.php';


// Get the request method
$requestMethod = $_SERVER['REQUEST_METHOD'];
// var_dump($requestMethod); //GET, POST, PUT, DELETE
$uri = $_SERVER['REQUEST_URI'];

$acceptHeader = isset($_SERVER['HTTP_ACCEPT']) ? $_SERVER['HTTP_ACCEPT'] : 'Header not found';

// Print all headers
foreach ($_SERVER as $key => $value) {
        if (strpos($key, '') === 0) {
            if($key == "HTTP_YEAR"){
                echo $key . '::::: ' . $value . '<br>';
            }
        }
    }

$uriSegments = explode('/', $uri);
$api_requset_category = $uriSegments[5];
$api_requset_name = $uriSegments[6];

// var_dump($api_requset_category);

// // var_dump($api_requset_name);
// die();

if ($api_requset_category == "networth"){

        switch ($api_requset_name) {
                case 'NetworthPerQuarter':
                        $NetworthPerQuarter = Networth::NetworthPerQuarter();
                        http_response_code(201);
                        echo json_encode($NetworthPerQuarter);
                        break;

                case 'networthYearCalculation':
                        $networthYearCalculation = Networth::networthYearCalculation();
                        http_response_code(201);
                        echo json_encode($networthYearCalculation);
                        break;
        
                case 'networthYearCalculationCategory':
                        $networthYearCalculationCategory = Networth::networthYearCalculationCategory();
                        http_response_code(201);
                        echo json_encode($networthYearCalculationCategory);
                        break;
        
                case 'networthYearPercentage':
                        $networthYearPercentage = Networth::networthYearPercentage();
                        http_response_code(201);
                        echo json_encode($networthYearPercentage);
                        break;
        }               
} else if ($api_requset_category == "budget"){
        switch ($api_requset_name) {
                case 'monthCategory':
                        $monthCategory = Budget::monthCategory();
                        http_response_code(201);
                        echo json_encode($monthCategory);
                        break;
                
                case 'budgetOverview':
                        $budgetOverview = Budget::budgetOverview();
                        http_response_code(201);
                        echo json_encode($budgetOverview);
                        break;
        
                // case 'budgetSalaryOverview':
                //         $budgetSalaryOverview = Budget::budgetSalaryOverview();
                //         http_response_code(201);
                //         echo json_encode($budgetSalaryOverview);
                //         break;
                
                case 'fullYearReview':
                        $monthCategory = Budget::monthCategory();
                        http_response_code(201);
                        echo json_encode($monthCategory);
                        break;
                 
                case 'insightData':
                        $insightData = Home::insightData();
                        http_response_code(201);
                        echo json_encode($insightData);
                        break;  

                case 'UtilsOnYear':
                        $UtilsOnYear = Home::UtilsOnYear();
                        http_response_code(201);
                        echo json_encode($UtilsOnYear);
                        break; 
                        
        }
}



?>