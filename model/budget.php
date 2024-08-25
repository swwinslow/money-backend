<?php
require_once '../../includes/db.php';

class Budget {
    public static function budgetOverview() {
        global $pdo;
        $year = '2024';
        $stmt = $pdo->query("SELECT ROUND((ROUND(t1.money, 2) / pay_money * 100),2) AS budget_percentage,ROUND((ROUND(t2.money, 2) / pay_money * 100),2) AS  spent_percentage, ROUND(t1.money, 2) AS budget_money, ROUND(t2.money,2) AS spent_money, ROUND((t1.money - t2.money),2) as 'difference', t2.category, CASE WHEN (t1.money - t2.money) < 0 THEN 'TRUE' ELSE 'FALSE' END AS NEGATIVE FROM (SELECT category, SUM(c_money) AS money from budget_months where budget_months.year = $year group by category) as t1, (SELECT SUM(money) AS 'money', YEAR(date) AS 'YEAR', category AS 'category', MONTH(date) AS 'MONTH' from trans where YEAR(date) = $year group by category ) as t2, (SELECT SUM(amount) AS pay_money, YEAR(DATE) as year_date from pay where YEAR(date) = $year and type_payment != 'Initial Money') as t3 WHERE t1.category = t2.category and t2.YEAR = t3.year_date");
        return $stmt->fetchAll();
    }
    public static function monthCategory() {
        global $pdo;
        $year = '2024';
        $stmt = $pdo->query("SELECT budget_months.month, budget_months.year, budget_months.category, ROUND(budget_months.c_money, 2) as c_money, ROUND(trans_sql.MONEY,2) AS MONEY, ROUND((budget_months.c_money - trans_sql.MONEY),2) as money_difference, CASE WHEN (budget_months.c_money - trans_sql.MONEY) < 0 THEN 'TRUE' ELSE 'FALSE' END AS NEGATIVE from (SELECT SUM(money) AS 'MONEY', YEAR(date) AS 'YEAR', category AS 'CAT', MONTH(date) AS 'MONTH' from trans where YEAR(date) = $year group by category, MONTH(date)) as trans_sql inner join budget_months on trans_sql.MONTH = budget_months.month_id and trans_sql.CAT = budget_months.category where budget_months.year = $year order by year,month_id, category");
        return $stmt->fetchAll();
    }

    public static function budgetSalaryOverview() {
        global $pdo;
        $year = '2024';
        $stmt = $pdo->query("SELECT ROUND((t1.money - t2.money),2) AS money, ROUND(t1.money,2) AS salary, ROUND(t2.money,2) AS trans, (ROUND(t3.budget_money,2) - ROUND(t1.money,2)) as left_over, ROUND(t3.budget_money,2) as budget, ROUND((t1.money -t3.budget_money ),2) as 'uncounted_money' FROM (SELECT SUM(amount) AS money FROM pay where year(date) = $year) as t1, (select sum(money) AS money from trans where YEAR(date) = $year) as t2, (SELECT SUM(c_money) as budget_money FROM `budget_months` WHERE `year` = $year) as t3");
        return $stmt->fetchAll();
    }    
}
?>