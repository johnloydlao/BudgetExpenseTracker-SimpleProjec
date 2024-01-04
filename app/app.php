<?php

declare(strict_types=1);

$directory = '../transaction_files/';

if ($handle = opendir($directory)) {

    $positiveSum = 0;
    $negativeSum = 0;
    $netSum = 0;

    $masterArray = [];

    while (false !== ($fileName = readdir($handle))) {

        if (pathinfo($fileName, PATHINFO_EXTENSION) === 'csv') {

            $file = fopen($directory . $fileName, 'r');

            $headers = fgetcsv($file);

            while (($line = fgetcsv($file)) !== false) {
                $assocArray = [];

                foreach ($headers as $index => $header) {
                    $assocArray[$header] = $line[$index] ?? '';
                }

                if (isset($assocArray['Date']) && !empty($assocArray['Date'])) {
                    $date = DateTime::createFromFormat('m/d/Y', $assocArray['Date']);
                    if ($date) {
                        $assocArray['Date'] = $date->format('M j, Y');
                    }
                }

                $amountValue = floatval(str_replace(['$', ','], '', $assocArray['Amount']));
                $netSum += $amountValue;

                if ($amountValue > 0) {
                    $positiveSum += $amountValue;
                } else {
                    $negativeSum += $amountValue;
                }

                $masterArray[] = $assocArray;
            }

            fclose($file);
        }
    }

    $incomeTotal = '$' . number_format(abs($positiveSum), 2);
    $expenseTotal = '-$' . number_format(abs($negativeSum), 2);
    $netTotal = '$' . number_format(abs($netSum), 2);

    closedir($handle);
}
