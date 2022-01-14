<?php

class Profession
{
    public string $title;
    public int $baseRate;
    public int $coffeeConsumption;
    public int $docPagesProduction;

    public function __construct($title, $baseRate, $coffeeConsumption, $docPagesProduction)
    {
        $this->title = $title;
        $this->baseRate = $baseRate;
        $this->coffeeConsumption = $coffeeConsumption;
        $this->docPagesProduction = $docPagesProduction;
    }
    public function setBaseRate(float $rate){}
    public function setCoffeeConsumption(int $consumption){}
    public function setDocPagesProduction(int $docPages){}

}


class Employee
{
    public string $department; //string
    public int $rang; //int
    public bool $is_boss; //bool
    public Profession $profession;

    public function __construct(Profession $profession, $department, $rang, $is_boss)
    {
        $this->profession = $profession;
        $this->department = $department;
        $this->rang = $rang;
        $this->is_boss = $is_boss;
    }

    public function calculateSalary(){
        $baseRate = $this->profession->baseRate;
        $a = 1; $b = 1;

        if($this->is_boss === true){
            $a = 1.5;
        }
        switch ($this->rang){
            case 1: $b = 1; break;
            case 2: $b = 1.25; break;
            case 3: $b = 1.5; break;
        }

        return $baseRate * $a * $b;
    }

    public function calculateCoffee(){
        $coffeeConsumption = $this->profession->coffeeConsumption;
        if ($this->is_boss === true){
            $coffeeConsumption = $coffeeConsumption * 2;
        }
        return $coffeeConsumption;
    }

    public function calculateDocPages(){
        $docPagesProduction = $this->profession->docPagesProduction;
        if ($this->is_boss === true){
            $docPagesProduction = 0;
        }
        return $docPagesProduction;
    }
}
class Department
{
    public string $depName;
    public array $staffing = []; //как создать массив объектов?

    public function __construct(string $name){
        $this->depName = $name;
    }

    public function addStaffUnit(Employee $employee, int $amount)
    {
         $this->staffing[] = ['employee'=>$employee, 'amount' => $amount];
    }

    public function employeesAmount() : int
    {
        $amount = 0;
        foreach ($this->staffing as $staffUnit){
          $amount +=  $staffUnit['amount'];
        }
        return $amount;
    }

    public function salaryCount() : float
    {
        $salaryFund = 0;
        foreach ($this->staffing as $staffUnit){
            $salaryFund += $staffUnit['amount'] * $staffUnit['employee']->calculateSalary();
        }
        return $salaryFund;
    }

    public function coffeeCount() : float
    {
        $coffeeFund = 0;
        foreach ($this->staffing as $staffUnit){
            $coffeeFund += $staffUnit['amount'] * $staffUnit['employee']->calculateCoffee();
        }
        return $coffeeFund;
    }

    public function averageMoneyPerDocPage() : float
    {
        $docPages = 0;
        foreach ($this->staffing as $staffUnit){
            $docPages += $staffUnit['amount'] * $staffUnit['employee']->calculateDocPages();
        }
        $salaryFund = $this->salaryCount();
        return round($salaryFund/$docPages,1);
    }

    public function docPagesCount() : int{
        $docPages= 0;
        foreach ($this->staffing as $staffUnit){
            $docPages += $staffUnit['amount'] * $staffUnit['employee']->calculateDocPages();
        }
        return $docPages;
    }

}

class Company
{
    public $deps = [];


    public  function addDep($depName){
        $this->deps[$depName] = new Department($depName);
    }
    public function addStaffUnitInDep (Employee $employee, int $amount){
        $depName = $employee->department;
        if (!empty($this->deps[$depName])) {
            $this->deps[$depName]->staffing[] = ['employee' => $employee, 'amount' => $amount];
        }
        else {
            echo 'Такой департамент не существует!';
            //exit;
        }
}

    public function getTotalEmployeeAmount(): int{
        $empAmount = 0;
        foreach ($this->deps as $dep){
            $empAmount += $dep->employeesAmount();
        }
        return $empAmount;
    }
    public function getTotalSalaryFund() : float {
        $totalSalary = 0;
        foreach ($this->deps as $dep){
            $totalSalary += $dep->salaryCount();
        }
        return $totalSalary;
    }
    public function getTotalCoffeeConsumption() : int {
        $totalCoffee = 0;
        foreach ($this->deps as $dep){
            $totalCoffee += $dep->coffeeCount();
        }
        return $totalCoffee;
    }
    public function getTotalDocPagesProduction() : int {
        $totalDocPages = 0;
        foreach ($this->deps as $dep){
            $totalDocPages += $dep->docPagesCount();
        }
        return $totalDocPages;
    }
    public function getTotalAverageMoneyPerDocPage() : float {
        $docPages = $this->getTotalDocPagesProduction();
        $salaryFund = $this->getTotalSalaryFund();
        return round($salaryFund/$docPages,1);
    }


}