<?php

namespace App\Classes;

use App\Models\AppHide;
use Exception;
use Symfony\Component\Process\Process;
use Illuminate\Support\Facades\File;
use JsonSerializable;

class CasaosApp implements JsonSerializable
{

    private string $app_id = '';
    private array $app_compose = [];

    public function __construct(string $app_id)
    {
        $this->app_id = $app_id;
        $app_base_path = Constants::PATH_CASAOS_APPS . "/" . $app_id;

        if (File::exists($app_base_path . '/docker-compose.yaml')) {
            $this->app_compose = yaml_parse_file($app_base_path . '/docker-compose.yaml');
        } else if (File::exists($app_base_path . '/docker-compose.yml')){
            $this->app_compose = yaml_parse_file($app_base_path . '/docker-compose.yml');
        }
    }

    public function isRunning() {
        $cmd = new Process(['casaos-cli', 'app-management', 'list', 'apps']);
        $cmd2 = new Process(['grep', $this->app_id.'[[:space:]]*running']);

        $cmd->run();

        $cmd2->setInput($cmd->getOutput());
        $cmd2->run();

        $cmd->wait();
        $cmd2->wait();

        return strlen(trim($cmd2->getOutput())) > 0;
    }

    public function appId() {
        return $this->app_id;
    }

    public function title() {
        try {
            return $this->app_compose['x-casaos']['title']['en_us'];
        } catch (Exception $e) {
            return $this->app_id;
        }
    }

    public function icon() {
        try {
            return $this->app_compose['x-casaos']['icon'];
        } catch (Exception $e) {
            return '';
        }
    }

    public function visible() {

        $row = AppHide::where('app_id',$this->app_id)->first();

        if (!is_null($row)) {
            return !$row->hide;
        }
        return true;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'app_id' => $this->appId(),
            'title' => $this->title(),
            'icon' => $this->icon(),
            'visible' => $this->visible()
        ];
    }
}
