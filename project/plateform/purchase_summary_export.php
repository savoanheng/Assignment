<?php 
    require("../config/filter.php");
  
    $filter = new SalesFilter($conn);
    $purchase_month = $filter->selectPurchaseByMonth();
// Filter the excel data 
function filterData(&$str){ 
    $str = preg_replace("/\t/", "\\t", $str); 
    $str = preg_replace("/\r?\n/", "\\n", $str); 
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
} 

// Excel file name for download 
$fileName = "Report_of_purchase_summary" . date('Y-m-d') . ".xls"; 

// Column names 
$fields = array('DATE', 'TOTAL INVOICE', 'PURCHASE AMOUNT', 'AMOUNT'); 
$header = array("Report purchase summary");
// Display column names as first row 
$headers= implode("\t", array_values($header)) . "\n"; 
$excelData = implode("\t", array_values($fields)) . "\n"; 
// Fetch records from database 

if( $purchase_month  > 0){ 
    // Output each row of the data 
    
    foreach($purchase_month  as $key){ 
        $lineData = array($key['Months'].$key['Years'], $key['total_invoice'], $key['Purchase'], number_format($key['Purchase'],2)); 
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
echo $headers; 
echo $excelData; 

exit;
?>