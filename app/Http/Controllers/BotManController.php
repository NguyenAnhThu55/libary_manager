<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use BotMan\BotMan\BotMan;
use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\Answer;
class BotManController extends Controller
{
    // public function handle(){
    //     $botman=app('botman');
    //     $botman->hears('{message}',function($botman,$message){
    //         if($message=="hi"){
    //             $this->askName($botman);
    //         }else{
    //             $botman->reply("Bạn Dang Tắc Mắc gì ạ!");
    //         }
    //     });
    //     $botman->listen();
    // }
    // public function askName($botman){
    //     $botman->askName('Hello chào bạn',function(Answer $answers){
    //         $name=$answers->getText();
    //         $this->say('Nice to meet u'.$name);
    //     });
    // }
}
