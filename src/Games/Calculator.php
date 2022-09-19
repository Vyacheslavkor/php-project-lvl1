<?php

namespace BrainGames\Games\Calculator;

const GAME_DESCRIPTION = 'What is the result of the expression?';

function isRightAnswer(string $question, string $answer): bool
{
    return (int) $answer === getRightAnswer($question);
}

function getRightAnswer(string $question): int
{
    [$firstNum, $sign, $secondNum] = explode(' ', $question);

    if ($sign === '*') {
        return (int) $firstNum * (int) $secondNum;
    }

    if ($sign === '+') {
        return (int) $firstNum + (int) $secondNum;
    }

    return (int) $firstNum - (int) $secondNum;
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
