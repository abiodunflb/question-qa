<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Answer;
use Auth;

class AcceptAnswerController extends Controller
{
    public function store(Answer $answer){

        if(Auth::user()->id === $answer->question->user_id){
            $answer->question->acceptBestAnswer($answer);
            return back();
        }else{
            return back()->with('err', 'Unauthorized');
        }
        
    }
}
