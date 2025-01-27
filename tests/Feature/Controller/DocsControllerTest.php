<?php

use App\Services\Documents\Location;
use Tests\TestCase;

class DocsControllerTest extends TestCase
{

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $this->createApplication();
    }


    /**
     * @dataProvider versionProvider
     * @param $version
     * @param $urls
     */
    public function testDocs($version, $urls)
    {


        $this->get(route('docs.show', [$version]))->assertStatus(200);

        $url = shuffle($urls)[0];

        if (strpos($url, "api")) {
            $this->get($url)->assertStatus(301);
        } else {
            $this->get($url)->assertStatus(200);
        }
    }


    public function versionProvider()
    {

        $return = [];

        $versions = config('docs.versions');
        $parseTargetDocument = 'documentation';

        /**
         * @var Location $location
         */
        $location = resolve(Location::class);
        $location->setLanguage('ko');

        foreach ($versions as $version => $versionStatus) {


            $location->setVersion($version);
            $fileContent = file_get_contents($location->getFileLocation($parseTargetDocument));

            $fileContent = str_replace("{{version}}", $version, $fileContent);

            preg_match_all('/\((?P<url>.*)\)/', $fileContent, $matches);
            $return[] = [$version, $matches['url']];
        }


        return $return;
    }

}
