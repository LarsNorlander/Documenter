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
        $this->checkAdmin();
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
        $this->checkAdmin();
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
        $this->checkAdmin();

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
        $this->checkAdmin();
        $userFiles = FileRecord::with('user')
                               ->with('achievements')
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

    public function deleted() {
        $this->checkAdmin();
        $userFiles = FileRecord::onlyTrashed()
                               ->with('user')
                               ->with('achievements')
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

    /*
     * The addDepts function takes data from the add department form
     * and puts it into the database. That's pretty much all there is
     * to it.
     */

    public function addDepts(Request $request) {
        $this->checkAdmin();
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
        $this->checkAdmin();
        //Delete stuff
        try {
            Department::destroy($id);
        } catch (\PDOException $e) {
            return "The department still has members enrolled in it.";
        }


        return redirect('/admin/depts');
    }

    // End of delDepts() method.

    /*
     * The addUser() function takes care of creating a new user account for the system
     * This way, an administrator could enroll a new user to the system.
     */

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

    // End of addUser() function.

    /*
     * The editUser() function allows the admin (and supposedly the user)
     * to edit the details of the user in question. This function grabs
     * the user's data and puts it into a form for so that it could be
     * edited.
     */

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

    // End of editUser() function.

    /*
     * The commitEditUser() function takes all the details from the
     * edit user form and commits them to the database. Once that's
     * done, the user's details have been edited accordingly.
     */

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

    // End or commitEditUser() function.

    /*
     * The editDept() function does the same thing as the editUser()
     * function that it fills up a form for editing name of a
     * department.
     */

    public function editDept($id) {
        $departments = Department::where('id' , $id)
                                 ->firstOrFail()
        ;

        return view('displays.admin.editDept')
            ->with('department' , $departments);
    }

    // End of editDept() function.

    /*
     * The commitEditDept() function does the same thing as the
     * commitEditDept() function. It commits the changes made
     * to the name of the department to the database.
     */

    public function commitEditDept(Request $request , $id) {
        $departments = Department::where('id' , $id)
                                 ->firstOrFail()
        ;
        $departments->name = $request->name;
        $departments->save();

        return redirect('/admin/depts');
    }

    // End of the commitEditDept() function.

    /*
     * The function lockUser() does what it says. It locks the user or
     * unlocks them depending on the current status of the user. It
     * then sends an email to the user concerned about the new status
     * of their account.
     */

    public function lockUser($id) {
        $this->checkAdmin();
        $user = User::where('id' , '=' , $id)
                    ->firstOrFail()
        ;

        if ($user->user_status_id == 1) {
            $user->user_status_id = 2;
            $user->old_password = $user->password;
            $user->password = "locked";

            Mail::queue('mail.accLocked' , [ ] , function($message) use (&$user) {
                $message->to($user->email , $user->fname)
                        ->subject('Account Locked.')
                ;
            });
        } else {
            $user->user_status_id = 1;
            $user->password = $user->old_password;
            Mail::queue('mail.accUnlocked' , [ ] , function($message) use (&$user) {
                $message->to($user->email , $user->fname)
                        ->subject('Account Unlocked.')
                ;
            });
        }

        $user->save();

        return redirect('/admin/users');
    }

    // End of the lockUser() function.

    /*
     * The appDelReq() function is short for "Approve Delete Request."
     * This function finalizes the deletion of a credential from the
     * system and notifies the user through email that their delete
     * request has been approved.
     */

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

        $achievement->delete();
        $file->delete();

        return redirect('/admin/delete');
    }

    // End of the appDelRe() function.

    /*
     * The denDelReq() function is short for "Deny Delete Request"
     * This method is triggered when the administrator rejects a
     * delete request in case it was done by mistake or a user
     * failed to provide a valid reason.
     */

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

    // End of the denDelReq() function.

    public function restore($id){
        $achievement = Achievements::withTrashed()->where('achievement_id' , '=' , $id)
                                   ->firstOrFail()
        ;
        $file = FileRecord::withTrashed()->where('id' , '=' , $id)
                          ->firstOrFail()
        ;

        $achievement->restore();
        $file->restore();
        $achievement->delete_pending = false;
        $achievement->delete_details = "";
        $achievement->save();

        return redirect('/admin/deleted');
    }


    /*
     * The retrieveTags method only serves to get the user's tags.
     * The reason this is here is to pass the data into the view.
     */

    private function retrieveTags() {
        $Tags = (array)json_decode(Auth::User()->user_tags);
        $userTags = [ ];

        foreach ($Tags as $tag) {
            $userTags[ $tag ] = $tag;
        }

        return $userTags;
    }

    // End of retrieveTags() function.

    /*
     * checkAuth() function checks to see if you are an administrator logged in
     * to the system. If not, you are not allowed to do any of the administrator
     * related tasks. All it does is do a check if you are not authorized, and if
     * the condition is true. It will interrupt the function to
     */

    private function checkAdmin() {
        if (!( Auth::check() && Auth::user()->user_type_id == 1 )) {
            return "You are not allowed to see this.";
        }
    }

    // End of checkAuth() function.

}
