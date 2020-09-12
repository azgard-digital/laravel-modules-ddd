<?php


namespace App\Http\Parser;

use Illuminate\Http\Request;

final class Accept
{
    /**
     * Available formats.
     *
     * @var array
     */
    private $formats;

    /**
     * Version List.
     *
     * @var array
     */
    private $versions;

    /**
     * Default version.
     *
     * @var string
     */
    private $version;


    public function __construct()
    {
        $this->formats = config('accept.formats');
        $this->versions = config('accept.versions');
        $this->version = config('accept.version');
    }

    public function isAvailableFormat(Request $request):bool
    {
        $acceptHeader = $request->header('Accept', '');
        $acceptHeader = explode(';',  $acceptHeader);

        if (!isset($acceptHeader[0]) || array_search($acceptHeader[0], $this->formats) === false) {
            return false;
        }

        return true;
    }

    public function parseApiVersion(Request $request):string
    {
        $acceptHeader = $request->header('Accept', '');
        $uri = $request->getRequestUri();

        if (!$acceptHeader || strpos($uri, "api") === false) {
            return '';
        }

        $acceptHeader = explode(';',  $acceptHeader);

        if (!isset($acceptHeader[1])) {
            return $this->version;
        }

        parse_str(trim($acceptHeader[1]), $output);

        if (!isset($output['version']) || array_search($output['version'], $this->versions) === false) {
            return $this->version;
        }

        return $output['version'];
    }
}
