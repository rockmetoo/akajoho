# Load DSL and Setup Up Stages
require 'capistrano/setup'

# keep some files/directories untouched
require 'capistrano/linked_files'

# Includes default deployment tasks
require 'capistrano/deploy'

require 'capistrano/composer'

# Loads custom tasks from `lib/capistrano/tasks' if you have any defined.
Dir.glob('lib/capistrano/tasks/*.rake').each { |r| import r }
Dir.glob('lib/capistrano/**/*.rb').each { |r| import r }
