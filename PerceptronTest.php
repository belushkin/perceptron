<?php

require_once('Perceptron.php');

class PerceptronTest
{

    public function testNAND()
    {
        $p = new Perceptron(2, 0, .1);

        $i = 0;
        while($i < 1000)
        {
            $input = array(0, 0);
            $output = 1;
            $p->train($input, $output);

            $input = array(0, 1);
            $output = 1;
            $p->train($input, $output);

            $input = array(1,0);
            $output = 1;
            $p->train($input, $output);

            $input = array(1,1);
            $output = 0;
            $p->train($input, $output);

            $i++;
        }

        $this->assertFalse((bool) $p->test(array(1,1)));
        $this->assertTrue((bool) $p->test(array(0,1)));
        $this->assertTrue((bool) $p->test(array(1,0)));
        $this->assertTrue((bool) $p->test(array(0,0)));
    }

    public function testAND()
    {
        $p = new Perceptron(2, 0, .1);

        $i = 0;
        while($i < 1000)
        {
            $input = array(0, 0);
            $output = 0;
            $p->train($input, $output);

            $input = array(0, 1);
            $output = 0;
            $p->train($input, $output);

            $input = array(1,0);
            $output = 0;
            $p->train($input, $output);

            $input = array(1,1);
            $output = 1;
            $p->train($input, $output);

            $i++;
        }

        $this->assertTrue((bool) $p->test(array(1,1)));
        $this->assertFalse((bool) $p->test(array(0,1)));
        $this->assertFalse((bool) $p->test(array(1,0)));
        $this->assertFalse((bool) $p->test(array(0,0)));
    }

    public function testOR()
    {
        $p = new Perceptron(2, 0, .1);

        $i = 0;
        while($i < 1000)
        {
            $input = array(0, 0);
            $output = 0;
            $p->train($input, $output);

            $input = array(0, 1);
            $output = 1;
            $p->train($input, $output);

            $input = array(1,0);
            $output = 1;
            $p->train($input, $output);

            $input = array(1,1);
            $output = 1;
            $p->train($input, $output);

            $i++;
        }

        $this->assertTrue((bool) $p->test(array(1,1)));
        $this->assertTrue((bool) $p->test(array(0,1)));
        $this->assertTrue((bool) $p->test(array(1,0)));
        $this->assertFalse((bool) $p->test(array(0,0)));
    }

    public function testNOR()
    {
        $p = new Perceptron(2, 0, .1);

        $i = 0;
        while($i < 1000)
        {
            $input = array(0, 0);
            $output = 1;
            $p->train($input, $output);

            $input = array(0, 1);
            $output = 0;
            $p->train($input, $output);

            $input = array(1,0);
            $output = 0;
            $p->train($input, $output);

            $input = array(1,1);
            $output = 0;
            $p->train($input, $output);

            $i++;
        }

        $this->assertFalse((bool) $p->test(array(1,1)));
        $this->assertFalse((bool) $p->test(array(0,1)));
        $this->assertFalse((bool) $p->test(array(1,0)));
        $this->assertTrue((bool) $p->test(array(0,0)));
    }

    public function testCAPTCHA()
    {
        $p = new Perceptron(4, 0, .1);

        $i = 0;
        while($i < 1000)
        {
            $input = array(1, 1, 1, 1);
            $output = 1;
            $p->train($input, $output);

            $input = array(0, 0, 0, 0);
            $output = 0;
            $p->train($input, $output);

            $input = array(1, 1, 1, 0);
            $output = 1;
            $p->train($input, $output);

            $input = array(1, 1, 0, 0);
            $output = 1;
            //$p->train($input, $output);

            $input = array(1, 0, 0, 0);
            $output = 1;
            $p->train($input, $output);

            $i++;
        }

        $this->assertTrue((bool) $p->test(array(1, 1, 1, 1)));
        $this->assertTrue((bool) $p->test(array(1, 0, 0, 0)));
        $this->assertTrue((bool) $p->test(array(1, 1, 0, 0)));
        $this->assertTrue((bool) $p->test(array(1, 1, 1, 0)));
        $this->assertFalse((bool) $p->test(array(0, 0, 0, 0)));
    }

    private function assertFalse($result) 
    {
	if ($result === false) {
	    echo "Test Ok\n";
	} else {
	    echo "Test Fail\n";
	}
    }

    private function assertTrue($result) 
    {
	if ($result === true) {
	    echo "Test Ok\n";
	} else {
	    echo "Test Fail\n";
	}
    }

}

$test = new PerceptronTest();
$test->testNAND();
$test->testAND();
$test->testOR();
$test->testNOR();
$test->testCAPTCHA();

