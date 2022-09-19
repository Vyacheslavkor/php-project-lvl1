<?php

use function cli\line;
use function cli\prompt;

const MAX_ROUNDS = 3;

function run(string $gameName)
{
    line('Welcome to the Brain Games!');
    $userName = prompt('May I have your name?');
    line("Hello, %s!", $userName);

    line(getGameDescription($gameName));

    for ($round = 1; $round <= MAX_ROUNDS; $round++) {
        $question = getQuestion($gameName);
        $answer = prompt("Question: {$question}");
        line("Your answer: %s", $answer);
        if (!isRightAnswer($gameName, $question, $answer)) {
            line("'%s' is wrong answer ;(. Correct answer was '%s'.", $answer, getRightAnswer($gameName, $question));
            line('Let\'s try again, %s!', $userName);
            exit();
        }

        line('Correct!');
    }

    line("Congratulations, %s!", $userName);
}

function getQuestion(string $gameName): string
{
    $function = "\\BrainGames\\Games\\{$gameName}\\getQuestion";
    return $function();
}

function getRightAnswer(string $gameName, string $question): string
{
    $function = "\\BrainGames\\Games\\{$gameName}\\getRightAnswer";
    return $function($question);
}

function isRightAnswer(string $gameName, string $question, string $answer): bool
{
    $function = "\\BrainGames\\Games\\{$gameName}\\isRightAnswer";
    return $function($question, $answer);
}

function getGameDescription(string $gameName): string
{
    $function = "\\BrainGames\\Games\\{$gameName}\\getGameDescription";
    return $function();
}
