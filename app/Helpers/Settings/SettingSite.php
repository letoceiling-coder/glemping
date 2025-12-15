<?php


namespace App\Helpers\Settings;


use App\Helpers\Admin\Property;
use App\Helpers\Image\ImageSize;
use App\Http\Controllers\Api\v1\EmailController;
use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\OfferResource;
use App\Http\Resources\UserResource;
use App\Models\EmailSend;
use App\Models\Menu;
use App\Models\NumberGuests;
use App\Models\Offer;
use App\Models\Setting;
use App\Models\User;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use function Symfony\Component\Translation\t;

class SettingSite
{
    const TIME_CACHE = 60 * 60 * 24;

    /**
     * @var mixed|null
     */
    public $accessToken;
    public ?string $ip;
    /**
     * @var UserResource|\Illuminate\Contracts\Auth\Authenticatable|null
     */
    public UserResource|null|\Illuminate\Contracts\Auth\Authenticatable $user;
    /**
     * @var mixed
     */
    public $info;
    /**
     * @var \string[][]
     */
    private array $const;
    /**
     * @var \Illuminate\Config\Repository|\Illuminate\Contracts\Foundation\Application|\Illuminate\Foundation\Application|mixed|string|null
     */
    private $menu;


    public function __construct()
    {

        $this->ip = $this->getIp();
        $this->menu = Menu::all();
        $this->accessToken = $_COOKIE['accessToken'] ?? null;
        $this->user = $this->getUser();
        $this->info = Cache::remember('InfoSite', self::TIME_CACHE, function () {
            return Setting::all();
        });
        $this->const = SettingPage::getSettings();


//        (new ImageSize());

    }


    public function getIp()
    {

        if (App::environment('local')) {
            return config('dev.default.ip');
        } else {
            return request()->ip();

        }
    }

    public function settings()
    {


        return [
            'ip' => $this->ip,
            'accessToken' => $this->accessToken,
            'user' => $this->user,
            'info' => Property::getProperty(),
            'default' => config('dev.default'),
            'const' => $this->const,
            'menuTop' => $this->menu->where('position','top'),
            'menuFooter' => $this->menu->where('position','footer'),
            'numberGuest' => $this->numberGuest(),
        ];
    }

    public function numberGuest(){
        return Cache::remember('numberGuest',60*60*2,function (){
            $numberGuest = NumberGuests::first();
            $numberGuest->guest = $numberGuest->guest + $numberGuest->increase;
            $numberGuest->save();

            return $numberGuest;

        });
    }
    public function getUser(): UserResource|\Illuminate\Contracts\Auth\Authenticatable|null
    {

        if (auth()->user() ) {//&& auth()->user()->token()
            if (!$this->accessToken) {
                $authToken = 'authToken';
                $this->accessToken = auth()->user()->createToken($authToken)->accessToken;
            }

            return new UserResource(auth()->user());

        } elseif ($this->accessToken) {


            $url = asset('/api/v1/user');

            $client = new Client();
            try {
                $response = $client->request('GET', $url, [
                    'headers' => [
                        'Accept' => 'application/json',
                        'Authorization' => 'Bearer ' . $this->accessToken,
                    ],
                ]);
                $user = json_decode($response->getBody())->user ?? null;
                if ($user) {
                    Auth::loginUsingId($user->id);

                    return new UserResource($user);
                }


            } catch (GuzzleException $e) {
                setcookie('accessToken', '', time() - 3600);
                unset($_COOKIE['accessToken']);
                $this->accessToken = '';
                dd($this->accessToken, $e);
            }

        }
        if (auth()->user() && !auth()->user()->token()){
            Auth::logout();

        }
        return null;
    }
}
