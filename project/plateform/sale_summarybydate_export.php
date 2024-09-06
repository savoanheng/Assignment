<?php 
    session_start();
    require("../config/filter.php");
  
    $filter = new SalesFilter($conn);
    $sdate = $_SESSION['sdate'];
    $edate = $_SESSION['edate'];
    $datefilter = $filter->filterSaleSummaryByDate($sdate,$edate);
// Filter the excel data 
function filterData(&$str){ 
    $str = preg_replace("/\t/", "\\t", $str); 
    $str = preg_replace("/\r?\n/", "\\n", $str); 
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
} 

// Excel file name for download 
$fileName = "Report_of_Sale_Summary_FilterDate" . date('Y-m-d') . ".xls"; 

// Column names 
$fields = array('INVOICE NUMBER', 'PURCHASE AMOUNT', 'SALE AMOUNT', 'AMOUNT'); 
$header = array("","Report Sale Summary Filter By Date");
// Display column names as first row 
$headers= implode("\t", array_values($header)) . "\n"; 
$excelData = implode("\t", array_values($fields)) . "\n"; 
// Fetch records from database 

if( $datefilter  > 0){ 
    // Output each row of the data 
    $total = 0.00;
    foreach($datefilter  as $key){ 
        $lineData = array($key['invoice_number'], $key['Purchase'], $key['Sale'], $key['Sale']); 
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