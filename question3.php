<?php

// Question 3:
// A tree is balanced when:
// 1)	The left and right subtrees' heights differ by at most one, AND
// 2)	The left subtree is balanced, AND
// 3)	The right subtree is balanced
// Please Implement checkIfTreeIsBalanced method

/**
 * This class is a Node
 * @author  David Almeciga <wdavid@dagrinchi.com>
 */
class Node {

    public $nodeID;
    public $left;
    public $right;

    /**
     * @param String $nodeID
     */
    public function __construct($nodeID) {
        $this->nodeID = $nodeID;
        $this->left = null;
        $this->right = null;
    }

    /**
     * @param Node $left
     * @return Node $left
     */
    public function setLeft($left) {
        return $this->left = $left;
    }

    /**
     * @param Node $right
     * @return Node $right
     */
    public function setRight($right) {
        return $this->right = $right;
    }

    /**
     * @return Node $left
     */
    public function getLeft() {
        return $this->left;
    }

    /**
     * @return Node $right
     */
    public function getRight() {
        return $this->right;
    }

}

/**
 * This class is a Tree
 * @author  David Almeciga <wdavid@dagrinchi.com>
 */
class Tree {

    private $root;
    private $height;

    public function __construct() {
        $this->root = null;
        $this->height = 0;
    }

    /**
     * @param Node $root
     * @return Node $root
     */
    public function setRoot($root) {
        return $this->root = $root;
    }

    /**
     * @return String $isBalanced
     */
    public function checkIfTreeIsBalanced() {
    	$isBalanced = "";
        if ($this->isBalanced($this->root, $this->height)) {
            $isBalanced = "Yeap, the tree is balanced. \n";
        } else {
        	$isBalanced = "Nop, the tree is not balanced. \n";
        }
        return $isBalanced;
    }

    /**
     * @param Node $node
     * @param int $height
     * @return Boolean
     */
    private function isBalanced($node, &$height) {

    	// Initialize heights
        $leftHeight = 0;
        $rightHeight = 0;

        $left = false;
        $right = false;

        // Check if the node is empty
        if ($node === null) {
            return true;
        } else {

        	// Get true or false if left or right are balanced
            $left = $this->isBalanced($node->getLeft(), $leftHeight);
            $right = $this->isBalanced($node->getRight(), $rightHeight);

            // Count the height
            if ($leftHeight > $rightHeight) {
                $height = $leftHeight + 1;
            } else {
                $height = $rightHeight + 1;
            }

            // Validate if the left height to right height or vice versa differ by max one
            if ($leftHeight - $rightHeight >= 2 || $rightHeight - $leftHeight >= 2) {
                return false;
            } else {
                return $left === $right;
            }
        }
    }

}

// Test tree1
$tree1 = new Tree();
$a1 = $tree1->setRoot(new Node("A"));
$b1 = $a1->setLeft(new Node("B"));
$c1 = $a1->setRight(new Node("C"));
$d1 = $b1->setLeft(new Node("D"));
$e1 = $b1->setRight(new Node("E"));
$f1 = $c1->setRight(new Node("F"));
$g1 = $e1->setLeft(new Node("G"));

print("TREE1 >>> " . $tree1->checkIfTreeIsBalanced());

// Test tree2
$tree2 = new Tree();
$a2 = $tree2->setRoot(new Node("A"));
$b2 = $a2->setLeft(new Node("B"));
$c2 = $a2->setRight(new Node("C"));
$d2 = $b2->setLeft(new Node("D"));
$e2 = $b2->setRight(new Node("E"));
$f2 = $c2->setLeft(new Node("F"));
$g2 = $c2->setRight(new Node("G"));
$h2 = $d2->setLeft(new Node("H"));
$i2 = $d2->setRight(new Node("I"));
$j2 = $e2->setRight(new Node("J"));
$k2 = $i2->setLeft(new Node("K"));
$l2 = $j2->setLeft(new Node("L"));

print("TREE2 >>> " . $tree2->checkIfTreeIsBalanced());