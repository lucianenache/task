<?php
namespace Application\models;
/**
 * Source of transactions, can read data.csv directly for simplicty sake,
 * should behave like a database (read only)
 *
 */

class TransactionTable {

	function __construct() {
	}

	public function getTransactionsByCustomerId($customerId) {
		$userTable = array();
		$allUsersTable = array();
		$allUsersTable = $this->readCSV();

		$userIdCol = 0;
		$j = 0;
		$k = 0;

		for ($col = 0; $col < count($allUsersTable); $col++) {
			for ($row = 0; $row < count($allUsersTable[$col]); $row++) {

				if ($allUsersTable[$col][$row] == "merchant") {
					$userIdCol = $col;
				}

				if ((int) $allUsersTable[$userIdCol][$row] == (int) $customerId && $userIdCol == $col) {

					for ($j = 0; $j < count($allUsersTable); $j++) {
						$userTable[$j][$k] = $allUsersTable[$j][$row];
					}
					$k++;
				}
			}
		}
		return $userTable;
	}

	private function readCSV() {
		$table = array();

		$file = fopen('../data/transactions.csv', 'r');
		while (($line = fgetcsv($file, 0, ";")) !== FALSE) {
			list($merchants[], $dates[], $values[]) = $line;
		}

		array_push($table, $merchants, $dates, $values);
		fclose($file);
		return $table;
	}
}