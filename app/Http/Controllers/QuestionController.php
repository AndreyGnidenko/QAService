<?php

namespace App\Http\Controllers;

use App\Topic as Topic;
use App\Question as Question;
use App\Answer as Answer;
use Illuminate\Http\Request;
use Validator;
use DB;
use Event;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth')->except (['indexFaq', 'createFaq', 'storeFaq'] );
    }

    public function indexByTopic(Request $request, $topicId)
    {
        $topics = Topic::all();

        $topic = Topic::find($topicId);
        $questions = $topic->questions()->get();

        return view('admin.topicDetails')->with(['topic' => $topic, 'questions' => $questions, 'topics' => $topics]);
    }

    public function indexFaq(Request $request)
    {
        $questions = Question::with('Topic')->where('is_hidden', false)->has('answer')->orderBy('created_at')->get();

        $topics = array();

        foreach ($questions as $question)
        {
            $topics[$question->topic->name][] = $question;
        }

        $allTopics = Topic::all();

        return view('guest.frequentQuestions')->with(['topics' => $topics, 'allTopics' => $allTopics]);
    }

    public function createFaq(Request $request)
    {
        $topics = Topic::all();

        return view('guest.newQuestion')->with(['topics' => $topics]);
    }

    public function storeFaq(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'question_text' => 'required',
            'author_name' => 'required',
            'author_email' => 'required',
        ]);

        if ($validator->fails()) {

            return redirect()->route('questions.faq')->withErrors($validator);
        }

        $questionParams = $request->all();
        $questionParams['is_hidden'] = $request->has('is_hidden');

        $newQuestion = Question::create($questionParams);

        return redirect()->route('questions.faq');
    }


    public function indexUnanswered()
    {
        $questions = Question::with('Topic')->where('is_hidden', false)->doesntHave('answer')->orderBy('created_at')->get();

        $topics = array();

        foreach ($questions as $question)
        {
            $topics[$question->topic->name][] = $question;
        }

        $allTopics = Topic::all();

        return view('admin.unansweredQuestions')->with(['topics' => $topics, 'allTopics' => $allTopics]);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'question_text' => 'required',
            'author_name' => 'required',
            'author_email' => 'required',
        ]);

        $questionId = $request->question_id;
        $topicId = $request->topic_id;

        if ($validator->fails()) {

            if (false !== strpos($request->url(), 'unanswered'))
            {
                return redirect()->route('questions.unanswered')->withErrors($validator);
            }

            return redirect()->route('topicquestions.index', ['topicId' => $topicId])->withErrors($validator);
        }

        $questionParams = $request->all();
        $questionParams['is_hidden'] = $request->has('is_hidden');
        $questionParams['topic_id'] = $request->new_topic_id;

        $question = Question::find($questionId);
        $question->update($questionParams);

        if (false !== strpos($request->url(), 'unanswered'))
        {
            return redirect()->route('questions.unanswered', ['topicId' => $topicId]);
        }
        return redirect()->route('topicquestions.index', ['topicId' => $topicId]);
    }

    public function answer(Request $request, $topicId = null)
    {
        $validator = Validator::make($request->all(), [
            'answer_text' => 'required',
        ]);

        if ($validator->fails())
        {
            if (false !== strpos($request->url(), 'unanswered'))
            {
                return redirect()->route('questions.unanswered')->withErrors($validator);
            }

            return redirect()->route('topicquestions.index', ['topicId' => $topicId])->withErrors($validator);
        }

        $answer = Answer::firstOrNew(['question_id' => $request->question_id]);
        $answer->answer_text = $request->answer_text;
        $answer->save();

        if (false !== strpos($request->url(), 'unanswered'))
        {
            return redirect()->route('questions.unanswered');
        }
        return redirect()->route('topicquestions.index', ['topicId' => $topicId]);
    }

    public function destroy(Request $request, $topicId = null)
    {
        $question_id = $request->question_id;

        Question::destroy($question_id);

        if (false !== strpos($request->url(), 'unanswered'))
        {
            return redirect()->route('questions.unanswered');
        }
        return redirect()->route('topicquestions.index', ['topicId' => $topicId]);
    }
}
