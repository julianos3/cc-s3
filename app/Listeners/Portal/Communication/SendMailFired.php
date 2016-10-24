<?php

namespace CentralCondo\Listeners\Portal\Communication;

use CentralCondo\Events\Portal\Communication\SendMail;
use CentralCondo\Repositories\Portal\Communication\Communication\UsersCommunicationRepository;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;

class SendMailFired
{
    /**
     * Create the event listener.
     *
     * @return void
     */

    protected $usersCommunicationRepository;

    public function __construct(UsersCommunicationRepository $usersCommunicationRepository)
    {
        $this->usersCommunicationRepository = $usersCommunicationRepository;
    }

    /**
     * Handle the event.
     *
     * @param  SendMail  $event
     * @return void
     */
    public function handle(SendMail $event)
    {
        //$user = User::find($event->userId)->toArray();
        $users = $this->usersCommunicationRepository->findWhere(['communication_id' => $event->communicationId]);

        $title = 'Comunicado';
        $content = 'Novo Comunicado';
        $message = 'Aqui vai o conteúdo do comunicado.';

        foreach ($users as $row) {

            Mail::queue('portal.emails.communication', ['title' => $title, 'content' => $content], function ($message) use ($row) {
                $message->from('suporte@centralcondo.com.br', 'Central Condo');
                $message->subject('Central Condo');
                $message->priority(1);
                $message->to($row->usersCondominium->user->email, $row->usersCondominium->user->name);
            });

        }

        /*
        Mail::send('emails.mailEvent', $user, function($message) use ($user) {
            $message->to($user['email']);
            $message->subject('Event Testing');
        });
       */

    }
}
