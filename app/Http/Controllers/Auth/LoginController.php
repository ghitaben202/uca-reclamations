<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\Utilisateur; // Utiliser ton modèle Utilisateur
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Où rediriger les utilisateurs après la connexion.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Créer une nouvelle instance de contrôleur.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    protected function credentials(Request $request)
    {
        return [
            'email_personnel' => $request->email_personnel,  // Utilise le nom de champ personnalisé
            'mot_de_passe' => $request->mot_de_passe,        // Utilise le nom de champ personnalisé
        ];
    }


    protected function attemptLogin(Request $request)
    {
        // Affiche les données de connexion pour déboguer
        dd($request->only('email_personnel', 'mot_de_passe'));

        return Auth::attempt(
            $this->credentials($request), $request->filled('remember')
        );
    }

    /**
     * Utiliser le modèle Utilisateur pour l'authentification.
     *
     * @return void
     */
    protected function guard()
    {
        return Auth::guard('web'); // Si tu utilises le guard 'web'
    }
}
