
## usuarios de prueba

usuario de prueba
```
ooo@gmail.com
ooooooooo
salcido.jesus.j@gmail.com
12345678
```

## Iniciar
esta onda prende todo:
```
php artisan serve
npm run dev
```


esta onda limpia el caché de las rutas:
```
php artisan route:cache
```


lista de rutas:
```
php artisan route:list
```



## Migraciones
esta onda "compila" las migraciones
```php
php artisan migrate
```

esto ya no me acuerdo
```php
php artisan migrate:rollback
php artisan migrate:rollback --step=5
php artisan make:migration agregar_imagen_user
```

## Eloquent
```php
php artisan make:model Cliente
php artisan migrate:refresh
```

## Factory
```php
php artisan make:factory FactoryPrueba
```

## Tinker
```php
composer dump-autoload
php artisan tinker
App\Models\Post::factory()
```

esto crea registros de prueba
```php
Post::factory -> times( 200 ) -> create();
Post::factory()->times(15)->create();
```

esto me trae el usuario cuyo id sea 7, y lo guarda en la variable $usuario
```php
$usuario = User::find(7);
```

entonces acá puedo usar la variable $usuario y traerme todos sus posts
```php
$usuario->posts
```

## comentarios

esto me crea el controlador (métodos de la clase), modelo (estructura de la BD) y migración (código para crear la tabla) del Comentario, o algo así
```php
php artisan make:model --migration --controller Comentario
```

otra migración, porque hice cambios en la tabla de comentarios, ahora si ya se creó la tabla
```
php artisan migrate
```

crea un policy y lo asocia al modelo de Post
```
php artisan make:policy PostPolicy --model=Post
```

hice un cambio en la migración, en el archivo, debo volver a migrar
```
php artisan migrate:rollback --step=1
php artisan migrate
```

## likes

crea el controlador de Like, también el modelo y la migración
```
php artisan make:model --migration --controller Like
```

modifiqué la migración de Like, debo "compilarla"
```
php artisan migrate
```

voy a crear el controlador para el perfil sisi
```
php artisan make:controller PerfilController
```


creé una migración :D
```
php artisan make:migration add_imagen_field_to_users_table
```

luego agregué un campo allí en el código y para que jalara puse esto
```
php artisan migrate
```

modelo, migración y controlador para los seguidores
```
php artisan make:model Follower -mc
```

hice un cambio en la migración
```
php artisan migrate
```

controlador de home
```
php artisan make:controler HomeController
```
