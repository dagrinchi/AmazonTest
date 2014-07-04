<?php

// Question 2:
// B. Given a directed graph, design an algorithm to find whether there is a route
// between two Items

/**
 * This class is a Item
 * @author  David Almeciga <wdavid@dagrinchi.com>
 */
class Item {

	private $itemID;
    private $left;
	private $right;

	/**
     * @param String $itemID
     */
    public function __construct($itemID) {
        $this->itemID = $itemID;
        $this->left = null;
        $this->right = null;
    }

    /** 
     * @return String $itemID
     */
    public function getItemID() {
        return $this->itemID;
    }

    /**
     * @param Item $left
     * @return Item $left
     */
    public function setLeft($left) {
        return $this->left = $left;
    }

    /**
     * @param Item $right
     * @return Item $right
     */
    public function setRight($right) {
        return $this->right = $right;
    }

    /**
     * @return Item $left
     */
    public function getLeft() {
        return $this->left;
    }

    /**
     * @return Item $right
     */
    public function getRight() {
        return $this->right;
    }
}

/**
 * This class is a Graph
 * @author  David Almeciga <wdavid@dagrinchi.com>
 */
class Graph {

	private $root;

    /**
     * @param Item $root
     * @return Item $root
     */
    public function setRoot($root) {
        return $this->root = $root;
    }

    /**
     * @return Item $root
     */
    public function getRoot() {
        return $this->root;
    }

}

/**
 * This class is a Route calculator
 * @author  David Almeciga <wdavid@dagrinchi.com>
 */
class Route {

	private $graph;

    private $route;
	
	/**
	 * @param Graph $graph
	 */
	public function __construct($graph) {
		$this->graph = $graph;
        $this->route = array();
	}

	/**
 	 * @param String $start
	 * @param String $end
	 */
	public function trace($start, $end) {
		if ($this->_trace($this->graph->getRoot(), $start, $end)) {
            print("The route is " . "\n");
            $i=1;
            foreach ($this->route as $step) {
                print("Step " . $i . " >>> " . $step->getItemID() . "\n");
                $i++;
            }
        } else {
            print("Sorry!, The route does not exits!" . "\n");
        }
	}

    private function _trace($root, $start, $end) {
        $startNode = new Item($start);
        $endNode = new Item($end);

        $queue = new SplQueue();        
        $queue->enqueue($root);

        while ($queue->count() > 0) {

            $node = $queue->dequeue();
            $this->route[] = $node;
            
            if ($node->getItemID() === $endNode->getItemID()) {
                return true;
            }           
                        
            if ($node->getLeft() !== null) {
                $queue->enqueue($node->getLeft());
            }           
            
            if ($node->getRight() !== null) {
                $queue->enqueue($node->getRight());
            }           

        }

        return false;
    }
}

$graph = new Graph();
$a = $graph->setRoot(new Item("A"));
$b = $a->setLeft(new Item("B"));
$c = $a->setRight(new Item("C"));
$d = $b->setLeft(new Item("D"));
$e = $b->setRight(new Item("E"));
$f = $c->setRight(new Item("F"));
$g = $e->setLeft(new Item("G"));

$route = new Route($graph);
$route->trace("A", "B");