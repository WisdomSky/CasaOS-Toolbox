<?php
namespace App\Http\Controllers;

use App\Models\AppHide;


class AssetGeneratorController extends Controller
{
    public function getCSS() {

        $css = [];

        foreach (AppHide::where('hide','1')->get() as $hidden_app) {
            $css["#app-{$hidden_app->app_id}"] = [
                "display" => "none"
            ];
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
