# laravel-jwt-apis
This is the demo of JWT tokens with Rest APIs

## Installation ⚒️

Installing and running this is super easy, please Follow below steps and you will be ready to rock 🤘

1. Install Laravel
2. Connect with database
3. Make an API controller for all the API like Register, Login, Profile, Refresh Token and Logout
4. Installing the JWT-Auth Package

```bash
composer require tymon/jwt-auth
```

5. Once the package is installed, you need to publish its configuration file. This will create a config/jwt.php file, which allows you to configure JWT-specific settings:

```bash
php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"
```

6. Generating the JWT Secret Key

```bash
php artisan jwt:secret
```
7. User Model
Add the Tymon\JWTAuth\Contracts\JWTSubject interface to the App\Models\User class, which is necessary for generating a JWT token using the tymon/jwt-auth library

```bash
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;


    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
```

8. Testing JWT Authentication
To test the JWT implementation:

Set the header Accept: application/json for all requests.
Upon login, include the JWT token in the Authorization header as a Bearer token for authenticated routes.


Now your JWT authentication is fully set up!
