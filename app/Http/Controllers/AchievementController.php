<?php

namespace App\Http\Controllers;

use App\Achievements;
use App\FileRecord;
use App\Http\Requests;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class AchievementController extends Controller {

    /*
     * Method for adding a new credential for employees.
     * Mostly similar to the way files are uploaded but
     * with mailing functions to HR and creating a new
     * record in the credentials table.
     */

    public function addAchievement(Request $request) {

        /*
         * This part takes the data from the file and sets them
         * to the appropriate field in each model for the File
         * Record table.
         */

        $file = $request->file('file');
        $entry = new FileRecord();
        $entry->mime = $file->getClientMimeType();
        $entry->filename = $request->name;
        $entry->total_versions = 1;
        $entry->public_version = 1;
        $entry->owner_id = Auth::User()->id;
        $users = [ ];
        $departments = [ ];
        $mass = "0";
        $sharing_array = [ 'users' => $users , 'departments' => $departments , 'mass' => $mass ];
        $sharing = json_encode($sharing_array);
        $entry->sharing = $sharing;
        $entry->doc_type_id = 2;
        $entry->save();

        // End of FileRecord storing section.

        /*
         * This part instantiates a new Achievement modal. This handles
         * the part of the request that contains all the details  of the
         * uploaded credential.
         */

        $achievement = new Achievements();
        $achievement->name = $request->name;
        $achievement->received = $request->received;
        $achievement->type = $request->type;
        $achievement->validity = $request->validity;
        $achievement->details = $request->details;
        $achievement->achievement_id = $entry->id;
        $achievement->save();

        // End of Achievement storing section.

        /*
         * This is where the file gets stored into the server's disk.
         * The file's location is defined as: <userID><fileID><fileName>
         */

        Storage::disk('local')
               ->put(Auth::User()->id . $entry->id . $request->name . "/1" , File::get($file))
        ;

        // At this point, the file has been successfully saved.

        /*
         * This part handles sending emails to the system admins and HR
         * to notify them of a new credential. This way, HR knows that
         * there is a credential they need to verify.
         */

        $admins = User::get()
                      ->where('user_type_id' , 1)
        ;
        $hrs = User::get()
                   ->where('user_dept_id' , 2)
        ;
        $uploader = Auth::user()->fname . " " . Auth::user()->lname . " (" . Auth::user()->username . ")";
        $data = [
            'uploader' => $uploader ,
            'fileName' => $entry->filename ,
            'id'       => $entry->id
        ];
        foreach ($admins as $admin) {
            Mail::queue('mail.newUpload' , $data , function($message) use (&$admin) {
                $message->to($admin->email , 'Admin')
                        ->subject('New Upload')
                ;
            });
        }
        foreach ($hrs as $hr) {
            Mail::queue('mail.newUpload' , $data , function($message) use (&$hr) {
                $message->to($hr->email , 'Admin')
                        ->subject('New Achievement Upload')
                ;
            });
        }

        // End of email sender section.

        return redirect('/dashboard/awards');
    }

    // End of the addAchievement method.

    /*
     * This method is responsible for filing a delete request.
     * The process just takes up the ID of the file and gets
     * data as to why the user wishes to delete the file. This
     * way, deletion will be verifiable.
     */

    public function delReqAchievement($id , Request $request) {

        /*
         * What this block does is just look up the file and set the
         * field delete_pending to true and storing the details of the
         * request in the delete_details. Once this is done, the admins
         * of the system should be able to view them.
         */

        $entry = Achievements::where('achievement_id' , '=' , $id)
                             ->firstOrFail()
        ;
        $entry->delete_pending = true;
        $entry->delete_details = $request->delDetails;
        $entry->save();

        // End of the update block.

        /*
         * This part grabs all the data needed for the email. Like the
         * filename, owner and owner's username. After that, the data
         * is passed on to the mail queue function which as the name
         * implies, creates an email that will be pushed to the queue
         * to be sent whenever it could.
         */

        $file = FileRecord::where('id' , $id)
                          ->firstOrFail()
        ;
        $owner = User::where('id' , $file->owner_id)
                     ->firstOrFail()
        ;
        $uploader = $owner->fname . " " . $owner->lname . " (" . $owner->username . ")";
        $admins = User::get()
                      ->where('user_type_id' , 1)
        ;
        $data = [ 'uploader' => $uploader ,
                  'fileName' => $entry->filename ];

        foreach ($admins as $admin) {
            Mail::queue('mail.newDelReq' , $data , function($message) use (&$admin) {
                $message->to($admin->email , 'Admin')
                        ->subject('New Delete Request')
                ;
            });
        }

        // End of the mailing block.

        return redirect('/dashboard/awards');
    }

    /*
     * This is the approve() function. It's the method an HR user triggers when
     * they validate a credential. All it does is set the approved field on the
     * record to true. After which, an email will be sent to the user notifying
     * them of the verification.
     */

    public function approve($id) {
        $entry = Achievements::where('achievement_id' , '=' , $id)
                             ->firstOrFail()
        ;
        $entry->approved = true;
        $entry->save();
        $file = FileRecord::where('id' , $id)
                          ->firstOrFail()
        ;
        $owner = User::where('id' , $file->owner_id)
                     ->firstOrFail()
        ;
        $data = [ 'fileName' => $entry->name ];

        Mail::queue('mail.hrApprove' , $data , function($message) use (&$owner) {
            $message->to($owner->email , $owner->fname)
                    ->subject('Achievement approved')
            ;
        });

        return redirect('/hr/verify');
    }

    // End of the approve() function.


    /*
     * Basically the exact opposite of the approve function. What
     * this does is delete the file and the records associated
     * with it. It then sends an email notifying the user that
     * the credential uploaded was rejected.
     */

    public function decline($id) {
        $entry = Achievements::where('achievement_id' , '=' , $id)
                             ->firstOrFail()
        ;

        $file = FileRecord::where('id' , $id)
                          ->firstOrFail()
        ;
        $owner = User::where('id' , $file->owner_id)
                     ->firstOrFail()
        ;
        $data = [ 'fileName' => $entry->name ];

        Mail::queue('mail.hrDeny' , $data , function($message) use (&$owner) {
            $message->to($owner->email , $owner->fname)
                    ->subject('Achievement rejected')
            ;
        });

        Storage::deleteDirectory($file->owner_id . $file->id . $file->filename);
        $entry->delete();
        $file->delete();

        return redirect('/hr/verify');
    }

    // End of decline() function.
}
