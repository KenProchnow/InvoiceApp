<?php

class TodoListController extends \BaseController {

	public function __construct(){
		// this will run on any post type method, and make sure that the token is a match. 
		// no one from another site can insert into our database, unless they came from our specific insert page. 
		// no one can send a post that was not from our page. 
		// beforeFilter will run before any post actions on this controller.
		$this->beforeFilter('csrf',array('on'=> ['post','put'] ) );
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//return View::make('todos.index');
		$todo_lists = TodoList::all();
		return View::make('todos.index')->with('todo_lists',$todo_lists);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('todos.create');	
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//define rules
		$rules = array(
				'name' => array('required','unique:todo_lists')
			);

		// pass input to validator
		$validator = Validator::make(Input::all(), $rules );

		// test if input fails
		if($validator->fails() ){
			// if the validator fails
			// $messages = $validator->messages();
			// return $messages;
			return Redirect::route('todos.create')->withErrors($validator)->withInput();
		}

		// insert into database
		$name = Input::get('name');
		$list = new TodoList();
		$list->name = $name;
		// $list->description = "this was hard coded to create";
		$list->save();
		return Redirect::route('todos.index')->withMessage('List was created');
		// return "created a new list";
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
		$list = TodoList::findOrFail($id);
		$items = $list->listItems()->get();
		// return $items;
		return View::make('todos.show')
		->with('list',$list)
		->withItems($items);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$list= TodoList::findOrFail($id);
		return View::make('todos.edit')->withList($list);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		// return Input::all();
		//define rules
		$rules = array(
				'name' => array('required','unique:todo_lists')
			);

		// pass input to validator
		$validator = Validator::make(Input::all(), $rules );

		// test if input fails
		if($validator->fails() ){
			// if the validator fails
			// $messages = $validator->messages();
			// return $messages;
			return Redirect::route('todos.edit',$id)->withErrors($validator)->withInput();
		}

		// insert into database
		$name = Input::get('name');
		$list = TodoList::findOrFail($id);
		$list->name = $name;
		// $list->description = "this was hard coded to create";
		$list->update();
		return Redirect::route('todos.index')->withMessage('List was updated');
		// return "created a new list";
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
		$todo_list = TodoList::findOrFail($id)->delete();
		return Redirect::route('todos.index')->withMessage('Item Deleted');
	}


}
