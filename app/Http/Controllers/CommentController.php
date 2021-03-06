<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Services\CommentService;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    private $commentService;

    public function __construct(CommentService $commentService){
        $this->commentService = $commentService;
    }

    /**
     * crate comment
     * @param CommentRequest $reg
     * @return mixed
     */
    public function createComment(CommentRequest $reg){
        $this->commentService->create($reg);
        return redirect()->back();
    }

    /**
     * delete comment
     * @param Request $reg
     * @return mixed
     */
    public function removeComment(Request $reg){
        $this->commentService->delete($reg);
        return redirect()->back();
    }

    /**
     * change comment
     * @param Request $reg
     * @return mixed
     */
    public function updateComment(Request $reg){
        $this->commentService->update($reg);
        return redirect()->back();
    }
}
