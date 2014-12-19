<?php
namespace Application\models;
/**
 * Merchant class, containing a merchant transactions
 * converted to GBP currency
 *
 */
class Merchant {

	private $id;
	private $transactionTable;
	private $currencyConverter;

	/**
	 * constructor
	 */
	function __construct($id, TransactionTable $transactionTable, CurrencyConverter $currencyConverter) {
		$this->id = $id;
		$this->transactionTable = $transactionTable;
		$this->currencyConverter = $currencyConverter;
	}

	/**
	 * Returns transactions for a give merchantId or empty otherwise.
	 *
	 * @return array
	 */
	public function getTransactions() {
		$converted = array();
		$table = $this->transactionTable->getTransactionsByCustomerId($this->id);
		$converted = $this->currencyConverter->convert($table[2]);
		$table[2] = $converted;
		return $table;
	}
}