<?php

namespace App\Http\Controllers;

use App\Achievements;
use App\Department;
use App\FileRecord;
use App\Http\Requests;
use App\User;
use App\UserType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller {

    /*
     * The upper section contains methods used to pass data to the views
     * based on different queries. The bottom part of this controller is
     * all about the different actions of the administrator.
     */

    /*
     * The index controller returns all files that are in the system.
     * The data is all passed into the Dashboard view to be displayed.
     */

    public function index() {
        $this->checkAuth();
        $allFiles = FileRecord::with('user')
                              ->get()
        ;

        $userTags = $this->retrieveTags();

        return view('dashboard')
            ->with('allFiles' , $allFiles)
            ->with('userTags' , $userTags)
            ->with('screen' , "admin")
            ;
    }

    // End of the index() controller.


    /*
     * The depts controller does almost the same thing as the index controller.
     * In case it wasn't obvious though, the only thing different here really
     * is that it fetches the departments instead.
     */

    public function depts() {
        $this->checkAuth();
        $allDepts = Department::get();

        $userTags = $this->retrieveTags();

        return view('dashboard')
            ->with('allDepts' , $allDepts)
            ->with('userTags' , $userTags)
            ->with('screen' , "admin")
            ->with('noSidebar' , true)
            ;
    }

    // End of the depts() function.

    /*
     * Just like the controllers before it. This fetches the users in the
     * database and pushes the data to the controller.
     */

    public function users() {
        $this->checkAuth();

        $allUsers = User::with('user_dept')
                        ->with('user_type')
                        ->get()
        ;

        $userTags = $this->retrieveTags();
        $departments = Department::get();
        $userTypes = UserType::get();

        return view('dashboard')
            ->with('allUsers' , $allUsers)
            ->with('userTags' , $userTags)
            ->with('departments' , $departments)
            ->with('userTypes' , $userTypes)
            ->with('screen' , "admin")
            ->with('noSidebar' , true)
            ;
    }

    // End of users() function.

    /*
     * This function grabs all the delete request pending in the system.
     * The data is then displayed by the application to await approval or
     * rejection by the admin depending on the reason stated.
     */

    public function delAwards() {
        $userFiles = FileRecord::with('user')
                               ->with('achievements')
                               ->where('owner_id' , Auth::User()->id)
                               ->where('doc_type_id' , 2)
                               ->get()
        ;

        $userTags = $this->retrieveTags();

        return view('dashboard')
            ->with('delReq' , $userFiles)
            ->with('userTags' , $userTags)
            ->with('screen' , 'admin')
            ;
    }

    // End of delAwards function.

    /*
     * The addDepts function takes data from the add department form
     * and puts it into the database. That's pretty much all there is
     * to it.
     */

    public function addDepts(Request $request) {
        $this->checkAuth();
        $name = $request->collegeName;
        $entry = new Department();
        $entry->name = $name;
        $entry->save();

        return redirect('/admin/depts');
    }

    // End of addDepts() function

    /*
     * The delDepts() department pretty much does what it says. It deletes
     * the department given that a department does not have any members under
     * it.
     */

    public function delDepts($id) {
        $this->checkAuth();
        //Delete stuff
        try{
            Department::destroy($id);
        } catch(\PDOException $e){
            return "The department still has members enrolled in it.";
        }


        return redirect('/admin/depts');
    }

    public function addUser(Request $request) {
        $newUser = new User();
        $newUser->fname = $request->fname;
        $newUser->lname = $request->lname;
        $newUser->username = $request->username;
        $newUser->email = $request->email;
        $newUser->password = bcrypt($request->password);
        $newUser->user_status_id = 1;
        $newUser->user_dept_id = $request->department;
        $newUser->user_type_id = $request->userType;

        $newUser->save();

        return redirect('/admin/users');
    }

    public function editUser($id) {
        $user = User::where('id' , $id)
                    ->firstOrFail()
        ;
        $departments = Department::get();
        $userTypes = UserType::get();

        return view('displays.admin.editUser')
            ->with('user' , $user)
            ->with('departments' , $departments)
            ->with('userTypes' , $userTypes)
            ;
    }

    public function commitEditUser(Request $request , $id) {
        $newUser = User::where('id' , $id)
                       ->firstOrFail()
        ;;
        $newUser->fname = $request->fname;
        $newUser->lname = $request->lname;
        $newUser->username = $request->username;
        $newUser->email = $request->email;
        if (!$request->password == "") {
            $newUser->password = bcrypt($request->password);
        }
        $newUser->user_dept_id = $request->department;
        $newUser->user_type_id = $request->userType;
        $newUser->save();

        return redirect('/admin/users');
    }

    public function editDept($id) {
        $departments = Department::where('id' , $id)
                                 ->firstOrFail()
        ;

        return view('displays.admin.editDept')
            ->with('department' , $departments);
    }

    public function commitEditDept(Request $request , $id) {
        $departments = Department::where('id' , $id)
                                 ->firstOrFail()
        ;
        $departments->name = $request->name;
        $departments->save();

        return redirect('/admin/depts');
    }

    public function lockUser($id) {
        $this->checkAuth();
        $user = User::where('id' , '=' , $id)
                    ->firstOrFail()
        ;

        if ($user->user_status_id == 1) {
            $user->user_status_id = 2;

            Mail::queue('mail.accLocked' , [ ] , function($message) use (&$user) {
                $message->to($user->email , $user->fname)
                        ->subject('Account Locked.')
                ;
            });
        } else {
            $user->user_status_id = 1;
            Mail::queue('mail.accUnlocked' , [ ] , function($message) use (&$user) {
                $message->to($user->email , $user->fname)
                        ->subject('Account Unlocked.')
                ;
            });
        }

        $user->save();

        return redirect('/admin/users');
    }

    public function appDelReq($id) {
        $achievement = Achievements::where('achievement_id' , '=' , $id)
                                   ->firstOrFail()
        ;
        $file = FileRecord::where('id' , '=' , $id)
                          ->firstOrFail()
        ;
        $owner = User::where('id' , '=' , $file->owner_id)
                     ->firstOrFail()
        ;

        $data = [
            'fileName' => $file->filename , ];
        Mail::queue('mail.confirmDelete' , $data , function($message) use (&$owner) {
            $message->to($owner->email , $owner->fname)
                    ->subject('Delete request approved.')
            ;
        });

        Storage::deleteDirectory($file->owner_id . $file->id . $file->filename);
        $achievement->delete();
        $file->delete();

        return redirect('/admin/delete');
    }

    public function denDelReq($id) {
        $entry = Achievements::where('achievement_id' , '=' , $id)
                             ->firstOrFail()
        ;
        $file = FileRecord::where('id' , '=' , $id)
                          ->firstOrFail()
        ;
        $owner = User::where('id' , '=' , $file->owner_id)
                     ->firstOrFail()
        ;
        $entry->delete_pending = false;
        $entry->delete_details = "";
        $entry->save();

        $data = [
            'fileName' => $file->filename , ];
        Mail::queue('mail.denyDelete' , $data , function($message) use (&$owner) {
            $message->to($owner->email , $owner->fname)
                    ->subject('Delete request rejected.')
            ;
        });

        return redirect('/admin/delete');
    }

    private function retrieveTags() {
        $Tags = (array)json_decode(Auth::User()->user_tags);
        $userTags = [ ];

        foreach ($Tags as $tag) {
            $userTags[ $tag ] = $tag;
        }

        return $userTags;
    }

    /*
     * checkAuth() function checks to see if you are an administrator logged in
     * to the system. If not, you are not allowed to do any of the administrator
     * related tasks. All it does is do a check if you are not authorized, and if
     * the condition is true. It will interrupt the function to
     */

    private function checkAuth() {
        if (!( Auth::check() && Auth::user()->user_type_id == 1 )) {
            return "You are not allowed to see this.";
        }
    }

    // End of checkAuth() function.

}
