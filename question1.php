<?php

// Question 1:
// Implement a data structure SetOfStacks, should be composed of several stacks,
// and should create a new stack once the previous one exceeds some threshold of capacity.
// SetOfStacks push() and SetOfStacks pop() should behave identically to a single stack 

/**
 * This class is a Item
 * @author  David Almeciga <wdavid@dagrinchi.com>
 */
class Item {

    private $itemID;
    private $itemName;

    /**
     * Construct the class
     * @param String $itemID
     * @param String $itemName
     */
    public function __construct($itemID, $itemName) {
        $this->itemID = $itemID;
        $this->itemName = $itemName;
    }

}

/**
 * This class is a Stack collection
 * @author  David Almeciga <wdavid@dagrinchi.com>
 */
class Stack {

    private $stackID;

    /**
     * Collection of items
     */
    private $items;
    private $capacity;

    /**
     * Construct the class
     * @param String $stackID
     * @param int $capacity
     */
    public function __construct($stackID, $capacity) {
        $this->stackID = $stackID;
        $this->capacity = $capacity;
    }

    /**
     * Push a new item to collection
     * @param String $itemID
     * @param String $itemName
     */
    public function push($itemID, $itemName) {
        $item = new Item($itemID, $itemName);
        $this->add($item);  
    }

    /**
     * Pop the last item
     */
    public function pop() {
        array_pop($this->items);
    }

    /**
     * Add the item
     * @param Item $item
     */
    public function add($item) {
        $this->items[] = $item;
    }

    /**
     * @return Boolean $isEmpty
     */
    public function isEmpty() {
        return !$this->items;
    }

    /**
     * Check if the current stack is full capacity
     * @return Boolean $isFull
     */
    public function isFull() {
        return count($this->items) == $this->capacity;
    }

}

/**
 * This class is a main app SetOfStacks, collection of stacks
 * @author  David Almeciga <wdavid@dagrinchi.com>
 */
class SetOfStacks {

    /**
     * Collection of stacks
     */
    private $stacks;
    private $capacity;

    /**
     * Construct the class
     * @param int $capacity
     */
    public function __construct($capacity) {
        $this->capacity = $capacity;
    }

    /**
     * Push a new stack to set of stacks
     * @param String $itemID
     * @param String $itemName
     */
    public function push($itemID, $itemName) {
        // Check if a new stack or current stack
        if ($this->isEmpty()) {
            // Create a new stack
            $stack = new Stack(uniqid(), $this->capacity);            
            $stack->push($itemID, $itemName);
            $this->add($stack);
        } else {
            // Get the last stack
            $stack = $this->last();
            // Check if the current stack is full capacity
            if ($stack->isFull()) {
                // print($itemName . " >> The stack is full! \n");

                // Create a new stack
                $stack = new Stack(uniqid(), $this->capacity);            
                $stack->push($itemID, $itemName);
                $this->add($stack);
            } else {
                $stack->push($itemID, $itemName);
            }
        }
    }

    /**
     * Pop the last item
     */
    public function pop() {
        // Check if empty the set of stacks
        if (!$this->isEmpty()) {
            // Get the last stack
            $stack = $this->last();            
            // Get if the last stack is empty
            if (!$stack->isEmpty()) {
                $stack->pop();                
            } else {
                array_pop($this->stacks);
            }
        }        
    }

    /**
     * Add the stack
     * @param Stack $stack
     */
    public function add($stack) {
        $this->stacks[] = $stack;
    }

    /**
     * @return Boolean $isEmpty
     */
    public function isEmpty() {
        return !$this->stacks;
    }

    /**
     * @return Stack $stack
     */
    public function last() {
        return end($this->stacks);
    }

}
