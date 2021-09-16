<?php return array (
  'arcanedev/log-viewer' => 
  array (
    'providers' => 
    array (
      0 => 'Arcanedev\\LogViewer\\LogViewerServiceProvider',
      1 => 'Arcanedev\\LogViewer\\Providers\\DeferredServicesProvider',
    ),
  ),
  'backpack/backupmanager' => 
  array (
    'providers' => 
    array (
      0 => 'Backpack\\BackupManager\\BackupManagerServiceProvider',
    ),
  ),
  'backpack/crud' => 
  array (
    'providers' => 
    array (
      0 => 'Backpack\\CRUD\\BackpackServiceProvider',
    ),
    'aliases' => 
    array (
      'CRUD' => 'Backpack\\CRUD\\app\\Library\\CrudPanel\\CrudPanelFacade',
      'Widget' => 'Backpack\\CRUD\\app\\Library\\Widget',
    ),
  ),
  'backpack/logmanager' => 
  array (
    'providers' => 
    array (
      0 => 'Backpack\\LogManager\\LogManagerServiceProvider',
    ),
  ),
  'backpack/permissionmanager' => 
  array (
    'providers' => 
    array (
      0 => 'Backpack\\PermissionManager\\PermissionManagerServiceProvider',
    ),
  ),
  'barryvdh/laravel-ide-helper' => 
  array (
    'providers' => 
    array (
      0 => 'Barryvdh\\LaravelIdeHelper\\IdeHelperServiceProvider',
    ),
  ),
  'codespb/livewire-notifier' => 
  array (
    'providers' => 
    array (
      0 => 'CodeSPB\\LivewireNotifier\\LivewireNotifierServiceProvider',
    ),
    'aliases' => 
    array (
      'LivewireNotifier' => 'CodeSPB\\LivewireNotifier\\Facades\\LaravelLivewireNotifier',
    ),
  ),
  'creativeorange/gravatar' => 
  array (
    'providers' => 
    array (
      0 => 'Creativeorange\\Gravatar\\GravatarServiceProvider',
    ),
    'aliases' => 
    array (
      'Gravatar' => 'Creativeorange\\Gravatar\\Facades\\Gravatar',
    ),
  ),
  'eduardoarandah/usermanager' => 
  array (
    'providers' => 
    array (
      0 => 'EduardoArandaH\\UserManager\\UserManagerServiceProvider',
    ),
  ),
  'facade/ignition' => 
  array (
    'providers' => 
    array (
      0 => 'Facade\\Ignition\\IgnitionServiceProvider',
    ),
    'aliases' => 
    array (
      'Flare' => 'Facade\\Ignition\\Facades\\Flare',
    ),
  ),
  'fideloper/proxy' => 
  array (
    'providers' => 
    array (
      0 => 'Fideloper\\Proxy\\TrustedProxyServiceProvider',
    ),
  ),
  'fruitcake/laravel-cors' => 
  array (
    'providers' => 
    array (
      0 => 'Fruitcake\\Cors\\CorsServiceProvider',
    ),
  ),
  'jenssegers/agent' => 
  array (
    'providers' => 
    array (
      0 => 'Jenssegers\\Agent\\AgentServiceProvider',
    ),
    'aliases' => 
    array (
      'Agent' => 'Jenssegers\\Agent\\Facades\\Agent',
    ),
  ),
  'jenssegers/mongodb' => 
  array (
    'providers' => 
    array (
      0 => 'Jenssegers\\Mongodb\\MongodbServiceProvider',
      1 => 'Jenssegers\\Mongodb\\MongodbQueueServiceProvider',
    ),
  ),
  'laravel/fortify' => 
  array (
    'providers' => 
    array (
      0 => 'Laravel\\Fortify\\FortifyServiceProvider',
    ),
  ),
  'laravel/jetstream' => 
  array (
    'providers' => 
    array (
      0 => 'Laravel\\Jetstream\\JetstreamServiceProvider',
    ),
  ),
  'laravel/sail' => 
  array (
    'providers' => 
    array (
      0 => 'Laravel\\Sail\\SailServiceProvider',
    ),
  ),
  'laravel/sanctum' => 
  array (
    'providers' => 
    array (
      0 => 'Laravel\\Sanctum\\SanctumServiceProvider',
    ),
  ),
  'laravel/tinker' => 
  array (
    'providers' => 
    array (
      0 => 'Laravel\\Tinker\\TinkerServiceProvider',
    ),
  ),
  'livewire/livewire' => 
  array (
    'providers' => 
    array (
      0 => 'Livewire\\LivewireServiceProvider',
    ),
    'aliases' => 
    array (
      'Livewire' => 'Livewire\\Livewire',
    ),
  ),
  'mattlibera/livewire-flash' => 
  array (
    'providers' => 
    array (
      0 => 'MattLibera\\LivewireFlash\\LivewireFlashServiceProvider',
    ),
    'aliases' => 
    array (
      'LivewireFlash' => 'MattLibera\\LivewireFlash\\LivewireFlash',
    ),
  ),
  'mckenziearts/laravel-notify' => 
  array (
    'providers' => 
    array (
      0 => 'Mckenziearts\\Notify\\LaravelNotifyServiceProvider',
    ),
    'aliases' => 
    array (
      'Notify' => 'Mckenziearts\\Notify\\Facades\\LaravelNotify',
    ),
  ),
  'mostafamaklad/laravel-permission-mongodb' => 
  array (
    'providers' => 
    array (
      0 => 'Maklad\\Permission\\PermissionServiceProvider',
    ),
  ),
  'nesbot/carbon' => 
  array (
    'providers' => 
    array (
      0 => 'Carbon\\Laravel\\ServiceProvider',
    ),
  ),
  'nunomaduro/collision' => 
  array (
    'providers' => 
    array (
      0 => 'NunoMaduro\\Collision\\Adapters\\Laravel\\CollisionServiceProvider',
    ),
  ),
  'ph7jack/wireui' => 
  array (
    'providers' => 
    array (
      0 => 'WireUi\\Providers\\WireUiServiceProvider',
    ),
    'aliases' => 
    array (
    ),
  ),
  'prologue/alerts' => 
  array (
    'providers' => 
    array (
      0 => 'Prologue\\Alerts\\AlertsServiceProvider',
    ),
    'aliases' => 
    array (
      'Alert' => 'Prologue\\Alerts\\Facades\\Alert',
    ),
  ),
  'spatie/laravel-backup' => 
  array (
    'providers' => 
    array (
      0 => 'Spatie\\Backup\\BackupServiceProvider',
    ),
  ),
  'spatie/laravel-permission' => 
  array (
    'providers' => 
    array (
      0 => 'Spatie\\Permission\\PermissionServiceProvider',
    ),
  ),
  'tymon/jwt-auth' => 
  array (
    'aliases' => 
    array (
      'JWTAuth' => 'Tymon\\JWTAuth\\Facades\\JWTAuth',
      'JWTFactory' => 'Tymon\\JWTAuth\\Facades\\JWTFactory',
    ),
    'providers' => 
    array (
      0 => 'Tymon\\JWTAuth\\Providers\\LaravelServiceProvider',
    ),
  ),
);