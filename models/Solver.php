<?php

namespace app\models;

use yii\base\InvalidParamException;

/**
 * Вычисляет результат простейшей арифметической операции между двумя числами.
 * Class Solver
 * @package app\models
 */
class Solver
{
    /**
     * Вычислить результат математической операции, записанной в строку
     * @param string $expression
     * @return mixed
     */
    public function solve($expression)
    {
        $expression = trim($expression);

        if(preg_match('/(\d+)(?:\s*)([\+\-\*\/])(?:\s*)(\d+)/', $expression, $matches) !== false){
            $operator = $matches[2];

            switch($operator){
                case '+':
                    return $matches[1] + $matches[3];
                case '-':
                    return $matches[1] - $matches[3];
                case '*':
                    return $matches[1] * $matches[3];
                case '/':
                    return $matches[1] / $matches[3];
            }
        }

        throw new InvalidParamException('Can\'t parse this expression');
    }
}
