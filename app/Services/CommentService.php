<?php

namespace App\Services;

use App\Interfaces\EditorInterface;
use App\Interfaces\UpdaterInterface;
use App\Models\UserComment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class   CommentService implements EditorInterface,UpdaterInterface
{
    /**
     * return all comments
     * @return mixed
     */
    public function getAllComments(){
        return UserComment::all();
    }

    /**
     * create new comment by user
     * @param $req
     */
    public function create($req){
        $comment = new UserComment();
        $comment->id_user = $req->id_user;
        $comment->id_good = $req->id_good;
        $comment->comment = $req->comment;
        $comment->save();
    }

    /**
     * update comment
     * @param $req
     */
    public function update($req){
        $comment = UserComment::find($req->id);
        $comment->comment = $req->comment;
        $comment->save();
    }

    /**
     * remove comment
     * @param $req
     */
    public function delete($req){
        $comment = UserComment::find($req->id);
        $comment->delete();
    }
}
