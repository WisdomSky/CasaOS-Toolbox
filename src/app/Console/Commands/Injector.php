<?php

namespace App\Console\Commands;

use App\Models\Setting;
use App\Services\Localhost;
use DOMDocument;
use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

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
    public function handle(Localhost $localhost)
    {

        $ip = Setting::where('name','base_url')->pluck('value')[0];
        $port = env('WEBUI_PORT');

        $this->info("IP: {$ip}:{$port}");

        $htmlFilePath = '/casaos/www/index.html';
        $cssFilePath = "http://{$ip}:{$port}/casaos-toolbox/apphide.css";


        $dom = new DOMDocument();
        $dom->loadHTMLFile($htmlFilePath);


        $cssLinks = $dom->getElementsByTagName('link');

        foreach ($cssLinks as $link) {

            if (str_contains($link->getAttribute('href'), 'casaos-toolbox')) {
                $link->parentNode->removeChild($link);
            }

        }

        $linkElement = $dom->createElement('link');
        $linkElement->setAttribute('rel', 'stylesheet');
        $linkElement->setAttribute('type', 'text/css');
        $linkElement->setAttribute('href', $cssFilePath);

        // Append the <link> element to the <head> section
        $headElement = $dom->getElementsByTagName('head')->item(0);
        $headElement->appendChild($linkElement);

        // Save the modified HTML back to a file
        $modifiedHtml = $dom->saveHTML();
        file_put_contents($htmlFilePath, $modifiedHtml);
    }
}
