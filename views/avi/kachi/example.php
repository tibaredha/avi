<?php  

$sep = "\t"; $nl  = "\n";

$content = file_get_contents('data.txt'); 

$records = explode($nl, $content); 
$header  = explode($sep, trim(array_shift($records))); 
$data    = array_fill_keys($header, array()); 

foreach ($records as $id=>$record) { 
    $record = trim($record); 
    $fields = explode($sep, $record); 
    $titles = $header; 
     
    foreach ($fields as $field) { 
        $title = array_shift($titles); 
        $data[$title][] = $field; 
    } 
} 

$x = $data['wt']; 
$y = $data['mpg']; 

require('kashi.php'); 

// $kashi = new Kashi($dbname, $dbuser, $dbpass, $dbhost); 
$kashi = new Kashi('test', 'root', '', 'localhost'); 

/**
 * Summary Statistics:
 */

// $x is an array of values 
echo 'Mean: ' . $kashi->mean($x) . '<br />'; 

// It will use previous data set if you don't provide one as an argument to the method 
echo 'Mode: '     . print_r($kashi->mode()) . '<br />'; 
echo 'Median: '   . $kashi->median()   . '<br />'; 
echo 'Variance: ' . $kashi->variance() . '<br />'; 
echo 'SD: '       . $kashi->sd()       . '<br />'; 
echo '%CV: '      . $kashi->cv()       . '<br />'; 
echo 'Skewness: ' . $kashi->skew()     . '<br />'; 
echo 'Kurtosis: ' . $kashi->kurt()     . '<br />'; 

/**
 * Correlation, Regression, and t-Test:
 */
echo 'Covariance: '  . $kashi->cov($x, $y) . '<br />'; 
echo 'Correlation: ' . $kashi->cor($x, $y) . '<br />'; 

$r = $kashi->cor($x, $y); 
$n = count($x); 
echo 'Significant of Correlation: ' . $kashi->corTest($r, $n) . '<br />'; 

echo 'Regression: ' . print_r($kashi->lm($x, $y), true) . '<br />'; 

echo 't-Test unpaired: ' . $kashi->tTest($x, $y, false) . '<br />'; 
echo 'Test: ' . $kashi->tDist($kashi->tTest($x, $y, false), (count($x)-1)*(count($y)-1)) . '<br />'; 

echo 't-Test paired: ' . $kashi->tTest($x, $y, true) . '<br />'; 
echo 'Test: ' . $kashi->tDist($kashi->tTest($x, $y, true), count($x)-1) . '<br />'; 

/**
 * Distributions:
 */
echo 'Normal distribution (x=0.5, mean=0, sd=1): '  . $kashi->norm(0.5, 0, 1) . '<br />'; 

echo 'Probability for the Student t-distribution (t=3, n=10) one-tailed: ';  
echo $kashi->tDist(3, 10, 1) . '<br />'; 

echo 'Probability for the Student t-distribution (t=3, n=10) two-tailed: ';  
echo $kashi->tDist(3, 10, 2) . '<br />'; 

echo 'F probability distribution (f=2, df1=12, df2=15): '  . $kashi->fDist(2, 12, 15) . '<br />'; 

echo 'Inverse of the standard normal cumulative distribution (p=0.95): '; 
echo $kashi->inverseNormCDF(0.95) . '<br />';

echo 't-value of the Student\'s t-distribution (p=0.05, n=29): '; 
echo $kashi->inverseTCDF(0.05, 29) . '<br />';

/**
 * Chi-square test or Contingency tables (A/B testing):
 */
$table['Automatic'] = array('4 Cylinders' => 3, '6 Cylinders' => 4, '8 Cylinders' => 12);
$table['Manual']    = array('4 Cylinders' => 8, '6 Cylinders' => 3, '8 Cylinders' => 2);

$result = $kashi->chiTest($table);

$probability = $kashi->chiDist($result['chi'], $result['df']); 
echo 'Chi-square test probability: ' . $probability . '<br />'; 

/**
 * Diversity index:
 */
$gear = array('3' => 15, '4' => 12, '5' => 5); 
$cyl  = array('4' => 11, '6' => 7, '8' => 14); 

echo 'Shannon index for gear: ' . $kashi->diversity($gear) . '<br />'; 
echo 'Shannon index for cyl: ' . $kashi->diversity($cyl) . '<br />'; 

/**
 * ANOVA:
 */
require('kashi_anova.php');

// $obj = new KashiANOVA($dbname, $dbuser, $dbpass, $dbhost);
$obj = new KashiANOVA('test', 'root', '', 'localhost');

$str = file_get_contents('anova_data.txt');
$obj->loadString($str); 

// mpg ~ cyl
$result = $obj->anova('cyl', 'mpg');
echo '<hr />Analysis of variance (ANOVA): mpg ~ cyl<pre>';
print_r($result);
echo '</pre>';
