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
        /* 

        Usei uma autenticação para SOAP como mais uma camada de segurança para liberação do wifi somente para um grupo de funcionarios porém a lógica é livre.
        Basta enviar a resposta para o watchguard com o hash para a validação.

        https://www.watchguard.com/help/docs/help-center/en-US/Content/en-US/Fireware/authentication/hotspot_external_web_server_config_c.html
        
        */

        $login =  $this->validarUsuario($_REQUEST['usuario'], $_REQUEST['password']);

        if ($login == true) {

            $xtm = $_REQUEST['xtm'];
            $redirect = $_REQUEST['redirect'];

            // Hash = SHA1(ts + sn + mac + success + sess-timeout + idle_timeout + shared_secret)
            $hash = $_REQUEST['ts'] . $_REQUEST['sn'] .  $_REQUEST['mac'] . 1 . 1200 . 600 . $_ENV['SHARED_SECRET'];

            // Os parâmetros seguem orientações da documentação do watchguard. ELes podem ir com valores padrões ou setados diretamente na configuração do firebox.

            $sig = hash("SHA1", $hash);

            $url = "$xtm?action=hotspot_auth&ts={$_REQUEST['ts']}&success=1&sess_timeout=1200&idle_timeout=600&sig=$sig&redirect=$redirect";


            return header("Location: $url");
        }

        $_SESSION['type'] = "danger";
        $_SESSION['message'] = "Usuário ou senha inválido";

        return header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    protected function validarUsuario($login, $senha): bool
    {
        //logica de validação de usuario
        return true;
    }
}