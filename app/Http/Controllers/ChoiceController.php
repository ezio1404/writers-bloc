<?php

namespace App\Http\Controllers;

use App\Models\Choices;
use App\Models\Lesson;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ChoiceController extends Controller
{
    public function show($lessonId, $quizId, $choiceId)
    {
        $lesson = Lesson::whereId($lessonId)->with([
            'quiz' => function ($q) use ($quizId, $choiceId) {
                return $q->whereId($quizId)->with(['choices' => function ($q2) use ($choiceId) {
                    return $q2->whereId($choiceId)->first();
                }]);
            },
        ])->first();

        return redirect()->route('teacher.choice.show', ['lesson' => $lesson]);
    }


    public function put(Request $request, $choiceId)
    {
        $validatedData = $request->validate([
            'choice' => ['required', 'max:255'],
        ]);

        $choice = Choices::find($choiceId);
        $choice->update($validatedData);

        Alert::toast('Updated Choice', 'success');
        return redirect()->route('teacher-quiz-show', [
            $request->lesson_id,
            $request->quiz_id,
        ]);
    }
}
