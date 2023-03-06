<?php

namespace App\Http\Controllers;

use Barryvdh\Debugbar\Facades\Debugbar;
use Google_Client;
use Google_Service_Indexing;
use Google_Service_Indexing_UrlNotification;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class PageController extends Controller {

    public function showIndex() {
        return view('welcome');
    }

    public function showGoogleApi() {
        return view('google-api-view');
    }

    public function showTest1() {
//        $process = new Process(array('python3', public_path('/py/test.py'), 'https://youtu.be/et2TFY6knBI'));
//        $process->run();
//
//        if (!$process->isSuccessful()) {
//            throw new ProcessFailedException($process);
//        }
//        $d = $process->getOutput();
//        $text = utf8_encode($d);
//        $text = mb_convert_encoding($text, "Windows-1251", "UTF-8");
//        dd($text);

        $dir = public_path('output/');
        $file = null;
        $name = null;
        if ($handle = opendir($dir)) {
            while (false !== ($file = readdir($handle))) {
                if (preg_match('/\.(mp3)/', $file)) {
                    $file = $dir . $file;
                    $name = $file;
                    break;
                }
            }
        }
//        if($file) return response()->download($file, basename($name));
//
//        return 'null';
        return view('test1')->with('file', $file);
    }

    public function getFile() {
        $url = \request('url');

        return response()->json(['success' => true]);
    }

    public
    function showTest2() {
        return view('test2');
    }

    public
    function startApi() {
        $urls = [
            'http://45.8.96.6/google-api',
            'http://45.8.96.6/test1',
            'http://45.8.96.6/test2'
        ];

        $client = new Google_Client();

        $client->setAuthConfig(public_path('/api/my-project-test1.json'));
        $client->addScope('https://indexing.googleapis.com/batch');
        $client->setUseBatch(true);

        $service = new Google_Service_Indexing($client);
        $batch = $service->createBatch();

        foreach ($urls as $url) {
            $postBody = new Google_Service_Indexing_UrlNotification();
            $postBody->setType('URL_UPDATED');
            $postBody->setUrl($url);
            $batch->add($service->urlNotifications->publish($postBody));
        }
        $results = $batch->execute(); // it does authorize in execute()

        dump($results);

        foreach ($results as $res) {
            dump($res->getErrors());
        }
    }

    public function sendIndexNow() {
        $list_url = [
            route('main'),
            route('test1'),
            route('test2'),
        ];

        $data = [
            'host' => route('main'),
            'key' => '4f9527fd1d5843b3b272e0d10184c570',
            'keyLocation' => route('main') . '/4f9527fd1d5843b3b272e0d10184c570.txt',
            'urlList' => $list_url
        ];

        $dir = public_path('sitemaps/json/');
        try {
            if (!is_dir($dir)) {
                mkdir($dir, 0777, true);
            }
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            Debugbar::warning($e->getMessage());
            return response()->json(['success' => false, 'dir' => $dir]);
        }



//        file_put_contents(public_path('sitemaps/json/') . 'urls' . '.json', json_encode($data));

        $dir = public_path('sitemaps/json/');
        $files = scandir($dir);
        natcasesort($files); //отсортировать файлы по порядку
        $client = new Client();
        $res = [];
        foreach ($files as $file_name) {
            if ($file_name != "." && $file_name != "..") {
                $data = file_get_contents($dir . $file_name);
                if ($data) {
                    $res[] = $file_name;
                    try {
                        $client->request('POST', 'https://yandex.com/indexnow', [
                            'headers' => [
                                'Content-Type' => 'application/json; charset=utf-8',
                                'Host' => 'yandex.com'
                            ],
                            'json' => json_decode($data)]);
                    } catch (GuzzleException $e) {
                        DebugBar::warning($e->getMessage());
                        return ['success' => false, 'file' => $file_name, 'msg' => $e->getMessage()];
                    }
                }
            }
        }

        array_map("unlink", glob(public_path('/sitemaps/json/*.json')));
        return ['success' => true, 'files' => $res];
    }
}
