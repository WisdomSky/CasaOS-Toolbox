<?php
namespace App\Http\Controllers;

use App\Models\Setting;
use App\Services\Toolbox;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;


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

        Artisan::call('toolbox:inject');

        return back();
    }

    public function cleaner(Request $request) {

        Artisan::call('toolbox:uninject');

        return back();
    }


    public function getBaseUrl() {
        $host = Setting::where('name','base_url')->pluck('value')[0];
        return response("//{$host}");
    }

    public function getCurrentVersion() {
        return response(config('app.casaos_toolbox_version'));
    }

    public function getLatestVersion(Toolbox $toolbox) {
        return response($toolbox->getToolboxLatestVersion());
    }

}
