<?
define('DEBUG', false);

/*

������� ������-926, 925
������� �����-920
������� ������ �����(���������)-921
������� ����-922
������� ������-923
������� ������� ������-924
������� ��������-927, 937, 922
������� ������-928
������ ��� �������-929
������� ��-920
������� �����-920
���� ���������-499, 926
������-926
��������-901,495
������-903,905,906,909,960,961,962,963,964,965,967
���-910,911,912,913,914,915,916,917,918,919,980,985,987,988,981,495
����2-904,908,951,950,952
���-952

*/

global $siteurl, $ForbiddenChars, $AllowedChars, $RequestRequiredFields, $calculator, $filestoragepath;

define("DB_HOST", "localhost");
define("DB_USER", "");
define("DB_PASS", "");
define("DB_NAME", "");

$connection = mysql_pconnect(DB_HOST,
                            DB_USER,
                            DB_PASS);
mysql_select_db(DB_NAME, $connection);

mysql_query("SET character_set_client = cp1251");
mysql_query("SET character_set_connection = cp1251");
mysql_query("SET character_set_results = utf8");


$ForbiddenChars = array("'", "�", "�", "�", "� ", "`", "'",">","<","\"");
$AllowedChars = array("&#39;", "&rdquo;", "&ldquo;", "&rsquo;", "&lsquo;", "&#96;", "&#39;","&gt;","&lt;","&quot;");

$YesOrNoArray = array("No","Yes");

$ShippingOptions = array("USPS First Class","USPS Overnight");

// ������������ � ���������� ���� ��� �������� �� �������
$RequestRequiredFields = array("toemail"=>"E-mail address", "toname"=>"Contact name", "source_text"=>"Source text");

// ������������ ���� ��� ������������
$ToEstimateRequiredFields = array("source_text"=>"Source text");

// ���������� ������������
$calculator	= array("maxwordsperday"=>1000, "baseppw"=>0.05);

// ����� �������� ������
$filestoragepath = $_SERVER['DOCUMENT_ROOT']. "/shared/";

// ����� ��� ��������� ������
$tempfilestoragepath = $_SERVER['DOCUMENT_ROOT']. "/temp/";

$SMSPortals = array(

"mts"=>"http://www.mts.ru/messaging1/sendsms/?",
"beeline"=>"http://www.beeline.ru/sms/index.wbp?",
"beeline_ua"=>"http://www.kyivstar.ua/sms/?",
"megafon"=>"http://msk.sendsms.megafon.ru/?",
"mtsu"=>"http://www.mts.com.ua/ukr/sendsms.php?",
"kyivstar"=>"http://www.kyivstar.ua/sms/?",
"life"=>"https://www.life.com.ua/sms/smsFree.html?locale=ua&",
"tele2spb"=>"http://www.spb.tele2.ru/send_sms.html",

);

$trackingUtils = array(
"usps" => "http://trkcnfrm1.smi.usps.com/PTSInternetWeb/InterLabelInquiry.do?origTrackNum=",
);


$viewPaymentIds = array(

	"ppl" => "https://www.paypal.com/us/cgi-bin/webscr?cmd=_view-a-trans&id=94L16857HA288254W",

);

// http://mtt.ru/info/def/index.wbp?def=964&number=326&region=&standard=&date=&operator=

?>
