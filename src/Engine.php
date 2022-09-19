<?php

use function cli\line;
use function cli\prompt;

const MAX_ROUNDS = 3;

function run(string $gameName)
{
    line('Welcome to the Brain Games!');
    $userName = prompt('May I have your name?');
    line("Hello, %s!", $userName);

    $gameDescription = getGameDescription($gameName);
    if (is_null($gameDescription)) {
        line('ERROR');
        exit;
    }

    line($gameDescription);

    for ($round = 1; $round <= MAX_ROUNDS; $round++) {
        $question = getQuestion($gameName);

        if (is_null($question)) {
            line('ERROR');
            exit;
        }

        $answer = prompt("Question: {$question}");
        line("Your answer: %s", $answer);
        if (!isRightAnswer($gameName, $question, $answer)) {
            $rightAnswer = getRightAnswer($gameName, $question);
            if (is_null($rightAnswer)) {
                line('ERROR');
                exit;
            }

            line("'%s' is wrong answer ;(. Correct answer was '%s'.", $answer, $rightAnswer);
            line('Let\'s try again, %s!', $userName);
            exit();
        }

        line('Correct!');
    }

    line("Congratulations, %s!", $userName);
}

function getQuestion(string $gameName)
{
    $function = "\\BrainGames\\Games\\{$gameName}\\getQuestion";

    if (is_callable($function)) {
        return $function();
    }

    return null;
}

function getRightAnswer(string $gameName, string $question)
{
    $function = "\\BrainGames\\Games\\{$gameName}\\getRightAnswer";
    if (is_callable($function)) {
        return $function($question);
    }

    return null;
}

function isRightAnswer(string $gameName, string $question, string $answer): bool
{
    $function = "\\BrainGames\\Games\\{$gameName}\\isRightAnswer";
    if (is_callable($function)) {
        return $function($question, $answer);
    }

    return false;
}

function getGameDescription(string $gameName)
{
    $function = "\\BrainGames\\Games\\{$gameName}\\getGameDescription";
    if (is_callable($function)) {
        return $function();
    }

    return null;
}
