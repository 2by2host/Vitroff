<?

function PostParser() {

	global $action, $error_msg, $Settings; 

	$do = $_POST['dosometh'];

	switch($do) {

	default:

		break;

	// ������ ���: ������� ��������� ��������
	case "step1":

		global $ToEstimateRequiredFields, $wordcount;

		// �������� ��� ����������� ���������� ��������
		$action = "step1";

		// ����������. �������� ��������� �����
		if (!IsRequiredFieldsFilled(&$ToEstimateRequiredFields)) { $action = "default"; break; }
		
		// � ������ ����, ���� ��� ���� ���������, ���������� ����������� � ������ ��������
		else include "lib/calculator.php";

		break;

	// ����������� ����� �������� ������ � ��������� �������������� �������� � ���������
	case "step2":

		$action = "step2";
		break;


	// �������� ������
	case "step3":

		global $RequestRequiredFields;
		include "lib/default.func.php";

		// I. �������� ��������� �����
		if (!IsRequiredFieldsFilled($RequestRequiredFields)) { $action = "step2"; break; }
	
		// II. ����������� �������:
		// ���� ������������ ��� ����� ������ �������� (������ ����� ��), ��:
		if (!ProcessSQL ('customers', "WHERE email = '$_POST[toemail]'")) {

			$table = "customers";
			
			// �. �������������� ������ ��� ����� ������� ������	
			$details['ip'] = $_SERVER['REMOTE_ADDR'];
			$details['email'] = trim($_POST['toemail']);

			// �������� ��� � ������� �������
			$name = explode(" ", trim($_POST['toname']));
			$details['firstname']	= ucfirst($name['0']);
			$details['lastname']	= ucfirst($name['1']);

			// ���� ����������� �������� 
			$details['timestamp'] = date('Y-m-d hh:mm:ss');

			// �. ������� ������ � ������� � ���� ������
			insert_data (&$details, &$table);
		
		}
		
		// III. ��������� ����������� ������� � ���� ������
		$table = "requests";
		
		// ����������� ���������� details ��� ���������� POST 
		$details = $_POST;

		// �������� ��� �������������, ���� �� ���� ����������, ��� ������� � ������� ��������
		$details['customer_id'] = ProcessSQL ('customers', "WHERE email = '$_POST[toemail]'");

		// �������� ��������� ����� � ������, ���� ��� ����
		$estimatedAmount = explode(" ", trim($_POST['estimatedprice']));
		$details['estimatedprice']	= $estimatedAmount['0'];
		$details['currency']		= $estimatedAmount['1'];
		$details['status_id']		= 1;

		// ���� �� ������� ��������� ����� ����������, �� ������ ���� ����
		if (empty($details['deadline'])) {
			$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")+5, date("Y"));
			$details['deadline'] = date('Y-m-d',$tomorrow);
		}

		// ������� ������ ������ ��� ����������� ������� � ��
		unset($details['toname'], $details['subject'], $details['ip'], $details['toemail'], $details['email'], $details['firstname'], $details['lastname']);

		// ������ ������� ������� � ������� requests
		insert_data (&$details, &$table);

		// IV. ���������� ��������� �������
		// ��������� ������ ��� ������������� ���������
		$template = mysql_fetch_array(mysql_query("SELECT * FROM templates WHERE id = '5'"));

			$_POST['fromname']	= $Settings['company_name'];
			$_POST['fromemail']	= $Settings['email']; 
			eval("\$_POST[content] = \"$template[content]\";");
			$_POST['subject']	= $template['subject'];

		sendmail();

		// ���������� ��������� �������
		// sendmail();

		$action = "null";
		$error_msg = "Your request was successfully submitted to our staff. Please allow us up to 24 hours for a reply.";

		break;

	}

}
?>