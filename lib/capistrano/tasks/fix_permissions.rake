namespace :deploy do
    desc "Set Laravel storage directory world-writable."
    task :fix_permissions do
        on release_roles :all do
            execute :sudo, :chmod, '-R 0777', current_path.join('app/storage')
            execute :sudo, :chown, '-R nginx:nginx', current_path.join('app/storage');
            execute :sudo, :chown, '-R nginx:nginx', current_path.join('app/storage/meta');
        end
    end

    desc "Set some directory chown"
    task :fix_cleanup do
        on release_roles :all do
            execute :sudo, :chown, '-R ec2-user:ec2-user', releases_path
        end
    end
end
