<?php

namespace App\Livewire;

use App\Models\Answer;
use Livewire\Component;
use App\Models\Question;
use Illuminate\Database\Query\JoinClause;

class QuestionComponent extends Component
{
    public Question $question;

    public function render()
    {
        return view('livewire.question-component');
    }

    public function mount(Question $question)
    {
        $this->question = $question;
    }

    public function saveAnswer($questionId, $option_id){
        $answer = Answer::query()
            ->where('question_id', $questionId)
            ->where('user_id', auth()->id())
            ->where('option_id', $option_id);

        if($answer->exists()){
            $answer->delete();
        } else {
            Answer::query()->firstOrCreate([
                'question_id' => $questionId,
                'user_id' => auth()->id(),
                'option_id' => $option_id
            ]);
        }

        $this->question = Question::with([ 'options' => function($query){
            $query->leftJoin('answers', function(JoinClause $join){
                $join->on('question_options.id', '=', 'answers.option_id');
            })->select('question_options.*', 'answers.id as answer_id');
        }])
        ->where('id', $questionId)
        ->first();

    }
}
