<?php
/**
 * ���������� �������� � ���. ������������
 */
function request_after_update()
{
    $tr = new RequestTranslator();
    $tr->assignMany($_POST);
}