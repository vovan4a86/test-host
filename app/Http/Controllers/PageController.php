<?php

namespace App\Http\Controllers;

use Google_Client;
use Google_Service_Indexing;
use Google_Service_Indexing_UrlNotification;
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
        $process = new Process(array('python3', public_path('/py/test.py'), 'https://youtu.be/et2TFY6knBI'));
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }
        $process->getOutput();
        return view('test1')->with('process', $process);

    }

    public function showTest2() {
        return view('test2');
    }

    public function startApi() {
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
}
