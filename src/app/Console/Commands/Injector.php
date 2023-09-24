<?php

namespace App\Console\Commands;

use App\Models\Setting;
use DOMDocument;
use Illuminate\Console\Command;

class Injector extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'toolbox:inject';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Inject custom CSS/JS files into CasaOS';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $host = Setting::where('name','base_url')->pluck('value')[0];

        $htmlFilePath = '/casaos/www/index.html';
        $cssFilePath = "//{$host}/casaos-toolbox.css";

        $dom = new DOMDocument();
        $dom->loadHTMLFile($htmlFilePath);

        $linkElements = $dom->getElementsByTagName('link');
        $linksToRemove = [];
        foreach ($linkElements as $linkElement) {
            $href = $linkElement->getAttribute('href');
            if (str_contains($href, 'casaos-toolbox')) {
                $linksToRemove[] = $linkElement;
            }
        }

        foreach ($linksToRemove as $linkElement) {
            $linkElement->parentNode->removeChild($linkElement);
        }

        $linkElement = $dom->createElement('link');
        $linkElement->setAttribute('rel', 'stylesheet');
        $linkElement->setAttribute('type', 'text/css');
        $linkElement->setAttribute('href', $cssFilePath);

        $headElement = $dom->getElementsByTagName('head')->item(0);
        $headElement->appendChild($linkElement);

        $modifiedHtml = $dom->saveHTML();
        file_put_contents($htmlFilePath, $modifiedHtml);
    }
}
