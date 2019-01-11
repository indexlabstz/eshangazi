<?php

namespace App\Http\Conversations;

use App\Member;
use App\Feedback;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Conversations\Conversation;

class FeedbackConversation extends Conversation
{
    protected $feedback;
    protected $member;

    public function askFeedback()
    {

        $user_id = $this->bot->getUser()->getId();

        $this->member = Member::where('user_platform_id', '=', $user_id)->first();

        $this->ask('Andika maoni yako hapa', function(Answer $answer) {

            $this->feedback = $answer->getText();

            if($this->member)
            {
                Feedback::create([
                    'feedback'  => $this->feedback,
                    'member_id' => $this->member->id
                ]);

                $this->bot->typesAndWaits(1);

                $this->say($this->bot->getUser()->getFirstName() . ', asante kwa maoni yako, tutayafanyia kazi.');
            }
        });
    }

    /**
     * Start the conversation.
     *
     * @return mixed
     */
    public function run()
    {
        $this->askFeedback();
    }
}
