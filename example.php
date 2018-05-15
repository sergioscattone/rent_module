<?php

namespace rent_bikes;

try {
    echo "Sample of Rental bikes module: ";

    echo "1.- Create the rental manager";
    $manager = new rent_manager();

    echo "2.- Create a daily rental";
    $manager->rent('day');

    echo "3.- Create a week rental";
    $manager->rent('week');

    echo "4.- Create a hour rental";
    $manager->rent('hour');

    echo "5.- Ask total cost";
    $manager->get_total_cost();

    echo "6.- Total cost after apply family discount";
    if ($manager->apply_for_family_promotion()) {
        $manager->family_rental();
    }
    
    echo "7.- Get all rents made so far";
    $rents = $manager->get_rents();
    foreach ($rents as $rent) {
        echo $rent->bike->id.': taken for '.$rent->bike->is_taken_for.' - cost '.$rent->cost;
    }
} catch (Exception $e) {
    echo "There was an error tring to make this example code. Details below:";
    echo $e->getMessage();
}