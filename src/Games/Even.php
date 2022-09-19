<?php

namespace BrainGames\Games\Even;

const ANSWER_YES = 'yes';
const ANSWER_NO = 'no';

function isRightAnswer($num, $answer): bool
{
    return $answer === getRightAnswer($num);
}

function getRightAnswer(int $num): string
{
    return isEven($num) ? ANSWER_YES : ANSWER_NO;
}

function isEven(int $num): bool
{
    return $num % 2 === 0;
}

function getQuestion(): int
{
    return random_int(1, 500);
}
