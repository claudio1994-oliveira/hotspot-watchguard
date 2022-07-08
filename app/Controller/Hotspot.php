<?php

namespace App\Controller;

class Hotspot extends Controller
{
    public function __construct()
    {
    }

    public function create()
    {
        /* dd($_GET['action']);
        dd($_SERVER['REQUEST_URI']); */
        // ?xtm=http://10.40.0.1:4106/wgcgi.cgi&action=hotspot_auth&ts=1656421482&sn=801304402FA8F&mac=22:4A:C0:03:6C:EC&redirect=http://connectivitycheck.gstatic.com/generate_204
        $url = str_replace("?",  "/", $_SERVER['REQUEST_URI']);
        $urlReplace = str_replace("&",  "/", $url);

        $dataUrl = explode('/', $urlReplace);

        $data = [];

        foreach ($dataUrl as $recurse) {

            $key = stristr($recurse, '=', TRUE);
            $content =  strstr($recurse, '=');

            if ($content == false) {
                continue;
            }

            $data[$key] = str_replace("=", "", $content);
        }

        return $this->render('hotspot/index.php', [
            'title' => "Home",
            'path' => $_ENV['BASE_URL'] . "/auth",
            'action' => $_GET['action'],
            'ts' =>  $_GET['ts'],
            'sn' => $_GET['sn'],
            'mac' => $_GET['mac'],
            'xtm' => $_GET['xtm']

        ]);
    }
}