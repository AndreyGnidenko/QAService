<?php

namespace App\Http\Controllers;

use App\Topic as Topic;
use App\Question as Question;
use App\Answer as Answer;
use Illuminate\Http\Request;
use Validator;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $topicId = $request->topicId;

        $topic = Topic::find($topicId);
        $questions = Question::where('topic_id', $topicId)->get();

        $question = Question::where('topic_id', $topicId)->first();

        //dd($questions);

        return view('adminTopicDetails')->with(['topic' => $topic, 'questions' => $questions]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $topicId = $request->topic_id;

        $validator = Validator::make($request->all(), [
            'question_text' => 'required',
        ]);

        if ($validator->fails()) {

            return redirect()->route('questions.index', ['topicId' => $topicId])->withErrors($validator);
        }

        $questionParams = $request->all();
        $questionParams['is_hidden'] = $request->has('is_hidden');

        $newQuestion = Question::create($questionParams);
        return redirect()->route('questions.index', ['topicId' => $topicId]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function indexUnanswered()
    {
        $questions = Question::doesntHave('answer')->get();

        return view('adminUnansweredQuestions')->with(['questions' => $questions]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $topicId = $request->topic_id;
        $questionId = $request->question_id;

        $questionParams = $request->all();
        $questionParams['is_hidden'] = $request->has('is_hidden');

        $question = Question::find($questionId);
        $question->update($questionParams);

        return redirect()->route('questions.index', ['topicId' => $topicId]);
    }

    public function answer(Request $request)
    {
        $topicId = $request->topic_id;

        $answer = Answer::firstOrNew(['question_id' => $request->question_id]);
        $answer->answer_text = $request->answer_text;
        $answer->save();

        return redirect()->route('questions.index', ['topicId' => $topicId]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $topicId = $request->topic_id;

        Question::destroy($id);
        return redirect()->route('questions.index', ['topicId' => $topicId]);
    }
}
