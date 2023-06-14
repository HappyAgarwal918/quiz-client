<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTestRequest;
use App\Option;
use App\Question;

class TestsController extends Controller
{
    public function index()
    {
        $questions = Question::with(['questionOptions' => function ($query) {
                        $query->inRandomOrder();
                    }])
                    ->paginate(5);

        return view('client.test', compact('questions'));
    }

    public function store(StoreTestRequest $request)
    {
        $options = Option::find(array_values($request->input('questions')));

        $result = auth()->user()->userResults()->create([
            'total_points' => $options->sum('points')
        ]);

        $questions = $options->mapWithKeys(function ($option) {
            return [$option->question_id => [
                        'option_id' => $option->id,
                        'points' => $option->points
                    ]
                ];
            })->toArray();

        $result->questions()->sync($questions);

        return redirect()->route('client.results.show', $result->id);
    }

    public function getdata($id)
    {
        $checked = Option::where('id',$id)->first();
        $correct = Option::where('question_id', $checked->question_id)->where('points',1)->first();
        // echo "<pre>";print_r($option);die;

        return response(['checked'=>$checked,'correct'=>$correct]);
    }
}
