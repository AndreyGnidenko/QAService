<?php

namespace App\Http\Controllers;

use App\Topic as Topic;
use Illuminate\Http\Request;
use Validator;

class TopicsController extends Controller
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

    public function index()
    {
        $topics = Topic::all();
        
        return view('admin.topics')->with(['topics' => $topics]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.topicDetails');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:topics',
        ]);

        if ($validator->fails()) {

            return redirect()->route('topics.index')->withErrors($validator);
        }

        $newTopic = Topic::create($request->all());

        return redirect()->route('topicquestions.index', ['topic' => $newTopic]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function edit(Topic $topic)
    {
        return redirect()->route('topicquestions.index', ['topic' => $topic]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Topic  $topics
     * @return \Illuminate\Http\Response
     */
    public function destroy(Topic $topic)
    {
        $topic->delete();
        return redirect()->route('topics.index');
    }
}
