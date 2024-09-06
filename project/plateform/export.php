<?php
    include("../config/Orders.php");
  
    $order = new Orders($conn);
    $report_of_sale = $order->selectReportSale();
    // Filter the excel data 
    function filterData(&$str){ 
        $str = preg_replace("/\t/", "\\t", $str); 
        $str = preg_replace("/\r?\n/", "\\n", $str); 
        if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
    } 
    
    // Excel file name for download 
    $fileName = "Report_of_Sale_" . date('Y-m-d') . ".xls"; 
    
    // Column names 
    $fields = array('Date', 'Customer Name', 'Warehouse', 'Status', 'GrandTotal', 'Payment Type'); 
    
    // Display column names as first row 
    $excelData = implode("\t", array_values($fields)) . "\n"; 
    
    // Fetch records from database 
    
    if( $report_of_sale > 0){ 
        // Output each row of the data 
        foreach($report_of_sale as $key){ 
            $lineData = array($key['CreateDate'], $key['Customer_name'], $key['Warehouse'], $key['Status'], number_format($key['GrandTotal'],2), $key['Payment_type'] ); 
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