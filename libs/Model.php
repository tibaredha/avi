<?php

class Model {

	function __construct() {
		$this->db = new Database(DB_TYPE, DB_HOST, DB_NAME, DB_USER, DB_PASS);
		$this->db->exec("SET CHARACTER SET utf8");
	}
	
	public function check_empty($data, $fields)
	{
		$msgr = null;
		foreach ($fields as $value) {
			if (empty($data[$value])) {
				$msgr .= "$value field empty <br />";
			}
		} 
		return $msgr;
	}
	
     public function createTable() {
        $sql = "
            CREATE TABLE IF NOT EXISTS avi1 (
                id          INT (50) AUTO_INCREMENT PRIMARY KEY,
                date        date NOT NULL,
				WILAYAD     int(10) NOT NULL,
			    COMMUNED    int(10) NOT NULL,
			    avicli      int(10) NOT NULL,
			    avicycl     int(10) NOT NULL,
			    avibtm      int(10) NOT NULL,
			    avisem      int(10) NOT NULL,
				avi0        int(10) NOT NULL,
				avi1        int(10) NOT NULL,
				avi2        int(10) NOT NULL,
				avi3        int(10) NOT NULL,
				avi4        int(10) NOT NULL,
				avi5        int(10) NOT NULL,
				avi6        int(10) NOT NULL,
				avi7        int(10) NOT NULL,
				avi8        int(10) NOT NULL,
				avi9        int(10) NOT NULL,
				avi10       int(10) NOT NULL,
				avi11       int(10) NOT NULL,
				avi12       int(10) NOT NULL,
				avi13       int(10) NOT NULL,
				avi14       int(10) NOT NULL,
				avi15       int(10) NOT NULL,
				avi16       int(10) NOT NULL,
				avi17       int(10) NOT NULL,
				avi18       int(10) NOT NULL,
				avi19       int(10) NOT NULL,
				avi20       int(10) NOT NULL,
				avi21       int(10) NOT NULL,
				avi22       int(10) NOT NULL,
				avi23       int(10) NOT NULL,
				avi24       int(10) NOT NULL,
				avi25       int(10) NOT NULL,
				avi26       int(10) NOT NULL,
				avi27       int(10) NOT NULL,
				avi28       int(10) NOT NULL,
				avi29       int(10) NOT NULL,
				avi30       int(10) NOT NULL,
				avi31       int(10) NOT NULL,
				avi32       int(10) NOT NULL,
				avi33       int(10) NOT NULL,
				avi34       int(10) NOT NULL,
				avi35       int(10) NOT NULL,
				avi36       int(10) NOT NULL,
				avi37       int(10) NOT NULL,
				avi38       int(10) NOT NULL,
				avi39       int(10) NOT NULL,
				avi40       int(10) NOT NULL,
				avi41       int(10) NOT NULL,
				avi42       int(10) NOT NULL,
				avi43       int(10) NOT NULL,
				avi44       int(10) NOT NULL,
				avi45       int(10) NOT NULL,
				avi46       int(10) NOT NULL,
				avi47       int(10) NOT NULL,
				avi48       int(10) NOT NULL,
				avi49       int(10) NOT NULL,
				avi50       int(10) NOT NULL,
				avi51       int(10) NOT NULL,
				avi52       int(10) NOT NULL,
				avi53       int(10) NOT NULL,
				avi54       int(10) NOT NULL,
				avi55       int(10) NOT NULL,
				avi56       int(10) NOT NULL,
				avi57       int(10) NOT NULL,
				avi58       int(10) NOT NULL,
				avi59       int(10) NOT NULL,
				avi60       int(10) NOT NULL,
				avi61       int(10) NOT NULL,
				avi62       int(10) NOT NULL,
				avi63       int(10) NOT NULL,
				avi64       int(10) NOT NULL,
				avi65       int(10) NOT NULL,
				avi66       int(10) NOT NULL,
				avi67       int(10) NOT NULL,
				avi68       int(10) NOT NULL,
				avi69       int(10) NOT NULL,
				avi70       int(10) NOT NULL,
				avi71       int(10) NOT NULL,
				avi72       int(10) NOT NULL,
				avi73       int(10) NOT NULL,
				avi74       int(10) NOT NULL,
				avi75       int(10) NOT NULL,
				avi76       int(10) NOT NULL,
				avi77       int(10) NOT NULL,
				avi78       int(10) NOT NULL,
				avi79       int(10) NOT NULL,
				avi80       int(10) NOT NULL,
				avi81       int(10) NOT NULL,
				avi82       int(10) NOT NULL,
				avi83       int(10) NOT NULL,
				avi84       int(10) NOT NULL,
				avi85       int(10) NOT NULL,
				avi86       int(10) NOT NULL,
				avi87       int(10) NOT NULL,
				avi88       int(10) NOT NULL,
				avi89       int(10) NOT NULL,
				avi90       int(10) NOT NULL,
				avi91       int(10) NOT NULL,
				avi92       int(10) NOT NULL,
				avi93       int(10) NOT NULL,
				avi94       int(10) NOT NULL,
				avi95       int(10) NOT NULL,
				avi96       int(10) NOT NULL,
				avi97       int(10) NOT NULL,
				avi98       int(10) NOT NULL,
				avi99       int(10) NOT NULL				
            );
         ";
        return $this->db->exec($sql);
    }
}