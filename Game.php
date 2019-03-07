<?php

class Game
{
    private $dice;
    private $position = 1;
    private $stepTime = 1;

    /**
     * Set step wait time
     * @param int $time
     */
    public function setStepTime(int $time)
    {
        $this->stepTime = $time;
    }

    /**
     * process the game
     */
    public function start()
    {
        do {
            $this->roll();
            $stop = $this->step();

            echo $this->dice . "-";
            if ($this->checkSnake()) {
                echo 'snake';
            }
            if ($this->checkLadder()) {
                echo 'ladder';
            }
            echo $this->position . PHP_EOL;

            sleep($this->stepTime);
        } while (!$stop);
    }

    /**
     * roll dice
     */
    public function roll()
    {
        $this->dice = rand(1, 6);
    }

    /**
     * Add position
     * @return bool
     */
    public function step()
    {
        $prevPosition = $this->position;
        $this->position += $this->dice;
        if ($this->position == 100) {
            return true;
        }
        if ($this->position > 100) {
            $this->position = $prevPosition;
            return false;
        }
        return false;
    }

    /**
     * Check for snake
     * @return bool
     */
    private function checkSnake()
    {
        if ($this->position % 9 == 0) {
            $this->position -= 3;
            return true;
        }
        return false;
    }

    /**
     * Check for ladder
     * @return bool
     */
    private function checkLadder()
    {
        if ($this->position == 25 || $this->position == 55) {
            $this->position += 10;
            return true;
        }
        return false;
    }
}