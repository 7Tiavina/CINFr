<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Règle de validation personnalisée pour reCAPTCHA
        Validator::extend('captcha', function ($attribute, $value, $parameters, $validator) {
            $recaptchaSecret = config('services.recaptcha.secret');

            if (empty($recaptchaSecret)) {
                \Log::error('reCAPTCHA secret not configured');
                return false;
            }

            $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
                'secret' => $recaptchaSecret,
                'response' => $value,
                'remoteip' => request()->ip(),
            ]);

            $result = $response->json();

            if (!$response->successful() || !($result['success'] ?? false)) {
                \Log::error('reCAPTCHA validation failed', ['response' => $result]);
                return false;
            }

            // Optionnel : vérifier le score pour reCAPTCHA v3
            if (isset($result['score']) && $result['score'] < 0.5) {
                \Log::warning('reCAPTCHA score trop bas', ['score' => $result['score']]);
                return false;
            }

            return true;
        });

        // Message d'erreur personnalisé pour la règle captcha
        Validator::replacer('captcha', function ($message, $attribute, $rule, $parameters) {
            return 'La validation reCAPTCHA a échoué. Veuillez vérifier que vous n\'êtes pas un robot.';
        });
    }
}
