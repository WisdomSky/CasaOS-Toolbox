<?php
namespace App\Http\Controllers;

use App\Classes\CasaosApp;
use App\Models\AppHide;
use Illuminate\Http\Request;
use Symfony\Component\Process\Process;


class AppsController extends Controller
{
    public function getAppsList() {

        $cmd = new Process(['casaos-cli', 'app-management', 'list', 'apps']);
        $cmd->run();
        $cmd->wait();
        $lines = explode("\n", $cmd->getOutput());

        $apps = [];
        for ($i = 2; $i < count($lines); $i++) {
            $columns = preg_split('/\s+/', $lines[$i]);
            if (strlen(trim(basename($columns[0]))) > 0) {
                $apps[] = new CasaosApp(basename($columns[0]));
            }
        }

        return response()->json($apps, 200, [], JSON_PRETTY_PRINT);
    }

    public function hideApp(Request $request) {
        $row = AppHide::firstOrCreate([
            'app_id' => $request->input('app_id')
        ]);

        $row->hide = $request->input('hide') == '1';

        $row->save();

        return response()->json($row);

    }

}
