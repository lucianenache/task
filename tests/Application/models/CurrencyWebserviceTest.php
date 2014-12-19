<?php

class CurrencyWebserviceTest extends PHPUnit_Framework_TestCase {

	protected $obj = NULL;

	/* Arrange */
	protected function setUp() {
		$this->obj = new Application\models\CurrencyWebservice;
	}

	public function testGetExchangeRateWithGBP() {
		/* act */
		$exchangeRate =
		/* assert */
		$this->assertEquals(1, $this->obj->getExchangeRate("GBP"));
		$this->assertInternalType("int", $this->obj->getExchangeRate("GBP"));
	}

	public function testGetExchangeRateWithEUR() {

		/* act */
		$exchangeRate = $this->obj->getExchangeRate("EUR");

		/* assert */
		$this->assertTrue($exchangeRate <= 2);
		$this->assertTrue($exchangeRate >= 1);
		$this->assertInternalType("float", $exchangeRate);
	}

	public function testGetExchangeRateWithUSD() {

		/* act */
		$exchangeRate = $this->obj->getExchangeRate("USD");

		/* assert */
		$this->assertTrue($exchangeRate <= 2);
		$this->assertTrue($exchangeRate >= 1);
		$this->assertInternalType("float", $exchangeRate);
	}

	/**
	 * @expectedException UnexpectedValueException
	 * @expectedExceptionMessage unknown currency code:
	 */
	public function testGetExchangeRateWithEmpty() {

		/* act */
		$exchangeRate = $this->obj->getExchangeRate("");

		/* assert */
		$this->assertEquals(1, $exchangeRate);
	}

	/**
	 * @expectedException UnexpectedValueException
	 * @expectedExceptionMessage unknown currency code:DKK
	 */
	public function testGetExchangeRateWithUnknownCurrency() {

		/* act */
		$exchangeRate = $this->obj->getExchangeRate("DKK");

		/* assert */
		$this->assertEquals(1, $exchangeRate);
	}

	/**
	 * @expectedException InvalidArgumentException
	 * @expectedExceptionMessage currency code is undefined at getExchangeRate(currency)
	 */
	public function testGetExchangeRateWithNullCurrency() {

		/* act */
		$exchangeRate = $this->obj->getExchangeRate(null);

		/* assert */
		//asserted inside the doc
	}

	protected function tearDown() {
		unset($this->obj);
	}
}
