<?php

namespace App\Console\Commands;

use App\Mail\SendMailable;
use App\Post;
use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Comment;


/**
 * Class CommentUsers
 * @package App\Console\Commands
 */

class CommentUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'comment:users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email notifications of comments on post to post owner';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->line('running comments:users');
        $commentArray = array();
        $date = date('Y-m-d');

        //getting the total posts created today
        $comments = Comment::whereDate('created_at', $date)->get();
        $i = 0;
        foreach ($comments as $comment) {
            $commentBody   = str_limit($comment->body, 40);
            $userName   = $comment->user->name;
            $postOwner  = User::where('id', $comment->post_id);
            dd($postOwner);

            $poster['name' . $i] = $userName;
            $poster['body' . $i] = $commentBody;

            $i++;
            array_push($commentArray, $poster);
        }

        if (!empty($postarray)) {
            Mail::to($postOwner.'@nef1.org')->send(new SendMailable($postarray));
            $this->line('shared comments');
        } else {
            $this->line('no comments to share');
        }

        $this->line('finished running comments:users');
    }

}
