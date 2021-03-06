<?php

namespace App\Http\Controllers;
use App\Posts;
use Validator;
use Response;
use Illuminate\Support\Facades\Input;
use App\http\Requests;
use Illuminate\Http\Request;

class PostController extends Controller
{
  public function index(){
    $post = Posts::paginate(10);
    return view('post.index',compact('post'));
  }

  public function addPost(Request $request){
    $rules = array(
      'title' => 'required',
      'body' => 'required',
    );
  $validator = Validator::make ( Input::all(), $rules);
  if ($validator->fails())
  return Response::json(array('errors'=> $validator->getMessageBag()->toarray()));

  else {
    $post = new Posts;
    $post->title = $request->title;
    $post->body = $request->body;
    $post->save();
    return response()->json($post);
  }
}

public function editPost(request $request){
$post = Posts::find ($request->id);
$post->title = $request->title;
$post->body = $request->body;
$post->save();
return response()->json($post);
}

public function deletePost(request $request){
$post = Posts::find ($request->id)->delete();
return response()->json();
}
}
