<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Mail;
use Auth;

class UsersController extends Controller
{
    public function __construct()
    {
//        Auth 中间件黑名单,除了except都要登陆
        $this->middleware('auth', [
            'except' => ['show', 'create', 'store', 'index', 'confirmEmail']
        ]);
//        only 白名单方法，将只过滤指定动作。
//我们提倡在控制器 Auth 中间件使用中，
//首选 except 方法，这样的话，
//当你新增一个控制器方法时，默认是安全的，此为最佳实践
//        Auth 中间件提供的 guest 选项，
//用于指定一些只允许未登录用户访问的动作
        $this->middleware('guest', [
            'only' => ['create']
        ]);
    }
    public function create()
    {
        return view('users.create');
    }
    public function show(User $user)
    {
//        desc 是英文 descending 的简写，意为倒序，也就是数字大的排靠前。
        $statuses = $user->statuses()
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('users.show', compact('user', 'statuses'));
    }
    public function store(Request $request)
    {
//        授权策略定义完成之后，我们便可以通过在用户控制器中使用 authorize 方法来验证用户授权策略。
//        authorize 方法接收两个参数，第一个为授权策略的名称，第二个为进行授权验证的数据。
        $this->validate($request, [
            'name' => 'required|max:50',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|confirmed|min:6'
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        $this->sendEmailConfirmationTo($user);
        session()->flash('success', '验证邮件已发送到你的注册邮箱上，请注意查收。');
        return redirect('/');
    }
    public function edit(User $user)
    {
        $this->authorize('update', $user);
        return view('users.edit', compact('user'));
    }
//update 方法接收两个参数，第一个为自动解析用户 id 对应的用户实例对象，第二个则为更新用户表单的输入数据
    public function update(User $user, Request $request)
    {
        $this->authorize('update', $user);
        $this->validate($request, [
            'name' => 'required|max:50',
            'password' => 'nullable|confirmed|min:6'
        ]);
        $data = [];
        $data['name'] = $request->name;
        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }
        $user->update($data);
        session()->flash('success', '个人资料更新成功！');

        return redirect()->route('users.show', $user->id);
    }
    public function index()
    {
//        使用 Eloquent 用户模型将所有用户的数据一下子完全取出来了，这么做会影响应用的性能
//        $users = User::all();
        $users = User::paginate(10);
        return view('users.index', compact('users'));
    }
    public function destroy(User $user)
    {
        $this->authorize('destroy', $user);
        $user->delete();
        session()->flash('success', '成功删除用户！');
        return back();
    }

//      账户激活 一节的邮件发送逻辑
    protected function sendEmailConfirmationTo($user)
    {
        $view = 'emails.confirm';
        $data = compact('user');
        $from = 'summer@example.com';
        $name = 'Summer';
        $to = $user->email;
        $subject = "感谢注册 Weibo 应用！请确认你的邮箱。";

        Mail::send($view, $data, function ($message) use ($from, $name, $to, $subject) {
            $message->from($from, $name)->to($to)->subject($subject);
        });
    }

//      用户的激活操作
//      Eloquent 的 where 方法接收两个参数，第一个参数为要进行查找的字段名称，
//      第二个参数为对应的值，查询结果返回的是一个数组，因此我们需要使用 firstOrFail 方法来取出第一个用户，
//      在查询不到指定用户时将返回一个 404 响应。
//      在查询到用户信息后，我们会将该用户的激活状态改为 true，激活令牌设置为空。
//      最后将激活成功的用户进行登录，并在页面上显示消息提示和重定向到个人页面。
    public function confirmEmail($token)
    {
        $user = User::where('activation_token', $token)->firstOrFail();

        $user->activated = true;
        $user->activation_token = null;
        $user->save();

        Auth::login($user);
        session()->flash('success', '恭喜你，激活成功！');
        return redirect()->route('users.show', [$user]);
    }

//    显示关注人列表方法
    public function followings(User $user)
    {
        $users = $user->followings()->paginate(30);
        $title = $user->name . '关注的人';
        return view('users.show_follow', compact('users', 'title'));
    }

//    显示粉丝列表方法
    public function followers(User $user)
    {
        $users = $user->followers()->paginate(30);
        $title = $user->name . '的粉丝';
        return view('users.show_follow', compact('users', 'title'));
    }
}
