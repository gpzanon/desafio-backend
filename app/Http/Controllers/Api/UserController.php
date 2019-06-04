<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Http\Requests\StoreUpdateUserFormRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Atribute for DI of App\User
    protected $user;
    // Path to save user image
    protected $path = 'users';

    /**
     * DI of \App\User
     * 
     * @param App\User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response JSON
     */
    public function index(Request $request)
    {
        $dataFilter = $request->all();
        $users = $this->user->getResults($dataFilter);

        return response()->json($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\StoreUpdateUserFormRequest  $request
     * @return \Illuminate\Http\Response JSON
     */
    public function store(StoreUpdateUserFormRequest $request)
    {
        $dataForm = $request->all();

        // Checks whether an image exists and whether it is valid
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            // Sets the name for the image
            $nameFile = $request->image->getClientOriginalName();

            // Name of the image to be saved in the database
            $dataForm['image'] = $nameFile;

            // Upload
            $upload = $request->image->storeAs($this->path, $nameFile);
            // If the upload occurs perfectly the image will be saved in storage/app/public/users/

            // Fail upload
            if (!$upload)
                return response()->json(['error' => 'user_fail_image_upload'], 500);
        }

        // Encrypt password
        $dataForm['password'] = bcrypt($dataForm['password']);

        // Creates user with fillable attributes in model
        $user = $this->user->create($dataForm);

        if (!$user)
            return response()->json(['error' => 'user_store_error'], 500);

        return response()->json($user, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response JSON
     */
    public function show($id)
    {
        $user = $this->user->find($id);

        if (!$user)
            return response()->json(['error' => 'user_not_found'], 404);

        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\StoreUpdateUserFormRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response JSON
     */
    public function update(StoreUpdateUserFormRequest $request, $id)
    {
        $user = $this->user->find($id);

        if (!$user)
            return response()->json(['error' => 'user_not_found'], 404);

        $dataForm = $request->all();

        // Checks whether an image exists and whether it is valid
        if ($request->hasFile('image') && $request->file('image')->isValid()) {

            // Deletes existing image
            if ($user->image != null) {
                if (Storage::exists("{$this->path}/{$user->image}"))
                    Storage::delete("{$this->path}/{$user->image}");
            }

            // Sets the name for the image
            $nameFile = $request->image->getClientOriginalName();

            // Name of the image to be saved in the database
            $dataForm['image'] = $nameFile;

            // Upload
            $upload = $request->image->storeAs($this->path, $nameFile);
            // If the upload occurs perfectly the image will be saved in storage/app/public/users/

            // Fail upload
            if (!$upload)
                return response()->json(['error' => 'user_fail_image_upload'], 500);
        }

        if (isset($dataForm['password'])) {
            //To update the password it is necessary to enter the current password
            $request->validate([
                'current_password' => 'required'
            ]);

            //Checks whether the current password entered matches the current registered password
            if (!(Hash::check($dataForm['current_password'], $user->password)))
                return response()->json(['error' => 'current_password_invalid'], 406);

            // Encrypt password
            $dataForm['password'] = bcrypt($dataForm['password']);
        }

        // Updates user with fillable attributes in model
        $update = $user->update($dataForm);

        if (!$update)
            return response()->json(['error' => 'user_update_error'], 500);

        return response()->json($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = $this->user->find($id);

        if (!$user)
            return response()->json(['error' => 'user_not_found'], 404);

        // Deletes existing image
        if ($user->image != null) {
            if (Storage::exists("{$this->path}/{$user->image}"))
                Storage::delete("{$this->path}/{$user->image}");
        }

        $delete = $user->delete();

        if (!$delete)
            return response()->json(['error' => 'user_delete_error'], 500);

        return response(['success' => 'user_deleted_success']);
    }
}
