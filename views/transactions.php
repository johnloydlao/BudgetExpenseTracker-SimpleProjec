<!DOCTYPE html>
<html>

<head>
    <title>Transactions</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            text-align: center;
        }

        table tr th,
        table tr td {
            padding: 5px;
            border: 1px #eee solid;
        }

        tfoot tr th,
        tfoot tr td {
            font-size: 20px;
        }

        tfoot tr th {
            text-align: right;
        }
    </style>
</head>

<body>
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Check #</th>
                <th>Description</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($masterArray as $dataRow) : ?>
                <tr>
                    <td><?php echo $dataRow['Date']; ?></td>
                    <td><?php echo $dataRow['Check #']; ?></td>
                    <td><?php echo $dataRow['Description']; ?></td>
                    <td style="color: <?php echo (strpos($dataRow['Amount'], '-') === 0) ? 'red' : 'green'; ?>">
                        <?php echo $dataRow['Amount']; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan=" 3">Total Income:</th>
                <td><?php echo $incomeTotal; ?></td>
            </tr>
            <tr>
                <th colspan="3">Total Expense:</th>
                <td><?php echo $expenseTotal; ?></td>
            </tr>
            <tr>
                <th colspan="3">Net Total:</th>
                <td><?php echo $netTotal; ?></td>
            </tr>
        </tfoot>
    </table>
</body>

</html>