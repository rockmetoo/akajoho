namespace :supervisord do
  %w(start stop restart).each do |task_name|
    desc "#{task } Supervisord"
    task task_name do
      on roles(:app), in: :sequence, wait: 5 do
        sudo "/etc/init.d/supervisord #{task_name}"
      end
    end
  end
end
