<?php
namespace App\Http\Controllers;

use App\Models\Setting;
use App\Services\Toolbox;
use Illuminate\Http\Request;


class SettingsController extends Controller
{
    public function getSettings() {
        return response()->json(collect(Setting::all())->mapWithKeys(function ($setting) {
            return [$setting->name => $setting->value];
        }));
    }


    public function saveSettings(Request $request) {

        if ($request->has('base_url')) {
            $host = Setting::where('name', 'base_url')->first();
            $host->value = $request->input('base_url');
            $host->save();
        }

        return $this->getSettings();
    }

    public function getBaseUrl() {
        $ip = Setting::where('name','base_url')->pluck('value')[0];
        $port = config('app.webui_port');
        return response("http://{$ip}:{$port}");
    }

    public function getCurrentVersion() {
        return response(config('app.casaos_toolbox_version'));
    }

    public function getLatestVersion(Toolbox $toolbox) {
        return response($toolbox->getToolboxLatestVersion());
    }

}
