<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Course;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    /**
     * Show the most recent questions
     *
     * @return Response
     */
    public function searchPage() {

      $questions = Question::orderBy('id', 'desc')->paginate(10);
      $courses = Course::all();
      return view('pages.search', ['courses' => $courses, 'questions' => $questions]);
      
    }
    
    /**
     * Show questions that match the advanced search
     */
    public function advancedSearch(Request $request){
      
      if($request->input('search-input') != ''){
        $search = str_replace(' ',' | ', $request->input('search-input'));
        $questions = Question::with(['owner','courses', 'tags'])->whereRaw("search||Coalesce(answers_search,'') @@ to_tsquery('simple',?)", [$search]);

        if($request->input('filter') == 'votes') $questions = $questions->orderBy('score', 'desc');
        else if($request->input('filter') == 'relevance') 
          $questions = $questions->orderByRaw("ts_rank(search||Coalesce(answers_search,''),to_tsquery('simple',?)) DESC", [$search]);
        else $questions = $questions->orderBy('id', 'desc');
      }
      else if($request->input('filter') == 'votes') $questions = Question::with(['owner','courses', 'tags'])->orderBy('score', 'desc');     
      else $questions = Question::with(['owner','courses', 'tags'])->orderBy('id', 'desc');

      return json_encode($questions->paginate(10));
    }

}
