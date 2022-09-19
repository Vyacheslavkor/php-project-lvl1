<?php

namespace BrainGames\Games\Calculator;

const GAME_DESCRIPTION = 'What is the result of the expression?';

function isRightAnswer($question, $answer): bool
{
    return (int) $answer === getRightAnswer($question);
}

function getRightAnswer($question): int
{
    [$firstNum, $sign, $secondNum] = explode(' ', $question);

    if ($sign === '*') {
        return $firstNum * $secondNum;
    }

    if ($sign === '+') {
        return $firstNum + $secondNum;
    }

    return $firstNum - $secondNum;
}

function getQuestion(): string
{
    $firstNum = random_int(1, 500);
    $secondNum = random_int(1, 500);
    $sign = getSign();

    return "{$firstNum} {$sign} {$secondNum}";
}

function getSign(): string
{
    $signs = ['*', '+', '-'];
    $key = array_rand($signs);
    return $signs[$key];
}

function getGameDescription(): string
{
    return GAME_DESCRIPTION;
}
