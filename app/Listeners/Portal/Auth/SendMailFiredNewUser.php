<?php

namespace CentralCondo\Listeners\Portal\Auth;

use CentralCondo\Entities\Portal\Condominium\UsersCondominium;
use CentralCondo\Events\Portal\Auth\SendMailNewUser;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;

class SendMailFiredNewUser
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
    public function handle(SendMailNewUser $event)
    {
        //dd($event);

        $users = $this->usersCondominium->with(['user'])->find(['id' => $event->user_condominium_id]);
        if ($users->toArray()) {
            foreach ($users as $row) {
                $title = 'Bem Vindo';
                $name = $row->user->name;
                $password = $event->password;
                $email = $row->user->email;
                $nameCondominium = $row->condominium->name;

                Mail::queue('portal.emails.auth.welcome-new-user',
                    [
                        'title' => $title,
                        'name' => $name,
                        'email' => $email,
                        'password' => $password,
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
