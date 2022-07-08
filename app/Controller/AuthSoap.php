<?php

namespace App\Controller;

use GuzzleHttp\Psr7;
use SoapClient;

class AuthSoap extends Controller
{
    protected $client;


    public function __construct()
    {
        $this->client = new SoapClient('http://seguranca.aridesa.com.br/ldap/default.asmx?WSDL');
    }


    public function store()
    {
        $loginAd =  $this->validarUsuarioAD($_REQUEST['usuario'], $_REQUEST['password']);

        if ($loginAd == true) {

            $_REQUEST['ts'];
            $_REQUEST['sn'];
            $_REQUEST['mac'];

            // Hash = SHA1(ts + sn + mac + success + sess-timeout + idle_timeout + shared_secret)
            $hash = $_REQUEST['ts'] . $_REQUEST['sn'] .  $_REQUEST['mac'] . 1 . 1200 . 600 . $_ENV['SHARED_SECRET'];
            $sig = hash("SHA1", $hash);

            $url = "http://10.40.0.1:4106/wgcgi.cgi?action=hotspot_auth&ts={$_REQUEST['ts']}&success=1&sess_timeout=1200&idle_timeout=600&sig=$sig&redirect=https://aridesa.com.br/";


            return header("Location: $url");
        }

        $_SESSION['type'] = "danger";
        $_SESSION['message'] = "Usuário ou senha inválido";

        return header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    protected function validarUsuarioAD($login, $senha)
    {
        try {
            $function = 'ValidaLDAP';
            $arguments = array($function => array('userid' => $login, 'password' => $senha));
            $result = $this->client->__soapCall($function, $arguments);
            if ($result->ValidaLDAPResult == 0) {
                return true;
            } else {
                return false;
            }
        } catch (\Exception $e) {
            die('Ocorreu um erro no Webservice - ' . $e->getMessage());
        }
    }
}