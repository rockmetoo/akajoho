namespace :php_fpm do
  def restart_php_fpm
    execute :sudo, '/etc/init.d/php-fpm restart'
  end

  desc "Reload PHP-FPM (requires sudo access to systemctl)."
  task :restart do
    on release_roles :all do
      restart_php_fpm
    end
  end
end
