<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;
use Auth;
class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::latest()->paginate(5);
        return view('questions.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('questions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required'
        ]);
        $question = new Question();
        $question->title = $request->input('title');
        $question->body = $request->input('body');
        $question->user_id = auth()->user()->id;
        $question->save();

        return redirect()->route('questions.index')->with('success', 'Question Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        return view('questions.show', compact('question'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        if(\Gate::denies('update-question', $question)){
            return redirect()->route('questions.index')->with('err', 'Unauthourized');
        }

        return view('questions.edit', compact('question'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        // if(\Gate::denies('update-question', $question)){
        //     return redirect()->route('questions.index')->with('err', 'Unauthourized');
        // }

        if(Auth::user()->id !== $question->user_id){
            return redirect()->route('questions.index')->with('err', 'Unauthourized');
        }
        $this->validate($request, [
            'title' => 'required',
            'body'  => 'required'
        ]);

        $question->title = $request->title;
        $question->body = $request->body;
        $question->save();

        return redirect()->route('questions.index')->with('success', 'Question Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        // if(\Gate::denies('delete-question', $question)){
        //     return redirect()->route('questions.index')->with('err', 'Unauthourized');
        // }

        if(Auth::user()->id !== $question->user_id){
            return redirect()->route('questions.index')->with('err', 'Unauthourized');
        }
        $question->delete();
        return redirect()->route('questions.index')->with('delete', 'Question removed');
    }
}
