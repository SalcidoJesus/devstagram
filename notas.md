## Iniciar
esta onda prende todo:
```
php artisan serve
npm run dev
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

esto me crea el controlador (métodos de la clase), modelo (estructura de la BD) y migración (código para crear la tabla) del Comentario, o algo así
```php
php artisan make:model --migration --controller Comentario
```

otra migración, porque hice cambios en la tabla de comentarios, ahora si ya se creó la tabla
```
php artisan migrate
```
