<?php

declare(strict_types = 1);

namespace Tests\Other;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AutoMowerTest extends WebTestCase {
    /**
     * Using a file or not for the input
     */
    const FILE = true;
    /**
    * in order of clock
    */
    const ORIENTATION = [
        'N' => ['y' => 1, 'x' => 0],
        'E' => ['y' => 0, 'x' => 1],
        'S' => ['y' => -1, 'x' => 0],
        'W' => ['y' => 0, 'x' => -1]
    ];
    /**
     * Operation on the pointer
     */
    const MOVE = ['G' => "prev", 'D' => "next", 'A' => "current"];

    /**
     * Position of the mower
     * @var stdClass
     */
    private $_position;
    private $_grid;
    private $_mower = [];

    private $_test = [
        '{"x":1,"y":3,"o":"N","mower":1}',
        '{"x":5,"y":1,"o":"E","mower":2}',
        '{"x":0,"y":2,"o":"N","mower":3}'
    ];

    public function testMoving()
    {
        $raw = $this->_getInput(__DIR__.DIRECTORY_SEPARATOR."mowerInput.txt");
        $this->grid = (object) ['x' => $raw[0][0], 'y' => $raw[0][1]];

        $or = self::ORIENTATION;
        $len = count($raw);
        //mower first id
        $m = 1;
        for ($i=1; $i < $len; $i++) {
            $current = $raw[$i];
            if($i%2 === 0) {
                //reset pointer
                reset($or);
                // Set the pointer to the current position
                while (key($or) !== $this->_position->o) next($or);
                $this->_execute($current, $or);
                $this->_mower[$m] = $this->_position;
                // Here communication of the position: socket_write/echo ...
                echo json_encode($this->_position).PHP_EOL;
                //bonjour assertion
                $this->assertEquals(current($this->_test), json_encode($this->_position));
                next($this->_test);
            } else {
                $this->_position =
                    (object) [
                        'x' => $current[0],
                        'y' => $current[1],
                        'o' => $current[2],
                        'mower' => $m++
                    ];
            }
        }

    }

    /**
     * all position communication
     * @return stdClass position
     */
    public function __toString()
    {
        return $this->_mower;
    }

    /**
     * get the input file content
     * @param  string $filePath the path of the file
     * @return array           content of the file
     */
    private function _getInput(string $filePath = "")
    : array
    {
        if(self::FILE) {
            $raw = explode(PHP_EOL,file_get_contents($filePath));
            if(empty($raw[count($raw)-1])) array_pop($raw);
        } else {
            /*$raw = [
            * 66,
            * 32W,
            * DAAGDAAADG,
            * ...
            * ]
            */
        }
        return $raw;
    }

    /**
     * Execute the operation list
     * @param  int $mower       the mowerId
     * @param  string $instruction all instruction
     * @param array &$or all orientation
     */
    private function _execute(string $instruction, array &$or)
    {
        $len = strlen($instruction);
        for ($i=0; $i < $len; $i++) {
            $current = $instruction[$i];
            if($current == "A") {
                $ope = current($or);
                if($this->_borderChecking($ope)) {
                    $this->_position->x += $ope['x'];
                    $this->_position->y += $ope['y'];
                    $this->_position->o = key($or);
                }
            } else {
                $this->_manageOrientation($current, $or);
            }
        }
        //always unset reference
        unset($or);
    }
    /**
     * manage the pointer orientation
     * @param  string $inst [description]
     * @param  array &$or   [description]
     */
    private function _manageOrientation(string $inst, array &$or)
    {
        $key = key($or);
        if(!self::MOVE[$inst]($or)){
            if($key === 'N') end($or);
            else reset($or);
        }
    }

    private function _borderChecking(array $operation)
    : bool
    {
        $x = $this->_position->x + $operation['x'];
        $y = $this->_position->y + $operation['y'];
        return !(($x > $this->grid->x || $y > $this->grid->y) || ($x < 0 || $y < 0));
    }
}
