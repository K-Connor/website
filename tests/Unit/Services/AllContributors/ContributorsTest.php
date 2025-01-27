<?php

namespace Tests\Unit;

use App\Services\AllContributors\EmojiConverter;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Services\AllContributors\Contributors;
use App\Services\AllContributors\TakeGitContributors;


class ContributorsTest extends TestCase
{
    /**
     * @dataProvider testDataSamples
     */
    public function testGetHtml(string $body)
    {
        // Arrange
        $responseMock = \Mockery::mock(\GuzzleHttp\Psr7\Response::class);
        $responseMock->shouldReceive('getContents')->andReturn($body);
        $responseMock->shouldReceive('getStatus')->andReturn(200);
        $responseMock->shouldReceive('getBody')->andReturn($responseMock);

        $requsetMock = \Mockery::mock(\GuzzleHttp\Client::class);
        $requsetMock->shouldReceive('get')->andReturn($responseMock);

        // Act
        $contributors = new Contributors(new EmojiConverter(), new TakeGitContributors($requsetMock));
        $res = $contributors->getHtml();

        // Assert
        $this->assertIsString($res);
    }

    /**
     * @dataProvider testDataSamples
     */
    public function testGetHtmlSpy(string $body)
    {
        // Arrange
        $responseSpy = \Mockery::spy(\GuzzleHttp\Psr7\Response::class);
        $responseSpy->shouldReceive('getContents')->andReturn($body);
        $responseSpy->shouldReceive('getBody')->andReturn($responseSpy);

        $requsetSpy = \Mockery::spy(\GuzzleHttp\Client::class);
        $requsetSpy->shouldReceive('get')->andReturn($responseSpy);

        // Act
        $contributors = new Contributors(new EmojiConverter(), new TakeGitContributors($requsetSpy));
        $res = $contributors->getHtml();

        // Assert
        $this->assertIsString($res);
    }


    public function testDataSamples()
    {
        return [
            [
                <<<EOL
{
  "projectName": "docs",
  "projectOwner": "laravelkr",
  "repoType": "github",
  "repoHost": "https://github.com",
  "files": [
    "README.md"
  ],
  "imageSize": 100,
  "commit": false,
  "contributors": [
    {
      "login": "findstar",
      "name": "Jung-Soo Ahn",
      "avatar_url": "https://avatars2.githubusercontent.com/u/1266944?v=4",
      "profile": "http://findstar.pe.kr",
      "contributions": [
        "doc"
      ]
    },
    {
      "login": "kkame",
      "name": "KKAME",
      "avatar_url": "https://avatars3.githubusercontent.com/u/4939813?v=4",
      "profile": "http://kkame.net",
      "contributions": [
        "doc"
      ]
    },
    {
      "login": "natz92",
      "name": "Natz",
      "avatar_url": "https://avatars1.githubusercontent.com/u/25763747?v=4",
      "profile": "https://github.com/natz92",
      "contributions": [
        "doc"
      ]
    },
    {
      "login": "ukits",
      "name": "SungUk Byun",
      "avatar_url": "https://avatars1.githubusercontent.com/u/946148?v=4",
      "profile": "https://github.com/ukits",
      "contributions": [
        "doc"
      ]
    },
    {
      "login": "whdckszxxx",
      "name": "Jong Chan Park",
      "avatar_url": "https://avatars2.githubusercontent.com/u/14170948?v=4",
      "profile": "https://github.com/whdckszxxx",
      "contributions": [
        "doc"
      ]
    },
    {
      "login": "kwonmory",
      "name": "KWONMORY",
      "avatar_url": "https://avatars3.githubusercontent.com/u/12936720?v=4",
      "profile": "https://github.com/kwonmory",
      "contributions": [
        "doc"
      ]
    },
    {
      "login": "lastgleam",
      "name": "Donghee KIM",
      "avatar_url": "https://avatars0.githubusercontent.com/u/18328030?v=4",
      "profile": "https://lastgleam.github.io",
      "contributions": [
        "doc"
      ]
    },
    {
      "login": "getsolaris",
      "name": "Mingeun Kim",
      "avatar_url": "https://avatars2.githubusercontent.com/u/19664237?v=4",
      "profile": "https://mingeun.com",
      "contributions": [
        "doc"
      ]
    },
    {
      "login": "AcidF0x",
      "name": "Duhui Cho",
      "avatar_url": "https://avatars0.githubusercontent.com/u/35107271?v=4",
      "profile": "https://acidf0x.github.io",
      "contributions": [
        "doc"
      ]
    },
    {
      "login": "idpokute",
      "name": "Mike Sehui Park",
      "avatar_url": "https://avatars1.githubusercontent.com/u/5393574?v=4",
      "profile": "https://github.com/idpokute",
      "contributions": [
        "doc"
      ]
    },
    {
      "login": "comsiro",
      "name": "comsiro",
      "avatar_url": "https://avatars3.githubusercontent.com/u/12705399?v=4",
      "profile": "https://github.com/comsiro",
      "contributions": [
        "doc"
      ]
    },
    {
      "login": "youngiggy",
      "name": "Joo Youngik",
      "avatar_url": "https://avatars1.githubusercontent.com/u/1668413?v=4",
      "profile": "https://github.com/youngiggy",
      "contributions": [
        "doc"
      ]
    },
    {
      "login": "NoGeunYoug",
      "name": "NoGeunYoug",
      "avatar_url": "https://avatars2.githubusercontent.com/u/22785651?v=4",
      "profile": "https://github.com/NoGeunYoug",
      "contributions": [
        "doc"
      ]
    },
    {
      "login": "smartbos",
      "name": "Hyunseok Lee",
      "avatar_url": "https://avatars2.githubusercontent.com/u/6157033?v=4",
      "profile": "http://leehyunseok.com",
      "contributions": [
        "doc"
      ]
    },
    {
      "login": "Hann",
      "name": "Jinsoo Han",
      "avatar_url": "https://avatars2.githubusercontent.com/u/718811?v=4",
      "profile": "https://github.com/Hann",
      "contributions": [
        "doc"
      ]
    },
    {
      "login": "YangMinJoo",
      "name": "Cherry Pie",
      "avatar_url": "https://avatars2.githubusercontent.com/u/24889107?v=4",
      "profile": "https://github.com/YangMinJoo",
      "contributions": [
        "doc"
      ]
    },
    {
      "login": "yupmin",
      "name": "yun young-jin",
      "avatar_url": "https://avatars1.githubusercontent.com/u/880878?v=4",
      "profile": "https://yupmin.net/",
      "contributions": [
        "doc"
      ]
    },
    {
      "login": "tienne",
      "name": "David Kwon",
      "avatar_url": "https://avatars2.githubusercontent.com/u/9584768?v=4",
      "profile": "http://web-front-end.tistory.com/",
      "contributions": [
        "doc"
      ]
    },
    {
      "login": "ChangJoo-Park",
      "name": "ChangJoo Park(박창주)",
      "avatar_url": "https://avatars0.githubusercontent.com/u/1451365?v=4",
      "profile": "http://kr.vuejs.org",
      "contributions": [
        "doc"
      ]
    },
    {
      "login": "ZerglingGo",
      "name": "ZerglingGo",
      "avatar_url": "https://avatars0.githubusercontent.com/u/3365053?v=4",
      "profile": "https://zerglinggo.net/",
      "contributions": [
        "doc"
      ]
    },
    {
      "login": "dspaudio",
      "name": "Wonkyoo Nam",
      "avatar_url": "https://avatars1.githubusercontent.com/u/869240?v=4",
      "profile": "https://github.com/dspaudio",
      "contributions": [
        "doc"
      ]
    },
    {
      "login": "GoodGoodJM",
      "name": "GoodGoodMan",
      "avatar_url": "https://avatars3.githubusercontent.com/u/8029093?v=4",
      "profile": "https://github.com/GoodGoodJM",
      "contributions": [
        "doc"
      ]
    },
    {
      "login": "ModernPug",
      "name": "Modern PHP User Group",
      "avatar_url": "https://avatars3.githubusercontent.com/u/8666157?v=4",
      "profile": "http://modernpug.org",
      "contributions": [
        "doc"
      ]
    },
    {
      "login": "XpressEngine",
      "name": "XpressEngine",
      "avatar_url": "https://avatars3.githubusercontent.com/u/1429259?v=4",
      "profile": "https://www.xpressengine.io/",
      "contributions": [
        "doc"
      ]
    },
    {
      "login": "inyoungk",
      "name": "inyoungk",
      "avatar_url": "https://avatars2.githubusercontent.com/u/48192948?v=4",
      "profile": "https://github.com/inyoungk",
      "contributions": [
        "doc"
      ]
    },
    {
      "login": "strawoo",
      "name": "WooHyunPark",
      "avatar_url": "https://avatars0.githubusercontent.com/u/11594582?v=4",
      "profile": "https://github.com/strawoo",
      "contributions": [
        "doc"
      ]
    },
    {
      "login": "meteopark",
      "name": "meteopark",
      "avatar_url": "https://avatars1.githubusercontent.com/u/8869584?v=4",
      "profile": "https://blog.meteopark.dev",
      "contributions": [
        "doc"
      ]
    },
    {
      "login": "anym0re",
      "name": "danlee",
      "avatar_url": "https://avatars3.githubusercontent.com/u/9912065?v=4",
      "profile": "https://github.com/anym0re",
      "contributions": [
        "doc"
      ]
    },
    {
      "login": "horace-velmont",
      "name": "HoraceVelmont",
      "avatar_url": "https://avatars3.githubusercontent.com/u/3744320?v=4",
      "profile": "http://velmont.cafe24.com",
      "contributions": [
        "doc"
      ]
    },
    {
      "login": "KangPilGyu",
      "name": "eiffeltop",
      "avatar_url": "https://avatars3.githubusercontent.com/u/39696372?v=4",
      "profile": "https://github.com/KangPilGyu",
      "contributions": [
        "doc"
      ]
    },
    {
      "login": "jungmyungzZ",
      "name": "Kim Jungmyung",
      "avatar_url": "https://avatars0.githubusercontent.com/u/42092924?v=4",
      "profile": "https://github.com/jungmyungzZ",
      "contributions": [
        "doc"
      ]
    },
    {
      "login": "cherryred5959",
      "name": "cherry",
      "avatar_url": "https://avatars2.githubusercontent.com/u/32331576?v=4",
      "profile": "https://github.com/cherryred5959",
      "contributions": [
        "doc"
      ]
    },
    {
      "login": "lucyholic",
      "name": "Lucy Kim",
      "avatar_url": "https://avatars3.githubusercontent.com/u/37027571?v=4",
      "profile": "https://github.com/lucyholic",
      "contributions": [
        "doc"
      ]
    },
    {
      "login": "jdssem",
      "name": "Jaedong Kim",
      "avatar_url": "https://avatars0.githubusercontent.com/u/978944?v=4",
      "profile": "http://jaedong.kim",
      "contributions": [
        "doc"
      ]
    },
    {
      "login": "fwang-laralabs",
      "name": "fwang-laralabs",
      "avatar_url": "https://avatars1.githubusercontent.com/u/26479627?v=4",
      "profile": "https://github.com/fwang-laralabs",
      "contributions": [
        "doc"
      ]
    },
    {
      "login": "dhtmdgkr123",
      "name": "dhtmdgkr123",
      "avatar_url": "https://avatars1.githubusercontent.com/u/27611405?v=4",
      "profile": "https://github.com/dhtmdgkr123",
      "contributions": [
        "doc"
      ]
    },
    {
      "login": "picory",
      "name": "picory",
      "avatar_url": "https://avatars3.githubusercontent.com/u/3766114?v=4",
      "profile": "https://github.com/picory",
      "contributions": [
        "doc"
      ]
    },
    {
      "login": "devSeok",
      "name": "ohjinseok",
      "avatar_url": "https://avatars3.githubusercontent.com/u/33000980?v=4",
      "profile": "https://devseok.github.io/",
      "contributions": [
        "doc"
      ]
    },
    {
      "login": "NalCoder",
      "name": "NalCoder",
      "avatar_url": "https://avatars0.githubusercontent.com/u/57889823?v=4",
      "profile": "https://github.com/NalCoder",
      "contributions": [
        "doc"
      ]
    }
  ],
  "contributorsPerLine": 7
}
EOL,
            ],
            [
                <<<EOL
{
  "files": [
    "README.md"
  ],
  "imageSize": 100,
  "commit": false,
  "contributors": [
    {
      "login": "kkame",
      "name": "KKAME",
      "avatar_url": "https://avatars3.githubusercontent.com/u/4939813?v=4",
      "profile": "https://kkame.net",
      "contributions": [
        "code"
      ]
    },
    {
      "login": "findstar",
      "name": "Jung-Soo Ahn",
      "avatar_url": "https://avatars2.githubusercontent.com/u/1266944?v=4",
      "profile": "http://findstar.pe.kr",
      "contributions": [
        "code"
      ]
    },
    {
      "login": "K-Connor",
      "name": "K.Connor",
      "avatar_url": "https://avatars0.githubusercontent.com/u/45898974?v=4",
      "profile": "https://github.com/K-Connor",
      "contributions": [
        "code"
      ]
    }
  ],
  "contributorsPerLine": 7,
  "projectName": "website",
  "projectOwner": "laravelkr",
  "repoType": "github",
  "repoHost": "https://github.com"
}
EOL
            ],
        ];
    }


//    public function testGetResponce()
//    {
//        $text = <<< EOF
//
//EOF;
//
//
//        $responseMock = \Mockery::mock();
////        ->assertJsonPath('team.owner.name', 'foo')
//    }
}
