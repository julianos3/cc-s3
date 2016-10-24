<?php

namespace CentralCondo\Http\Controllers;

use Mail;
use CentralCondo\User;
use Illuminate\Http\Request;
use CentralCondo\Http\Controllers\Controller;

class EmailController extends Controller
{
    /**
     * Send an e-mail reminder to the user.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function sendEmailReminder(Request $request)
    {

		$title = 'Bem vindo!';
		$content = 'seja bem vindo';
		$message = 'opa';
				
        Mail::queue('emails.teste', ['title' => $title, 'content' => $content], function ($message) {
			$message->from('suporte@centralcondo.com.br', 'Central Condo');
			$message->subject('Central Condo');
			$message->priority(1);
			$message->to('juliano@agencias3.com.br', 'Juliano Monteiro');
		});
    }
} 