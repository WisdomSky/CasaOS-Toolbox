<?php

namespace App\Console\Commands;
use DOMDocument;
use Illuminate\Console\Command;

class Uninjector extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'toolbox:uninject';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Uninject custom CSS/JS files from CasaOS';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $htmlFilePath = '/casaos/www/index.html';

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

        $modifiedHtml = $dom->saveHTML();

        file_put_contents($htmlFilePath, $modifiedHtml);

    }
}
