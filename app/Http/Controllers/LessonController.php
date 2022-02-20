<?php

namespace App\Http\Controllers;

use App\Events\NewMessage;
use App\Events\PrivateMessage;
use Illuminate\Http\Request;
use App\Events\ChartEvent;
class LessonController extends Controller
{
    public function ajax()
    {
        $arr = [
            [
                'lesson' => '123',
                'subject' => 'litrature'
            ],
            [
                'lesson' => '32',
                'subject' => 'match'
            ],
        ];
        sleep(1);
        return response()->json($arr);
    }
    public function lineChart()
    {
        sleep(1);
        $data = [
            'labels' => ['Cars', 'Products', 'Flats', 'Lessons'],
            'datasets' => array([
                'label' => 'Offers',
                'backgroundColor' => ['blue', 'pink', 'red', 'green'],
                'data' => [rand(1, 10), rand(1, 10), rand(1, 10), rand(1, 10)]
            ])
        ];
        return response()->json($data);
    }

    public function newEvent(Request $request)
    {
        $data = [
            'labels' => ['Cars', 'Products', 'Flats', 'Lessons'],
            'datasets' => array([
                'label' => 'Offers',
                'backgroundColor' => ['blue', 'pink', 'red', 'green'],
                'data' => [rand(1, 10), rand(1, 10), rand(1, 10), rand(1, 10)]
            ])
        ];
        if ($request->has('label')){
            array_push($data['labels'], $request->label);
            array_push($data['datasets'][0]['data'], $request->sale);
            array_push($data['datasets'][0]['backgroundColor'], random_html_color());
        }

        event(new ChartEvent($data));
        return response()->json($data);
    }
    public function socketChat(Request $request)
    {

        event(new NewMessage($request->input('message')));
    }
    public function privateChat(Request $request)
    {
        PrivateMessage::dispatch($request->all());
        return $request->all();
    }
}
