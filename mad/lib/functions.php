<?php
/**
 * �������
 *
 * @author Vladimir Chmil <vladimir.chmil@gmail.com>
 */

/**
 * stdoutToString()
 *
 * ����� ������� mad � ������� ���������� �� ���������� � ���������� (������ echo)
 *
 * ������ ������:
 * $echo = stdoutToString('GenerateInputTag', 'ppwt1', "Translator's price", "text", " &nbsp;", "<br>", "");
 *
 * � $echo ����� ����� GenerateInputTag()
 *
 * @param ��� ���������� �������
 * @param ���������� �-��� 1
 * .........................
 * @param ���������� �-��� N-1
 * @param ���������� �-��� N
 *
 * @return string
 */
function stdoutToString()
{
    $args = func_get_args();
    $func = array_shift($args);

    if (is_callable($func)) {
        ob_start();

        call_user_func_array($func, $args);

        $tag = ob_get_contents();
        ob_end_clean();

        return $tag;
    }

    return "";
}

/**
 * ���������� ������ ���� � ������� html. ��� ������� �����-�� ��� � $file
 *
 * @param $file   ��� php ������� (__FILE__)
 * @param $suffix file name suffix
 *
 * @return string
 */
function getTemplateFullPath($file, $suffix = "")
{
    return dirname($file) . "/" . str_replace(".php", "", basename($file)) . $suffix . ".html";
}


/**
 * ���������� ������ � �������, ������� ���� � $allowed_fields
 *
 * @param $input_array
 * @param $allowed_fields
 *
 * @return array
 */
function filterRequestArray($input_array, $allowed_fields)
{
    return array_intersect_key($input_array, array_flip($allowed_fields));
}
