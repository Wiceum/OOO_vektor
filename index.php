<?php error_reporting(-1);

require_once './classes.php';


$engineer = new Profession('инженер',200, 5, 50);
$analyst = new Profession('аналитк', 800, 50, 5);
$manager = new Profession('менеджер', 500,20, 200 );
$marketer = new Profession('маркетолог', 400, 15, 150);


$vector = new Company();

$vector->addDep('Закупки');
$vector->addStaffUnitInDep((new Employee($manager,'Закупки',1, false)), 9);
$vector->addStaffUnitInDep((new Employee($manager, 'Закупки', 2, false)), 3);
$vector->addStaffUnitInDep((new Employee($manager, 'Закупки', 3, false)), 2);
$vector->addStaffUnitInDep((new Employee($marketer, 'Закупки', 1, false)), 2);
$vector->addStaffUnitInDep((new Employee($manager, 'Закупки', 2, true)), 1);

$vector->addDep('Продажи');
$vector->addStaffUnitInDep((new Employee($manager,'Продажи',1, false)), 12);
$vector->addStaffUnitInDep((new Employee($marketer,'Продажи',1, false)), 6);
$vector->addStaffUnitInDep((new Employee($analyst,'Продажи',1, false)), 3);
$vector->addStaffUnitInDep((new Employee($analyst,'Продажи',2, false)), 2);
$vector->addStaffUnitInDep((new Employee($marketer,'Продажи',1, true)), 1);

$vector->addDep('Реклама');
$vector->addStaffUnitInDep((new Employee($marketer,'Реклама',1, false)), 15);
$vector->addStaffUnitInDep((new Employee($marketer,'Реклама',2, false)), 10);
$vector->addStaffUnitInDep((new Employee($manager,'Реклама',1, false)), 8);
$vector->addStaffUnitInDep((new Employee($engineer,'Реклама',1, false)), 2);
$vector->addStaffUnitInDep((new Employee($marketer,'Реклама',3, true)), 1);

$vector->addDep('Логистика');
$vector->addStaffUnitInDep((new Employee($manager,'Логистика',1, false)), 13);
$vector->addStaffUnitInDep((new Employee($manager,'Логистика',2, false)), 5);
$vector->addStaffUnitInDep((new Employee($engineer,'Логистика',1, false)), 5);
$vector->addStaffUnitInDep((new Employee($manager,'Логистика',1, true)), 1);


?>

<table>
    <tr><th>Департамент</th><th>сотр.</th><th>тугр.</th><th>кофе</th><th>стр.</th><th>тугр./стр.</th></tr>
    <? foreach ($vector->deps as $dep): ?>
    <tr>
        <td><?=$dep->depName ?></td>
        <td><?=$dep->employeesAmount() ?></td>
        <td><?=$dep->salaryCount() ?></td>
        <td><?=$dep->coffeeCount()?></td>
        <td><?=$dep->docPagesCount()?></td>
        <td><?=$dep->averageMoneyPerDocPage()?></td>
    </tr>
    <? endforeach; ?>
    <tr>
    <td>Всего</td>
    <td><?=$vector->getTotalEmployeeAmount() ?></td>
    <td><?=$vector->getTotalSalaryFund() ?></td>
    <td><?=$vector->getTotalCoffeeConsumption()?></td>
    <td><?=$vector->getTotalDocPagesProduction()?></td>
    <td><?=$vector->getTotalAverageMoneyPerDocPage()?></td>
    </tr>
</table>
