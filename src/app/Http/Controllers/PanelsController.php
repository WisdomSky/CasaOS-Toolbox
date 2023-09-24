<?php

namespace App\Http\Controllers;

use App\Classes\CasaosApp;
use App\Models\AppHide;
use App\Models\PanelHide;
use App\Services\Localhost;
use Illuminate\Http\Request;
use Symfony\Component\Process\Process;

class PanelsController extends Controller
{

    public function getPanelsList(Localhost $localhost) {
        return response()->json(PanelHide::all(), 200, [], JSON_PRETTY_PRINT);
    }

    public function updatePanelVisibility(Request $request) {
        $row = PanelHide::firstOrCreate([
            'name' => $request->input('name')
        ]);

        $row->visible = $request->input('visible');

        $row->save();

        return response()->json($row);

    }
}
