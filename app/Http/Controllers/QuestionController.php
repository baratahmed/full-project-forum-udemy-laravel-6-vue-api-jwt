<?php

namespace App\Http\Controllers;

use App\Model\Question;
use Illuminate\Http\Request;
use App\Http\Resources\QuestionResource;
use Illuminate\Support\Str;
use App\Http\Requests\QuestionRequest;

class QuestionController extends Controller
{

    public function __construct()
    {
        $this->middleware('jwt', ['except' => ['index','show']]);
        //$this->middleware('auth:api', ['except' => ['login']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return QuestionResource::collection(Question::latest()->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuestionRequest $request)
    {
        //$request['slug'] = Str::slug($request->title);
        $question = auth()->user()->questions()->create($request->all());
        //Question::create($request->all());
        return response(new QuestionResource($question), 201); // 201 means CREATED   //vendor/symfony/http-foundation/Response.php
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        return new QuestionResource($question);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        $question->update($request->all());
        return response('Updated', 202); // 202 means HTTP_ACCEPTED    //vendor/symfony/http-foundation/Response.php
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        $question->delete();
        return response('Deleted', 204); // 204 means NO CONTENT   //vendor/symfony/http-foundation/Response.php
    }
}
