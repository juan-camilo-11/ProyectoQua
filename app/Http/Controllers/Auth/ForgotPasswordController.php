<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request; 
use Illuminate\Notifications\Messages\MailMessage;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;
      // Agrega la propiedad para la vista personalizada
      public $template = 'email.resetPassword';

      public function __construct()
      {
          $this->middleware('guest');
      }
  
      // Modifica el método para usar la vista personalizada
      protected function sendResetLinkEmail(Request $request)
      {
          $this->validateEmail($request);
        dd('xd');
          // Personaliza el correo electrónico
          $response = Password::sendResetLink(
              $request->only('email'),
              
          );  
  
          return $response == Password::RESET_LINK_SENT
              ? $this->sendResetLinkResponse($request, $response)
              : $this->sendResetLinkFailedResponse($request, $response);
      }
}
