<?php

namespace App\Http\Controllers\User\Auth;

use App\Models\User;
use App\Http\Controllers\User\UserController;
use App\Service\PaymentService;
use App\Service\UserService;
use App\Service\VeritransService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Str;

use Redirect;
use Storage;

class RegisterController extends UserController
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/register/finish';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:web');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $rules =[
            'user_kind' => ['required',  'digits_between:1,5'],
            'name' => ['required', 'string', 'max:150'],
            'birth_year' => ['required', 'numeric', 'min:1901', 'max:2999'],
            'birth_month' => ['required', 'numeric', 'min:1', 'max:12'],
            'birth_day' => ['required', 'numeric', 'min:1', 'max:31'],
            'picture' => ['nullable', 'image', 'max:10240'],
            'work_place' => ['required', 'string', 'max:256'],
            'email' => ['required', 'string', 'email', 'max:150', 'unique:users,email,NULL,id,deleted_at,NULL'],
            //'email' => ['required', 'string', 'email', 'max:150', 'unique:users'],
            'password' => ['required', 'string', 'min:3', 'confirmed'],
            'qualification' => ['nullable', 'string', 'max:512'],
            'etc' => ['nullable', 'string', 'max:512'],
        ];

        $messages = [
            'name.required'=> '氏名を入力してください。',
            'birth_year.required'=> '年を入力してください。',
            'birth_year.numeric'=> '年を正確に入力してください。',
            'birth_year.min'=> '年を正確に入力してください。',
            'birth_year.max'=> '年を正確に入力してください。',
            'birth_month.required'=> '月を入力してください。',
            'birth_month.numeric'=> '月を正確に入力してください。',
            'birth_month.min'=> '月を正確に入力してください。',
            'birth_month.max'=> '月を正確に入力してください。',
            'birth_day.required'=> '日を入力してください。',
            'birth_day.numeric'=> '日を正確に入力してください。',
            'birth_day.min'=> '日を正確に入力してください。',
            'birth_day.max'=> '日を正確に入力してください。',
            'picture.image'=> '画像ファイルを選択してください。',
            'picture.max'=> '画像には10MB以下のファイルを指定してください。',
            'work_place.required'=> '勤務先を入力してください。',
            'email.unique'=> '指定のログインIDは既に使用されています。',
            'etc.max'=> 'ひとことを512文字以下で入力してください。',
            'qualification.max'=> '有資格を512文字以下で入力してください。',
        ];

        $user_kind = isset($data['user_kind']) ? $data['user_kind'] : 0;

        if ($user_kind == config('const.user_kind.doctor')) {
            $rules = array_merge($rules, [
                'department' => ['required', 'numeric'],
                'license_img' => ['required', 'image', 'max:10240'],
                'medical_reg_year' => ['required', 'numeric', 'min:1901', 'max:2999'],
            ]);

            $messages = array_merge($messages, [
                'department.required'=> '所属科を選択してください。',
                'license_img.required'=> '本人確認証画像を選択してください。',
                'license_img.image'=> '本人確認証画像を選択してください。',
                'license_img.max'=> '本人確認証画像には10MB以下のファイルを指定してください。',
                'medical_reg_year.required'=> '医籍登録年を入力してください。',
                'medical_reg_year.numeric'=> '医籍登録年を正確に入力してください。',
                'medical_reg_year.min'=> '医籍登録年を正確に入力してください。',
                'medical_reg_year.max'=> '医籍登録年を正確に入力してください。',
            ]);
        } else if ($user_kind == config('const.user_kind.comedical')) {
            $rules = array_merge($rules, [
                'license_img' => ['required', 'image', 'max:10240'],
                'co_occupation' => ['required', 'numeric'],
            ]);
            $messages = array_merge($messages, [
                'license_img.required'=> '国家資格証画像を選択してください。',
                'license_img.image'=> '国家資格証画像を選択してください。',
                'license_img.max'=> '国家資格証画像には10MB以下のファイルを指定してください。',
                'co_occupation.required'=> '職種を選択してください。',
            ]);
        } else if ($user_kind == config('const.user_kind.maker')) {
            $rules = array_merge($rules, [
                'license_img' => ['required', 'image', 'max:10240'],
            ]);
            $messages = array_merge($messages, [
                'license_img.required'=> '社員証画像を選択してください。',
                'license_img.image'=> '社員証画像を選択してください。',
                'license_img.max'=> '社員証画像には10MB以下のファイルを指定してください。',
            ]);
        } else if ($user_kind == config('const.user_kind.personal')) {
            $rules = array_merge($rules, [
                'license_img' => ['required', 'image', 'max:10240'],
                'payment_id' => ['required'],
            ]);

            $messages = array_merge($messages, [
                'license_img.required'=> '医療従事者証画像を選択してください。',
                'license_img.image'=> '医療従事者証画像を選択してください。',
                'license_img.max'=> '医療従事者証画像には10MB以下のファイルを指定してください。',
                'payment_id.required'=> '支払方法を選択してください。',
            ]);
        } else if ($user_kind == config('const.user_kind.corporation')) {
            $rules = array_merge($rules, [
                'payment_id' => ['required'],
            ]);

            $messages = array_merge($messages, [
                'payment_id.required'=> '支払方法を選択してください。',
            ]);
        } else {
            $rules = [
                'user_kind' => ['required',  'digits_between:1,5'],
            ];
            $messages = [
                'user_kind.required'=> '契約者を選択してください。',
            ];
        }

        return Validator::make($data, $rules, $messages);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $license_filename = '';
        $picture_filename = '';

        if(request()->has('license_img')) {
            $license_file = request()->file('license_img');
            $license_filename = Str::random(40).'.'. $license_file->getClientOriginalExtension();
            $path = $license_file->storeAs('license_img', $license_filename);
        }

        if(request()->has('picture')) {
            $picture_file = request()->file('picture');
            $picture_filename = Str::random(40).'.'. $picture_file->getClientOriginalExtension();
            $path = $picture_file->storeAs('public/pictures', $picture_filename);
        }

        $member_code = UserService::getMemberCodeByKind($data['user_kind']);
        $member_no = UserService::generateOfferNumber($member_code);

        $user =  User::create([
            'member_no' => $member_no,
            'name' => $data['name'],
            'birthday' => $data['birth_year'] . '-' . $data['birth_month'] . '-' . $data['birth_day'],
            'picture' => $picture_filename,
            'user_kind' => $data['user_kind'],
            'work_place' => $data['work_place'],
            'department' => isset($data['department']) ? $data['department'] : '',
            'department_etc' => isset($data['department_etc']) ? $data['department_etc'] : '',
            'medical_reg_year' => isset($data['medical_reg_year']) ? $data['medical_reg_year'] : '',
            'qualification' => isset($data['qualification']) ? $data['qualification'] : '',
            'co_occupation' => isset($data['co_occupation']) ? $data['co_occupation'] : '',
            'co_occupation_etc' => isset($data['co_occupation_etc']) ? $data['co_occupation_etc'] : '',
            'payment_id' => isset($data['payment_id']) ? $data['payment_id'] : 0,
            'license_image' => $license_filename,
            'etc' => isset($data['etc']) ? $data['etc'] : '',
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        if (($user->user_kind == config('const.user_kind.personal') || $user->user_kind == config('const.user_kind.corporation')) && $user->payment_id == config('const.payment_credit_type')  ){
            $account_id = config('veritrans.account_prefix') . $user->member_no;
            $register_result = VeritransService::registerAccount($account_id);
            $check_result = VeritransService::registerCreditCard($account_id, request()->input('token'));
            $errors = [];
            if(isset($check_result['status'])) {
                if ($check_result['status'] == VeritransService::PAY_NOW_ID_SUCCESS_CODE) {
                    return $user;
                }
            }
            $user->forceDelete();
            return false;
        } else {
            return $user;
        }
    }

    public function showRegisterDoctor()
    {
        return view("{$this->platform}.auth.register.doctor");
    }

    public function showRegisterComedical()
    {
        return view("{$this->platform}.auth.register.comedical");
    }

    public function showRegisterOther()
    {
        $payments = PaymentService::getAllPayments();
        return view("{$this->platform}.auth.register.other", [
            'payments' => $payments,
        ]);
    }

    public function showRegisterMaker()
    {
        return view("{$this->platform}.auth.register.maker");
    }

    public function showRegisterFinish()
    {
        return view("{$this->platform}.auth.register.finish");
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $user = $this->create($request->all());
        if (is_object($user)) {
            event(new Registered($user));
            return redirect()->route('user.register.finish');
        } else {
            $errors['payment_id'] = 'クレジットカード入力内容を確認してください。';
            return back()->withInput()->withErrors($errors);
        }

    }

    protected function guard()
    {
        return Auth::guard('web');
    }

}
