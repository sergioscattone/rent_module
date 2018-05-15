<?php

namespace rent_bikes;

class bike
{
    private $id;
    private $is_taken_for;
    
    public function take($minutes){
        $this->is_taken_for = $minutes;
    }
}
