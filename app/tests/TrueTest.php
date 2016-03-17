<?php

class TrueTest extends TestCase {

	/**
	 * A basic functional test example.
	 *
	 * @return void
	 */
	
	// assertTrue() to test true
	// assertFalse() to test false
	// assertSame() takes two arguments to test if they are the same, this is used for strings.
	// assertContain() take two arguments again to see if a keyword is contained in the string.
	// assertArrayHasKey() first arg is test name, second arg is the array.    
	// there are assertions for objects, classes, json files, xml files, and reg expres, etc.. many more. 
	public function testTrue()
	{
		$theTruth = true;
		$this->assertTrue($theTruth);
	}

	public function testSame()
	{
		$string = "this is a string";
		$this->assertSame("this is a string",$string);
	}

	public function testArray(){
		$array = ['name'=>'ken','lname'=>'prochnow'];
		$this->assertArrayHasKey('name',$array);
	}

}
