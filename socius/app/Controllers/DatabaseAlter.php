<?php namespace App\Controllers\SpUser;
use App\Models\User;
use App\Models\Uservariable;
use CodeIgniter\Controller;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class DatabaseAlter extends Controller
{
	public function __construct()
	{
		$this->user = new User();
		$this->uservars = new Uservariable();
		$this->uri = new \CodeIgniter\HTTP\URI(current_url()); 
		
	}
	public function DatabaseImport()
    {
		$db      = \Config\Database::connect();
		$filename = site_url().'public/assets/db_smartplan24.sql';//How to Create SQL File Step : url:http://localhost/phpmyadmin->detabase select->table select->Export(In Upper Toolbar)->Go:DOWNLOAD .SQL FILE
		//$filename = 'db_smartplan24.sql';//How to Create SQL File Step : url:http://localhost/phpmyadmin->detabase select->table select->Export(In Upper Toolbar)->Go:DOWNLOAD .SQL FILE
		$op_data = '';
		$lines = file($filename);
		foreach ($lines as $line)
		{
			if (substr($line, 0, 2) == '--' || $line == '')//This IF Remove Comment Inside SQL FILE
			{
				continue;
			}
			$op_data .= $line;
			if (substr(trim($line), -1, 1) == ';')//Breack Line Upto ';' NEW QUERY
			{
				$db->query($op_data);
				$op_data = '';
			}
		}
		echo "Table Created Inside " . $database . " Database.......";
		// Close connection
    }
	
	public function DatabaseExport()
    {
		$db      = \Config\Database::connect();
		$password = 'MYPASS';
		if(isset($_POST['password']) && $_POST['password'] == $password)
		{
				
		//$con = mysqli_connect('localhost', 'democonv_smart24', 'Smd~69KAjgr@', 'democonv_smartplan24');
		$con = mysqli_connect('localhost', 'root', '', 'db_smartplan24');
		$tables = array();
		$result = mysqli_query($con,"SHOW TABLES");
		while ($row = mysqli_fetch_row($result)) {
			$tables[] = $row[0];
		}

		$return = '';

		foreach ($tables as $table) {
			$result = mysqli_query($con, "SELECT * FROM ".$table);
			$num_fields = mysqli_num_fields($result);

			$row2 = mysqli_fetch_row(mysqli_query($con, 'SHOW CREATE TABLE '.$table));
			$return .= "\n\n".$row2[1].";\n\n";

			for ($i=0; $i < $num_fields; $i++) { 
				while ($row = mysqli_fetch_row($result)) {
					$return .= 'INSERT INTO '.$table.' VALUES(';
					for ($j=0; $j < $num_fields; $j++) { 
						$row[$j] = addslashes($row[$j]);
						if (isset($row[$j])) {
							$return .= '"'.$row[$j].'"';} else { $return .= '""';}
							if($j<$num_fields-1){ $return .= ','; }
						}
						$return .= ");\n";
					}
				}
				$return .= "\n\n\n";
			
		}
		$today = date('d-m-Y');
		$backup_name = "sp24_db_backup_".$today.".sql";
		header('Content-Type: application/octet-stream');   
		header("Content-Transfer-Encoding: Binary"); 
		header("Content-disposition: attachment; filename=\"".$backup_name."\"");  
		echo $return;
		exit;
		}
		else
		{
			$error_msg = "Incrorrect password please contact to super admin";
		}
		echo view('sp-user/sql/sql');
    }
}
