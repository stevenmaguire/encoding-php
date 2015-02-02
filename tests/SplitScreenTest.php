<?php

use Stevenmaguire\EncodingDotCom\SplitScreen;

class SplitScreenTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->split_screen = new SplitScreen;
    }

    public function test_It_Can_Set_Number_Of_Columns()
    {
        $columns = rand(1,10);

        $this->split_screen->setColumns($columns);

        $this->assertEquals($columns, $this->split_screen->columns);
    }

    public function test_It_Can_Set_Number_Of_Rows()
    {
        $rows = rand(1,10);

        $this->split_screen->setRows($rows);

        $this->assertEquals($rows, $this->split_screen->rows);
    }

    public function test_It_Can_Set_Padding_For_All_Edges_When_Value_Provided()
    {
        $padding = rand(1,10);

        $this->split_screen->setPadding($padding);

        $this->assertEquals($padding, $this->split_screen->padding_left);
        $this->assertEquals($padding, $this->split_screen->padding_right);
        $this->assertEquals($padding, $this->split_screen->padding_top);
        $this->assertEquals($padding, $this->split_screen->padding_bottom);
    }

    public function test_It_Can_Set_Default_Padding_For_All_Edges_When_No_Value_Provided()
    {
        $expected_padding = 10;

        $this->split_screen->setPadding();

        $this->assertEquals($expected_padding, $this->split_screen->padding_left);
        $this->assertEquals($expected_padding, $this->split_screen->padding_right);
        $this->assertEquals($expected_padding, $this->split_screen->padding_top);
        $this->assertEquals($expected_padding, $this->split_screen->padding_bottom);
    }
}
