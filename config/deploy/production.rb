# Simple Role Syntax
# ==================
# Supports bulk-adding hosts to roles, the primary server in each group
# is considered to be the first unless any hosts have the primary
# property set.  Don't declare `role :all`, it's a meta role.

role :app, %w{52.68.204.24}
set :user, "ec2-user"
set :branch, 'master'

set :composer_install_flags, '--prefer-source --no-interaction'

server '52.68.204.24:22', user: 'ec2-user', roles: %w[app web db],
    ssh_options: {
        keys: [File.expand_path('~/.ssh/rockmetoou_aws.key')],
        forward_agent: true,
        auth_methods: %w(publickey)
    }

