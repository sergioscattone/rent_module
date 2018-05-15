<?php

namespace rent_bikes;

class test_cases extends TestCase // presumes library installed
{
    public function rent_for_hour()
    {
        $rent = new rent();
        $rent->rent_by_hour();
        $bike_db = ORM::factory('bike', $rent->bike->id);
        $this->assertEquals($bike_db->is_taken_for, 60);
        $rent_db = ORM::factory('rent', $rent->id);
        $this->assertEquals($rent_db->cost, 5);
    }
    
    public function rent_for_day()
    {
        $rent = new rent();
        $rent->rent_by_day();
        $bike_db = ORM::factory('bike', $rent->bike->id);
        $this->assertEquals($bike_db->is_taken_for, 60*24);
        $rent_db = ORM::factory('rent', $rent->id);
        $this->assertEquals($rent_db->cost, 20);
    }
    
    public function rent_for_week()
    {
        $rent = new rent();
        $rent->rent_by_week();
        $bike_db = ORM::factory('bike', $rent->bike->id);
        $this->assertEquals($bike_db->is_taken_for, 60*24*7);
        $rent_db = ORM::factory('rent', $rent->id);
        $this->assertEquals($rent_db->cost, 60);
    }
    
    public function rent_manager_for_hour()
    {
        $manager = new rent_manager();
        $manager->rent('hour');
        $rents = $manager->get_rents();
        $bike_db = ORM::factory('bike', $rents[0]->bike->id);
        $this->assertEquals($bike_db->is_taken_for, 60);
        $rent_db = ORM::factory('rent', $rents[0]->id);
        $this->assertEquals($rent_db->cost, 5);
    }
    
    public function rent_manager_for_day()
    {
        $manager = new rent_manager();
        $manager->rent('day');
        $rents = $manager->get_rents();
        $bike_db = ORM::factory('bike', $rents[0]->bike->id);
        $this->assertEquals($bike_db->is_taken_for, 60*24);
        $rent_db = ORM::factory('rent', $rents[0]->id);
        $this->assertEquals($rent_db->cost, 20);
    }
    
    public function rent_manager_for_week()
    {
        $manager = new rent_manager();
        $manager->rent('week');
        $rents = $manager->get_rents();
        $bike_db = ORM::factory('bike', $rents[0]->bike->id);
        $this->assertEquals($bike_db->is_taken_for, 60*24*7);
        $rent_db = ORM::factory('rent', $rents[0]->id);
        $this->assertEquals($rent_db->cost, 60);
    }
    
    public function family_rental()
    {
        $manager = new rent_manager();
        $manager->rent('week');
        $manager->rent('day');
        $manager->rent('hour');
        $total_cost = $manager->get_total_cost();
        $discount_cost = $manager->family_rental();
        $this->assertEquals($total_cost * 0.7, $discount_cost);
    }
}