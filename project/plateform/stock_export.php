<?php 
   require("../config/Products.php");
   $product = new Products($conn);
   $Allproduct = $product->selectAllProduct();
// Filter the excel data 
function filterData(&$str){ 
    $str = preg_replace("/\t/", "\\t", $str); 
    $str = preg_replace("/\r?\n/", "\\n", $str); 
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
} 

// Excel file name for download 
$fileName = "Stock_report_" . date('Y-m-d') . ".xls"; 

// Column names 
$fields = array('Product_name', 'Product_code', 'Unit', 'Defualt Warehouse','Total Quantity'); 
$header = array("Stock Report");
// Display column names as first row 
$excelData = implode("\t", array_values($fields)) . "\n"; 
$headers = implode("\t",array_values($header) ) . "\n"; 
// Fetch records from database 

if( $Allproduct  > 0){ 
    // Output each row of the data 
    
    foreach( $Allproduct  as $key){ 
        $lineData = array($key['Product_name'], $key['Product_code'], $key['Unit'], $key['UnitInStock'],$key['UnitInStock']); 
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