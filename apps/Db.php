<?php

class Db{

	protected $db;

	public function __construct(){

		try {

			if(strcmp(OUR_DOMAINNAME, LIVE_DOMAIN) == 0) {
				

			    $username = 'sksoftsolutions_simpleaccounting';

				$password = 'UPL)TrZk+J5)';

				$database = 'sksoftsolutions_simpleaccounting';

			}

			else{

				
				$username = 'root';

				$password = '';

				$database = 'simpleaccounting';

			}

			$_SESSION["currency"] = '£';

			$this->db = new PDO("mysql:dbname=$database;host=localhost;charset=utf8", $username, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

		}



		catch (PDOException $e) {

			$this->writeIntoLog('Connection failed: ' . $e->getMessage());

			sleep(5);

			call_user_func('__construct');

		}

	}



	public function writeIntoLog($message){

		if($message !=''){

			$fileName = './error_log';

			if(is_array($message)){$message = implode(', ', $message);}

			file_put_contents($fileName, date('Y-m-d H:i:s')." $message\n",FILE_APPEND);

		}

	}



	public function getObj($statement, $bindData, $paramType=0){

		$sql = $this->db->prepare($statement);

		if(!empty($bindData)){

			foreach($bindData as $fieldname=>$fieldvalue){

				if($paramType>0){

					$sql->bindValue(":$fieldname",$fieldvalue, PDO::PARAM_INT);

				}

				else{

					$sql->bindValue(":$fieldname",$fieldvalue, PDO::PARAM_STR);

				}

			}

		}

		$sql->execute();

		$errors = $sql->errorInfo();

		if($errors[2]==''){

			if($sql->rowCount()>0){

				return $sql;

			}

			else{

				return false;

			}

		}

		else{

			$this->writeIntoLog('Query failed: ' . $errors[2]." near $statement");

			return false;

		}

	}



	public function getData($statement, $bindData, $paramType=0){

		$sql = $this->db->prepare($statement);

		if(count($bindData)>0){

			foreach($bindData as $fieldname=>$fieldvalue){

				if($paramType>0){

					$sql->bindValue(":$fieldname",$fieldvalue, PDO::PARAM_INT);

				}

				else{

					$sql->bindValue(":$fieldname",$fieldvalue, PDO::PARAM_STR);

				}

			}

		}

		$result = $sql->execute();

		if($result){

			$returnData = $sql->fetchAll(PDO::FETCH_ASSOC);

		}

		else{

			$errors = $sql->errorInfo();

			$this->writeIntoLog('Query Pagination failed: ' . $errors[2]." near $statement");

			$returnData = false;

		}

		return $returnData;

	}



	public function insert($tablename, $fieldsData){

		$fieldsArray = array_keys($fieldsData);

		$str = "INSERT INTO $tablename (`".implode('`, `', $fieldsArray)."`) values(:".implode(', :', $fieldsArray).")";

		$sql = $this->db->prepare($str);

		foreach($fieldsData as $fieldname=>$fieldvalue){

			$sql->bindValue(":$fieldname",$fieldvalue, PDO::PARAM_STR);

		}



		$result = $sql->execute();

		if($result){

			return $this->db->lastInsertId();

		}

		else{

			foreach($fieldsData as $field=>$value){

				$str = str_replace(":$field", $value, $str);

			}

			$errors = $sql->errorInfo();

			$this->writeIntoLog('Insert failed: ' . $errors[2]." near $str");

			return false;

		}

	}



	public function update($tablename, $fieldsData, $id){

		$idName = $tablename.'_id';

		$fieldsArray = array_keys($fieldsData);

		$str = "UPDATE $tablename SET";

		$l=0;

		foreach($fieldsArray as $oneField){

			if($l>0){$str .= ", ";}

			$str .= " $oneField = :$oneField";

			$l++;

		}

		$str .= " WHERE $idName = :$idName";

		$sql = $this->db->prepare($str);

		foreach($fieldsData as $field=>$value){

			$sql->bindValue(":$field", $value, PDO::PARAM_STR);

		}

		$sql->bindValue(":$idName",$id, PDO::PARAM_INT);

		$result = $sql->execute();

		if($result){

			return $sql->rowCount();

		}

		else{

			foreach($fieldsData as $field=>$value){

				$str = str_replace(":$field", $value, $str);

			}

			$errors = $sql->errorInfo();

			$this->writeIntoLog('Update failed: ' . $errors[2]." near $str");

			return false;

		}

	}



	public function delete($tableName, $fieldName, $fieldValue){

		$str = "DELETE FROM $tableName WHERE $fieldName = :$fieldName";

		$sql = $this->db->prepare($str);

		$sql->bindValue(":$fieldName",$fieldValue, PDO::PARAM_INT);

		$result = $sql->execute();

		if($result){

			return $sql->rowCount();

		}

		else{

			$errors = $sql->errorInfo();

			$this->writeIntoLog('Delete failed: ' . $errors[2]." near $str");

			return false;

		}

	}



	public function supportEmail($emailId = 'info'){

		$emailAddress = array('info'=>"info@".LIVE_DOMAIN,

							'support'=>"support@".LIVE_DOMAIN,

							'do_not_reply'=>"do_not_reply@".LIVE_DOMAIN

							);

		if(!array_key_exists($emailId, $emailAddress)){

			// return 'shobhancse@gmail.com';
                        return 'imranmailbd@gmail.com';


		}

		else{

			return $emailAddress[$emailId];

		}

	}



	public function seoInfo($metaName = 'metaTitle'){

		$SEOmetaData = array();

		$SEOmetaData['metaSiteName'] = " Simple Accounting & Tax Solutions Inc.";

		$SEOmetaData['metaTitle'] = "Simple Accounting & Tax Solutions Inc. | Simple Accounting";

		$SEOmetaData['metaKeyword'] = "Company Formation Service Canada, Accounting Consultant Canada, Tax Consultant Canada";

		$SEOmetaData['metaDescription'] = "Simple Accounting & Tax Solutions Inc. Your company accounting and tax solution consultant in Canada.";

		$SEOmetaData['metaDomain'] = "https://simpleaccounting.sksoftsolutions.ca/";

		$SEOmetaData['metaImage'] = $SEOmetaData['metaDomain']."assets/accounts/logo1.png";

		// $SEOmetaData['metaVideo'] = "https://www.youtube.com/@CanadianImmigrationlegal";

		$SEOmetaData['metaLocale'] = "en_CA";



		$SEOmetaData['metaUrl'] = array();

		$SEOmetaData['aboutUrl']['canadian-immigration-lawyer.html'] = 'Canadian Immigration Lawyer';

		$SEOmetaData['aboutUrl']['canadian-immigration-visa.html'] = 'Canadian Immigration Visa';

		$SEOmetaData['aboutUrl']['work-permit-visa-in-canada.html'] = 'Work Permit Visa in Canada';

		$SEOmetaData['aboutUrl']['student-visa-in-canada.html'] = 'Student Visa in Canada';

		$SEOmetaData['aboutUrl']['refugee-lawyer-toronto.html'] = 'Refugee Lawyer Toronto';

		$SEOmetaData['aboutUrl']['immigration-law-firm-toronto.html'] = 'Immigration law firm toronto';



		$SEOmetaData['immiUrl']['company-assessment.html'] = 'Company Assessment';

		$SEOmetaData['immiUrl']['immigration-program.html'] = 'Immigration Program';

		$SEOmetaData['immiUrl']['business-visa.html'] = 'Business Visa';

		$SEOmetaData['immiUrl']['visitor-visa.html'] = 'Visitor Visa';

		$SEOmetaData['immiUrl']['citizenship.html'] = 'Citizenship';

		$SEOmetaData['immiUrl']['temporary-work-visa.html'] = 'Temporary Work Visa';

		$SEOmetaData['immiUrl']['student-visa.html'] = 'Student Visa';

		$SEOmetaData['immiUrl']['immigration-appeal-hearing.html'] = 'Immigration Appeal Hearing';



		return $SEOmetaData[$metaName]??$SEOmetaData['metaTitle'];

	}

}

?>