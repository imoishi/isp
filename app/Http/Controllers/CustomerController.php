<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Package;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CustomerController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        abort_unless(Gate::allows('access-customer'), 403);

        $users = User::with('package:id,name', 'area:id,name')
            ->whereNotNull('package_id')
            ->latest()
            ->get();
        $packages = Package::where('status', 1)->latest()->get();
        $areas = Area::where('status', 1)->latest()->get();

        return view('admin.customer.index', compact('users', 'packages', 'areas'));
    }


    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Validation\ValidationException
     * @throws \Exception
     */
    public function store(Request $request)
    {
        abort_unless(Gate::allows('create-customer'), 403);


        $this->validate($request, [
            'first_name' => 'required|string|max:255',
//            'phone' => 'required|string|max:20|unique:users',
//            'email' => 'required|string|email|max:255|unique:users',
//            'password' => 'required|string|min:6|confirmed'
            ]);

        $request->has('status') ? $request['status'] = 1 : $request['status'] = 0;
//        $data = $request->except('role_id', '_token');
        $data = $request->all();


        if ($request->hasFile('avatar')) {
            $data['avatar'] = uploadImage($request->avatar, imagePath()['profile']['path'], imagePath()['profile']['size']);
        }else{
            $data['avatar'] = '';
        }


        $user = User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'phone' => $data['phone'],
            'email' => $data['email'],
//            'under_by' => Auth::user()->id,
            'address' => $data['address'],
            'area_id' => $data['area_id'],
            'package_id' => $data['package_id'],
            'password' => bcrypt(123456),
            'avatar' => $data['avatar'],
            'status' => $data['status'],
        ]);

//        $user->roles()->sync($request->role_id);

        return redirect()->back()->with('success', trans('trans.created_successfully'));
    }

    /**
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Validation\ValidationException
     * @throws \Exception
     */
    public function update(Request $request, $userId)
    {
        abort_unless(Gate::allows('update-customer'), 403);

        $user  = User::findOrFail($userId);
        $this->validate($request, [
            'first_name' => 'required|string|max:255',
//            'phone' => ['required', 'string', 'max:20', Rule::unique('users')->ignore($user->id)],
//            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
//            'role_id' => 'required',
        ]);

        $request->has('status') ? $request['status'] = 1 : $request['status'] = 0;

        $data = $request->all();

        if($request->hasFile('avatar')) {
            $old = $user->avatar ?: null;
            $data['avatar'] = uploadImage($request->avatar, imagePath()['profile']['path'], imagePath()['profile']['size'], $old);
        }else{
            $data['avatar'] = '';
        }

        $user = $user->update([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'address' => $data['address'],
            'area_id' => $data['area_id'],
            'package_id' => $data['package_id'],
            'avatar' => $data['avatar'],
            'status' => $data['status'],
        ]);

//        $user->roles()->sync($request->role_id);

        return redirect()->back()->with('success', trans('trans.updated_successfully'));
    }

    /**
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($userId)
    {
        abort_unless(Gate::allows('delete-customer'), 403);

        $user  = User::findOrFail($userId);

        $user->forceDelete();
        return redirect()->back()->with('success', trans('trans.deleted_successfully'));
    }

    /**
     * Update user status.
     *
     * @param User $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function statusUpdate($userId)
    {
        abort_unless(Gate::allows('status-change-customer'), 403);
        $user  = User::findOrFail($userId);
        $user->update([
            'status' => !$user->status
        ]);
        return redirect()->back()->with('success', trans('trans.updated_successfully'));
    }
}
