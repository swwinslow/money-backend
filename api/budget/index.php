<?php
header('Content-Type: application/json');

require_once '../../includes/db.php';
require_once '../../model/budget.php';
require_once '../../model/networth.php';
require_once '../../model/grocery.php';


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
$api_request_name = $uriSegments[5];

switch ($api_request_name) {
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

        case 'budgetSalaryOverview':
                $budgetSalaryOverview = Budget::budgetSalaryOverview();
                http_response_code(201);
                echo json_encode($budgetSalaryOverview);
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
                //networthYearCalculationCategory
        
        case 'networthYearPercentage':
                $networthYearPercentage = Networth::networthYearPercentage();
                http_response_code(201);
                echo json_encode($networthYearPercentage);
                break;
                //
        //
        case 'NetworthPerQuarter':
                $NetworthPerQuarter = Networth::NetworthPerQuarter();
                http_response_code(201);
                echo json_encode($NetworthPerQuarter);
                break;
}


// case 'POST':
//         $data = json_decode(file_get_contents('php://input'), true);
//         $id = createItem($pdo, $data);
//         http_response_code(201);
//         echo json_encode(['id' => $id]);
//         break;

// case 'PUT':
//         if ($id) {
//         $data = json_decode(file_get_contents('php://input'), true);
//         updateItem($pdo, $id, $data);
//         echo json_encode(['message' => 'Item Updated']);
//         } else {
//         http_response_code(400);
//         echo json_encode(['message' => 'Bad Request']);
//         }
//         break;

// case 'DELETE':
//         if ($id) {
//         deleteItem($pdo, $id);
//         echo json_encode(['message' => 'Item Deleted']);
//         } else {
//         http_response_code(400);
//         echo json_encode(['message' => 'Bad Request']);
//         }
//         break;

// default:
//         http_response_code(405);
//         echo json_encode(['message' => 'Method Not Allowed']);
//         break;





// if ($method == 'GET') {
//         $trans = Trans::getAllTrans();
//         echo json_encode($trans);
// } else {
//     http_response_code(405); // Method Not Allowed
//     echo json_encode(["message" => "Method not allowed"]);
// }}

?>