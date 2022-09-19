<?php

namespace BrainGames\Games\Gcd;

const GAME_DESCRIPTION = 'Find the greatest common divisor of given numbers.';

function isRightAnswer($question, $answer): bool
{
    return (int) $answer === getRightAnswer($question);
}

function getRightAnswer($question): int
{
    [$firstNum, $secondNum] = explode(' ', $question);

    return findGreatestCommonDivisor($firstNum, $secondNum);
}

function findGreatestCommonDivisor($firstNum, $secondNum)
{
    if ($firstNum > $secondNum) {
        $num = $firstNum;
        $del = $secondNum;
    } else {
        $num = $secondNum;
        $del = $firstNum;
    }

    $result = $num % $del;

    return $result === 0
        ? $del
        : findGreatestCommonDivisor($del, $result);
}

function getQuestion(): string
{
    $firstNum = random_int(1, 500);
    $secondNum = random_int(1, 500);

    return "{$firstNum} {$secondNum}";
}

function getGameDescription(): string
{
    return GAME_DESCRIPTION;
}
