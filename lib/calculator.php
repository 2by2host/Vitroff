<?

global $calculator, $price, $dateCanBeCompleted, $minimal;

$source_text	= $_POST['source_text'];

// ������� ������ ���������� ����
$_POST['wordcount'] = $wordcount = str_word_count(stripslashes(htmlspecialchars($source_text)));

// ��������� ������� ����
$baseprice		= round(($calculator['baseppw'] * $wordcount),2);

// ��������� ������� ����
$price['usd']	= round(($baseprice + 0.30 + $baseprice * 0.04),2);

// ���� ���� ������ 4,75
if ($price['usd'] > 4.75) {
	$price['eur']	= round(($price['usd']*0.8000),2);
	$price['gbp']	= round(($price['usd']*0.5615),2);
	$price['cad']	= round(($price['usd']*1.12),2);
	$price['aud']	= round(($price['usd']*1.33),2);
}

// ���� ������, �� ��������� ��� �������� ������� ������ 4,75
else {
	$price = array('usd'=> 4.75, 'eur' => 4.75, 'gbp'=> 4.75, 'cad'=> 4.75, 'aud'=> 4.75);

	// � ���������� ������� � ������� ������������ �������
	$minimal = "<div style='font-size:90%; margin-bottom: 5px;'><br> The minimal payment in $price[usd] USD<br> ($price[aud] AUD or $price[eur] EUR or $price[gbp] GBP or $price[cad] CAD) applies.</div>";
}

?>