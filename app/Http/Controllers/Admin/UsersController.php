<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\UserRequest;
use App\Models\User;
use App\Service\UserService;
use Illuminate\Http\Request;
use Session;

class UsersController extends AdminController
{
    public function index(Request $request)
    {

        $search_params = $request->input('search_params');
        $users = UserService::doSearch($search_params)->sortable(['member_no' => 'desc'])->paginate($this->per_page);

        Session::put('admin.users.index.params', $request->all());

        return view("{$this->platform}.users.index", [
            'users' => $users
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $all_index_params = Session::get('admin.users.index.params');

        $user = User::findOrFail($id);
        return view("{$this->platform}.users.show", [
            'user' => $user,
            'return_params' => $all_index_params,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $all_index_params = Session::get('admin.users.index.params');

        $user = User::findOrFail($id);

        return view("{$this->platform}.users.edit", [
            'user' => $user,
            'return_params' => $all_index_params,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {

        $all_index_params = Session::get('admin.users.index.params');

        $user = User::findOrFail($id);

        if (UserService::doUpdate($user, $request->all())) {
            $request->session()->flash('success', '会員情報を編集しました。');
        } else {
            $request->session()->flash('success', '会員情報編集が失敗しました。');
        }

        return redirect()->route('admin.users.index', $all_index_params);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        if (UserService::doDelete($id) ) {
            $request->session()->flash('success', '会員を削除しました。');
        } else {
            $request->session()->flash('error', '会員削除が失敗しました。');
        }

        return back();
    }
}
