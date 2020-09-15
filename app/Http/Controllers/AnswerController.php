<?php

namespace App\Http\Controllers;

use App\Answer;
use Illuminate\Http\Request;
use Auth;
use App\Question;

class AnswerController extends Controller
{
   
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Question $question, Request $request)
    {
        

        $request->validate([
            'body'=>'required',
        ]);

        $answer = new Answer();
        $answer->body = $request->body;
        $answer->user_id = Auth::user()->id;
        $answer->question_id = $question->id;
        $answer->save();

        return back()->with('success', 'Answer submitted');

    
        }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question, Answer $answer)
    {
        if(Auth::user()->id === $answer->user_id){
            return view('answers.edit', compact('question','answer'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question, Answer $answer )
    {
        $request->validate([
            'body' => 'required'
        ]);

        $answer->body = $request->body;
        $answer->save();

        return redirect()->route('questions.show', $question->slug)->with('success', 'Answer updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question, Answer $answer)
    {
        $answer->delete();
        return back()->with('err', 'answer deleted');
        // return redirect()->route('questions.show', $question->slug)->with('err', 'answer deleted');
    }
}
