<?php

namespace App\Console\Commands;

use App\Post;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailable;

class RegisteredUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'registered:users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Daily Digest sent to all users';

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
        $this->line('running registered:users');
        $postarray = array();
        $date = date('Y-m-d');

        //getting the total posts created today
        $posts = Post::whereDate('created_at', $date)->get();
        $i = 0;
        foreach ($posts as $post) {
            $postBody   = str_limit($post->body, 40);
            $userName   = $post->user->name;

            $poster['name' . $i] = $userName;
            $poster['body' . $i] = $postBody;

            $i++;
            array_push($postarray, $poster);
        }

        if (!empty($postarray)) {
            Mail::to('staff@nef1.org')->send(new SendMailable($postarray));
            $this->line('shared posts');
        } else {
            $this->line('no posts to share');
        }

        $this->line('finished running registered:users');
    }
}
