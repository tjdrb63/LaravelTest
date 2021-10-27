<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\SubjectUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class PostController extends Controller
{
    public function subjectlist(){
        return Inertia::render('Subject/SubjectList');
    }
    public function subjectpost(){
        return Inertia::render('Subject/SubjectPost');
    }
    public function subjectuser(){
        return Inertia::render('Subject/SubjectUser');
    }
    public function PostSubject(Request $request){
        $subject = new Subject();
        $subject -> subject_name = $request -> title;
        $subject -> subject_num = $request -> num;
        $subject -> subject_comment = $request -> comment;
        $subject -> save();

        return $request;
    }
    public function ShowSubject(){
        return Subject::latest()->paginate(5);
    }
    public function UpdateSubject(Request $request){
        $id = $request -> subject_id;
        $subject = Subject::findOrFail($id);
        $subject -> subject_name = $request -> name;
        $subject -> subject_num = $request -> num;
        $subject -> subject_comment = $request -> comment;
        $subject -> save();
    }
    public function DeleteSubject(Request $request){
        $id = $request -> subject_id;
        $subject = Subject::findOrFail($id);
        $subject -> delete();
    }
    public function CheckSubject($id){
            $list = new SubjectUser();
            $list -> user_id = Auth::id();
            $list -> subject_id = $id;
            $list -> save();
            return "수강신청을 완료 했습니다.";

    }
    public function ShowUser(){
        return SubjectUser::all();
    }
}
