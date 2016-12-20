<?php

Route::get('email/bem-vindo', function () {
    return view('emails/portal/bem-vindo');
});

Route::get('portal/emails/auth/welcome-new-user', function () {
    return view('portal/emails/auth/welcome-new-user');
});