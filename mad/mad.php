<?php
error_reporting(0);

// ��������� ����� ��� ������� � ������� �������
include "../lib/shared.php";

// ����� ������� ��� ������ � mysql (insert, update, delete)
include "../lib/default.func.php";

// ������������� �������
include "lib/lib.php";

/* ����� ���������� 2013 */
include "lib/init.php";

// ���������� �������, ���������� ����� GET/POST
include "lib/default.php";

// ����������� ������� �������� ���� (���� ��� �������)
include "tpl/$pagetemplate.html";

?>