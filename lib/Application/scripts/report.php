<?php

//run chcp and find out if it has 65001 if not
//execute chcp 65001 (windows)

include '../models/Merchant.php';
include '../models/CurrencyConverter.php';
include '../models/TransactionTable.php';

if (isset($argv[1])) {
	$merchant_id = $argv[1];
} else {
	print_r('Usage:php report.php [publisherId]');
	return;
}

$merchant = new Merchant($merchant_id, new TransactionTable(), new CurrencyConverter());

echo ("-----------------------------------------------------------------\n");
echo ("|" . "\tId\t" . "|\t" . "Date" . "\t\t|\t" . "transactions" . "\t|\n");
echo ("-----------------------------------------------------------------\n");

$list = $merchant->getTransactions();

for ($row = 0; $row < count($list[0]); $row++) {
	for ($col = 0; $col < count($list); $col++) {
		/*find wich col is reserverd for the userId*/
		echo ("|\t" . $list[$col][$row]);
		if ($col < 2) {echo ("\t");}
	}
	for ($i = 0; $i < 16 - strlen($list[$col - 1][$row]); $i++) {echo (" ");}
	echo ("|\n");
}

echo ("-----------------------------------------------------------------");
