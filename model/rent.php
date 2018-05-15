<?php

namespace rent_bikes;

class rent
{
    private $id;
    private $bike;
    private $cost;
    
    private function do_rent(int $minutes, int $cost)
    {
        $bike = new bike();
        $bike->take($minutes);
        $this->bike = $bike;
        $this->cost = $cost;
    }
    
    public function rent_by_hour()
    {
        $this->do_rent(60, 5);// @TODO: load de cost from DB
    }
    
    public function rent_by_day()
    {
        $this->do_rent(60*24, 20);// @TODO: load de cost from DB
    }
    
    public function rent_by_week()
    {
        $this->do_rent(60*24*7, 60);// @TODO: load de cost from DB
    }
    
    public function get_cost(){
        return $this->cost;
    }
}