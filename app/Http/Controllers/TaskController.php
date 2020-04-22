<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Task;
use App\Post;



class TaskController extends Controller
{
    public $taskArray = array(
                'Think of somebody you’ve been in the box toward. Do one thing for this person that will be helpful to him or her',
                'In every interaction today, concentrate on seeing the needs, objectives, and challenges of others. See what happens as a result',
                'Help someone feel appreciated today',
                'Think of someone who has been waiting for something from you. Today, do what they have been waiting for',
                'Before making decisions today, ask: Who will be affected by this decision? Coordinate with them',
                'Focus on solutions today rather than affixing blame',
                'Think of someone who likely feels like you see him/her as a vehicle. What changes do you need to make in this situation',
                'Be a really good listener today. Talk less. Hear more',
                'Learn the names of three people today, call them by name, and learn something about them that is memorable',
                'Help someone to succeed at something today',
                'Let no one be irrelevant to you today',
                'Think of something you could learn from someone in the organization in order to better fulfill your responsibilities and then ask that person for instructions/advice in that area',
                'Think of a way you have made something more difficult for a coworker and then apologize',
                'What difficult conversation have I been avoiding? Engage in that conversation today with an outward mindset',
                'Help one of your coworkers to shine today',
                'Meet to learn (see page 104) with someone today',
                'Praise a coworker to a superior',
                'Think of a way you are contributing to a workplace problem and take responsibility for the problem',
                'Think of and implement one change in the way that you do your job that would increase your helpfulness to coworkers who are affected by what you do',
                'Give information, resources, help, or support to a coworker today',
                'Look for a coworker who is struggling and find a way to help him/her',
                'Think of a way you could creatively share some of your resources with a coworker and then propose that to your coworker',
                'Compliment three coworkers today',
                'Do something for a coworker today that he/she would like you to do but that you have been resisting',
                'Before tackling a sticky issue today, apply the Start-in-the-Right-Way tool (page 102)',
                'Find something to like about each coworker you encounter today. Especially the difficult ones',
                'Find a solution to a problem that has been negatively affecting the workplace',
                'Ask three coworkers for advice about something',
                'Find reasons to thanks as many coworkers as you can',
                'When you start to feel aggravated toward someone today, try to remember a time when you have done something similar to what he or she is doing',
                'Learn something from each person you interact with today',
                "Do something helpful for your boss that he/she doesn’t expect and that your job doesn’t require",
                'Compared to yesterday, think of what I need to do differently today to perform at a 3A+ level',
                'Do something for your boss that would relieve some of the pressure he/she is feeling',
                'Apply the Outward Mindset Pattern to solve an ongoing problem',
                'If you haven’t formally reported to your boss on your work over the last thirty days, set up a time to meet to report',
                'Think of something you could learn from your boss in order to better fulfill your responsibilities and then ask your boss for instruction/advice in that area',
                'What hard or uncomfortable thing have you been avoiding doing? Do it today',
                'Imagine how your boss would like you to spend your time today, then work that way',
                'Apply the Influence Pyramid (page 39) to a situation at work today',
                'Refrain from complaining or saying anything negative about anyone today',
                'What does responsibility require of you today? Do what responsibility requires',
                'Think about who is the primary customer of your work. Is it an external customer or a customer internal in the company? Then ask yourself: How well served does this customer feel? Then do something to improve that answer',
                'Apologize about something you need to apologize for',
                'Think of some way in which you are giving less that your best effort. Give your best effort on that today',
                'Adjust something you are doing today to be more helpful to others',
                'Conduct a Meet-to-Give (see page 110) with someone you impact',
                'Think of some excuse you have been using in your work. Today, work in such a way that you need no excuses',
                'Ask the three questions (page 84) to someone you affect',
                'Learn the objectives of three people that you affect at work',
                'If you were acting with the mentality of an owner of your business what would you do differently than you are currently doing? Institute one of those changes today',
                'What would your day look like today if you used every minute productively? Work that way today'
    );


    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getTask(){
        $count  = count($this->taskArray);
        $task   = $this->taskArray[rand(0, $count)];
        return response()->json(['task' => $task], 200);
    }

/*    public function taskText(Request $request){
        $taskId     = $request['taskId'];
        $taskText   = Task::where('task_id', $taskId );
        return view('dashboard', compact('taskItemText')) ;
    }*/

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveTask(Request $request){
        $user           = Auth::user();
        $message        = 'There was an error';
        $task = new Task();
        $task->task_Body        =   $request['taskToday'];
        $task->employee_id      =   $user->id;

        if( $task->save() ){
            $message = 'Post successfully created!';
        }
        return redirect()->route( 'taskList' )->with( [ 'message' => $message ] );
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function taskList(){
        $user   = Auth::user();
        $userId = $user->id;

        $posts = Post::orderBy('created_at', 'desc')->get();
        $tasks = Task::where('employee_id', $userId )->get();

        return view('dashboard', compact('posts', 'tasks'));
    }

    /**
     * @param $task_id
     * @return \Illuminate\Http\RedirectResponse
     */

    public static function TaskDelete($task_id){

        $task = Task::where('id', $task_id)->first();
        $task->delete();
        return redirect()->route('taskList')->with(['message'=>'Successfully deleted']);
    }


}
