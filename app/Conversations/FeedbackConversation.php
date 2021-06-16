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

        $this->ask('Andika swali/maoni yako', function (Answer $answer) {

            $this->feedback = $answer->getText();

            if ($this->member) {
                Feedback::create([
                    'feedback'  => $this->feedback,
                    'member_id' => $this->member->id
                ]);

                $this->bot->typesAndWaits(1);

                $this->say($this->bot->getUser()->getFirstName() . ', swali/maoni yako yamepokelewa.');
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
