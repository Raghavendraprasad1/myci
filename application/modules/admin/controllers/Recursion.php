<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Recursion extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
    }

    public $i = 0;
    function first_recursion_program()
    {
        while ($this->i < 5) {
            $this->i++;
            echo "raghav" . $this->i;
            $this->first_recursion_program();
        }
    }

    function get_factorial($num)
    { 
        if ($num == 0 || $num == 1) {
            // echo "raghav if";
            return 1;
        }
        elseif($num > 0) {
            // echo "raghav else </br>";
            return $num * $this->get_factorial($num - 1);
      }
    }

    function get_factorial_nextfn()
    {
        echo "Factorial of number is : ".$this->get_factorial(5)."</br>";
         $this->number_display(1);
    }

    
    function number_display($num)
    {
        if($num<5)
        {
            echo "</br>$num </br>";
            $this->number_display($num+1);
        }
    }
}
