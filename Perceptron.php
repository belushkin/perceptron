<?php

class Perceptron
{
    protected $vectorLength;
    protected $bias;
    protected $learningRate;
    protected $weightVector;
    protected $output = null;

    public function __construct($vectorLength, $bias = 0.0, $learningRate = .5)
    {
        if ($vectorLength < 1) {
            throw new \InvalidArgumentException();
        } elseif ($learningRate <= 0 || $learningRate > 1) {
            throw new \InvalidArgumentException();
        }

        $this->vectorLength = $vectorLength;
        $this->bias = $bias;
        $this->learningRate = $learningRate;

        for ($i = 0; $i < $this->vectorLength; $i++) {
            $this->weightVector[$i] = rand()/getrandmax() * 2 - 1;
        }
    }

    public function test($inputVector)
    {
        if (!is_array($inputVector) || count($inputVector) != $this->vectorLength) {
            throw new \InvalidArgumentException();
        }

        $testResult = $this->dotProduct($this->weightVector, $inputVector) + $this->bias;

        $this->output = $testResult > 0 ? 1 : 0;
        return $this->output;
    }

    public function train($inputVector, $outcome)
    {
        if (!is_array($inputVector) || !($outcome == 0 || $outcome == 1)) {
            throw new \InvalidArgumentException();
        }

        $output = $this->test($inputVector);
        for ($i = 0; $i < $this->vectorLength; $i++) {
            $this->weightVector[$i] =
                $this->weightVector[$i] + $this->learningRate * ((int) $outcome - (int) $output) * $inputVector[$i];
        }

        $this->bias = $this->bias + ((int) $outcome - (int) $output);
    }

    private function dotProduct($vector1, $vector2)
    {
        return array_sum(
            array_map(
                function ($a, $b) {
                    return $a * $b;
                },
                $vector1,
                $vector2
            )
        );
    }

}
