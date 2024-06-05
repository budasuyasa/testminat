<?php

use App\Http\Controllers\ProfileController;
use App\Models\Question;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $question = Question::with([ 'options' => function($query){
        $query->leftJoin('answers', function(JoinClause $join){
            $join->on('question_options.id', '=', 'answers.option_id');
        })->select('question_options.*', 'answers.id as answer_id');
    }])->paginate(1);

    return view('dashboard', compact('question'));

})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
