<?

include "../lib/shared.php";
include "../lib/default.func.php";
include "lib/lib.php";

switch(@$_GET['action']) {

default:

	break;

case "unlinkfile":

	global $filestoragepath;

	// ������� ���� ��������� � �����
	unlink($filestoragepath.$_GET['filename']);

	// ������� � ���� ������
	delete_data ("name", "files", $_GET['filename']);

	// ����� ������
	break;

case "createfile":

	SaveSourceIntofile($_GET['id']);

	break;

}

?>