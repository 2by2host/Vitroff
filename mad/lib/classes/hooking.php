<?php

/**
 * ������ � ������. ���� ������� � lib/modules
 *
 * PHP version 5
 *
 * @category Website
 * @package  Application
 * @author   technofreak
 * @author   Vladimir Chmil <vladimir.chmil@gmail.com>
 * @license  http://mit-license.org/ MIT license
 * @link     http://thetechnofreak.com/technofreak/hook-system-php/
 */

/**
 * ����. �������� �� �������� �������� ��� � wordpress
 *
 * ���������� ��� php ����� �� HOOKS_PATH. �������� �� ����������� ����������.
 * ��������� ���������� � HOOKS_PATH �����:
 *
 * - HOOKS_PATH
 *    |- requests
 *        |- edit
 *            |- gui <- ����� ����� � html � ��.
 *            |- actions <- ����� �������� (crud etc)
 *        |- add
 *            |- ........
 *    |- translators
 *        |- add
 *            |- ........
 *
 * ��� ����������� SEF ������: vitroff.com/mad/requests/edit/480
 *
 * PHP version 5
 *
 * @category Website
 * @package  Application
 * @author   Vladimir Chmil <vladimir.chmil@gmail.com>
 * @license  http://mit-license.org/ MIT license
 * @link     http://xxx
 */
class Hooking
{
    private $hooks;

    function __construct()
    {
        /* ��������� ������� */
        foreach (
            new RecursiveIteratorIterator(
                new RecursiveDirectoryIterator(
                    HOOKS_PATH
                )
            ) as $x
        ) {
            if (stripos($x->getPathname(), ".php") !== false && is_dir($x->getPathname()) === false) {
                require_once $x->getPathname();
            }
        }

        $this->hooks = array();
    }

    function add_action($where, $callback, $priority = 50)
    {
        if (! isset($this->hooks[$where])) {
            $this->hooks[$where] = array();
        }
        $this->hooks[$where][$callback] = $priority;
    }

    function remove_action($where, $callback)
    {
        if (isset($this->hooks[$where][$callback]))
            unset($this->hooks[$where][$callback]);
    }

    function execute($where, $args = array())
    {
        if (isset($this->hooks[$where]) && is_array($this->hooks[$where])) {
            arsort($this->hooks[$where]);
            foreach ($this->hooks[$where] as $callback => $priority) {
                call_user_func_array($callback, $args);
            }
        }
    }
}

/* �����. ������� ��� Hooking (�� ���� wordpress) */
function add_action($where, $callback, $priority = 50)
{
    global $hooking_daemon;
    if (isset($hooking_daemon) && is_callable($callback))
        $hooking_daemon->add_action($where, $callback, $priority);
}

function remove_action($where, $callback)
{
    global $hooking_daemon;
    if (isset($hooking_daemon))
        $hooking_daemon->remove_action($where, $callback);
}

function execute_action($where, $args = array())
{
    global $hooking_daemon;
    if (isset($hooking_daemon))
        $hooking_daemon->execute($where, $args);
}

