<?php
use Application\models\CurrencyConverter;
use Application\models\Merchant;
/**
 * skipped because of problems with mocking the getTransactions method.
 */

class MerchantTest extends PHPUnit_Framework_TestCase {

	protected $obj = NULL;
	protected $transactionTableMock = NULL;
	protected $tableDataMock = NULL;

	/* Arrange */
	protected function setUp() {
		$this->markTestSkipped('must be revisited.');
		/* prepare mock */
		$this->tableDataMock = array(
			array("merchant", "2", "1", "2"),
			array("date", "01/05/2010", "01/05/2011", "01/05/2009"),
			array("value", "GBP18", "USD23.05", "EUR25"),
		);
		/* prepare mocked table*/
		$transactionTableMock = $this->getMockBuilder('TransactionTable')
		                             ->setMethods(array('getTransactionsByCustomerId'))
		                             ->getMock();

		$transactionTableMock->expects($this->once())
		                     ->method('getTransactionsByCustomerId')
		                     ->with(1)
		                     ->will($this->returnValue($this->tableDataMock)); //Whatever value you want to return

		$this->obj = new Merchant(1, $transactionTableMock, new CurrencyConverter());
		$result = $this->obj->getTransactions =
		$this->obj->expects($this->once())
		               ->method('getTransactions');
	}

	public function testGetValidMerchantRates() {
		$this->markTestSkipped('must be revisited.');
		/* act */
		$result = $this->obj->getTransactions();

	}

	protected function tearDown() {
		unset($this->obj);
	}
}
