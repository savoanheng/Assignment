<?php 
    require("../config/Payment.php");
    $pay = new Payments($conn);
    $payment = $pay->selectAllPayment();
// Filter the excel data 
function filterData(&$str){ 
    $str = preg_replace("/\t/", "\\t", $str); 
    $str = preg_replace("/\r?\n/", "\\n", $str); 
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
} 

// Excel file name for download 
$fileName = "Report_All_Payment" . date('Y-m-d') . ".xls"; 

// Column names 
$fields = array('CREATE DATE','INVOICE NUMBER', 'PAYMENT TYPE', 'PAYMENT AMOUNT'); 
$header = array("","Report All Payments");
// Display column names as first row 
$headers= implode("\t", array_values($header)) . "\n"; 
$excelData = implode("\t", array_values($fields)) . "\n"; 
// Fetch records from database 

if( $payment  > 0){ 
    // Output each row of the data 
    $total = 0.00;
    foreach($payment  as $key){ 
        $lineData = array($key['CreateDate'],$key['invoice_id'], $key['Payment_type'], $key['Payment_amount'] ); 
        array_walk($lineData, 'filterData'); 
        $excelData .= implode("\t", array_values($lineData)) . "\n"; 
        $total += $key['Payment_amount'];
    }
    $pays = array("","","Total",$total);
    $grandtotal= implode("\t", array_values($pays)) . "\n"; 

}else{ 
    $excelData .= 'No records found...'. "\n"; 
} 

// Headers for download 
header("Content-Type: application/vnd.ms-excel"); 
header("Content-Disposition: attachment; filename=\"$fileName\""); 

// Render excel data 
echo $headers; 
echo $excelData; 
echo $grandtotal; 

exit;
?>