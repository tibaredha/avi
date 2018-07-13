<?php
require_once('kashi.php');

class KashiANOVA {
    protected $dbh;
    protected $preparedStmt;
    protected $kashi;
    public $persistent = false;

    public function __construct($dbname='test', $dbuser='root', $dbpass='', $dbhost='localhost') {
        $this->kashi = new Kashi();
        
        // We save data in SQL to have a scalable data-analysis solution (ENGINE=MEMORY ?)
        $this->dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
        
        $tableA = 'CREATE TABLE IF NOT EXISTS kashi_factors (id INT NOT NULL, kashi_factor VARCHAR(50) NOT NULL, kashi_level VARCHAR(50) NOT NULL, PRIMARY KEY (id, kashi_factor))';
        $tableB = 'CREATE TABLE IF NOT EXISTS kashi_variates (id INT NOT NULL, kashi_trait VARCHAR(50) NOT NULL, kashi_value DECIMAL(9,3) NOT NULL, PRIMARY KEY (id, kashi_trait))';
        
        $this->dbh->exec($tableA);
        $this->dbh->exec($tableB);
        
        $this->preparedStmt['insertFactor']  = $this->dbh->prepare("INSERT INTO kashi_factors VALUES (:myRecord, :myName, :myValue)");
        $this->preparedStmt['insertVariate'] = $this->dbh->prepare("INSERT INTO kashi_variates VALUES (:myRecord, :myName, :myValue)");
        $this->preparedStmt['queryFactor']   = $this->dbh->prepare("SELECT id FROM kashi_factors WHERE kashi_factor=:myFactor AND kashi_level=:myLevel");
        $this->preparedStmt['ssBetween']     = $this->dbh->prepare("SELECT kashi_level, AVG(kashi_value) AS kashi_mean, SUM(kashi_value) AS kashi_total, SUM(kashi_value*kashi_value) AS kashi_ss, COUNT(kashi_value) AS kashi_count FROM kashi_factors INNER JOIN kashi_variates USING(id) WHERE kashi_factor=:myTreat AND kashi_trait=:myTrait GROUP BY kashi_level");
    }
	
	public function __destruct() {
        $tableA = 'DROP TABLE kashi_factors';
        $tableB = 'DROP TABLE kashi_variates';
        
        if (!$this->persistent) {
            $this->dbh->exec($tableA);
            $this->dbh->exec($tableB);
        }

        $this->dbh = null;
	}
    
    public function loadArray($data) {
        $this->dbh->exec('TRUNCATE TABLE kashi_factors');
        $this->dbh->exec('TRUNCATE TABLE kashi_variates');

        foreach ($data as $name=>$values) {
            if (substr($name, -1) == '!') {
                $name  = substr($name, 0, -1);
                $table = 'kashi_factors';
                $stmt  = 'insertFactor';
            } else {
                $table = 'kashi_variates';
                $stmt  = 'insertVariate';
            }
            
            $this->preparedStmt[$stmt]->bindParam(':myRecord', $record, PDO::PARAM_INT);
            $this->preparedStmt[$stmt]->bindParam(':myValue', $value, PDO::PARAM_STR);
            $this->preparedStmt[$stmt]->bindParam(':myName', $name, PDO::PARAM_STR);
            
            $record = 1;
            foreach ($values as $value) {
                $this->preparedStmt[$stmt]->execute();    
                $record++;
            }
        }
    }

    protected function readString($str) {
        $data   = array();
        $str    = str_replace("\r", '', $str);
        $lines  = explode("\n", $str);
        $header = explode("\t", $lines[0]);
        $maxCol = count($header);
        $maxRow = count($lines);
        
        for ($i=1; $i<$maxRow; $i++) {
            if (trim($lines[$i]) == '') continue;
            $fields = explode("\t", $lines[$i]);
            for ($j=0; $j<$maxCol; $j++) {
                $data[$header[$j]][] = $fields[$j];
            }            
        }
        
        return $data;
    }
    
    public function loadString($str) {
        $this->loadArray($this->readString($str));
    }
    
    protected function query($factors, $trait, $return='summary') {
        $this->preparedStmt['queryFactor']->bindParam(':myFactor', $factor, PDO::PARAM_STR);
        $this->preparedStmt['queryFactor']->bindParam(':myLevel', $level, PDO::PARAM_STR);
        
        foreach ($factors as $factor=>$level) {
            $this->preparedStmt['queryFactor']->execute();           
            $result = $this->preparedStmt['queryFactor']->fetchAll();            
            $keys   = array();

            foreach ($result as $row) {
                $keys[] = $row['id'];
            }

            if (!isset($activeKeys)) {
                $activeKeys = $keys;
            }
            
            $activeKeys = array_intersect($activeKeys, $keys);
        }

        $data   = array();
        $idList = implode(",", $activeKeys);
        
        if ($return == 'values') {
            $sql    = "SELECT id, kashi_value FROM kashi_variates WHERE kashi_trait='$trait' AND id in ($idList)";
                   
            foreach ($this->dbh->query($sql) as $row) {
                $data[$row['id']] = $row['kashi_value'];
            }
        } else if ($return == 'summary') {
            $sql    = "SELECT SUM(kashi_value) AS a, AVG(kashi_value) AS b, COUNT(kashi_value) AS c FROM kashi_variates WHERE kashi_trait='$trait' AND id in ($idList)";
            $result = $this->dbh->query($sql)->fetch(PDO::FETCH_ASSOC);
            
            $data['sum']   = $result['a'];
            $data['avg']   = $result['b'];
            $data['count'] = $result['c'];
        }

        return $data;
    }
    
    public function anova ($treat, $trait) {
        $sql     = "SELECT COUNT(DISTINCT kashi_level) AS levels FROM kashi_factors WHERE kashi_factor='$treat'";
        $result  = $this->dbh->query($sql)->fetch(PDO::FETCH_ASSOC);
        $r       = $result['levels'];
        $treatDF = $r - 1;
        
        $sql     = "SELECT COUNT(DISTINCT id) AS levels FROM kashi_variates WHERE kashi_trait='$trait'";
        $result  = $this->dbh->query($sql)->fetch(PDO::FETCH_ASSOC);
        $t       = $result['levels'];
        $totalDF = $t - 1;
        
        $errorDF = $totalDF - $treatDF;
        
        $sql        = "SELECT SUM(kashi_value*kashi_value) AS ss, SUM(kashi_value) AS grandTotal, COUNT(kashi_value) AS observations FROM kashi_variates WHERE kashi_trait='$trait'";
        $result     = $this->dbh->query($sql)->fetch(PDO::FETCH_ASSOC);
		$ss         = $result['ss'];
        $grandTotal = $result['grandTotal'];
        $t          = $result['observations'];
        
        $C          = pow($grandTotal, 2) / $t;
        $SSTot      = $ss - $C;
        $grandMean  = $grandTotal / $t;

        $sql        = "SELECT DISTINCT kashi_level FROM kashi_factors WHERE kashi_factor='$treat'";
        $levels     = array();
        $means      = array();
        $reps       = array();
        $variation  = 0;
        
        foreach ($this->dbh->query($sql) as $row) {
            $levels[] = $row['kashi_level'];
        }
        
        foreach ($levels as $level) {
            $result     = $this->query(array($treat=>$level), $trait, 'summary');
            $variation += pow($result['sum'], 2) / $result['count'];
            
            $means[$level] = $result['avg'];
            $reps[$level]  = $result['count'];
        }
        
        ksort($means);
        ksort($reps);
        
        $SST = $variation - $C;
        $SSE = $SSTot - $SST;
        $MST = $SST / $treatDF;
        $MSE = $SSE / $errorDF;
        $VRT = $MST / $MSE;
        $F   = $this->kashi->fDist($VRT, $treatDF, $errorDF);
        
        if (max($reps) == min($reps)) {
            $SE  = sqrt($MSE / max($reps));
            $SED = sqrt(2) * $SE;
            // qt(0.975, Residual df) 
            $LSD = $this->kashi->inverseTCDF(0.05, $errorDF) * $SED;
        } else {
            $SE  = array();
            $SED = array();
            $LSD = array();

            $SE['min']  = sqrt($MSE / min($reps));
            $SED['min'] = sqrt(2) * $SE['min'];
            $LSD['min'] = $this->kashi->inverseTCDF(0.05, $errorDF) * $SED['min'];

            $SE['max']  = sqrt($MSE / max($reps));
            $SED['max'] = sqrt(2) * $SE['max'];
            $LSD['max'] = $this->kashi->inverseTCDF(0.05, $errorDF) * $SED['max'];
        }
        
		$CV  = 100 * sqrt($MSE) / $grandMean;
        
		$anova['TDF']   = $treatDF;
		$anova['EDF']   = $errorDF;
        $anova['TotDF'] = $totalDF;
		$anova['SST']   = $SST;
		$anova['SSE']   = $SSE;
		$anova['SSTot'] = $SSTot;
		$anova['MST']   = $MST;
		$anova['MSE']   = $MSE;
		$anova['VRT']   = $VRT;
        $anova['F']     = $F;
		$anova['Mean']  = $grandMean;
		$anova['Means'] = $means;       
        $anova['Reps']  = $reps;
		$anova['SE']    = $SE;
		$anova['SED']   = $SED;
		$anova['LSD']   = $LSD;
		$anova['CV']    = $CV;
        
        return $anova;
    }
}
