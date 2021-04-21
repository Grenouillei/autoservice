<?php

namespace App\Services;

use App\Models\UserComment;

class CommentService{

    /**
     * return all comments
     * @return mixed
     */
    public function getAllComments(){
        return UserComment::all();
    }

    /**
     * create new comment by user
     * @param $reg
     */
    public function setComment($reg){
        $comment = new UserComment();
        $comment->id_user = $reg->id_user;
        $comment->id_good = $reg->id_good;
        $comment->comment = $reg->comment;
        $comment->save();
    }

    /**
     * update comment
     * @param $reg
     */
    public function updateComment($reg){
        $comment = UserComment::find($reg->id);
        $comment->comment = $reg->comment;
        $comment->save();
    }

    /**
     * remove comment
     * @param $reg
     */
    public function deleteComment($reg){
        $comment = UserComment::find($reg->id);
        $comment->delete();
    }
}
