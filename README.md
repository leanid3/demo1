Установка:
    https://github.com/leanid3/demo1.git
    composer install 
    npm i 
    php artisan ui bootstrap --auth


запуск фронта:
    npm build && npm run dev

запуск сервера:
    php artisan serve


основные команды тинкер:
    посмотреть связь 
        DB::select("PRAGMA table_info(cards)")
        DB::select("SELECT sql FROM sqlite_master WHERE type='table' AND name='cards';")
    
    получить запись
        DB::select('Select * from cards') или App\Models\User::all()
    
    получить определенную запись
        App\Models\User::where('email', 'ivan@example.com')->first()
    
    обновить запись
        App\Models\User::where('id', 1)->update(['name' => 'Новое имя'])

    создать запись
        App\Models\User::create(['name' => 'Иван', 'email' => 'ivan@example.com', 'password' => bcrypt('123456')])

    Удалить по ID
        App\Models\User::destroy(1)

    Удалить по условию
        App\Models\User::where('name', 'Иван')->delete()

    если есть связи
        $user = App\Models\User::find(1)

        Создать новый пост для пользователя
        $post = new App\Models\Post(['title' => 'Заголовок', 'content' => 'Текст...'])
        $user->posts()->save($post)

        Или получить все посты
        $user->posts