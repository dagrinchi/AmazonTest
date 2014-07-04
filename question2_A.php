<?php

// Question 2:
// A. You are asked to stack boxes to form a tower. For practical and safety reasons,
// each box must be smaller and lighter than the box below of it.
// Using the height and weight of each box as an input, write a method to compute
// the largest possible number of boxes in such a tower.

/**
 * This class is a Box object
 * @author  David Almeciga <wdavid@dagrinchi.com>
 */
class Box {

    private $height;
    private $weight;

    /**
     * @param $height
     * @param $weight
     */
    public function __construct($height, $weight) {
        $this->height = $height;
        $this->weight = $weight;
    }

    public function getHeight() {
        return $this->height;
    }

    public function getWeight() {
        return $this->weight;
    }

}

/**
 * This class is a Tower object
 * @author  David Almeciga <wdavid@dagrinchi.com>
 */
class Tower {

    private $boxes;

    public function add($box) {
        $this->boxes[] = $box;
        $this->onAdd();
    }

    private function onAdd() {
        usort($this->boxes, array("Tower", "order"));
    }

    static function order($a, $b) {
        if ($a->getHeight() > $b->getHeight() && $a->getWeight() > $b->getWeight()) {
            return +1;
        } else if ($a->getHeight() < $b->getHeight() && $a->getWeight() < $b->getWeight()) {
            return -1;
        }
    }

}

$tower = new Tower();
$tower->add(new Box(7, 9));
$tower->add(new Box(2, 2));
$tower->add(new Box(30, 20));
$tower->add(new Box(43, 50));
$tower->add(new Box(11, 12));
$tower->add(new Box(25, 13));
$tower->add(new Box(8, 10));
$tower->add(new Box(10, 15));


print($tower->count() . "\n");
