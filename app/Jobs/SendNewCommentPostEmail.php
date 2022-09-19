<?php

namespace App\Jobs;

use App\Mail\NewCommentEmail;
use App\Models\Post;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendNewCommentPostEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected int $post_id;
    protected User $user;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(int $post_id, User $user)
    {
        $this->post_id = $post_id;
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $post = Post::with('user')->find($this->post_id);

        if (!$post) {
            return;
        }

        $email = new NewCommentEmail($post, $this->user);
        Mail::to($post->user->email)->send($email);
    }
}
