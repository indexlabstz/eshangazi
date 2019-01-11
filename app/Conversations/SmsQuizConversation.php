<?php

namespace App\Http\Conversations;

use App\Question;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Outgoing\Question as BotManQuestion;

class SmsQuizConversation extends Conversation
{
    protected $correct;
    protected $score = 0;
    protected $iterations = 0;
    protected $data;

    /**
     * Start conversation
     */
    public function startConv()
    {
        $Question = BotManQuestion::create('Karibu '.$this->bot->getUser()->getFirstName(). ' kwenye maswali na majibu')
                ->fallback('Unable to start game')
                ->callbackId('start_game')
                ->addButtons([
                    Button::create('Cheza')->value('yes'),
                    Button::create('Baadae')->value('no')
                ]);
        return $this->ask($Question, function (Answer $answer) {
            if($answer->getValue() === 'yes'){
                $this->askQuestion();
            }else{
                $this->say("Asante ".$this->bot->getUser()->getFirstName() .
                                    "!, karibu ujaribu kucheza muda wowote.. 👋");
            }
        });
    }

    /**
     * Asking questions
     */
    public function askQuestion()
    {
        if($this->iterations == 0)
            $this->data = Question::with('answers')->has('answers', '>=', 2)->inRandomOrder()->take(5)->get();

        if(! $this->data->isEmpty())
        {
            $question = $this->data[$this->iterations]->question;

            $answers = [];

            foreach($this->data[$this->iterations]->answers as $answer)
            {
                $answers[] = $answer->answer;

                if($answer->correct == 1)
                    $this->correct = $answer->answer;

            }

            shuffle($answers);

            $question_pass = BotManQuestion::create($question)
                ->fallback('Unable to ask question')
                ->callbackId('ask_question');

            foreach($answers as $answer)
            {
                $question_pass->addButtons([
                    Button::create($answer)->value($answer)
                ]);
            }

            return $this->ask($question_pass, function (Answer $answer) {
                $this->iterations++;

                if (! is_null($answer->getValue()))
                {
                    if ($answer->getValue() === $this->correct)
                    {
                        $this->score += 1;

                    //     $this->say("Swal." .
                    //         $this->iterations . "/" .
                    //         $this->data->count(). ". ✔️ Sahihi 👍, umeshinda alama 1.");
                    // } else {
                    //     $this->say("Swal." .
                    //         $this->iterations . "/" .
                    //         $this->data->count() . ". ❌ Si-sahihi, sahihi ni " .
                    //         $this->correct . ", alama 0.");
                    }

                    if($this->iterations < $this->data->count())
                    {
                        $this->askQuestion();
                    }
                    else
                    {
                        if($this->score == $this->data->count())
                        {
                            $sms ="Hongera 👏👏 " .
                                $this->bot->getUser()->getFirstName() .
                                "!, umepata ".$this->score . "/"
                                . $this->data->count() .
                                " . Hongeraaa! 🏆🏆 \n";
                        }else if($this->score >= ($this->data->count()/2))
                        {
                            $sms = "Umefanya vizuri 👏 " .
                                $this->bot->getUser()->getFirstName() .
                                "!, umepata " .
                                $this->score . "/" .
                                $this->data->count() .
                                ". \n";
                        }else{
                            $sms = $this->bot->getUser()->getFirstName() .
                                "!, Naamini unaweza kufanya vizuri zaidi ya " .
                                $this->score . "/" . $this->data->count() .
                                " ulizopata, Kila la heri! 👊 \n";
                        }
                        
                        //$this->bot->typesAndWaits(2);

                        $question_conf = BotManQuestion::create($sms . "Je, ungependa kucheza awamu nyingine?")
                            ->fallback("Unable to ask for repeat confirmantion")
                            ->callbackId("ask_for_repeat")
                            ->addButtons([
                                Button::create("Ndio")->value("yes"),
                                Button::create("Hapana")->value("no"),
                            ]);

                        $this->ask($question_conf, function(Answer $answer)
                        {
                            if ($answer->getValue() === 'yes')
                            {
                                $this->score = 0;
                                $this->iterations = 0;
                                $this->askQuestion();
                            }
                            else if ($answer->getValue() === 'no')
                            {
                                $this->say("Asante ".$this->bot->getUser()->getFirstName() .
                                    "!, karibu ujaribu kucheza tena muda wowote.. 👋");
                            }
                        });
                    }
                    
                } else {
                    $question_wrong = BotManQuestion::create("Oooh❗😬😬, " .
                        $this->bot->getUser()->getFirstName() .
                        "! Inaonekana kuna kitu hakijaenda sawa, Tafadhali azinsha upya!")
                        ->fallback("Something went wrong")
                        ->callbackId("something_is_wrong")
                        ->addButtons([
                            Button::create("Azisha")->value("yes"),
                            Button::create("Hapana")->value("no"),
                        ]);

                    $this->ask($question_wrong, function(Answer $answer)
                    {
                        if ($answer->getValue() === 'yes')
                        {
                            $this->score = 0;
                            $this->iterations = 0;
                            $this->askQuestion();
                        }
                        else if ($answer->getValue() === 'no')
                        {
                            $this->say("Ooh pole 🙇‍ " .
                                $this->bot->getUser()->getFirstName() .
                                "!, karibu ujaribu kucheza tena muda wowote.. 👋");
                        }
                    });
                }
            });

        }else{
            $this->say('Hakua maswali kwa sasa, rudi baadae...');
        }
    }

    /**
     * Start the conversation.
     *
     * @return mixed
     */
    public function run()
    {
        $this->startConv();
    }
}
