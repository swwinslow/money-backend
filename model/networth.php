<?php
require_once '../../includes/db.php';

class Networth {
    public static function networthYearCalculation() {
        global $pdo;
        $year = '2024';
        $stmt = $pdo->query("select 
        COUNT(*) as total_count,
        end_of_year, 
        date, 
        ROUND(SUM(`category_value` - `category_liabilities`),2) AS money_value,
        ROUND(SUM(`category_liabilities`),2) AS money_debt,
        (ROUND((ROUND(SUM(`category_liabilities`),2) / ROUND(SUM(`category_value` - `category_liabilities`),2) * 100),2)) as money_ratio 
        from net_worth group by date order by date DESC");
        return $stmt->fetchAll();
    }

    //

    public static function networthYearCalculationCategory() {
        global $pdo;
        $year = '2023';
        
        // $month = '03';
        // $day = '31';
        
        // $month = '06';
        // $day = '30';
        
        $month = '12';
        $day = '31';
        
        // $month = '12';
        // $day = '31';

        $stmt = $pdo->query("select $year as year, $month as month, $day as day, `category_type`,
        ROUND(SUM(`category_value`),2) AS money_value
        from net_worth where MONTH(date) = $month and YEAR(date) = $year group by category_type");
        return $stmt->fetchAll();
    }

    public static function networthYearPercentage() {
        global $pdo;
        // $year = '2023';
        
        $stmt = $pdo->query("SELECT *, (t1.category_money_value / t2.total_money_value * 100) as percentage FROM (select category_type, ROUND(SUM(`category_value` - `category_liabilities`),2) AS category_money_value from net_worth where YEAR(date) = '2023' and MONTH(date) = '12' group by category_type order by date DESC) as t1, (select ROUND(SUM(`category_value` - `category_liabilities`),2) AS total_money_value from net_worth where YEAR(date) = '2023' and MONTH(date) = '12' group by date order by date DESC) as t2");
        return $stmt->fetchAll();
    }

    public static function NetworthPerQuarter() {
        global $pdo;
        // $year = '2023';
        $stmt = $pdo->query("select MONTH(NOW()) as month_current, end_of_year as 'year', date, MONTH(date) as 'month', ROUND(SUM(`category_value` - `category_liabilities`),2) AS money_value from net_worth group by date order by date DESC LIMIT 20");
        return $stmt->fetchAll();
    }

    //
}

?>