<?php 
    require("../config/filter.php");
  
    $filter = new SalesFilter($conn);
    $salemonth = $filter->selectSaleByMonth();
// Filter the excel data 
function filterData(&$str){ 
    $str = preg_replace("/\t/", "\\t", $str); 
    $str = preg_replace("/\r?\n/", "\\n", $str); 
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
} 

// Excel file name for download 
$fileName = "Report_of_Sale_summary" . date('Y-m-d') . ".xls"; 

// Column names 
$fields = array('DATE', 'TOTAL INVOICE', 'SALE AMOUNT', 'AMOUNT'); 
$header = array("","Report Sale Summary");
// Display column names as first row 
$headers= implode("\t", array_values($header)) . "\n"; 
$excelData = implode("\t", array_values($fields)) . "\n"; 
// Fetch records from database 

if(  $salemonth  > 0){ 
    // Output each row of the data 
    $total = 0.00;
    foreach( $salemonth  as $key){ 
        $lineData = array($key['Months'].$key['Years'], $key['invoice'], $key['Sale'], $key['Sale']); 
        array_walk($lineData, 'filterData'); 
        $excelData .= implode("\t", array_values($lineData)) . "\n"; 
        $total += $key['Sale'];
    }
    $grandTotal = array("","","",$total);
    $total_sale= implode("\t", array_values($grandTotal)) . "\n"; 

}else{ 
    $excelData .= 'No records found...'. "\n"; 
} 

// Headers for download 
header("Content-Type: application/vnd.ms-excel"); 
header("Content-Disposition: attachment; filename=\"$fileName\""); 

// Render excel data 
echo $headers; 
echo $excelData; 
echo $total_sale; 

exit;
?>