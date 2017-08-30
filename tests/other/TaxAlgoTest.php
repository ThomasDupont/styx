<?php

namespace Tests\Other;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TaxAlgoTest extends WebTestCase
{
    const RATES = [
        0.05,
        0.15,
        0.25,
        0.30,
    ];
    const LEVELS = [
        50,
        250,
        500
    ];

    public function testTaxCalculation()
    {
        $income1 = 75000000;
        $this->assertEquals(6250000, $this->_calcul($income1));
        $income2 = 750000000;
        $this->assertEquals(170000000, $this->_calcul($income2));
    }

    /**
     * Tax calculation Algo, base on constante put in configuration
     * @param  int $income The amount to calculate
     * @return float         The amount of tax
     */
    private function _calcul($income) {
        $income /= 1000000;
        $tax = 0;
        $levelsGood = $this->_getLevel($income);
		$len = count($levelsGood);
        for ($j = 0; $j < $len; $j++) {
            $tax += ($levelsGood[$j] - ($j > 0 ? $levelsGood[$j - 1] : 0)) * self::RATES[$j];
        }
        $tax += ($income - ($j > 0 ? $levelsGood[$j - 1] : 0)) * self::RATES[$len];
        return $tax*1000000;
    }

    /**
     * Get the level of the calculation
     * @param  int $income The amount to calculate
     * @return array         array of level
     */
    private function _getLevel($income) {

        $levelsGood = [];
		$len = count(self::LEVELS);
        for ($j = 0; $j < $len; $j++) {
            $el = self::LEVELS[$j];
            if ($el > $income)
                break;
            $levelsGood[] = $el;
        }
        return $levelsGood;
    }
}
