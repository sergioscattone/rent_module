<?php

namespace rent_bikes;

class rent_manager implements iPromotions
{
    private $rents = null;
    private $min_cant_prom = 3;// @TODO: load the value from database configuration table
    private $max_cant_prom = 5;// @TODO: load the value from database configuration table
    
    public function __contstruct($min_cant_prom = null, $max_cant_prom = null)
    {
        if (!is_null($min_cant_prom)){
            $this->min_cant_prom = $min_cant_prom;
        }
        
        if (!is_null($max_cant_prom)){
            $this->min_cant_prom = $max_cant_prom;
        }
    }
    
    public function rent($mode = 'hour')
    {
        $rent = new rent();
        switch ($mode) {
            case 'week':
                $rent->rent_by_week();
                break;
            case 'day':
                $rent->rent_by_day();
                break;
            case 'hour':
            default :
                $rent->rent_by_hour();
                break;
        }
        $this->rents[] = $rent;
    }
    
    public function get_rents()
    {
        return $this->rents;
    }


    public function family_rental()
    {
        if (!$this->apply_for_family_promotion()) {
            throw new Exception('This promotion only apply having taken '.$this->min_cant_prom.' to '.$this->max_cant_prom.' rents.');
        }
        return $this->get_total_cost() * 0.7;// @TODO: load the % of discount from database configuration table 
    }
    
    public function apply_for_family_promotion() {
        $cant_rents = count($this->rents);
        return ($cant_rents < $this->min_cant_prom || $cant_rents > $this->max_cant_prom);
    }
    
    public function get_total_cost()
    {
        $total_cost = 0;
        foreach ($this->rents as $rent) {
            $total_cost += $rent->get_cost();
        }
        return $total_cost;
    }
}