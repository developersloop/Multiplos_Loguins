<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Socialite;
use Auth;
class SocialAuthController extends Controller
{
    public function entrarGithub()
    {
        return Socialite::driver('github')->redirect();
    }

    public function retornoGithub() // retornar usuario
    {
         $userSocial = Socialite::driver('github')->user(); // pegando o nome do usuario do meu gihub
         $email = $userSocial->getEmail(); // pegando o email do meu github

         if(Auth::check()) // verificando se o usuario esta autentificado
         {
           $user = Auth::user();
           $user->github = $email;
           $user->save();
           return redirect()->intended('/hello');
         }

         $user = User::where('github',$email)->first();

         if(isset($user->name))
         {
           Auth::login($user);
           return redirect()->intended('/hello');
         }

         if(User::where('email',$email)->count())
         {
           $user = User::where('email',$email)->first();
           $user->github  = $email;
           $user->save();
           Auth::login($user);
            return redirect()->intended('/hello');
         }

          // caso os dados da rede social não estiver no banco de dados, ele automaticamente cria esses dados
         $user = new User;
         $user->name = $userSocial->getName();
         $user->email = $userSocial->getEmail();
         $user->github = $userSocial->getEmail();
         $user->password = bcrypt($userSocial->token);
         $user->save();
         Auth::login($user); // faz o loguin com os dados desse usuario vindo da rede social
         return redirect()->intended('/hello');
    }



    public function entrarfacebook()
    {
      return Socialite::driver('facebook')->redirect();



    }

    public function retornofacebook()
    {
      $userSocial = Socialite::driver('facebook')->user(); // pegando o nome do usuario do meu gihub
      $email = $userSocial->getEmail(); // pegando o email do meu github

      if(Auth::check()) // verificando se o usuario esta autentificado
      {
        $user = Auth::user();
        $user->github = $email;
        $user->save();
        return redirect()->intended('/home');
      }

      $user = User::where('facebook',$email)->first();

      if(isset($user->name))
      {
        Auth::login($user);
        return redirect()->intended('/home');
      }

      if(User::where('email',$email)->count())
      {
        $user = User::where('email',$email)->first();
        $user->github  = $email;
        $user->save();
        Auth::login($user);
         return redirect()->intended('/home');
      }

      $user = new User;
      $user->name = $userSocial->getName();
      $user->email = $userSocial->getEmail();
      $user->github = $userSocial->getEmail();
      $user->password = bcrypt($userSocial->token);
      $user->save();
      Auth::login($user);
      return redirect()->intended('/home');
    }
}
