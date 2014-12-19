<?php
namespace Application\models;
use InvalidArgumentException;
use UnexpectedValueException;

/**
 * Dummy web service returning random exchange rates
 * for basic currencies like GBP USD EUR
 * considers GBP as default currency
 */

class CurrencyWebservice {

	/** @const currencyMap */
	const MIN_RANGE = 1100;
	/** @var currencyMap */
	const MAX_RANGE = 2000;
	/** @var currencyMap */
	const DIVIDER = 1000;

	/* @array currencyMap */
	private $currencyMap = array();

	/* @array currencyList */
	private $currencyList = array(
		"GBP",
		"USD",
		"EUR");

	/**
	 * constructor
	 */
	function __construct() {

		$this->currencyMap = array();
		$this->currencyMap = $this->init();

	}

	/**
	 * Initializes array map with quotes for each currency, GBP is taken as reference
	 *
	 * @return array map {currencyCode}{rate}
	 */
	private function init() {
		$currMap = array();
		for ($i = 0; $i < count($this->currencyList); $i++) {
			if ($this->currencyList[$i] == "GBP") {
				$this->currMap[$this->currencyList[$i]] = 1;
			} else {
				$this->currMap[$this->currencyList[$i]] = mt_rand(self::MIN_RANGE, self::MAX_RANGE) / self::DIVIDER;
			}
		}
		return $this->currMap;
	}

	/**
	 * Returns exchange rate for a provided @currency
	 * @param String $currency
	 * @return float
	 */
	public function getExchangeRate($currency) {
		try {
			if (!isset($currency)) {
				throw new InvalidArgumentException("currency code is undefined at getExchangeRate(currency)");
			}

			foreach ($this->currencyMap as $code => $rate) {
				if ($currency == $code) {
					return $rate;
				}
			}
			throw new UnexpectedValueException("unknown currency code:" . $currency);
		} catch (Exception $e) {
			echo $e->getMessage();
			die;
		}

	}
}
