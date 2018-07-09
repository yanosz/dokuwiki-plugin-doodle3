<?php

use PHPUnit\Framework\TestCase;
require_once("doodle-utils.php");

final class DoodleUtilsTest extends TestCase
{
    private  $oldDoodle = array(
            'Robert' => array(
            'username'  => 'doogie',
            'choices'   => array(0, 3),
            'ip'        => '123.123.123.123',
            'time'      => 1284970602
            ),
            'Peter' => array(
            'choices'   => array(),
            'ip'        => '222.122.111.1',
            'time'      > 12849702333
            ));

    private  $newDoodle = array(
        'Robert' => array(
            'username'  => 'doogie',
            'choices'   => array('A', 'D'),
            'ip'        => '123.123.123.123',
            'time'      => 1284970602
        ),
        'Peter' => array(
            'choices'   => array(),
            'ip'        => '222.122.111.1',
            'time'      > 12849702333
        ));

    private $doodleChoices = array('A','0','C','D');


    /**
     * Option IDs are created based on the column-name
     */
    public function testOptionIdsPositive() {
        $this->assertEquals(DoodleUtils::optionId(0,$this->doodleChoices),"A");

    }

    /**
     * Test old doodle is treated correctly
     * doogie has selected 'A'
     */
    public function testOldFormatWorks() {
        $this->assertEquals(DoodleUtils::optionIsChosen(0,$this->doodleChoices,$this->oldDoodle['Robert']),true);
    }

    /**
     * Test old doodle no regression (to String):
     * Altough, Robert has selected column 0 --- option 1 with label '0' is not selected
     */
    public function testOldFormatWorksRegression() {
        $this->assertEquals(DoodleUtils::optionIsChosen(1,$this->doodleChoices,$this->oldDoodle['Robert']),false);
    }

    /**
     * Test new doodle converted: Robert has selected 'A', although, his data is old
     */
    public function testNewDoodleConvert() {
        $this->assertEquals(DoodleUtils::optionIsChosen(0,$this->doodleChoices,$this->newDoodle['Robert']),true);
    }

    /**
     * Test new doodle, new options: Robert has selected 'A', although, his data is old
     */
    public function testNewDoodleNewOptions() {
        $this->assertEquals(DoodleUtils::optionIsChosen(0,$this->doodleChoices,$this->newDoodle['Robert']),true);
    }

    /**
     * Test new doodle, new options: Robert has not selected '0' in column 1
     */
    public function testNewDoodleNewOptionsNegative() {
        $this->assertEquals(DoodleUtils::optionIsChosen(1,$this->doodleChoices,$this->newDoodle['Robert']),false);
    }

    /**
     * Roberts options are saved as 'A', 'D'
     */
    public function testSelectedOptionIds() {
        $this->assertEquals(DoodleUtils::selectedOptionIds($this->oldDoodle['Robert']['choices'],$this->doodleChoices),array('A','D'));
    }

}