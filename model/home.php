<?php
require_once '../../includes/db.php';

class Home {
    public static function HouseUtils() {
        global $pdo;
        $year = '2024';
        $stmt = $pdo->query("SELECT ROUND(SUM(money),2) as money, MONTH(date) as month FROM trans where ((business = 'AES - Indiana') OR (business = 'Citizen Energy') OR (business = 'Mortgage' AND items != '%Extra Principal%')) and YEAR(date) = $year group by MONTH(date)");
        return $stmt->fetchAll();
    }

    public static function insightData() {
        global $pdo;
        $year = '2024';
        $blddd = $pdo->query("SELECT ROUND(SUM(money),2) as money, YEAR(DATE) as year FROM `trans` WHERE `items` LIKE '%BLDDD%' GROUP BY YEAR(DATE) ORDER BY `trans`.`date` DESC");
        $blddd_data = $blddd->fetchAll();

        $bldddlilly = $pdo->query("SELECT ROUND(SUM(money),2) as money, YEAR(DATE) as year FROM `trans` WHERE `items` LIKE '%BLDDD - Lilly Lunch%' GROUP BY YEAR(DATE) ORDER BY `trans`.`date` DESC");
        // $bldddlilly->execute();
        $bldddlilly_data = $bldddlilly->fetchAll();

        $homestuff = $pdo->query("SELECT ROUND(SUM(money),2) as money, YEAR(DATE) as year FROM `trans` WHERE `business` LIKE '%Menards%' OR `business` LIKE '%Lowes%' GROUP BY YEAR(DATE) ORDER BY `trans`.`date` DESC");
        $homestuff_data = $homestuff->fetchAll();

        $grocercies = $pdo->query("SELECT ROUND(SUM(money),2) as money, YEAR(DATE) as year FROM `trans` WHERE `category` = 'Groceries' GROUP BY YEAR(DATE) ORDER BY `trans`.`date` DESC");
        $grocercies_data = $grocercies->fetchAll();


        $gas = $pdo->query("SELECT ROUND(SUM(money),2) as money, YEAR(DATE) as year FROM `trans` WHERE `items` LIKE '%Gas%' and category = 'CAR' GROUP BY YEAR(DATE) ORDER BY `trans`.`date` DESC");
        $gas_data = $gas->fetchAll();

        $statefarmcar = $pdo->query("SELECT ROUND(SUM(money),2) as money, YEAR(date) as year FROM `trans` WHERE `business` LIKE '%state farm%' AND `category` = 'CAR' group by year ORDER BY `trans`.`date` DESC");
        $statefarmcar_data = $statefarmcar->fetchAll();

        $payYear = $pdo->query("SELECT ROUND(SUM(amount),2) as money, YEAR(DATE) as year FROM `pay` WHERE type_payment != 'Initial Money' GROUP BY YEAR(DATE) ORDER BY `pay`.`date` ASC");
        $payYear_data = $payYear->fetchAll();

        $data = array('BLDDD' => $blddd_data,  'BLDDDLL' => $bldddlilly_data, 'homestuff' => $homestuff_data, 'Grocercies' => $grocercies_data, 'CarGas' => $gas_data, 'SFCar' => $statefarmcar_data, 'PayYear' => $payYear_data);

        return $data;
    }

    public static function UtilsOnYear() {
        global $pdo;
        $year = '2024';
        $stmt = $pdo->query("SELECT MONTH(DATE) AS month, YEAR(DATE) as year, ROUND(SUM(money),2) as money FROM `trans` WHERE (`business` LIKE 'AES - Indiana' OR business = 'Citizen Energy') GROUP BY MONTH(DATE), YEAR(DATE) order by YEAR(DATE), MONTH(date) ASC");
        return $stmt->fetchAll();
    }
}

?>