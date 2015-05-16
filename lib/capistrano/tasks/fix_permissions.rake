namespace :deploy do
    desc "Set Laravel storage directory world-writable."
    task :fix_permissions do
        on release_roles :all do
            execute :sudo, :chmod, '-R 0777', current_path.join('app/storage')
            execute :sudo, :chown, '-R nginx.nginx', current_path.join('app/storage');
            execute :sudo, :chown, '-R nginx.nginx', current_path.join('app/storage/meta');
            #execute :sudo, :chown, 'nginx:nginx', current_path.join('app/storage/meta/services.json');
            execute :sudo, :mkdir, '-p ', current_path.join('public/uploadFiles');
            execute :sudo, :mkdir, '-p ', current_path.join('public/uploadFiles/realProfilePic');
            execute :sudo, :mkdir, '-p ', current_path.join('public/uploadFiles/tmpProfilePic');
            execute :sudo, :chown, '-R nginx.nginx', current_path.join('public/uploadFiles');
            execute :sudo, :chown, '-R nginx.nginx', current_path.join('public/uploadFiles/realProfilePic');
            execute :sudo, :chown, '-R nginx.nginx', current_path.join('public/uploadFiles/tmpProfilePic');
            execute :sudo, :chmod, '-R 0777', current_path.join('public/uploadFiles');
        end
    end

    desc "Set some directory chown"
    task :fix_cleanup do
        on release_roles :all do
            execute :sudo, :chown, '-R ec2-user:ec2-user', releases_path
            execute :sudo, :chown, 'ec2-user:ec2-user', deploy_to
        end
    end
end
