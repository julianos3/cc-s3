<?php

namespace CentralCondo\Listeners\Portal\Condominium\User;

use CentralCondo\Entities\Portal\Condominium\UsersCondominium;
use CentralCondo\Events\Portal\Condominium\User\SendMail;
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

    protected $usersCondominium;

    public function __construct(UsersCondominium $usersCondominium)
    {
        $this->usersCondominium = $usersCondominium;
    }

    /**
     * Handle the event.
     *
     * @param  SendMail $event
     * @return void
     */
    public function handle(SendMail $event)
    {
        $users = $this->usersCondominium->with(['user', 'condominium'])->find(['id' => $event->user_condominium_id]);
        if ($users->toArray()) {
            foreach ($users as $row) {
                $title = 'Bem Vindo ao seu novo condomínio';
                $name = $row->user->name;
                $nameCondominium = $row->condominium->name;

                Mail::queue('portal.emails.auth.new-condominium',
                    [
                        'title' => $title,
                        'name' => $name,
                        'nameCondominium' => $nameCondominium
                    ], function ($message) use ($row) {
                        $message->from('suporte@centralcondo.com.br', 'Bem vindo | Central Condo - Seu Condomínio nas nuvens');
                        $message->subject('Central Condo - Seu Condomínio nas nuvens');
                        $message->priority(1);
                        $message->to($row->user->email, $row->user->name);
                    });
            }
        }

    }
}
