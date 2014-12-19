<?php

class CurrencyConverterTest extends PHPUnit_Framework_TestCase {

	protected $obj = NULL;
	private $validArray;
	private $invalidArray;

	/* Arrange */
	protected function setUp() {
		$this->obj = new Application\models\CurrencyConverter;
		$this->validArray = array(
			"GBP5",
			"EUR25",
			"USD50",
		);
		$this->invalidArray = array(
			"GBP5",
			"DKK25",
			"USD50",
		);
	}

	public function testConvertWithValidArray() {

		/* act */
		$convertedValues = $this->obj->convert($this->validArray);

		/* assert */
		$this->assertInternalType("array", $convertedValues);
	}

	/**
	 * @expectedException UnexpectedValueException
	 * @expectedExceptionMessage unknown currency code:DKK
	 */
	public function testConvertWithInvalidArray() {

		/* act */
		$convertedValues = $this->obj->convert($this->invalidArray);

		/* assert */
		$this->assertEquals(1, $convertedValues);
	}

	public function testConvertWithEmptyArray() {

		/* act */
		$convertedValues = $this->obj->convert(array());

		/* assert */
		$this->assertEquals(array(), $convertedValues);
	}

	public function testConvertWithNullArray() {

		/* act */
		$convertedValues = $this->obj->convert(null);

		/* assert */
		$this->assertEquals(array(), $convertedValues);
	}

	protected function tearDown() {
		unset($this->obj);
		unset($this->validArray);
		unset($this->invalidArray);
	}
}
