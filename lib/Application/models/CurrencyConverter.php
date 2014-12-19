<?php
namespace Application\models;
/**
 * Helper class, uses  CurrencyWebservice
 *
 */
include 'CurrencyWebservice.php';
class CurrencyConverter {

	private $currencyWebService;

	/**
	 * constructor
	 */
	function __constructor() {
	}

	/**
	 * Receives an array of ammounts in format {XXXYYYYYY} where XXX is the
	 * currency code of the ammount and YYYYYY the amount, and returns an array
	 * with the amount converted in GBP.
	 * @param array $amounts
	 * @return array
	 */
	public function convert($amounts) {
		$this->currencyWebService = new CurrencyWebservice();

		$converted = array();
		for ($i = 0; $i < count($amounts); $i++) {
			$rate = $this->currencyWebService->getExchangeRate(substr($amounts[$i], 0, 3));
			$conv = round($rate * (int) substr($amounts[$i], 3), 2);
			array_push($converted, "GBP " . $conv);
		}
		return $converted;
	}
}