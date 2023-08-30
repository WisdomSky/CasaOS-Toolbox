<?php

namespace App\Services;

use Symfony\Component\Process\Process;

class Localhost
{
    public function getNetworkIpAddress() {
        $cmd = new Process(['hostname', '-I']);
        $cmd2 = new Process(['awk', '{print $1}']);

        $cmd->run();

        $cmd2->setInput($cmd->getOutput());
        $cmd2->run();

        $cmd->wait();
        $cmd2->wait();

        return trim($cmd2->getOutput());
    }


    public function getGatewayPort() {
        $cmd = new Process(['cat', '/casaos/gateway.ini']);
        $cmd2 = new Process(['grep', 'port']);

        $cmd->run();

        $cmd2->setInput($cmd->getOutput());
        $cmd2->run();

        $cmd->wait();
        $cmd2->wait();

        return explode('=',trim($cmd2->getOutput()))[1];
    }

}
