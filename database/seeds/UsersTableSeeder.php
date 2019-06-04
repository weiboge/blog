<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    public function run()
    {

//        times 和 make 方法是由 FactoryBuilder 类 提供的 API。
//times 接受一个参数用于指定要创建的模型数量，make 方法调用后将为模型创建一个 集合。
//makeVisible 方法临时显示 User 模型里指定的隐藏属性 $hidden，
//接着我们使用了 insert 方法来将生成假用户列表数据批量插入到数据库中

        // 获取 Faker 实例
        $faker = app(Faker\Generator::class);

        // 头像假数据
        $avatars = [
            'https://iocaffcdn.phphub.org/uploads/images/201710/14/1/s5ehp11z6s.png',
            'https://iocaffcdn.phphub.org/uploads/images/201710/14/1/Lhd1SHqu86.png',
            'https://iocaffcdn.phphub.org/uploads/images/201710/14/1/LOnMrqbHJn.png',
            'https://iocaffcdn.phphub.org/uploads/images/201710/14/1/xAuDMxteQy.png',
            'https://iocaffcdn.phphub.org/uploads/images/201710/14/1/ZqM7iaP4CR.png',
            'https://iocaffcdn.phphub.org/uploads/images/201710/14/1/NDnzMutoxX.png',
        ];
        // 生成数据集合
//        each() 是 集合对象 提供的 方法，用来迭代集合中的内容并将其传递到回调函数中。
        $users = factory(User::class)
            ->times(10)
            ->make()
            ->each(function ($user, $index)
            use ($faker, $avatars)
            {
                // 从头像数组中随机取出一个并赋值
                $user->avatar = $faker->randomElement($avatars);
            });
        // 让隐藏字段可见，并将数据集合转换为数组
        $user_array = $users->makeVisible(['password', 'remember_token'])->toArray();
        // 插入到数据库中
        User::insert($user_array);


//        $users = factory(User::class)->times(50)->make();
//
//        // 让隐藏字段可见，并将数据集合转换为数组，插入到数据库中
//        User::insert($users->makeVisible(['password', 'remember_token'])->toArray());

        $user = User::find(1);
        $user->name = 'Summer';
        $user->email = 'summer@example.com';
        $user->avatar = 'https://iocaffcdn.phphub.org/uploads/images/201710/14/1/ZqM7iaP4CR.png';
        $user->is_admin = true;
        $user->save();
    }
}
