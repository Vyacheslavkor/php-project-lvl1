<?php

namespace BrainGames\Even;

use function cli\line;
use function cli\prompt;

const MAX_ROUNDS = 3;
const ANSWER_YES = 'yes';
const ANSWER_NO = 'no';

function game()
{
    line('Welcome to the Brain Games!');
    $userName = prompt('May I have your name?');
    line("Hello, %s!", $userName);

    line('Answer "yes" if the number is even, otherwise answer "no".');

    for ($round = 1; $round <= MAX_ROUNDS; $round++) {
        $num = random_int(1, 500);
        $answer = prompt("Question: {$num}");
        line("Your answer: %s", $answer);
        if (!isRightAnswer($num, $answer)) {
            line("'%s' is wrong answer ;(. Correct answer was '%s'.", $answer, getRightAnswer($num));
            exit();
        }

        line('Correct!');
    }

    line("Congratulations, %s!", $userName);
}

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
