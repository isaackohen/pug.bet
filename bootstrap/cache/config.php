<?php return array (
  'admin' => 
  array (
    'name' => 'Laravel-admin',
    'logo' => '<b>Laravel</b> admin',
    'logo-mini' => '<b>La</b>',
    'bootstrap' => '/home/ploi/demo.bulk.bet/app/Admin/bootstrap.php',
    'route' => 
    array (
      'prefix' => 'admin',
      'namespace' => 'App\\Admin\\Controllers',
      'middleware' => 
      array (
        0 => 'web',
        1 => 'admin',
      ),
    ),
    'directory' => '/home/ploi/demo.bulk.bet/app/Admin',
    'title' => 'Admin',
    'https' => false,
    'auth' => 
    array (
      'controller' => 'App\\Admin\\Controllers\\AuthController',
      'guard' => 'admin',
      'guards' => 
      array (
        'admin' => 
        array (
          'driver' => 'session',
          'provider' => 'admin',
        ),
      ),
      'providers' => 
      array (
        'admin' => 
        array (
          'driver' => 'eloquent',
          'model' => 'Encore\\Admin\\Auth\\Database\\Administrator',
        ),
      ),
      'remember' => true,
      'redirect_to' => 'auth/login',
      'excepts' => 
      array (
        0 => 'auth/login',
        1 => 'auth/logout',
      ),
    ),
    'upload' => 
    array (
      'disk' => 'admin',
      'directory' => 
      array (
        'image' => 'images',
        'file' => 'files',
      ),
    ),
    'database' => 
    array (
      'connection' => '',
      'users_table' => 'admin_users',
      'users_model' => 'Encore\\Admin\\Auth\\Database\\Administrator',
      'roles_table' => 'admin_roles',
      'roles_model' => 'Encore\\Admin\\Auth\\Database\\Role',
      'permissions_table' => 'admin_permissions',
      'permissions_model' => 'Encore\\Admin\\Auth\\Database\\Permission',
      'menu_table' => 'admin_menu',
      'menu_model' => 'Encore\\Admin\\Auth\\Database\\Menu',
      'operation_log_table' => 'admin_operation_log',
      'user_permissions_table' => 'admin_user_permissions',
      'role_users_table' => 'admin_role_users',
      'role_permissions_table' => 'admin_role_permissions',
      'role_menu_table' => 'admin_role_menu',
    ),
    'operation_log' => 
    array (
      'enable' => true,
      'allowed_methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
        2 => 'POST',
        3 => 'PUT',
        4 => 'DELETE',
        5 => 'CONNECT',
        6 => 'OPTIONS',
        7 => 'TRACE',
        8 => 'PATCH',
      ),
      'except' => 
      array (
        0 => 'admin/auth/logs*',
      ),
    ),
    'check_route_permission' => true,
    'check_menu_roles' => true,
    'default_avatar' => '/vendor/laravel-admin/AdminLTE/dist/img/user2-160x160.jpg',
    'map_provider' => 'google',
    'skin' => 'skin-blue-light',
    'layout' => 
    array (
      0 => 'sidebar-mini',
      1 => 'sidebar-collapse',
    ),
    'login_background_image' => '',
    'show_version' => true,
    'show_environment' => true,
    'menu_bind_permission' => true,
    'enable_default_breadcrumb' => true,
    'minify_assets' => 
    array (
      'excepts' => 
      array (
      ),
    ),
    'enable_menu_search' => true,
    'menu_exclude' => 
    array (
      0 => '_handle_selectable_',
      1 => '_handle_renderable_',
    ),
    'top_alert' => '',
    'grid_action_class' => 'Encore\\Admin\\Grid\\Displayers\\DropdownActions',
    'extension_dir' => '/home/ploi/demo.bulk.bet/app/Admin/Extensions',
    'extensions' => 
    array (
    ),
  ),
  'app' => 
  array (
    'name' => 'Bulkbet',
    'env' => 'production',
    'debug' => false,
    'url' => 'https://demo.bulk.bet',
    'asset_url' => 'public',
    'timezone' => 'UTC',
    'locale' => 'en',
    'fallback_locale' => 'en',
    'faker_locale' => 'en_US',
    'key' => 'base64:VFeDAF8pIzz9YbxuIzFg2bsM8wBk1oy/8zhTBylrJus=',
    'cipher' => 'AES-256-CBC',
    'providers' => 
    array (
      0 => 'Illuminate\\Auth\\AuthServiceProvider',
      1 => 'Illuminate\\Broadcasting\\BroadcastServiceProvider',
      2 => 'Illuminate\\Bus\\BusServiceProvider',
      3 => 'Illuminate\\Cache\\CacheServiceProvider',
      4 => 'Illuminate\\Foundation\\Providers\\ConsoleSupportServiceProvider',
      5 => 'Illuminate\\Cookie\\CookieServiceProvider',
      6 => 'Illuminate\\Database\\DatabaseServiceProvider',
      7 => 'Illuminate\\Encryption\\EncryptionServiceProvider',
      8 => 'Illuminate\\Filesystem\\FilesystemServiceProvider',
      9 => 'Illuminate\\Foundation\\Providers\\FoundationServiceProvider',
      10 => 'Illuminate\\Hashing\\HashServiceProvider',
      11 => 'Illuminate\\Mail\\MailServiceProvider',
      12 => 'Illuminate\\Notifications\\NotificationServiceProvider',
      13 => 'Illuminate\\Pagination\\PaginationServiceProvider',
      14 => 'Illuminate\\Pipeline\\PipelineServiceProvider',
      15 => 'Illuminate\\Queue\\QueueServiceProvider',
      16 => 'Illuminate\\Redis\\RedisServiceProvider',
      17 => 'Illuminate\\Auth\\Passwords\\PasswordResetServiceProvider',
      18 => 'Illuminate\\Session\\SessionServiceProvider',
      19 => 'Illuminate\\Translation\\TranslationServiceProvider',
      20 => 'Illuminate\\Validation\\ValidationServiceProvider',
      21 => 'Illuminate\\View\\ViewServiceProvider',
      22 => 'Jenssegers\\Mongodb\\MongodbServiceProvider',
      23 => 'Arcanedev\\LogViewer\\LogViewerServiceProvider',
      24 => 'Mckenziearts\\Notify\\LaravelNotifyServiceProvider',
      25 => 'App\\Providers\\AppServiceProvider',
      26 => 'App\\Providers\\AuthServiceProvider',
      27 => 'App\\Providers\\BroadcastServiceProvider',
      28 => 'App\\Providers\\EventServiceProvider',
      29 => 'App\\Providers\\NovaServiceProvider',
      30 => 'App\\Providers\\RouteServiceProvider',
      31 => 'App\\Providers\\FortifyServiceProvider',
      32 => 'App\\Providers\\JetstreamServiceProvider',
    ),
    'aliases' => 
    array (
      'App' => 'Illuminate\\Support\\Facades\\App',
      'Arr' => 'Illuminate\\Support\\Arr',
      'Artisan' => 'Illuminate\\Support\\Facades\\Artisan',
      'Auth' => 'Illuminate\\Support\\Facades\\Auth',
      'Blade' => 'Illuminate\\Support\\Facades\\Blade',
      'Broadcast' => 'Illuminate\\Support\\Facades\\Broadcast',
      'Bus' => 'Illuminate\\Support\\Facades\\Bus',
      'Cache' => 'Illuminate\\Support\\Facades\\Cache',
      'Config' => 'Illuminate\\Support\\Facades\\Config',
      'Cookie' => 'Illuminate\\Support\\Facades\\Cookie',
      'Crypt' => 'Illuminate\\Support\\Facades\\Crypt',
      'Date' => 'Illuminate\\Support\\Facades\\Date',
      'DB' => 'Illuminate\\Support\\Facades\\DB',
      'Eloquent' => 'Illuminate\\Database\\Eloquent\\Model',
      'Event' => 'Illuminate\\Support\\Facades\\Event',
      'File' => 'Illuminate\\Support\\Facades\\File',
      'Gate' => 'Illuminate\\Support\\Facades\\Gate',
      'Hash' => 'Illuminate\\Support\\Facades\\Hash',
      'Http' => 'Illuminate\\Support\\Facades\\Http',
      'Lang' => 'Illuminate\\Support\\Facades\\Lang',
      'Log' => 'Illuminate\\Support\\Facades\\Log',
      'Mail' => 'Illuminate\\Support\\Facades\\Mail',
      'Notification' => 'Illuminate\\Support\\Facades\\Notification',
      'Password' => 'Illuminate\\Support\\Facades\\Password',
      'Queue' => 'Illuminate\\Support\\Facades\\Queue',
      'RateLimiter' => 'Illuminate\\Support\\Facades\\RateLimiter',
      'Redirect' => 'Illuminate\\Support\\Facades\\Redirect',
      'Redis' => 'Illuminate\\Support\\Facades\\Redis',
      'Request' => 'Illuminate\\Support\\Facades\\Request',
      'Response' => 'Illuminate\\Support\\Facades\\Response',
      'Route' => 'Illuminate\\Support\\Facades\\Route',
      'Schema' => 'Illuminate\\Support\\Facades\\Schema',
      'Session' => 'Illuminate\\Support\\Facades\\Session',
      'Storage' => 'Illuminate\\Support\\Facades\\Storage',
      'Str' => 'Illuminate\\Support\\Str',
      'URL' => 'Illuminate\\Support\\Facades\\URL',
      'Validator' => 'Illuminate\\Support\\Facades\\Validator',
      'View' => 'Illuminate\\Support\\Facades\\View',
    ),
  ),
  'auth' => 
  array (
    'defaults' => 
    array (
      'guard' => 'web',
      'passwords' => 'users',
    ),
    'guards' => 
    array (
      'web' => 
      array (
        'driver' => 'session',
        'provider' => 'users',
      ),
      'sanctum' => 
      array (
        'driver' => 'sanctum',
        'provider' => NULL,
      ),
    ),
    'providers' => 
    array (
      'users' => 
      array (
        'driver' => 'eloquent',
        'model' => 'App\\Models\\User',
      ),
    ),
    'passwords' => 
    array (
      'users' => 
      array (
        'provider' => 'users',
        'table' => 'password_resets',
        'expire' => 60,
        'throttle' => 60,
      ),
    ),
    'password_timeout' => 10800,
  ),
  'broadcasting' => 
  array (
    'default' => 'redis',
    'connections' => 
    array (
      'pusher' => 
      array (
        'driver' => 'pusher',
        'key' => '5f6d1ca2c4287d2c9410',
        'secret' => '22b48e34a66a89a94210',
        'app_id' => '1257671',
        'options' => 
        array (
          'cluster' => 'eu',
          'useTLS' => true,
        ),
      ),
      'ably' => 
      array (
        'driver' => 'ably',
        'key' => NULL,
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'default',
      ),
      'log' => 
      array (
        'driver' => 'log',
      ),
      'null' => 
      array (
        'driver' => 'null',
      ),
    ),
  ),
  'cache' => 
  array (
    'default' => 'redis',
    'stores' => 
    array (
      'apc' => 
      array (
        'driver' => 'apc',
      ),
      'array' => 
      array (
        'driver' => 'array',
        'serialize' => false,
      ),
      'database' => 
      array (
        'driver' => 'database',
        'table' => 'cache',
        'connection' => NULL,
        'lock_connection' => NULL,
      ),
      'file' => 
      array (
        'driver' => 'file',
        'path' => '/home/ploi/demo.bulk.bet/storage/framework/cache/data',
      ),
      'memcached' => 
      array (
        'driver' => 'memcached',
        'persistent_id' => NULL,
        'sasl' => 
        array (
          0 => NULL,
          1 => NULL,
        ),
        'options' => 
        array (
        ),
        'servers' => 
        array (
          0 => 
          array (
            'host' => '127.0.0.1',
            'port' => 11211,
            'weight' => 100,
          ),
        ),
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'cache',
        'lock_connection' => 'default',
      ),
      'dynamodb' => 
      array (
        'driver' => 'dynamodb',
        'key' => '',
        'secret' => '',
        'region' => 'us-east-1',
        'table' => 'cache',
        'endpoint' => NULL,
      ),
      'octane' => 
      array (
        'driver' => 'octane',
      ),
    ),
    'prefix' => 'bulkbet_cache',
  ),
  'cors' => 
  array (
    'paths' => 
    array (
      0 => 'api/*',
      1 => 'sanctum/csrf-cookie',
    ),
    'allowed_methods' => 
    array (
      0 => '*',
    ),
    'allowed_origins' => 
    array (
      0 => '*',
    ),
    'allowed_origins_patterns' => 
    array (
    ),
    'allowed_headers' => 
    array (
      0 => '*',
    ),
    'exposed_headers' => 
    array (
    ),
    'max_age' => 0,
    'supports_credentials' => false,
  ),
  'database' => 
  array (
    'default' => 'mongodb',
    'connections' => 
    array (
      'sqlite' => 
      array (
        'driver' => 'sqlite',
        'url' => NULL,
        'database' => 'bulkbet',
        'prefix' => '',
        'foreign_key_constraints' => true,
      ),
      'mongodb' => 
      array (
        'driver' => 'mongodb',
        'host' => '127.0.0.1',
        'port' => '29019',
        'database' => 'bulkbet',
        'username' => 'sSAw222akoklmNKL',
        'password' => 'pKSAOASJ290mfNn',
        'options' => 
        array (
          'database' => 'admin',
        ),
      ),
      'mysql' => 
      array (
        'driver' => 'mysql',
        'url' => NULL,
        'host' => '127.0.0.1',
        'port' => '29019',
        'database' => 'bulkbet',
        'username' => 'sSAw222akoklmNKL',
        'password' => 'pKSAOASJ290mfNn',
        'unix_socket' => '',
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'prefix_indexes' => true,
        'strict' => true,
        'engine' => NULL,
        'options' => 
        array (
        ),
      ),
      'pgsql' => 
      array (
        'driver' => 'pgsql',
        'url' => NULL,
        'host' => '127.0.0.1',
        'port' => '29019',
        'database' => 'bulkbet',
        'username' => 'sSAw222akoklmNKL',
        'password' => 'pKSAOASJ290mfNn',
        'charset' => 'utf8',
        'prefix' => '',
        'prefix_indexes' => true,
        'schema' => 'public',
        'sslmode' => 'prefer',
      ),
      'sqlsrv' => 
      array (
        'driver' => 'sqlsrv',
        'url' => NULL,
        'host' => '127.0.0.1',
        'port' => '29019',
        'database' => 'bulkbet',
        'username' => 'sSAw222akoklmNKL',
        'password' => 'pKSAOASJ290mfNn',
        'charset' => 'utf8',
        'prefix' => '',
        'prefix_indexes' => true,
      ),
    ),
    'migrations' => 'migrations',
    'redis' => 
    array (
      'client' => 'predis',
      'options' => 
      array (
        'cluster' => 'redis',
        'prefix' => 'bulkbet_database_',
      ),
      'default' => 
      array (
        'url' => NULL,
        'host' => '127.0.0.1',
        'password' => 'foobared',
        'port' => '6379',
        'database' => '0',
      ),
      'cache' => 
      array (
        'url' => NULL,
        'host' => '127.0.0.1',
        'password' => 'foobared',
        'port' => '6379',
        'database' => '1',
      ),
    ),
  ),
  'filesystems' => 
  array (
    'default' => 'local',
    'disks' => 
    array (
      'local' => 
      array (
        'driver' => 'local',
        'root' => '/home/ploi/demo.bulk.bet/storage/app',
      ),
      'public' => 
      array (
        'driver' => 'local',
        'root' => '/home/ploi/demo.bulk.bet/storage/app/public',
        'url' => '/storage',
        'visibility' => 'public',
      ),
      's3' => 
      array (
        'driver' => 's3',
        'key' => '',
        'secret' => '',
        'region' => 'us-east-1',
        'bucket' => '',
        'url' => NULL,
        'endpoint' => NULL,
        'use_path_style_endpoint' => false,
      ),
    ),
    'links' => 
    array (
      '/home/ploi/demo.bulk.bet/public/storage' => '/home/ploi/demo.bulk.bet/storage/app/public',
    ),
  ),
  'fortify-options' => 
  array (
    'two-factor-authentication' => 
    array (
      'confirmPassword' => true,
    ),
  ),
  'fortify' => 
  array (
    'guard' => 'web',
    'middleware' => 
    array (
      0 => 'web',
    ),
    'passwords' => 'users',
    'username' => 'identity',
    'email' => 'email',
    'views' => false,
    'home' => '/dashboard',
    'prefix' => '',
    'domain' => NULL,
    'limiters' => 
    array (
      'login' => 'login',
      'two-factor' => 'two-factor',
    ),
    'redirects' => 
    array (
      'login' => NULL,
      'logout' => NULL,
      'password-confirmation' => NULL,
      'register' => NULL,
      'email-verification' => NULL,
      'password-reset' => NULL,
    ),
    'features' => 
    array (
      0 => 'registration',
      1 => 'reset-passwords',
      2 => 'email-verification',
      3 => 'update-profile-information',
      4 => 'update-passwords',
      5 => 'two-factor-authentication',
    ),
  ),
  'hashing' => 
  array (
    'driver' => 'bcrypt',
    'bcrypt' => 
    array (
      'rounds' => 10,
    ),
    'argon' => 
    array (
      'memory' => 1024,
      'threads' => 2,
      'time' => 2,
    ),
  ),
  'jetstream' => 
  array (
    'stack' => 'livewire',
    'middleware' => 
    array (
      0 => 'web',
    ),
    'features' => 
    array (
      0 => 'terms',
      1 => 'profile-photos',
      2 => 'api',
    ),
    'profile_photo_disk' => 'public',
  ),
  'livewire' => 
  array (
    'class_namespace' => 'App\\Http\\Livewire',
    'view_path' => '/home/ploi/demo.bulk.bet/resources/views/livewire',
    'layout' => 'layouts.app',
    'asset_url' => 'https://demo.bulk.bet',
    'middleware_group' => 'web',
    'temporary_file_upload' => 
    array (
      'disk' => NULL,
      'rules' => NULL,
      'directory' => NULL,
      'middleware' => NULL,
      'preview_mimes' => 
      array (
        0 => 'png',
        1 => 'gif',
        2 => 'bmp',
        3 => 'svg',
        4 => 'wav',
        5 => 'mp4',
        6 => 'mov',
        7 => 'avi',
        8 => 'wmv',
        9 => 'mp3',
        10 => 'm4a',
        11 => 'jpg',
        12 => 'jpeg',
        13 => 'mpga',
        14 => 'webp',
        15 => 'wma',
      ),
      'max_upload_time' => 1,
    ),
    'manifest_path' => NULL,
  ),
  'livewire-notifier' => 
  array (
    'positionClass' => 'absolute top-3 right-2 z-50',
    'defaultMsgClass' => 'w-80 rounded-xl text-sm shadow-2xl',
    'duration' => 5000,
    'types' => 
    array (
      'success' => 
      array (
        'msgClass' => 'bg-green-200',
        'progressClass' => 'bg-green-500',
        'icon' => 'livewire-notifier::icons.success',
      ),
      'error' => 
      array (
        'msgClass' => 'bg-gradient-to-r from-red-200 to-red-300',
        'progressClass' => 'bg-red-500',
        'icon' => 'livewire-notifier::icons.error',
      ),
      'fail' => 
      array (
        'msgClass' => 'bg-gradient-to-r from-red-200 to-red-300',
        'progressClass' => 'bg-red-500',
        'icon' => 'livewire-notifier::icons.error',
      ),
      'warning' => 
      array (
        'msgClass' => 'bg-gradient-to-r from-yellow-200 to-yellow-300',
        'progressClass' => 'bg-yellow-500',
        'icon' => 'livewire-notifier::icons.error',
      ),
      'warn' => 
      array (
        'msgClass' => 'bg-gradient-to-r from-yellow-200 to-yellow-300',
        'progressClass' => 'bg-yellow-500',
        'icon' => 'livewire-notifier::icons.error',
      ),
      'info' => 
      array (
        'msgClass' => 'bg-gradient-to-r from-blue-200 to-blue-300',
        'progressClass' => 'bg-blue-500',
        'icon' => 'livewire-notifier::icons.info',
      ),
      'default' => 
      array (
        'msgClass' => 'bg-gradient-to-r from-gray-200 to-gray-300',
        'progressClass' => 'bg-gray-700',
        'icon' => 'livewire-notifier::icons.info',
      ),
    ),
  ),
  'log-viewer' => 
  array (
    'storage-path' => '/home/ploi/demo.bulk.bet/storage/logs',
    'pattern' => 
    array (
      'prefix' => 'laravel-',
      'date' => '[0-9][0-9][0-9][0-9]-[0-9][0-9]-[0-9][0-9]',
      'extension' => '.log',
    ),
    'locale' => 'auto',
    'theme' => 'bootstrap-4',
    'route' => 
    array (
      'enabled' => true,
      'attributes' => 
      array (
        'prefix' => 'logging-admin',
        'middleware' => NULL,
      ),
    ),
    'per-page' => 30,
    'download' => 
    array (
      'prefix' => 'laravel-',
      'extension' => 'log',
    ),
    'menu' => 
    array (
      'filter-route' => 'log-viewer::logs.filter',
      'icons-enabled' => true,
    ),
    'icons' => 
    array (
      'all' => 'fa fa-fw fa-list',
      'emergency' => 'fa fa-fw fa-bug',
      'alert' => 'fa fa-fw fa-bullhorn',
      'critical' => 'fa fa-fw fa-heartbeat',
      'error' => 'fa fa-fw fa-times-circle',
      'warning' => 'fa fa-fw fa-exclamation-triangle',
      'notice' => 'fa fa-fw fa-exclamation-circle',
      'info' => 'fa fa-fw fa-info-circle',
      'debug' => 'fa fa-fw fa-life-ring',
    ),
    'colors' => 
    array (
      'levels' => 
      array (
        'empty' => '#D1D1D1',
        'all' => '#8A8A8A',
        'emergency' => '#B71C1C',
        'alert' => '#D32F2F',
        'critical' => '#F44336',
        'error' => '#FF5722',
        'warning' => '#FF9100',
        'notice' => '#4CAF50',
        'info' => '#1976D2',
        'debug' => '#90CAF9',
      ),
    ),
    'highlight' => 
    array (
      0 => '^#\\d+',
      1 => '^Stack trace:',
    ),
  ),
  'logging' => 
  array (
    'default' => 'daily',
    'channels' => 
    array (
      'stack' => 
      array (
        'driver' => 'stack',
        'channels' => 
        array (
          0 => 'single',
        ),
        'ignore_exceptions' => false,
      ),
      'single' => 
      array (
        'driver' => 'single',
        'path' => '/home/ploi/demo.bulk.bet/storage/logs/laravel.log',
        'level' => 'debug',
      ),
      'daily' => 
      array (
        'driver' => 'daily',
        'path' => '/home/ploi/demo.bulk.bet/storage/logs/laravel.log',
        'level' => 'debug',
        'days' => 14,
      ),
      'slack' => 
      array (
        'driver' => 'slack',
        'url' => NULL,
        'username' => 'Laravel Log',
        'emoji' => ':boom:',
        'level' => 'debug',
      ),
      'papertrail' => 
      array (
        'driver' => 'monolog',
        'level' => 'debug',
        'handler' => 'Monolog\\Handler\\SyslogUdpHandler',
        'handler_with' => 
        array (
          'host' => NULL,
          'port' => NULL,
        ),
      ),
      'stderr' => 
      array (
        'driver' => 'monolog',
        'level' => 'debug',
        'handler' => 'Monolog\\Handler\\StreamHandler',
        'formatter' => NULL,
        'with' => 
        array (
          'stream' => 'php://stderr',
        ),
      ),
      'syslog' => 
      array (
        'driver' => 'syslog',
        'level' => 'debug',
      ),
      'errorlog' => 
      array (
        'driver' => 'errorlog',
        'level' => 'debug',
      ),
      'null' => 
      array (
        'driver' => 'monolog',
        'handler' => 'Monolog\\Handler\\NullHandler',
      ),
      'emergency' => 
      array (
        'path' => '/home/ploi/demo.bulk.bet/storage/logs/laravel.log',
      ),
    ),
  ),
  'mail' => 
  array (
    'default' => 'smtp',
    'mailers' => 
    array (
      'smtp' => 
      array (
        'transport' => 'smtp',
        'host' => 'smtp.eu.mailgun.org',
        'port' => '587',
        'encryption' => 'tls',
        'username' => 'postmaster@mailer.apigamble.com',
        'password' => '34ef5ad8f01b9bc7e823893c36f32c82-156db0f1-1e7aed36',
        'timeout' => NULL,
        'auth_mode' => NULL,
      ),
      'ses' => 
      array (
        'transport' => 'ses',
      ),
      'mailgun' => 
      array (
        'transport' => 'mailgun',
      ),
      'postmark' => 
      array (
        'transport' => 'postmark',
      ),
      'sendmail' => 
      array (
        'transport' => 'sendmail',
        'path' => '/usr/sbin/sendmail -bs',
      ),
      'log' => 
      array (
        'transport' => 'log',
        'channel' => NULL,
      ),
      'array' => 
      array (
        'transport' => 'array',
      ),
      'failover' => 
      array (
        'transport' => 'failover',
        'mailers' => 
        array (
          0 => 'smtp',
          1 => 'log',
        ),
      ),
    ),
    'from' => 
    array (
      'address' => 'postmaster@mailer.apigamble.com',
      'name' => 'Bulkbet',
    ),
    'markdown' => 
    array (
      'theme' => 'default',
      'paths' => 
      array (
        0 => '/home/ploi/demo.bulk.bet/resources/views/vendor/mail',
      ),
    ),
  ),
  'notify' => 
  array (
    'theme' => 'light',
    'demo' => true,
    'timeout' => 2,
    'preset-messages' => 
    array (
      'user-updated' => 
      array (
        'message' => 'The user has been updated successfully.',
        'type' => 'success',
        'model' => 'connect',
        'title' => 'User Updated',
      ),
    ),
  ),
  'nova' => 
  array (
    'name' => 'Bulkbet',
    'domain' => NULL,
    'url' => 'https://demo.bulk.bet',
    'path' => '/nova',
    'guard' => NULL,
    'passwords' => NULL,
    'middleware' => 
    array (
      0 => 'web',
      1 => 'Laravel\\Nova\\Http\\Middleware\\Authenticate',
      2 => 'Laravel\\Nova\\Http\\Middleware\\DispatchServingNovaEvent',
      3 => 'Laravel\\Nova\\Http\\Middleware\\BootTools',
      4 => 'Laravel\\Nova\\Http\\Middleware\\Authorize',
    ),
    'pagination' => 'simple',
    'actions' => 
    array (
      'resource' => 'Laravel\\Nova\\Actions\\ActionResource',
    ),
    'currency' => 'USD',
  ),
  'permission' => 
  array (
    'models' => 
    array (
      'permission' => 'Maklad\\Permission\\Models\\Permission',
      'role' => 'Maklad\\Permission\\Models\\Role',
    ),
    'collection_names' => 
    array (
      'roles' => 'roles',
      'permissions' => 'permissions',
    ),
    'cache_expiration_time' => 1440,
    'log_registration_exception' => true,
    'display_permission_in_exception' => false,
  ),
  'queue' => 
  array (
    'default' => 'redis',
    'connections' => 
    array (
      'sync' => 
      array (
        'driver' => 'sync',
      ),
      'database' => 
      array (
        'driver' => 'database',
        'table' => 'jobs',
        'queue' => 'default',
        'retry_after' => 90,
        'after_commit' => false,
      ),
      'beanstalkd' => 
      array (
        'driver' => 'beanstalkd',
        'host' => 'localhost',
        'queue' => 'default',
        'retry_after' => 90,
        'block_for' => 0,
        'after_commit' => false,
      ),
      'sqs' => 
      array (
        'driver' => 'sqs',
        'key' => '',
        'secret' => '',
        'prefix' => 'https://sqs.us-east-1.amazonaws.com/your-account-id',
        'queue' => 'default',
        'suffix' => NULL,
        'region' => 'us-east-1',
        'after_commit' => false,
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'default',
        'queue' => 'default',
        'retry_after' => 90,
        'block_for' => NULL,
        'after_commit' => false,
      ),
    ),
    'failed' => 
    array (
      'driver' => NULL,
      'database' => 'mongodb',
      'table' => 'failed_jobs',
    ),
  ),
  'sanctum' => 
  array (
    'stateful' => 
    array (
      0 => 'localhost',
      1 => 'localhost:3000',
      2 => '127.0.0.1',
      3 => '127.0.0.1:8000',
      4 => '::1',
      5 => 'demo.bulk.bet',
    ),
    'expiration' => NULL,
    'middleware' => 
    array (
      'verify_csrf_token' => 'App\\Http\\Middleware\\VerifyCsrfToken',
      'encrypt_cookies' => 'App\\Http\\Middleware\\EncryptCookies',
    ),
  ),
  'services' => 
  array (
    'mailgun' => 
    array (
      'domain' => NULL,
      'secret' => NULL,
      'endpoint' => 'api.mailgun.net',
    ),
    'postmark' => 
    array (
      'token' => NULL,
    ),
    'ses' => 
    array (
      'key' => '',
      'secret' => '',
      'region' => 'us-east-1',
    ),
  ),
  'session' => 
  array (
    'driver' => 'redis',
    'lifetime' => '3600',
    'expire_on_close' => false,
    'encrypt' => false,
    'files' => '/home/ploi/demo.bulk.bet/storage/framework/sessions',
    'connection' => NULL,
    'table' => 'sessions',
    'store' => NULL,
    'lottery' => 
    array (
      0 => 2,
      1 => 100,
    ),
    'cookie' => 'bulkbet_session',
    'path' => '/',
    'domain' => NULL,
    'secure' => NULL,
    'http_only' => false,
    'same_site' => 'lax',
  ),
  'view' => 
  array (
    'paths' => 
    array (
      0 => '/home/ploi/demo.bulk.bet/resources/views',
    ),
    'compiled' => '/home/ploi/demo.bulk.bet/storage/framework/views',
  ),
  'wireui' => 
  array (
    'icons' => 
    array (
      'style' => 'outline',
    ),
    'modal' => 
    array (
      'zIndex' => 'z-50',
      'maxWidth' => '2xl',
      'spacing' => 'p-4',
      'align' => 'start',
      'blur' => false,
    ),
  ),
  'flare' => 
  array (
    'key' => NULL,
    'reporting' => 
    array (
      'anonymize_ips' => true,
      'collect_git_information' => false,
      'report_queries' => true,
      'maximum_number_of_collected_queries' => 200,
      'report_query_bindings' => true,
      'report_view_data' => true,
      'grouping_type' => NULL,
      'report_logs' => true,
      'maximum_number_of_collected_logs' => 200,
      'censor_request_body_fields' => 
      array (
        0 => 'password',
      ),
    ),
    'send_logs_as_events' => true,
    'censor_request_body_fields' => 
    array (
      0 => 'password',
    ),
  ),
  'ignition' => 
  array (
    'editor' => 'phpstorm',
    'theme' => 'light',
    'enable_share_button' => true,
    'register_commands' => false,
    'ignored_solution_providers' => 
    array (
      0 => 'Facade\\Ignition\\SolutionProviders\\MissingPackageSolutionProvider',
    ),
    'enable_runnable_solutions' => NULL,
    'remote_sites_path' => '',
    'local_sites_path' => '',
    'housekeeping_endpoint_prefix' => '_ignition',
  ),
  'trustedproxy' => 
  array (
    'proxies' => NULL,
    'headers' => 94,
  ),
  'livewire-flash' => 
  array (
    'views' => 
    array (
      'container' => 'livewire-flash::livewire.flash-container',
      'message' => 'livewire-flash::livewire.flash-message',
      'overlay' => 'livewire-flash::livewire.flash-overlay',
    ),
    'styles' => 
    array (
      'info' => 
      array (
        'bg-color' => 'bg-blue-100',
        'border-color' => 'border-blue-400',
        'icon-color' => 'text-blue-400',
        'text-color' => 'text-blue-800',
        'icon' => 'fas fa-info-circle',
      ),
      'success' => 
      array (
        'bg-color' => 'bg-green-100',
        'border-color' => 'border-green-400',
        'icon-color' => 'text-green-400',
        'text-color' => 'text-green-800',
        'icon' => 'fas fa-check',
      ),
      'warning' => 
      array (
        'bg-color' => 'bg-yellow-100',
        'border-color' => 'border-yellow-400',
        'icon-color' => 'text-yellow-400',
        'text-color' => 'text-yellow-800',
        'icon' => 'fas fa-exclamation-circle',
      ),
      'error' => 
      array (
        'bg-color' => 'bg-red-100',
        'border-color' => 'border-red-400',
        'icon-color' => 'text-red-400',
        'text-color' => 'text-red-800',
        'icon' => 'fas fa-exclamation-triangle',
      ),
      'overlay' => 
      array (
        'overly-bg-color' => 'bg-gray-500',
        'overlay-bg-opacity' => 'opacity-75',
        'title-text-color' => 'text-gray-900',
        'body-text-color' => 'text-gray-500',
        'button-border-color' => 'border-transparent',
        'button-bg-color' => 'bg-indigo-600',
        'button-text-color' => 'text-white',
        'button-hover-bg-color' => 'hover:bg-indigo-700',
        'button-hover-text-color' => 'hover:text-white',
        'button-focus-ring-color' => 'focus:ring-indigo-500',
        'button-extra-classes' => '',
        'button-text' => 'Close',
      ),
    ),
  ),
  'jwt' => 
  array (
    'secret' => NULL,
    'keys' => 
    array (
      'public' => NULL,
      'private' => NULL,
      'passphrase' => NULL,
    ),
    'ttl' => 60,
    'refresh_ttl' => 20160,
    'algo' => 'HS256',
    'required_claims' => 
    array (
      0 => 'iss',
      1 => 'iat',
      2 => 'exp',
      3 => 'nbf',
      4 => 'sub',
      5 => 'jti',
    ),
    'persistent_claims' => 
    array (
    ),
    'lock_subject' => true,
    'leeway' => 0,
    'blacklist_enabled' => true,
    'blacklist_grace_period' => 0,
    'decrypt_cookies' => false,
    'providers' => 
    array (
      'jwt' => 'Tymon\\JWTAuth\\Providers\\JWT\\Lcobucci',
      'auth' => 'Tymon\\JWTAuth\\Providers\\Auth\\Illuminate',
      'storage' => 'Tymon\\JWTAuth\\Providers\\Storage\\Illuminate',
    ),
  ),
  'tinker' => 
  array (
    'commands' => 
    array (
    ),
    'alias' => 
    array (
    ),
    'dont_alias' => 
    array (
      0 => 'App\\Nova',
    ),
  ),
);
