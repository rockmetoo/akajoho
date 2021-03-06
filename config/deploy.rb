# config valid only for current version of Capistrano
lock '3.4.0'

set :application, 'akazoho'
set :repo_url, 'git@github.com:rockmetoo/akazoho.git'

# Default value for :scm is :git
set :scm, :git

# Default branch is :master
# ask :branch, proc { `git rev-parse --abbrev-ref HEAD`.chomp }.call

# Default deploy_to directory is /var/www/my_app
set :deploy_to, '/var/www/akazoho'
set :deploy_via, :remote_cache
set :use_sudo, true
set :pty, true
set :copy_exclude, [".git", ".gitignore", ".tags", ".tags_sorted_by_file", "Capfile", "apiary.apib"]
set :keep_releases, 4

# keep uploadFiles directory untouched
set :linked_dirs, %w(public/uploadFiles)

namespace :laravel do
    desc "Optimize Laravel Class Loader"
    task :optimize do
        on roles(:web), in: :sequence, wait: 5 do
            within release_path  do
                execute :php, "artisan clear-compiled"
                execute :php, "artisan optimize"
            end
        end
    end
end

namespace :deploy do
    Rake::Task["deploy:check:directories"].clear
    
    namespace :check do
        desc '(overwrite) Check shared and release directories exist'
        task :directories do
            on release_roles :all do
                execute :sudo, :mkdir, '-pv', shared_path, releases_path
                execute :sudo, :chown, '-R', "#{fetch(:user)}:#{fetch(:group)}", deploy_to
            end
        end
    end
    
    before :finishing, 'linked_files:upload_dirs'
    
    after :cleanup, 'deploy:fix_cleanup'
    after :finishing, 'deploy:fix_permissions'
    after :finishing, 'laravel:optimize'
    
    # nginx is run by supervisord
    after :finishing, 'supervisord:restart'
    after :finishing, 'nginx:stop'
    after :finishing, 'php_fpm:restart'
end