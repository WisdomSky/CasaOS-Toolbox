<?php
namespace App\Http\Controllers;

use App\Models\AppHide;
use App\Models\PanelHide;
use Illuminate\Support\Facades\Auth;


class AssetGeneratorController extends Controller
{
    public function getCSS() {

        $css = [];

        foreach (AppHide::where('hide','1')->get() as $hidden_app) {
            $css["#app-{$hidden_app->app_id}"] = [
                "display" => "none"
            ];
        }

        foreach (PanelHide::all() as $panel) {

            if ($panel->name === 'settings_button' && !$panel->visible) {
                $css[".navbar-brand > *:has(.casa-tune)"] = [
                    "display" => "none !important"
                ];
            }

            if ($panel->name === 'terminal_button' && !$panel->visible) {
                $css[".navbar-brand > *:has(.casa-terminal)"] = [
                    "display" => "none !important"
                ];
            }

            if ($panel->name === 'storage_manager_button' && !$panel->visible) {
                $css[".widget-icon-button:has(.casa-setting)"] = [
                    "display" => "none !important"
                ];
            }

            if ($panel->name === 'app_menu_button' && !$panel->visible) {
                $css[".action-btn"] = [
                    "display" => "none !important"
                ];
            }

            if ($panel->name === 'app_add_new_button' && !$panel->visible) {
                $css[".dropdown:has(.casa-plus)"] = [
                    "display" => "none !important"
                ];
            }

            if ($panel->name === 'app_appstore_button' && !$panel->visible) {
                $css["[id='app-App Store']"] = [
                    "display" => "none !important"
                ];
            }

            if ($panel->name === 'app_files_button' && !$panel->visible) {
                $css["#app-Files"] = [
                    "display" => "none !important"
                ];
            }


        }


        return response($this->css_array_to_css($css))->header('Content-Type', 'text/css');
    }


    private function css_array_to_css($rules, $indent = 0): string {
        $css = '';
        $prefix = str_repeat('  ', $indent);

        foreach ($rules as $key => $value) {
            if (is_array($value)) {
                $selector = $key;
                $properties = $value;

                $css .= $prefix . "$selector {\n";
                $css .= $prefix . $this->css_array_to_css($properties, $indent + 1);
                $css .= $prefix . "}\n";
            } else {
                $property = $key;
                $css .= $prefix . "$property: $value;\n";
            }
        }

        return $css;
    }


}
