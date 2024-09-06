<?php 
    require("../config/Orders.php");
  
    $order = new Orders($conn);
    $purchase = $order->selectReportPurchase();
// Filter the excel data 
function filterData(&$str){ 
    $str = preg_replace("/\t/", "\\t", $str); 
    $str = preg_replace("/\r?\n/", "\\n", $str); 
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
} 

// Excel file name for download 
$fileName = "Report_of_purchase_" . date('Y-m-d') . ".xls"; 

// Column names 
$fields = array('DATE', 'INVOICE NUMBER', 'CREATE BY', 'AMOUNT'); 
$header = array("Report Purchase");
// Display column names as first row 
$excelData = implode("\t", array_values($header)) . "\n"; 
$excelData = implode("\t", array_values($fields)) . "\n"; 

// Fetch records from database 

if( $purchase > 0){ 
    // Output each row of the data 
    
    foreach($purchase as $key){ 
        $lineData = array($key['CrateDate'], $key['invoice_number'], $key['department'], number_format($key['GrandTotal'],2)); 
        array_walk($lineData, 'filterData'); 
        $excelData .= implode("\t", array_values($lineData)) . "\n"; 
    } 
}else{ 
    $excelData .= 'No records found...'. "\n"; 
} 

// Headers for download 
header("Content-Type: application/vnd.ms-excel"); 
header("Content-Disposition: attachment; filename=\"$fileName\""); 

// Render excel data 
echo $excelData; 

exit;
?>